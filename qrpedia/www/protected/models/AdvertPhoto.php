<?php

class AdvertPhoto extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'advert_photos';
    }

    public $url;

    public function rules()
    {
        return array(
            array('advert_id, file', 'required'),
            array('advert_id', 'numerical', 'integerOnly' => true),
            array('file', 'length', 'max' => 20),
            array('label', 'length', 'max' => 255),

            array('id, advert_id, file, label', 'safe', 'on' => 'search'),
        );
    }


    public function relations()
    {
        return array(
            'advert'=>array(self::BELONGS_TO, 'Advert', 'advert_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'advert_id' => 'Advert',
            'file' => 'File',
            'label' => 'Label',
        );
    }


    public function afterFind()
    {
        $this->url = $this->file ? Yii::app()->baseUrl . Yii::app()->params['upload_dir'] . $this->file : '';
    }

}