<?php

/**
 * This is the model class for table "babies".
 *
 * The followings are the available columns in table 'babies':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $nickname
 * @property integer $sex
 * @property string $birth_date
 * @property string $birth_time
 * @property string $birth_place
 * @property string $photo
 * @property string $mother
 * @property string $father
 * @property string $weight
 * @property string $height
 * @property integer $hair_type
 * @property string $hair_color
 * @property string $eye_color
 * @property string $doctor
 * @property string $birth_house
 * @property string $similar_to
 * @property string $alter_name
 * @property string $was_near
 * @property string $description
 * @property string $medicine_info
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property BabyFeeds[] $babyFeeds
 * @property BabyHeights[] $babyHeights
 * @property BabyMedicalRecords[] $babyMedicalRecords
 * @property BabyTeeth[] $babyTeeths
 * @property BabyVaccinations[] $babyVaccinations
 * @property BabyWeights[] $babyWeights
 * @property Diary[] $diaries
 * @property PhotoAlbums[] $photoalbums
 */
class Baby extends CActiveRecord
{
    static $signers = array(
        '21.03 - 20.04' => array('Овен', 'Дракон', 'Аметист', 'Фиалка'),
        '21.04 - 21.05' => array('Телец', 'Змея', 'Агат', 'Ландыш'),
        '22.05 - 21.06' => array('Близнецы', 'Лошадь', 'Берилл', 'Маргаритка'),
        '22.06 - 21.07' => array('Рак', 'Коза', 'Изумруд', 'Жимолость'),
        '23.07 - 23.08' => array('Лев', 'Обезьяна', 'Рубин', 'Пион'),
        '24.08 - 23.09' => array('Дева', 'Петух', 'Ямша', 'Астра'),
        '24.09 - 23.10' => array('Весы', 'Собака', 'Бриллиант', 'Ноготки'),
        '24.10 - 22.11' => array('Скорпион', 'Свинья', 'Опал', 'Гвоздика'),
        '23.11 - 21.12' => array('Стрелец', 'Крыса', 'Бирюза', 'Нарцисс'),
        '22.12 - 20.01' => array('Козерог', 'Бык', 'Оникс', 'Белая гвоздика'),
        '21.01 - 18.02' => array('Водолей', 'Тигр', 'Сапфир', 'Нарцисс'),
        '19.02 - 20.03' => array('Рыбы', 'Кролик', 'Хризолит', 'Жасмин'),
    );


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'babies';
    }

    static $sex_texts = array(
        '0' => 'Девочка',
        '1' => 'Мальчик'
    );

    static $hair_type_texts = array(
        '0' => 'Прямые',
        '1' => 'Кудрявые',
        '2' => 'Волнистые'
    );

    public function rules()
    {
        return array(
            array('user_id, name, nickname, sex, birth_date', 'required'),
            array('birth_date', 'DateValidator', 'beforeToday' => true),
            array('sex, hair_type', 'numerical', 'integerOnly' => true),
            array('weight, height', 'numerical', 'integerOnly' => false),
            array('user_id', 'length', 'max' => 10),
            array('name, nickname, birth_place, mother, father, doctor, birth_house, similar_to, alter_name', 'length', 'max' => 100),
            array('hair_color, eye_color', 'length', 'max' => 20),
            array('birth_time, was_near, description', 'safe'),
            array('photo', 'file', 'types' => 'jpg, gif, png, bmp', 'allowEmpty' => true),
            array('medicine_info', 'safe'),

            array('id, medicine_info, user_id, name, nickname, sex, was_near, birth_time, birth_place, photo, mother, father, weight, height, hair_type, hair_color, eye_color, doctor, birth_house, similar_to, alter_name, description', 'safe', 'on' => 'search'),
            array('birth_date', 'DateValidator', 'on' => 'search'),
        );
    }

    public function afterFind()
    {
        $this->birth_date = date('d.m.Y', strtotime($this->birth_date));
        $this->birth_time = $this->birth_time ? substr($this->birth_time, 0, 5) : '';
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'babyFeeds' => array(self::HAS_MANY, 'BabyFeeds', 'baby_id'),
            'babyHeights' => array(self::HAS_MANY, 'BabyHeights', 'baby_id'),
            'babyMedicalRecords' => array(self::HAS_MANY, 'BabyMedicalRecords', 'baby_id'),
            'babyTeeths' => array(self::HAS_MANY, 'BabyTeeth', 'baby_id'),
            'babyVaccinations' => array(self::HAS_MANY, 'BabyVaccinations', 'baby_id'),
            'babyWeights' => array(self::HAS_MANY, 'BabyWeights', 'baby_id'),
            'diaries' => array(self::HAS_MANY, 'Diary', 'baby_id'),
            'photoalbums' => array(self::HAS_MANY, 'PhotoAlbums', 'baby_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'name' => 'Имя',
            'nickname' => 'Никнейм',
            'sex' => 'Пол',
            'birth_time' => 'Время рождения',
            'birth_date' => 'Дата рождения',
            'birth_place' => 'Место рождения',
            'photo' => 'Фотография',
            'mother' => 'Мама',
            'father' => 'Папа',
            'weight' => 'Вес при рождении',
            'height' => 'Рост при рождении',
            'hair_type' => 'Тип волос',
            'hair_color' => 'Цвет волос',
            'eye_color' => 'Цвет глаз',
            'doctor' => 'Доктор',
            'birth_house' => 'Роддом',
            'similar_to' => 'На кого был похож ребенок?',
            'alter_name' => 'Альтернативные имена',
            'description' => 'Воспоминания о рождении',
            'was_near' => 'Кто был рядом?',
            'medicine_info' => 'Общая информация',
        );
    }

    public function getPhoto()
    {
        return empty($this->photo) ? Yii::app()->params['nophoto_baby'] : Yii::app()->params['upload_baby_dir'] . $this->photo;
    }


    public function getTextAge()
    {
        $diff = abs(time() - strtotime($this->birth_date));

        $date1 = new DateTime($this->birth_date);
        $date2 = new DateTime(date("Y-m-d"));

        $interval = $date1->diff($date2);

        $years = $interval->y;
        $months = $interval->m;
        $days = $interval->d;


        $days_str = 'дней';
        if ($days == 1) $days_str = 'день';
        if ($days >= 2 && $days <= 4) $day_str = 'дня';

        $month_str = 'месяцев';
        if ($months == 1) $month_str = 'месяц';
        if ($months >= 2 && $months <= 4) $month_str = 'месяца';

        $year_str = 'лет';
        if ($years == 1) $year_str = 'год';
        if ($years >= 2 && $years <= 4) $year_str = 'года';

        $days_str = $days > 0 ? $days . ' ' . $days_str : '';
        $month_str = $months > 0 ? $months . ' ' . $month_str : '';
        $year_str = $years > 0 ? $years . ' ' . $year_str : '';

        return $year_str . ' ' . $month_str . ' ' . $days_str;
    }

    private function getSigner()
    {
        $date = getdate(strtotime($this->birth_date));
        $month = $date['mon'];
        $day = $date['mday'];

        foreach (self::$signers as $date => $signer) {
            $from_mon = (int)substr($date, 3, 2);
            $from_day = (int)substr($date, 0, 2);
            $to_mon = (int)substr($date, 11, 2);
            $to_day = (int)substr($date, 8, 2);

            if (($from_mon == $month && $day >= $from_day) || ($to_mon == $month && $day <= $to_day)) {
                return $signer;
            }
        }

        return null;
    }

    public function getGreeceSign()
    {
        $data = $this->getSigner();
        return $data[0];
    }

    public function getChinaSign()
    {
        $data = $this->getSigner();
        return $data[1];
    }

    public function getStone()
    {
        $data = $this->getSigner();
        return $data[2];
    }

    public function getFlower()
    {
        $data = $this->getSigner();
        return $data[3];
    }

}