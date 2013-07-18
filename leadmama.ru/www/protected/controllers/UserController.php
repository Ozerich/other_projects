<?php

class UserController extends Controller
{
    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions'=>array('captcha'),
                'users'=>array('*'),
            ),
        );
    }

    public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
            ),
        );
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionLogin()
    {
        $model = new LoginForm;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->homeUrl);
        }

        $this->render('login', array('model' => $model));
    }

    public function actionRegister($invite = '')
    {
        $model = new User('register');

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'register_form') {
                echo CActiveForm::validate($model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['User'])) {


            if ($model->save()) {
                $this->uploadFile($model, 'avatar', 'avatar', Yii::app()->params['upload_user_dir']);

                $invite = $_POST['invite'];

                if (!empty($invite)) {

                    $invite = UserInvite::model()->findByAttributes(array(
                        'hash' => $invite
                    ));

                    if (!$invite) {
                        $this->redirect('/');
                    }

                    $invites = UserInvite::model()->findAllByAttributes(array(
                        'email' => $invite->email
                    ));

                    foreach ($invites as $invite) {
                        UserOpenBaby::add($model->id, $invite->baby_id);
                        $invite->delete();
                    }
                }

                $identity = new UserIdentity($_POST['User']['email'], $_POST['User']['password']);
                $identity->authenticate();

                Yii::app()->user->login($identity);

                $this->redirect(Yii::app()->homeUrl);
            }

        }


        $this->render('register', array('model' => $model, 'invite' => $invite));
    }

    public function actionMedicine_info()
    {
        $model = Yii::app()->user->getBaby();

        if (isset($_POST['Baby'])) {
            $model->attributes = $_POST['Baby'];
            if ($model->save(false)) {
                $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        }

        $this->renderPartial('//health/_medicine_form', array('model' => $model));
    }


    public function actionOpen_access()
    {
        $result = array(
            'is_error' => false,
            'message' => ''
        );

        $baby_id = Yii::app()->user->getBaby()->id;

        if (isset($_POST['email'])) {

            $validator = new CEmailValidator;
            if (!$validator->validateValue($_POST['email'])) {
                $result['is_error'] = true;
                $result['message'] = 'Неправильный формат e-mail';
            } else {
                $user = User::model()->findByAttributes(array('email' => $_POST['email']));
                if ($user) {
                    $result['is_error'] = true;
                    $result['message'] = 'Пользователь с таким емейлом уже существует. Его логин: <b>' . $user->login . "</b>";
                } else {
                    if (UserInvite::exist($baby_id, $_POST['email'])) {
                        $result['is_error'] = true;
                        $result['message'] = 'Вы уже приглашали данного пользователя';
                    } else {
                        $invite = UserInvite::saveInvite($baby_id, $_POST['email']);

                        $message = new YiiMailMessage;

                        $message->subject = 'Вам был открыт доступ';
                        $message->view = 'baby_invite';
                        $message->from = 'info@leadmama.ru';
                        $message->to = $_POST['email'];

                        $message->setBody(array(
                                'user_name' => Yii::app()->user->model()->login,
                                'baby_name' => Yii::app()->user->getBaby()->name,
                                'url' => '/register/invite/' . $invite->hash,
                            ),
                            'text/html');

                        Yii::app()->mail->send($message);

                        $result['is_error'] = false;
                        $result['message'] = 'Электронное письмо с приглашением было отправлено';
                    }
                }
            }

        } else if (isset($_POST['login'])) {

            $user = User::model()->findByAttributes(array('login' => $_POST['login']));
			if(!$user){
				$user = User::model()->findByAttributes(array('email' => $_POST['login']));
			}

            if (!$user) {
                $result['is_error'] = true;
                $result['message'] = 'Пользователь не найден';
            } else if ($user->id == Yii::app()->user->id) {
                $result['is_error'] = true;
                $result['message'] = 'Вы не можете открыть доступ себе';
            } else {
                if (UserOpenBaby::check($user->id, $baby_id)) {
                    $result['is_error'] = true;
                    $result['message'] = 'У этого пользователя уже есть доступ к просмотру ребенка';
                } else {
                    UserOpenBaby::add($user->id, $baby_id);
                    $result['error'] = false;
                    $result['message'] = 'Доступ пользователю открыт';
                }
            }
        }


        echo json_encode($result);
        Yii::app()->end();
    }
	
	public function actionRestore($code = ''){
	
	
		if(empty($code)){
			$email = Yii::app()->request->getPost('email');
			$response = array();
			
			
			$model = User::model()->findByAttributes(array('email' => $email));
			
			if($model)
			{
			
				$model->restore_code = md5(uniqid());
				$model->save();
			
				$message = new YiiMailMessage;

				$message->subject = 'Новый пароль';
				$message->view = 'restore_password';
				$message->from = Yii::app()->params['email_admin'];
				$message->to = $model->email;

				$message->setBody(array(
					'model' => $model,
					'password' => $password,
				), 'text/html');

				Yii::app()->mail->send($message);
				
				

			}							

			Yii::app()->end();
		}
		else{
			
			$user = User::model()->findByAttributes(array('restore_code' => $code));
			if(!$user){
				throw new CHttpException(404);
			}
			
			if(Yii::app()->request->isPostRequest){
				$password = Yii::app()->request->getPost('password');
				
				$user->password = $user->hashPassword($password);
				$user->save();
				
				
				die;
			}

			
			$this->render('new_password', array('user' => $user));
			
		}
	}
}