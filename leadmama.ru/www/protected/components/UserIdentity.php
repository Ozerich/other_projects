<?php


class UserIdentity extends CUserIdentity
{
    public $email;
    public $password;

    private $_id;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function authenticate()
    {
        $record = User::model()->findByAttributes(array('email' => $this->email));
        if ($record === null){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if (!$record->validatePassword($this->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else {
            $this->_id = $record->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}