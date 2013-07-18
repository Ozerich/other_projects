<?php

class Company extends UserModel
{
    public $phone_parts = array('', '', '', '');

    public static $forms = array(
        'legal' => 'Юридическое лицо',
        'physical' => 'Физическое лицо'
    );

    public static $areas = array(
        '1' => 'Электроэнергетика',
        '2' => 'Топливная',
        '3' => 'Черная металлургия',
        '4' => 'Цветная металлургия',
    );

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'companies';
    }

    public function rules()
    {
        return array(
            array('email, password, name, contact_person, address', 'required'),
            array('email, password, name, contact_person, address, legal_address', 'length', 'max' => 255),
            array('phone', 'length', 'max' => 20),

            array('email', 'email'),
            array('email, name', 'unique'),

            array('form, details,phone, area, balance', 'safe'),

            array('id, email, password, name, contact_person, address, legal_address, details, phone', 'safe', 'on' => 'search'),
        );
    }


    public function relations()
    {
        return array();
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'email' => 'E-mail (логин)',
            'password' => 'Пароль',
            'name' => 'Название',
            'contact_person' => 'Контактное лицо',
            'address' => 'Адрес',
            'legal_address' => 'Юридический адрес',
            'details' => 'Реквизиты',
            'phone' => 'Телефон',
            'form' => 'Юр. форма',
            'area' => 'Отрасль',
            'balance' => 'Баланс'
        );
    }

    public function afterFind()
    {
        $this->phone_parts = array('', '', '', '');

        if (preg_match('#\+7\((\d+)\)-(\d+)-(\d+)-(\d+)#sui', $this->phone, $data)) {
            $this->phone_parts = array($data[1], $data[2], $data[3], $data[4]);
        }

    }

    public function beforeSave()
    {
        if ($this->package_count_remaining == 0) {
            $this->package_name = null;
            $this->package_date = null;
            $this->package_days = null;
            $this->package_types = null;
            $this->package_count_remaining = null;
        }

        return parent::beforeSave();
    }

    public function checkAdvertTypeAccess($type)
    {
        $types = $this->package_types;

        $types = $types ? explode(',', $types) : array();

        return in_array($type, $types);
    }
}