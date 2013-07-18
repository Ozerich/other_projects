<?

class Helper
{

    public static function mysql_date($value)
    {
        $value = preg_replace('#(\d\d)\.(\d\d)\.(\d\d\d\d)#sui', '\\3-\\2-\\1', $value);
        return $value;
    }

}

?>