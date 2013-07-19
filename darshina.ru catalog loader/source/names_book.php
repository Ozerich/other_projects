<?php

class NamesBook
{
    private $mysql_handle;

    private $data = array();

    private function sql($q)
    {
        $q = mysql_query($q, $this->mysql_handle) or die(mysql_error());
        return $q;
    }

    private function updateData(){
        $this->data = array();
        $q = $this->sql("SELECT * FROM `brands` ORDER BY `name`", $this->mysql_handle);

        while ($row = mysql_fetch_assoc($q)) {
            $this->data[$row['id']] = array(
                'name' => $row['name'],
                'alternative' => $row['alternative'] ? explode(',', tolowercase($row['alternative'])) : array(),
                'models' => array()
            );

            $qq = $this->sql("SELECT * FROM `models` WHERE brand = " . $row['id'] . " ORDER BY `model`");

            while ($row2 = mysql_fetch_assoc($qq)) {
                $this->data[$row['id']]['models'][$row2['id']] = array(
                    'name' => $row2['model'],
                    'spike' => $row2['spike'],
                    'is_winter' => $row2['is_winter'],
                    'alternative' => $row2['alternative'] ? explode(';', tolowercase($row2['alternative'])) : array(),
                );
            }
        }
    }

    public function __construct($host, $user, $password, $database)
    {
		print_r($host.', '.$user.', '.$password);exit;
        $this->mysql_handle = mysql_connect($host, $user, $password, $database) or die("MySQL Error: " . mysql_error());
        mysql_select_db($database) or die("MySQL Error:" . mysql_error());

        $this->updateData();

    }

    public function getData()
    {
        $result = array();

        foreach ($this->data as $id => $brand) {

            $models = array();

            foreach ($brand['models'] as $model_id => $model) {
                $models[] = array(
                    'id' => $model_id,
                    'name' => $model['name'],
                    'is_winter' => $model['is_winter'],
                    'spikes' => $model['spike']
                );
            }

            $result[] = array(
                'id' => $id,
                'name' => $brand['name'],
                'models' => $models
            );

        }

        return $result;
    }

    public function __destruct()
    {
        mysql_close($this->mysql_handle);
    }

    public function find(Tyre $tyre)
    {
        $tyre->brand = trim($tyre->brand);
        $tyre->model = trim($tyre->model);

        foreach ($this->data as $brand) {
            if (tolowercase($tyre->brand) == tolowercase($brand['name']) || in_array(tolowercase($tyre->brand), $brand['alternative'])) {
                $tyre->brand = $brand['name'];
                $tyre->known_brand = true;

                foreach ($brand['models'] as $model) {
                    if (tolowercase($tyre->model) == tolowercase($model['name']) || in_array(tolowercase($tyre->model), $model['alternative'])) {
                        $tyre->model = $model['name'];
                        $tyre->spikes = $model['spike'] ? 'Да' : 'Нет';
	
						$tyre->season = $model['is_winter'] ? 'Зима' : 'Лето';
						
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function addModel($brand_id, $model_name, $spikes, $is_winter = 0)
    {
        $this->updateData();

        if (!isset($this->data[$brand_id])) die;

        foreach ($this->data[$brand_id] as $id => $model) {
            if (tolowercase($model['name']) == tolowercase($model_name)) {
                return $id;
            }
        }

        $this->sql("INSERT INTO `models` (brand, model, spike, is_winter) VALUES($brand_id, '$model_name', $spikes, $is_winter)");
        return mysql_insert_id($this->mysql_handle);
    }

    public function addAltModel($model_id, $altname)
    {
        $q = $this->sql("SELECT * FROM `models` WHERE `id` = $model_id");
        $row = mysql_fetch_assoc($q);
        if (!$row) return false;

        $this->sql("UPDATE `models` SET `alternative` = '" . ($row['alternative'] . ($row['alternative'] ? ';' : '') . tolowercase($altname)) . "' WHERE id = $model_id");

        return true;
    }

    public function addBrand($brand)
    {
        $this->updateData();
        foreach ($this->data as $id => $_brand) {
            if (tolowercase($_brand['name']) == tolowercase($brand)) {
                return $id;
            }
        }

        $this->sql("INSERT INTO `brands` (name) VALUES('$brand')");
        return mysql_insert_id($this->mysql_handle);
    }

    public function addAltBrand($brand_id, $altname)
    {
        $q = $this->sql("SELECT * FROM `brands` WHERE `id` = $brand_id");
        $row = mysql_fetch_assoc($q);
        if (!$row) return false;

        $this->sql("UPDATE `brands` SET `alternative` = '" . ($row['alternative'] . ($row['alternative'] ? ',' : '') . tolowercase($altname)) . "' WHERE id = $brand_id");

        return true;
    }
	
	
	public function saveAsCSV(){
		$filename = $_SERVER['DOCUMENT_ROOT'].'/tmp/'.uniqid().'.csv';
		$f = fopen($filename, 'w+');
		
		foreach($this->data as $brand)
		{
			$first = true;
			foreach($brand['models'] as $ind => $model){
				$line = array('', $model['name'], $model['spike'] ? '+' : '', $model['is_winter'] ? '1' : '');
				
				if($first){
					$line[0] = $brand['name'];
					if(count($brand['alternative']) > 0){
						$line[0].=' ('.implode(',',$brand['alternative']).')';
					}
					
					$first = false;
				}
				
				foreach($model['alternative'] as $alt){
					$line[] = $alt;
				}

				fputcsv($f, $line, ';');	
			}
		}
		fclose($f);
		
		return $filename;
	}

}