<?php

class Letozima4WinterParser extends BaseParser
{
    public function getName(){
        return "Лето и зима №4 (зима)";
    }

    public function do_parse($file)
    {
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if (empty($data[1])) continue;

            $item = new Tyre();

            $item->season = 'Зима';
            $item->spikes = $data[4] == 'шип' ? 'Да' : 'Нет';

            $item->brand = $data[0];
            $item->model = $data[1];

            $info = $this->parseSizes($data[2]);
            $item->width = $info['w'];
            $item->height = $info['h'];
            $item->diametr = $info['d'];

            $item->index = $data[3];
            $item->price = $data[5];
            $item->count = $data[6];

            $this->Add($item);
        }
    }
}