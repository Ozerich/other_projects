<?php

class AuthController extends Controller
{
    public $layout = 'none';

    public function actionLogin()
    {
        $this->layout = 'none';
        if ($_POST) {
            $email = Yii::app()->request->getPost('email');
            $password = Yii::app()->request->getPost('password');

            $identity = new UserIdentity($email, $password);
            $identity->authenticate();
            $identity->setState('isAdmin', $identity->isAdmin);

            $result = array(
                'success' => false,
                'url' => '',
            );
            if ($identity->errorCode === UserIdentity::ERROR_NONE) {
                Yii::app()->user->login($identity);
                $result = array(
                    'success' => true,
                    'url' => $identity->isAdmin ? '/companies' : '/adverts'
                );
            }

            echo json_encode($result);
            Yii::app()->end();
        } else {
            $this->render('login');
        }
    }

    public function actionRegister()
    {
        $company = new Company();

        if ($_POST) {

            $company->attributes = $_POST['Company'];

            if (isset($_POST['ajax'])) {
                if (isset($_POST['ajax']) == 'register_form') {
                    echo CActiveForm::validate($company);
                    Yii::app()->end();
                }
            }
            $company->balance = 10000;
            if ($company->save()) {
                $this->redirect('/');
            }

        } else {
            throw new CHttpException(404);
        }
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRestore($code = '')
    {
        if ($_POST) {
            $email = Yii::app()->request->getPost('email');
            $company = Company::model()->findByAttributes(array('email' => $email));
            if (!$company) {
                echo '0';
                Yii::app()->end();
            }

            $company->restore_code = md5(uniqid());
            $company->save();


            $message = new YiiMailMessage;

            $message->subject = 'Новый пароль';
            $message->view = 'restore_password';
            $message->from = Yii::app()->params['from_email'];
            $message->to = $company->email;

            $message->setBody(array('company' => $company), 'text/html');

            Yii::app()->mail->send($message);

            echo '1';
            Yii::app()->end();

        }

        $company = Company::model()->findByAttributes(array('restore_code' => $code));
        if (!$company) {
            throw new CHttpException(404);
        }

        $password = Company::getRandomPassword();

        $company->restore_code = '';
        $company->salt = $company->generateSalt();
        $company->password = $company->hashPassword($password);
        $company->save();

        $message = new YiiMailMessage;

        $message->subject = 'Новый пароль';
        $message->view = 'new_password';
        $message->from = Yii::app()->params['from_email'];
        $message->to = $company->email;

        $message->setBody(array('company' => $company, 'password' => $password), 'text/html');

        Yii::app()->mail->send($message);
        $this->redirect('/');
    }
}