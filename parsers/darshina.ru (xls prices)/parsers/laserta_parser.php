<?php

class LasertaParser extends BaseParser
{
    public function getName()
    {
        return "Ласерта";
    }

    public function do_parse($file)
    {
        $type = 0;
        $count = 0;
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if ($count++ < 1) continue;

            if ($data[0] == 'Летние') {
                $type = 1;
                continue;
            } else if ($data[0] == 'Зимние') {
                $type = 0;
                continue;
            }

            if (empty($data[1])) continue;


            $item = new Tyre();

            $item->price = str_replace(' ', '', $data[1]);
            $item->price = strpos($item->price, ',') !== false ? substr($item->price, 0, strpos($item->price, ',')) : $item->price;
            $item->count = $data[2];

            $item->name = $data[0];

            $info = $this->parseSizes($item->name);
            $item->width = $info['w'];
            $item->height = $info['h'];
            $item->diametr = $info['d'];

            $str = str_replace($item->name, 'распр.', '');
            $item->brand = substr($item->name, 0, strpos($item->name, $item->width));

            $item->spikes = strpos($item->name, 'шип.') ? 'Да' : 'Нет';
            $item->season = $type == 1 ? 'Лето' : 'Зима';

            $item->index = trim(substr($item->name, $info['pos']));
            $item->model = substr($item->index, strpos($item->index, ' ') + 1);
            $item->index = substr($item->index, 0, strpos($item->index, ' ') );


            $this->Add($item);


        }
    }
}