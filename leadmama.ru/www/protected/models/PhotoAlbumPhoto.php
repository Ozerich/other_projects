<?php

/**
 * This is the model class for table "photoalbum_photos".
 *
 * The followings are the available columns in table 'photoalbum_photos':
 * @property string $id
 * @property string $photoalbum_id
 * @property string $photo
 * @property string $likes
 *
 * The followings are the available model relations:
 * @property Photoalbums $photoalbum
 */
class PhotoAlbumPhoto extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

		public function tableName()
	{
		return 'photoalbum_photos';
	}

	public function rules()
	{
		return array(
            array('photo', 'file', 'types' => 'jpg, gif, png, bmp', 'allowEmpty' => true),
		);
	}

	public function relations()
	{
		return array(
			'photoalbum' => array(self::BELONGS_TO, 'PhotoAlbum', 'photoalbum_id'),
            'comments' => array(self::HAS_MANY, "PhotoAlbumPhotoComment", "photoalbum_photo_id")
		);
	}

	public function attributeLabels()
	{
		return array(
			'photo' => 'Фотография',
		);
	}

    public function getPhoto()
    {
        return empty($this->photo) ? '' : Yii::app()->params['upload_gallery_dir'] . $this->photo;
    }
}