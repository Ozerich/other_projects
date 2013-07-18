<?php

/**
 * This is the model class for table "baby_vaccinations".
 *
 * The followings are the available columns in table 'baby_vaccinations':
 * @property string $id
 * @property string $baby_id
 * @property string $date
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Babies $baby
 */
class BabyVaccination extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'baby_vaccinations';
	}

	public function rules()
	{
		return array(
			array('date, name', 'required'),
			array('name', 'length', 'max'=>100),
            array('date', 'DateValidator', 'beforeToday' => true),
			array('description', 'safe'),

			array('id, baby_id, date, name, description', 'safe', 'on'=>'search'),
		);
	}

    public function afterFind()
    {
        $this->date = date('d.m.Y', strtotime($this->date));
    }


    public function relations()
	{
		return array(
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'baby_id' => 'Baby',
			'date' => 'Дата',
			'name' => 'Название',
			'description' => 'Описание',
		);
	}

}