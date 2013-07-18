<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $user_id
 * @property string $baby_id
 *
 */

class UserOpenBaby extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_open_babies';
    }

    public static function check($user_id, $baby_id)
    {
        return self::model()->exists('user_id = ? AND baby_id = ?', array($user_id, $baby_id));
    }

    public static function add($user_id, $baby_id)
    {
        $item = new self();
        $item->user_id = $user_id;
        $item->baby_id = $baby_id;
        return $item->save();
    }
}