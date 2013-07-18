<?php

class Package extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'packages';
    }

    public $types_text;

    public function rules()
    {
        return array(
            array('name, count, types, days, price', 'required'),
            array('count, days, price', 'numerical', 'integerOnly' => true),
            array('name, types', 'length', 'max' => 255),

            array('id, name, count, types, days, price', 'safe', 'on' => 'search'),
        );
    }


    public function afterFind()
    {
        $types_all = explode(',', $this->types);
        $types = array();
        $types_data = Yii::app()->user->model()->form == 'physical' ? Advert::$physical_types : Advert::$legal_types;

        foreach ($types_all as $type) {
            $type = trim($type);
            if (isset($types_data[$type])) {
                $types[] = $types_data[$type];
            }
        }

        $this->types_text = implode(', ', $types);
    }

}