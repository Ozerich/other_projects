<?php

/**
 * This is the model class for table "diary".
 *
 * The followings are the available columns in table 'diary':
 * @property string $id
 * @property string $baby_id
 * @property string $date
 * @property string $title
 * @property string $text
 * @property string $milestones
 * @property string $photo
 * @property string $custom_milestone
 *
 * The followings are the available model relations:
 * @property Babies $baby
 * @property DiaryComments[] $diaryComments
 */
class Diary extends CActiveRecord
{

    public $milestones_text = array();

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'diary';
	}

	public function rules()
	{
		return array(
			array('date, title, text', 'required'),
			array('title', 'length', 'max'=>255),

            array('photo', 'file', 'types' => 'jpg, gif, png, bmp', 'allowEmpty' => true),

            array('date', 'DateValidator', 'beforeToday' => true),

            array('milestones, custom_milestone', 'safe'),


			array('id, baby_id, date, title, text, photo, custom_milestone', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
			'comments' => array(self::HAS_MANY, 'DiaryComment', 'diary_id'),
		);
	}

    public function afterFind()
    {
        $this->date = date('d.m.Y', strtotime($this->date));

        $this->milestones_text = array();

        if(!empty($this->milestones))
        {
            $milestones = explode(',', $this->milestones);
            if(!empty($milestones))
            {
                foreach($milestones as $milestone_id)
                {
                    $milestone = DiaryMilestone::model()->findByPk($milestone_id);
                    $this->milestones_text[] = $milestone->name;
                }
            }
        }

    }

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'baby_id' => 'Baby',
			'date' => 'Дата',
			'title' => 'Название',
			'text' => 'Описание',
			'photo' => 'Фото',
		);
	}

    public static function get($baby_id = 0)
    {
        return self::model()->findAllByAttributes(array('baby_id' => $baby_id));
    }

    public function getPhoto()
    {
        return empty($this->photo) ? '' : Yii::app()->params['upload_diary_dir'] . $this->photo;
    }

    public function getDateCount()
    {

        $date1 = new DateTime($this->baby->birth_date);
        $date2 = new DateTime($this->date);

        $interval = $date1->diff($date2);

        $res =  array(
            'days' => $interval->d,
            'months' => $interval->m,
            'years' => $interval->y
        );

        return $res;
    }

    public function defaultScope(){
        return array(
            'order' => 'date DESC'
        );
    }
}