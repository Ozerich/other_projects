<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $login
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $birth_date
 * @property string $fio
 * @property string $phone
 * @property string $register_date
 * @property string $avatar
 * @property string $is_admin
 *
 * The followings are the available model relations:
 * @property Babies[] $babies
 * @property DiaryComments[] $diaryComments
 */
class User extends CActiveRecord
{
	public $need_update_password = false;
	
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'users';
    }
	
	public static $types = array(
		'1' => 'Я буду вести дневник моего малыша и читать дневники друзей',
		'0' => 'Я буду только читать дневники друзей'
	);

    public $password2;

    public $verifyCode;

    public function rules()
    {
        return array(
            array('login, password, email, fio, salt, type', 'required'),
            array('login, avatar', 'length', 'max' => 50),
            array('login, email', 'unique', 'on' => 'insert'),
            array('email, fio', 'length', 'max' => 255),
            array('email', 'email'),
            array('phone', 'length', 'max' => 100),

			array('restore_code', 'safe'),
			
            array('password', 'required', 'on' => 'register'),
            array('password2', 'compare', 'compareAttribute' => 'password', 'on' => 'register'),
            array('password', 'length', 'max' => 64, 'min' => 6, 'on' => 'register'),
            array('register_date', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'register'),

            array('verifyCode', 'captcha', 'allowEmpty' => false, 'on' => 'register'),

            array('avatar', 'file', 'types' => 'jpg, gif, png, bmp', 'allowEmpty' => true),

            array('birth_date', 'safe'),

            array('id, login, password, email, birth_date, fio, phone, register_date, avatar, is_admin', 'safe', 'on' => 'search'),

        );

    }

    public function relations()
    {
        return array(
            'baby' => array(self::HAS_ONE, 'Baby', 'user_id'),
            'diaryComments' => array(self::HAS_MANY, 'DiaryComment', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'password2' => 'Повторите пароль',
            'email' => 'E-mail',
            'birth_date' => 'Дата рождения',
            'fio' => 'Ваше ФИО',
            'phone' => 'Телефон',
            'register_date' => 'Дата регистрации',
            'avatar' => 'Фотография',
            'verifyCode' => 'Проверочный код',
			'type' => 'Цель регистрации'
        );
    }


    public function validatePassword($password)
    {
        return crypt($password, $this->salt) === $this->password;
    }

    public function hashPassword($password)
    {
        return crypt($password, $this->salt);
    }

    protected function generateSalt($cost = 10)
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
	
	public static function getRandomPassword()
    {
        return rand() % 1000000 + 1000000;
    }

    public function beforeValidate()
    {

        if ($this->isNewRecord || $this->need_update_password) {
            $this->salt = $this->generateSalt();
        }

        return parent::beforeValidate();
    }


    public function beforeSave()
    {
        if ($this->isNewRecord || $this->need_update_password) {
            $this->password = $this->hashPassword($this->password);
        }
        $this->birth_date = Helper::mysql_date($this->birth_date);

        return parent::beforeSave();
    }


    public function checkBabyAccess($baby_id)
    {
        if ($this->baby && $this->baby->id == $baby_id) return true;
        return UserOpenBaby::model()->exists('baby_id = ? AND user_id = ?', array($baby_id, $this->id));
    }

    public function getOpenBabies()
    {
        $data = UserOpenBaby::model()->findAllByAttributes(array(
            'user_id' => $this->id
        ));

        $result = array();

        foreach ($data as $item) {
            $result[] = Baby::model()->findByPk($item->baby_id);
        }

        return $result;
    }

}