<?php

/**
 * This is the model class for table "photoalbums".
 *
 * The followings are the available columns in table 'photoalbums':
 * @property string $id
 * @property string $baby_id
 * @property string $title
 * @property string $photo
 * @property string $description
 *
 * The followings are the available model relations:
 * @property PhotoAlbumPhotos[] $photoalbumPhotoses
 * @property Babies $baby
 */
class PhotoAlbum extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'photoalbums';
	}


	public function rules()
	{
		return array(
			array('title, description', 'required'),

			array('title', 'length', 'max'=>255),

            array('photo', 'file', 'types' => 'jpg, gif, png, bmp', 'allowEmpty' => true),

			array('photo, description', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{

		return array(
			'photos' => array(self::HAS_MANY, 'PhotoAlbumPhoto', 'photoalbum_id'),
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'baby_id' => 'Baby',
			'title' => 'Название фотоальбома',
			'photo' => 'Обложка альбома',
			'description' => 'Описание альбома',
		);
	}

    public function getPhoto()
    {
        return empty($this->photo) ? '' : Yii::app()->params['upload_gallery_dir'] . $this->photo;
    }

}