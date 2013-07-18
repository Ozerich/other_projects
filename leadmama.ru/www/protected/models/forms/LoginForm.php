<?php

class LoginForm extends CFormModel
{
    public $email;
    public $password;
	
	public $remember;

    private $_identity;

    public function rules()
    {
        return array(
            array('email, password', 'required'),
			array('remember', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'E-mail пользователя',
            'password' => 'Пароль',
			'remember' => 'Запомнить',
        );
    }

    public function authenticate($attribute, $params)
    {
        $this->_identity = new UserIdentity($this->email, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', 'Неправильный пароль');
    }

    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
		
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->remember ? 3600 * 24 * 30 : 0;
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
   
    }
}
