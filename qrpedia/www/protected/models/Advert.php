<?php

class Advert extends CActiveRecord
{
    public static $legal_types = array(
        'legal_company' => 'Визитка компании',
        'legal_company_extended' => 'Расширенная визитка компании',
        'legal_basic_page' => 'Базовая страница',
        'legal_custom_page' => 'Произвольная страница'
    );

    public static $physical_types = array(
        'physical_human' => 'Визитка человека',
        'physical_company' => 'Визитка компании',
        'physical_page' => 'Страница',
        'physical_afisha' => 'Мероприятие'
    );

    public static $appeals = array(
        'mister' => 'Мистер',
        'senior' => 'Сеньор'
    );

    public $photos;
    public $type_text;
    public $photo_url;
    public $phone_parts = array('', '', '', '');


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function tableName()
    {
        return 'adverts';
    }

    public function rules()
    {
        return array(
            array('name', 'required'),

            array('name, area, address, place, appeal, surname, job, job_position, phone, phone_2, contact_person, fax, zip, email, skype, facebook, vkontakte, twitter, linkedin, youtube, www, map_coords', 'length', 'max' => 255),
            array('type, date_publish, father_name, date_added, short_description, description, datetime, qrfile', 'safe'),

            array('id, user_id, status, type, date_publish, date_added, name, area, address, place, short_description, description, appeal, surname, job, job_position, photo, phone, phone_2, contact_person, fax, zip, email, skype, facebook, vkontakte, twitter, linkedin, youtube, www, map_coords, datetime', 'safe', 'on' => 'search'),
        );
    }


    public function relations()
    {
        return array(
            // TODO: Разобраться чего не работает то
            'photos' => array(self::HAS_MANY, 'AdvertPhoto', 'advert_id'),
            'company' => array(self::BELONGS_TO, "Company", "user_id"),
        );
    }

    public function attributeLabels()
    {
        switch ($this->scenario) {

            case 'physical_human':

                return array(
                    'appeal' => 'Визитка человека',
                    'name' => 'Имя',
                    'surname' => 'Фамилия',
                    'father_name' => 'Отчество',
                    'job' => 'Название организации',
                    'job_position' => 'Должность',
                    'photo' => 'Фотография',
                    'phone' => 'Тел. контактный',
                    'fax' => 'Факс',
                    'email' => 'E-mail',
                    'skype' => 'Скайп',
                    'facebook' => 'Страница FB',
                    'vkontakte' => 'Страница ВК',
                    'linkedin' => 'Страница в LinkEdin',
                    'www' => 'Ссылка на сайт'
                );

            case 'physical_company':

                return array(
                    'name' => 'Название компании',
                    'area' => 'Отрасль',
                    'address' => 'Адрес',
                    'short_description' => 'Краткое описание',
                    'description' => 'Описание',
                    'photo' => 'Логотип компании',
                    'photos' => 'Фотографии компании',
                    'phone' => 'Тел. контактный',
                    'fax' => 'Факс',
                    'zip' => 'Почтовый индекс',
                    'email' => 'E-mail',
                    'www' => 'Web-сайт',
                    'facebook' => 'Страница FB',
                    'vkontakte' => 'Страница ВК',
                    'twitter' => 'Страница Twitter',
                );

            case 'physical_page':

                return array(
                    'name' => 'Заголовок(название)',
                    'short_description' => 'Краткое описание',
                    'description' => 'Описание',
                    'photos' => 'Фотографии компании',
                    'youtube' => 'Ссылка на ролик Youtube',
                    'email' => 'E-mail',
                    'www' => 'Web-сайт',
                    'facebook' => 'Страница FB',
                    'vkontakte' => 'Страница ВК',
                    'twitter' => 'Страница Twitter',

                );

            case 'physical_afisha':

                return array(
                    'name' => 'Название мероприятия',
                    'place' => 'Место проведения',
                    'short_description' => 'Краткое описание',
                    'description' => 'Описание',
                    'photos' => 'Фотографии компании',
                    'datetime' => 'Время проведения',
                    'email' => 'E-mail',
                    'phone' => 'Тел. 1',
                    'phone_2' => 'Тел. 2',
                    'contact_person' => 'Контактное лицо',
                    'www' => 'Web-сайт',
                    'facebook' => 'Страница FB',
                    'vkontakte' => 'Страница ВК',
                    'twitter' => 'Страница Twitter',
                );

            case 'legal_company':
            case 'legal_company_extended':

                return array(
                    'name' => 'Название компании',
                    'photo' => 'Логотип',
                    'phone' => 'Телефон/факс',
                    'email' => 'E-mail',
                    'short_description' => 'Краткое описание',
                    'address' => 'Адрес компании',
                    'photos' => 'Фотографии'
                );

            case 'legal_basic_page':

                return array(
                    'name' => 'Название компании',
                    'phone' => 'Телефон/факс',
                    'email' => 'E-mail',
                    'address' => 'Адрес компании',
                    'photos' => 'Фотографии'
                );

            case 'legal_custom_page':

                return array(
                    'name' => 'Название компании',
                    'description' => 'Краткая информация',
                    'photos' => 'Фотографии'
                );

            default:
                return array();
        }

    }


    public static function GetAllTypes()
    {
        $types_all = Yii::app()->user->model()->form == 'physical' ? self::$physical_types : self::$legal_types;
        $types = array();

        foreach ($types_all as $ind => $type) {
            if (Yii::app()->user->model()->checkAdvertTypeAccess($ind)) {
                $types[$ind] = $type;
            }
        }

        return $types;
    }


    public function beforeSave()
    {
        $this->user_id = Yii::app()->user->id;

        return parent::beforeSave();
    }

    public function getPhotos()
    {
        return AdvertPhoto::model()->findAllByAttributes(array('advert_id' => $this->id));
    }

    public function afterFind()
    {
        $this->type_text = Yii::app()->user->model()->form == 'legal' ? self::$legal_types[$this->type] : self::$physical_types[$this->type];

        $this->photo_url = $this->photo ? Yii::app()->baseUrl . Yii::app()->params['upload_dir'] . $this->photo : '';

        if (preg_match('#\+7\((\d+)\)-(\d+)-(\d+)-(\d+)#sui', $this->phone, $data)) {
            $this->phone_parts = array($data[1], $data[2], $data[3], $data[4]);
        }

        $this->setScenario($this->type);

        return parent::afterFind();
    }


    public function getQRCodeUrl(){
        return Yii::app()->params['qrcodes_dir'].$this->qrfile;
    }


}