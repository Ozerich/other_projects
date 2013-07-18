<?php

class UserModel extends CActiveRecord
{
    public static function getRandomPassword()
    {
        return rand() % 1000000 + 1000000;
    }

    public function validatePassword($password)
    {
        return crypt($password, $this->salt) === $this->password;
    }

    public function hashPassword($password)
    {
        return crypt($password, $this->salt);
    }

    public function generateSalt($cost = 10)
    {
        if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
            throw new CException('Cost parameter must be between 4 and 31.');
        }
        $rand = '';
        for ($i = 0; $i < 8; ++$i)
            $rand .= pack('S', mt_rand(0, 0xffff));
        $rand .= microtime();
        $rand = sha1($rand, true);
        $salt = '$2a$' . str_pad((int)$cost, 2, '0', STR_PAD_RIGHT) . '$';
        $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
        return $salt;
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->salt = $this->generateSalt();
        }

        return parent::beforeValidate();
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->password = $this->hashPassword($this->password);
        }

        return parent::beforeSave();
    }
}
