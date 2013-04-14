<?php

class KamtehParser extends BaseParser
{
    public function getName(){
        return "Камтех";
    }

    public function do_parse($file)
    {
		$meta_data = stream_get_meta_data($file);
        $lines = file($meta_data["uri"]);


        $count = 0;
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if($count++ < 2)continue;

            $item = new Tyre();

            $item->name = $data[0];
            $item->width = $data[1];
            $item->height = $data[2];
            $item->diametr = $data[3];
            $item->price = $data[5];
            $item->brand = $data[6];
            $item->season = $data[7];
            $item->count = $data[4];


            $index = substr($item->name, strpos($item->name, ' ') + 1);
            $index = substr($index, strpos($index, ' ') + 1);
            if(substr($index, 0, 2) == 'XL')  $index = substr($index, strpos($index, ' ') + 1);
            $item->model = substr($index, strpos($index, ' ') + 1);
            $index = substr($index, 0, strpos($index, ' '));
            $item->index = $index;

            $this->Add($item);
        }
    }
}