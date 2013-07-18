<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $baby_id
 * @property string $email
 * @property string $hash
 *
 */

class UserInvite extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user_invites';
    }

    public static function  exist($baby_id, $email)
    {
        return self::model()->findByAttributes(array(
            'baby_id' => $baby_id,
            'email' => $email
        )) != null;
    }

    public static function saveInvite($baby_id, $email)
    {
        $hash = uniqid();

        $invite = new self();
        $invite->hash = $hash;
        $invite->baby_id = $baby_id;
        $invite->email = $email;
        $invite->save();

        return $invite;

    }

}