<?php

class BabyController extends BaseBabyController
{
    public $layout = 'user';
	
	public function __construct($action){
		$this->active_tab = 'baby';
		parent::__construct($action);
	}

    public function actionIndex($firstday = false, $baby_id = 0)
    {
        $baby = $baby_id ? Baby::model()->findByPk($baby_id) : Yii::app()->user->getBaby();
        if (!$baby) {
            if ($baby_id == 0) {
                $this->render('//no_baby');
                return;
            }
            throw new CHttpException(404);
        }

        if (!$baby) {
            throw new CHttpException(404);
        }

        $this->is_guest = $baby->id != Yii::app()->user->getBaby()->id;
		
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}


        if (!$this->is_guest) {

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'baby_form') {
                echo CActiveForm::validate($baby);
                Yii::app()->end();
            }

            if (isset($_POST['Baby'])) {
                $baby->attributes = $_POST['Baby'];
                if ($baby->save()) {
                    $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
                }
            }
        }

        $this->list_tabs = array(
            array(
                'link' => '/baby/' . ($this->is_guest ? $baby->id : ''),
                'label' => 'О малыше',
                'active' => true
            ), array(
                'link' => '/baby/' . ($this->is_guest ? $baby->id . '/' : '') . 'firstday',
                'label' => 'Первый день',
                'active' => false
            )
        );

        if ($firstday) {
            $this->list_tabs[0]['active'] = false;
            $this->list_tabs[1]['active'] = true;
        }
		
		$this->baby = $baby;

        $this->render($firstday ? 'first_day' : 'index', array('model' => $baby, 'is_guest' => $this->is_guest));
    }

    public function actionUpdate()
    {
		if(Yii::app()->user->isGuest){
			$this->redirect('/register');
		}
        unset($this->list_tabs);

        $user = Yii::app()->user->model();
        $baby = $user->baby ? $user->baby : new Baby();

        if (isset($_POST['Baby'])) {

            $baby->attributes = $_POST['Baby'];
            $baby->user_id = $user->id;

            if ($baby->save()) {
                $this->uploadFile($baby, 'photo', 'photo', Yii::app()->params['upload_baby_dir']);
                $this->redirect('/baby/');
            }


        }

        $this->render('update', array('model' => $baby));
    }

    public function actionUpdatePhoto()
    {
        $model = Yii::app()->user->getBaby();

        if (isset($_POST['Baby'])) {
            $this->uploadPhoto($model, 'photo', 'photo', Yii::app()->params['upload_baby_dir']);
            $this->redirect('/');
        }
    }

}