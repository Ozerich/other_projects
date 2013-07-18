<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $user_id
 * @property string $photoalbum_photo_id
 *
 * The followings are the available model relations:
 * @property PhotoAlbumPhoto $photo
 * @property User $user
 */
class UserLike extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_likes';
    }


    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'photo' => array(self::HAS_MANY, 'PhotoAlbumPhoto', 'photoalbum_photo_id'),
        );
    }

    public static function like($user_id, $photo_id)
    {
        $exist = self::model()->countByAttributes(array(
            'user_id' => $user_id,
            'photoalbum_photo_id' => $photo_id
        ));

        if ($exist) {
            return FALSE;
        }

        $like = new self();

        $like->user_id = $user_id;
        $like->photoalbum_photo_id = $photo_id;

        return $like->save();
    }

}