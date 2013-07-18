<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property string $id
 * @property string $alias
 * @property string $title
 * @property string $text
 * @property string $meta_keywords
 * @property string $meta_description
 */
class Page extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pages';
    }

    public function rules()
    {
        return array(
            array('alias, title, text', 'required'),
            array('alias, title, meta_keywords', 'length', 'max' => 255),
            array('meta_description, sidebar', 'safe'),

            array('id, alias, title, text, meta_keywords, meta_description', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'alias' => 'URL алиас',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'sidebar' => 'Сайдбар справа',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
        );
    }


    public function getLink()
    {
        return '/page/' . $this->alias;
    }
}