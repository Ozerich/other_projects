<?php

class Zima2Parser extends BaseParser
{
    public function getName(){
        return "Зима №2";
    }

    public function do_parse($file)
    {
        $count = 0;
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if(empty($data[0]) || empty($data[2]) || $count++ < 2)continue;

            $item = new Tyre();

            $item->spikes = strpos($data[0], 'Шип') || strpos($data[0], 'шип') ? 'Да' : 'Нет';

            $data[0] = trim(str_replace(array('Автошины', 'Шип', 'шип','DD'), array('','',''), $data[0]));

            $index = substr($data[0], strrpos($data[0], ' '));

            $data[0] = trim(substr($data[0], 0, strlen($data[0]) - strlen($index)));

            $item->name = $data[0];
            $item->price = (int)trim(str_replace(',','',$data[2]));
            $item->count = $data[1];

            $info = $this->parseSizes($data[0]);

            $item->width = $info['w'];
            $item->height = $info['h'];
            $item->diametr = $info['d'];
            $item->index = str_replace('.','',$index);

            preg_match('#.+?R.+?\s(.+?)\s(.+?)$#sui', $item->name, $reg);

            $item->brand = $reg[1];
            $item->model = $reg[2];

            $item->season = 'Зима';

            $this->Add($item);
        }
    }
}