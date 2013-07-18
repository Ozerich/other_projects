<?php

class CalendarController extends BaseBabyController
{
	public function __construct($action){
		$this->active_tab = 'calendar';
		parent::__construct($action);
	}
	
    public function actionIndex($baby_id = 0)
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

        $this->is_guest = $baby->id != Yii::app()->user->getBaby()->id;
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}

        if($_POST && isset($_POST['type']))
        {
            $type = $_POST['type'];
            $this->redirect('/'.$type.'/');
        }
        $events = array();
        for ($i = 1; $i <= 48; $i++) {
            $events[$i] = array();
        }


        $heights = BabyHeight::model()->findAllByAttributes(array('baby_id' => $baby->id));
        if (!empty($heights)) {
            foreach ($heights as $height) {
                $events[$height->month][] = 'Я вырос на ' . $height->value . ' см!';
            }
        }

        $weights = BabyWeight::model()->findAllByAttributes(array('baby_id' => $baby->id));
        if (!empty($weights)) {
            foreach ($weights as $weight) {
                $events[$weight->month][] = 'Я вырос на ' . $weight->value . ' кг!';
            }
        }

        $teeth = BabyTooth::model()->findByAttributes(array('baby_id' => $baby->id));
        if ($teeth) {
            for ($i = 1; $i < 20; $i++) {

                $param = 'tooth_' . $i;
                $value = $teeth->$param;
                if (!$value) continue;

                $diff = abs(strtotime($value) - strtotime($baby->birth_date));

                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                $month = $months + $years * 12;
                $events[$month][] = 'Вырос зуб';
            }
        }

        $this->render('index', array('events' => $events, 'is_guest' => $this->is_guest));
    }

}