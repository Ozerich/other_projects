<?php

class DateFilter extends CValidator
{
    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;

        $value = preg_replace('#(\d\d)\.(\d\d)\.(\d\d\d\d)#sui', '\\3-\\2-\\1', $value);

        $object->$attribute = $value;
    }
}
