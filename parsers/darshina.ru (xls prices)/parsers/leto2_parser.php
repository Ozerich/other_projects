<?php

class Leto2Parser extends BaseParser
{
    public function getName(){
        return "Лето №2";
    }

    public function do_parse($file)
    {
        $count = 0;
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if(empty($data[0]) || empty($data[2]) || $count++ < 2)continue;

            $item = new Tyre();

            $data[0] = trim(str_replace('Автошины', '', $data[0]));

            $index = substr($data[0], strrpos($data[0], ' '));

            $data[0] = trim(substr($data[0], 0, strlen($data[0]) - strlen($index)));

            $item->name = $data[0];
            $item->price = (int)trim(str_replace(',','',$data[2]));
            $item->count = $data[1];

            $info = $this->parseSizes($data[0]);

            $item->width = $info['w'];
            $item->height = $info['h'];
            $item->diametr = $info['d'];
            $item->index = $index;

            preg_match('#.+?R.+?\s(.+?)\s(.+?)$#sui', $item->name, $reg);

            $item->brand = $reg[1];
            $item->model = $reg[2];

            $item->season = 'Лето';
            $item->spikes = 'Нет';

            $this->Add($item);
        }
    }
}