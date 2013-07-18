<?php

/**
 * This is the model class for table "diary_comments".
 *
 * The followings are the available columns in table 'diary_comments':
 * @property string $id
 * @property string $diary_id
 * @property string $user_id
 * @property string $text
 * @property string $datetime
 *
 * The followings are the available model relations:
 * @property Diary $diary
 * @property Users $user
 */
class DiaryComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiaryComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'diary_comments';
	}

	public function rules()
	{

		return array(
			array('text', 'required'),

            array('datetime','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
			array('id, diary_id, user_id, text, datetime', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
			'diary' => array(self::BELONGS_TO, 'Diary', 'diary_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

    public function afterFind()
    {
        $this->datetime = date('H:i d.m.Y', strtotime($this->datetime));
    }

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'diary_id' => 'Diary',
			'user_id' => 'User',
			'text' => 'Комментарий',
			'datetime' => 'Datetime',
		);
	}

}