<?php

/**
 * This is the model class for table "baby_teeth".
 *
 * The followings are the available columns in table 'baby_teeth':
 * @property string $id
 * @property string $baby_id
 * @property string $tooth_1
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Babies $baby
 */
class BabyTooth extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'baby_teeth';
    }


    public function rules()
    {
		return array(

            array('tooth_1,tooth_2,tooth_3,tooth_4,tooth_5,tooth_6,tooth_7,tooth_8,tooth_9,tooth_10,tooth_11,tooth_12,tooth_13,
            tooth_14,tooth_15,tooth_16,tooth_17,tooth_18,tooth_19,tooth_20', 'DateValidator', 'beforeToday' => true),

			array('id, baby_id, tooth_num, date', 'safe', 'on' => 'search'),
		);
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
            'tooth_1' => 'Центральный резец',
            'tooth_2' => 'Центральный резец',
            'tooth_3' => 'Боковой резец',
            'tooth_4' => 'Боковой резец',
            'tooth_5' => 'Клык',
            'tooth_6' => 'Клык',
            'tooth_7' => 'Первый моляр',
            'tooth_8' => 'Первый моляр',
            'tooth_9' => 'Второй моляр',
            'tooth_10' => 'Второй моляр',
            'tooth_11' => 'Второй моляр',
            'tooth_12' => 'Второй моляр',
            'tooth_13' => 'Первый моляр',
            'tooth_14' => 'Первый моляр',
            'tooth_15' => 'Клык',
            'tooth_16' => 'Клык',
            'tooth_17' => 'Боковой резец',
            'tooth_18' => 'Боковой резец',
            'tooth_19' => 'Центральный резец',
            'tooth_20' => 'Центральный резец',
        );
    }

    public function afterFind()
    {
        for($i = 1; $i <= 20; $i++)
        {
            $param = 'tooth_'.$i;
            $this->$param = $this->$param === null || $this->$param == '0000-00-00'  ? '' : date('d.m.Y', strtotime($this->$param));
        }

    }

}