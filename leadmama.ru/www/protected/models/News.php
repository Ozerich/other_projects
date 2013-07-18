<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property string $id
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $date
 */
class News extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return array(
            array('title, text, date', 'required'),
            array('title', 'length', 'max' => 255),
            array('image', 'file', 'types' => 'jpg, gif, png, bmp', 'allowEmpty' => true),

            array('date', 'DateValidator', 'beforeToday' => true),

            array('id, title, text, image, date', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'date' => 'Дата новости',
            'title' => 'Заголовок',
            'text' => 'Содержание',
            'image' => 'Картинка',
        );
    }

    public function afterFind()
    {
        $this->date = date('d.m.Y', strtotime($this->date));
    }

    public function getLink()
    {
        return '/news/'.$this->id;
    }

    public function getImage()
    {
        return empty($this->image) ? '' : Yii::app()->params['upload_news_dir'] . $this->image;
    }

	public function defaultScope(){
        return array(
            'order' => 'date desc',
        );      
 

	}
}