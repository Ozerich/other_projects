<?php

/**
 * This is the model class for table "baby_feeds".
 *
 * The followings are the available columns in table 'baby_feeds':
 * @property string $id
 * @property string $baby_id
 * @property string $date
 * @property string $text
 *
 * The followings are the available model relations:
 * @property Babies $baby
 */
class BabyFeed extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'baby_feeds';
	}


	public function rules()
	{

		return array(
			array('date, text', 'required'),
            array('date', 'DateValidator', 'beforeToday' => true),

			array('id, baby_id, date, text', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{

		return array(
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
		);
	}

    public function afterFind()
    {
        $this->date = date('d.m.Y', strtotime($this->date));
    }

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'baby_id' => 'Baby',
			'date' => 'Дата',
			'text' => 'Текст',
		);
	}

}