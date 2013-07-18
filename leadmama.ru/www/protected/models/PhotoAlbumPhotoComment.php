<?php

/**
 * This is the model class for table "photoalbum_photos_comments".
 *
 * The followings are the available columns in table 'photoalbum_photos_comments':
 * @property string $id
 * @property string $photoalbum_photo_id
 * @property string $user_id
 * @property string $datetime
 * @property string $text
 *
 * The followings are the available model relations:
 * @property PhotoalbumPhotos $photoalbumPhoto
 * @property Users $user
 */
class PhotoAlbumPhotoComment extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'photoalbum_photos_comments';
    }

    public function rules()
    {
        return array(
            array('text', 'required'),

            array('datetime', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'),

            array('id, photoalbum_photo_id, user_id, datetime, text', 'safe', 'on' => 'search'),
        );
    }


    public function relations()
    {
        return array(
            'photo' => array(self::BELONGS_TO, 'PhotoAlbumPhoto', 'photoalbum_photo_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'text' => 'Комментарий',
        );
    }

    public function afterFind()
    {
        $this->datetime = date('d.m.Y H:i', strtotime($this->datetime));
    }
}