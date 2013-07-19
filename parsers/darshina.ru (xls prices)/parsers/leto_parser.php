<?php

class LetoParser extends BaseParser
{
    public function do_parse($file)
    {
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
            if (count($data) > 0 && strpos($data[0], '/') !== false) {
                $item = new Tyre();

                $item->name = trim($data[1] . " " . $data[0]);
                $item->brand = trim($data[1]);
                $item->model = trim($data[2]);
                $item->index = (int)$data[3];
                $item->price = trim($data[4]);

                $item->width = Tyre::parseWidthFromSize($data[0]);
                $item->height = Tyre::parseHeightFromSize($data[0]);
                $item->diametr = Tyre::parseDiametrFromSize($data[0]);

                $this->Add($item);
            }
        }
    }
}