<?php

class Admin extends UserModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'admins';
	}

	public function rules()
	{
		return array(
			array('id, email, password, salt', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('email, password, salt', 'length', 'max'=>255),

			array('id, email, password, salt', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'salt' => 'Salt',
		);
	}

}