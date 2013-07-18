<?php

class DateValidator extends CValidator
{
    public $beforeToday = false;

    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if(empty($value)){
            $object->$attribute = null;
            return;
        }

        $pattern = '#\d\d\.\d\d\.\d\d\d\d#sui';
        $sql_pattern = '#\d\d\d\d\-\d\d\-\d\d#sui';

        if (!preg_match($pattern, $value) && !preg_match($sql_pattern, $value)) {
            $this->addError($object, $attribute, 'Дата должна иметь формат дд.мм.гггг');
            return;
        }

        $time = strtotime($value);

        if ($this->beforeToday) {
            $today = getdate(time());
            if ($time >= mktime(23, 59, 59, $today['mon'], $today['mday'], $today['year'])) {
                $this->addError($object, $attribute, 'Дата в будущем - такое не возможно');
                return;
            }
        }

        $object->$attribute = date('Y-m-d', $time);
    }
}