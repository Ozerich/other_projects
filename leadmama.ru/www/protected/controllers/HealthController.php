<?php

class HealthController extends BaseBabyController
{
	public function __construct($action){
		$this->active_tab = 'health';
		parent::__construct($action);
	}
	
    public function beforeAction($action)
    {

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->redirect('/medicine/');
    }

    public function actionMedicine($id = '')
    {
        $this->list_tabs[0]['active'] = true;

        if (!$_POST) {

            $baby = $id ? Baby::model()->findByPk($id) : Yii::app()->user->getBaby();

            if (!$baby) {
                if (!$id) {
                    $this->list_tabs = array();
                    $this->render('//no_baby');
                    return;
                }
                throw new CHttpException(404);
            }


        } else {
            $baby = Yii::app()->user->getBaby();
        }
		
		
		$this->baby = $baby;

        $this->is_guest = $baby->id != Yii::app()->user->getBaby()->id;
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}
		
        $records = BabyMedicalRecord::model()->findAllByAttributes(array('baby_id' => $baby->id));
        $vaccinations = BabyVaccination::model()->findAllByAttributes(array('baby_id' => $baby->id));

        $record_model = new BabyMedicalRecord();
        $vaccination_model = new BabyVaccination();

        if (!$this->is_guest) {

            if (isset($_POST['BabyMedicalRecord'])) {
                $record_model = $id ? BabyMedicalRecord::model()->findByPk($id) : new BabyMedicalRecord();
                $record_model->attributes = $_POST['BabyMedicalRecord'];
            }

            if (isset($_POST['BabyVaccination'])) {
                $vaccination_model = $id ? BabyVaccination::model()->findByPk($id) : new BabyVaccination();
                $vaccination_model->attributes = $_POST['BabyVaccination'];
            }

            if (isset($_POST['ajax'])) {

                if ($_POST['ajax'] == 'record_form') {
                    echo CActiveForm::validate($record_model);
                } else if ($_POST['ajax'] == 'vaccination_form') {
                    echo CActiveForm::validate($vaccination_model);
                }

                Yii::app()->end();
            }

            if (isset($_POST['BabyMedicalRecord'])) {
                $record_model->baby_id = Yii::app()->user->getBaby()->id;
                if ($record_model->save()) {
                    $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
                }
            }

            if (isset($_POST['BabyVaccination'])) {
                $vaccination_model->baby_id = Yii::app()->user->getBaby()->id;
                if ($vaccination_model->save()) {
                    $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
                }
            }
        }

        $this->list_tabs = array(
            array(
                'link' => '/medicine/' . ($this->is_guest ? $id : ''),
                'label' => 'Медицинские записи',
                'active' => true
            ), array(
                'link' => '/feeding/' . ($this->is_guest ? $id : ''),
                'label' => 'Кормление',
                'active' => false
            )
        );

        $this->render('medicine', array(
            'records' => $records,
            'vaccinations' => $vaccinations,
            'record_model' => $record_model,
            'vaccination_model' => $vaccination_model,
            'is_guest' => $this->is_guest
        ));
    }

    public function actionDelete_record($id = 0)
    {
        $item = BabyMedicalRecord::model()->findByPk($id);
        if (!$item) {
            throw new CHttpException(404, "Access denied");
        }

        $item->delete();
        $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    }

    public function actionEdit_record($id = 0)
    {
        $model = BabyMedicalRecord::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, "Access denied");
        }

        if (isset($_POST['BabyMedicalRecord'])) {
            $model->attributes = $_POST['BabyMedicalRecord'];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'record_form') {
                echo CActiveForm::validate($model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['BabyMedicalRecord'])) {
            $model->baby_id = Yii::app()->user->getBaby()->id;
            if ($model->save()) {
                $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        }

        $this->renderPartial('_record_form', array('model' => $model));
    }


    public function actionDelete_vaccination($id = 0)
    {
        $item = BabyVaccination::model()->findByPk($id);
        if (!$item) {
            throw new CHttpException(404, "Access denied");
        }

        $item->delete();
        $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    }

    public function actionEdit_vaccination($id = 0)
    {
        $model = BabyVaccination::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, "Access denied");
        }

        if (isset($_POST['BabyVaccination'])) {
            $model->attributes = $_POST['BabyVaccination'];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'vaccination_form') {
                echo CActiveForm::validate($model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['BabyVaccination'])) {
            $model->baby_id = Yii::app()->user->getBaby()->id;
            if ($model->save()) {
                $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        }

        $this->renderPartial('_vaccination_form', array('model' => $model));
    }


    public function actionFeeding($baby_id = 0)
    {
        $this->list_tabs[1]['active'] = true;

        $baby = $baby_id == 0 ? Yii::app()->user->getBaby() : Baby::model()->findByPk($baby_id);
		$this->baby = $baby;
		
        if (!$baby) {
            if ($baby_id == 0) {
                $this->list_tabs = array();
                $this->render('//no_baby');
                return;
            }
            throw new CHttpException(404);
        }

        $this->is_guest = $baby->id != Yii::app()->user->getBaby()->id;

        $items = BabyFeed::model()->findAllByAttributes(array('baby_id' => $baby->id));


        $this->list_tabs = array(
            array(
                'link' => '/medicine/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Медицинские записи',
                'active' => false
            ), array(
                'link' => '/feeding/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Кормление',
                'active' => true
            )
        );

        $this->render('feeding', array('items' => $items, 'model' =>     new BabyFeed(), 'is_guest' => $this->is_guest));
    }

    public function actionDelete_feeding($id = 0)
    {
        $item = BabyFeed::model()->findByPk($id);
        if (!$item) {
            throw new CHttpException(404, "Access denied");
        }

        $item->delete();
        $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    }

    public function actionEdit_feeding($id = 0)
    {

        $model = $id ? BabyFeed::model()->findByPk($id) : new BabyFeed();

        if ($_POST) {
            if (isset($_POST['BabyFeed'])) {
                $model->attributes = $_POST['BabyFeed'];
            }

            if (isset($_POST['ajax'])) {
                if ($_POST['ajax'] == 'feeding_form') {
                    echo CActiveForm::validate($model);
                }

                Yii::app()->end();
            }

            if (isset($_POST['BabyFeed'])) {
                $model->baby_id = Yii::app()->user->getBaby()->id;
                if ($model->save()) {
                    $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
                }
            }
        }


        $this->renderPartial('_feeding_form', array('model' => $model));
    }


}