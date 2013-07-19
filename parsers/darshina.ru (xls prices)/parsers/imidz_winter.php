<?php

class ImidzWinterParser extends BaseParser
{
    public function getName()
    {
        return "Имидж Зима";
    }

    public function do_parse($file)
    {
        $count = 0;
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if (empty($data[0]) || $count++ < 1) continue;

            $item = new Tyre();

            $item->brand = $data[1];
            $item->model = $data[2];
            $item->index = $data[4];
            $item->price = $data[5];
            $item->count = $data[6];

            $info = $this->parseSizes($data[0]);
            $item->width = $info['w'];
            $item->height = $info['h'];
            $item->diametr = $info['d'];

            $item->spikes = $data[6] == 'Шип.' ? 'Да' : '';

            $item->season = 'Зима';

            $this->Add($item);
        }
    }
}