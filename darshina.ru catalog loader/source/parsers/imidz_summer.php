<?php

class ImidzSummerParser extends BaseParser
{
    public function getName(){
        return "Имидж Лето";
    }

    public function do_parse($file)
    {
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if (count($data) > 0 && strpos($data[0], '/') !== false) {
                $item = new Tyre();

                $item->name = trim($data[1] . " " . $data[0]);
                $item->brand = trim($data[1]);
                $item->model = trim($data[2]);
                $item->index = (int)$data[3];
                $item->price = trim(str_replace(',','',$data[4]));
                $item->count = trim($data[5]);

                $info = $this->parseSizes($data[0]);

                $item->width = $info['w'];
                $item->height = $info['h'];
                $item->diametr = $info['d'];

                $item->season = 'Лето';
                $item->spikes = 'Нет';

                $this->Add($item);
            }
        }
    }
}