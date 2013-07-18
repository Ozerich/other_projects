<?php

class GrowthController extends BaseBabyController
{
	public function __construct($action){
		$this->active_tab = 'growth';
		parent::__construct($action);
	}
	
    public function actionWeight($baby_id = 0)
    {
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


        $this->is_guest = Yii::app()->user->getBaby()->id != $baby->id;
		
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}

        $model = new BabyWeight();

        if (isset($_POST['BabyWeight'])) {
            $model->attributes = $_POST['BabyWeight'];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'weight_form') {
                echo CActiveForm::validate($model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['BabyWeight'])) {
            $model->baby_id = Yii::app()->user->getBaby()->id;
            if ($model->save()) {
                $this->redirect('/weight/');
            }
        }

        $this->list_tabs = array(
            array(
                'link' => '/weight/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Вес',
                'active' => true
            ), array(
                'link' => '/height/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Рост',
                'active' => false
            ), array(
                'link' => '/teeth/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Зубы',
                'active' => false
            )
        );
        $this->render('weight', array('baby_id' => $baby_id ? $baby_id : 0, 'model' => $model, 'is_guest' => $this->is_guest));
    }

    public function actionHeight($baby_id = 0)
    {
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


        $this->is_guest = Yii::app()->user->getBaby()->id != $baby->id;
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}

        $model = new BabyHeight();

        if (isset($_POST['BabyHeight'])) {
            $model->attributes = $_POST['BabyHeight'];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'height_form') {
                echo CActiveForm::validate($model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['BabyHeight'])) {
            $model->baby_id = Yii::app()->user->getBaby()->id;
            if ($model->save()) {
                $this->redirect('/height/');
            }
        }

        $this->list_tabs = array(
            array(
                'link' => '/weight/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Вес',
                'active' => false
            ), array(
                'link' => '/height/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Рост',
                'active' => true
            ), array(
                'link' => '/teeth/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Зубы',
                'active' => false
            )
        );

        $this->render('height', array('baby_id' => $baby_id ? $baby_id : 0, 'model' => $model, 'is_guest' => $this->is_guest));
    }


    public function actionTeeth($baby_id = 0)
    {

        $baby = $baby_id == 0 ? Yii::app()->user->getBaby() : Baby::model()->findByPk($baby_id);
		$this->baby = $baby;
        if (!$baby) {
            if ($baby_id == 0) {
                $this->render('//no_baby');
                return;
            }
            throw new CHttpException(404);
        }


        $this->is_guest = Yii::app()->user->getBaby()->id != $baby->id;
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}

        $model = BabyTooth::model()->findByAttributes(array('baby_id' => $baby->id));

        if (!$this->is_guest) {

            if (!$model) {
                $model = new BabyTooth();
                $model->baby_id = Yii::app()->user->getBaby()->id;
                $model->save();
            }

            if (isset($_POST['BabyTooth'])) {
                $model->attributes = $_POST['BabyTooth'];
            }

            if (isset($_POST['ajax'])) {
                if ($_POST['ajax'] == 'teeth_form') {
                    echo CActiveForm::validate($model);
                }

                Yii::app()->end();
            }

            if (isset($_POST['BabyTooth'])) {
                $model->baby_id = Yii::app()->user->getBaby()->id;
                if ($model->save()) {
                    $this->redirect('/teeth/');
                }
            }
        }

        $this->list_tabs = array(
            array(
                'link' => '/weight/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Вес',
                'active' => false
            ), array(
                'link' => '/height/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Рост',
                'active' => false
            ), array(
                'link' => '/teeth/' . ($this->is_guest ? $baby_id : ''),
                'label' => 'Зубы',
                'active' => true
            )
        );

        $this->render('teeth', array('model' => $model, 'is_guest' => $this->is_guest));
    }

    public function actionTooth($num = 0)
    {
        $model = BabyTooth::model()->findByAttributes(array('baby_id' => Yii::app()->user->getBaby()->id));

        if (!$model) {
            throw new CHttpException(404, "Access denied");
        }

        $param = 'tooth_' . $num;
        if (isset($_POST['BabyTooth'])) {
            $model->$param = $_POST['BabyTooth'][$param];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'tooth_form') {
                echo CActiveForm::validate($model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['BabyTooth'])) {
            if ($model->save()) {
                $this->redirect('/teeth/');
            }
        }

		$this->baby = Baby::model()->findByPk($model->baby_id); 

        $this->renderPartial('_tooth_form', array('model' => $model, 'param' => $param, 'num' => $num));
    }


    public function actionIndex()
    {
        $this->redirect('/weight/');
    }

    public function actionChart($type, $baby_id = 0)
    {
        if ($type != 'height' && $type != 'weight') {
            throw new CHttpException(404, "Access denied");
        }

        $data = array();
        $label = '';

        if ($type == 'height') {
            $data = BabyHeight::model()->findAllByAttributes(array(
                'baby_id' => $baby_id ? $baby_id : Yii::app()->user->getBaby()->id
            ));
            $label = 'Рост';
        } else if ($type == 'weight') {
            $data = BabyWeight::model()->findAllByAttributes(array(
                'baby_id' => $baby_id ? $baby_id : Yii::app()->user->getBaby()->id
            ));
            $label = 'Вес';
        }

        $months = array();
        $values = array();

        foreach ($data as $item) {
            $months[] = $item->month;
            $values[] = floatval($item->value);
        }

        echo json_encode(array(
            'months' => $months,
            'values' => $values,
            'label' => $label,
			'param' => $type == 'weight' ? 'кг.' : 'cм.',
			'axisTitles' => array(
				'y' => $type == 'weight' ? 'кг.' : 'cм.',
				'x' => 'месяцы',
			),
        ));
        Yii::app()->end();
    }
}