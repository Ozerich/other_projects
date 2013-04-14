<?php

class NamesParser
{
    private $mysql_handle;

    public function __construct($host, $user, $password, $name)
    {
        $this->mysql_handle = mysql_connect($host, $user, $password, $name) or die("SQL ERROR: " . mysql_error());
        mysql_select_db($name, $this->mysql_handle);
    }

    public function __destruct()
    {
        mysql_close($this->mysql_handle);
    }

    private function query($q)
    {
        mysql_query($q, $this->mysql_handle) or die("SQL ERROR: " . mysql_error());
    }

    private function add_brand($brand)
    {
        $alternative = '';

        if (strpos($brand, '(')) {
            preg_match('#\((.+?)\)#sui', $brand, $alts);
            $alts = explode(',', $alts[1]);

            foreach ($alts as &$alt) {
                $alt = trim($alt);
            }

            $alternative = implode(',', $alts);

            $brand = substr($brand, 0, strpos($brand, '('));
        }

        $this->query("INSERT INTO brands (`name`, `alternative`) VALUES ('" . trim($brand) . "','" . $alternative . "')");
        return mysql_insert_id($this->mysql_handle);
    }

    private function add($brand, $model, $spike, $alternative)
    {
        $alternative = implode(';', $alternative);

        $brand = tolowercase($brand);
        $spike = tolowercase($spike);
        $alternative = tolowercase($alternative);

        $q = 'INSERT INTO models (`brand`, `model`, `spike`, `alternative`) VALUES ("' . $brand . '", "' . $model . '","' . (int)$spike . '","' . $alternative . '")';
        $this->query($q);

    }

    private function reset()
    {
        $this->query('TRUNCATE models');
        $this->query('TRUNCATE brands');
    }

    public function parse($filename)
    {
        $this->reset();
        prepareCSV($filename);
        $f = fopen($filename, 'r+');

        $brand = '';

        while (($data = fgetcsv($f, 1000, ';')) !== FALSE) {

            if (!empty($data[0])) {
                $brand = $data[0];
                $brand = $this->add_brand($brand);
            }

            $model = $data[1];
            $spike = $data[2] == 'шип';

            $alternative = array();
            for ($i = 3; $i <= 5; $i++) {
                if (!empty($data[$i])) {
                    $alternative[] = $data[$i];
                }
            }

            $this->add($brand, $model, $spike, $alternative);
        }
        fclose($f);
    }
}