<?php

/**
 * This is the model class for table "baby_heights".
 *
 * The followings are the available columns in table 'baby_heights':
 * @property string $id
 * @property string $baby_id
 * @property integer $month
 * @property double $value
 *
 * The followings are the available model relations:
 * @property Babies $baby
 */
class BabyHeight extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'baby_heights';
    }


    public function rules()
    {
        return array(
            array('month, value', 'required'),
            array('month', 'numerical', 'integerOnly' => true),
            array('value', 'numerical'),

            array('id, baby_id, month, value', 'safe', 'on' => 'search'),
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
            'month' => 'Месяц',
            'value' => 'Рост (см)',
        );
    }


    public static function getTextMonths()
    {
        $result = array();

        for ($i = 1; $i <= 48; $i++) {
            $result[$i] = $i . ' месяц';
        }

        return $result;
    }

    public function defaultScope()
    {
        return array(
            'order' => 'month ASC'
        );
    }

    public function afterValidate()
    {
        $exist = self::model()->findByAttributes(array(
            'baby_id' => $this->baby_id,
            'month' => $this->month
        ));

        if ($exist) {
            $this->id = $exist->id;
            $this->setIsNewRecord(false);
        }
    }

}