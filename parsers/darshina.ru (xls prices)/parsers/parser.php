<?php

class Tyre
{
    public $name;
    public $brand;
    public $model;
    public $index;
    public $width;
    public $height;
    public $diametr;
    public $season;
    public $spikes;
    public $price;
    public $file;
    public $count;

    public $known_brand = false;

    public static function parseWidthFromSize($size)
    {
        return substr($size, 0, strpos($size, '/'));
    }

    public static function parseHeightFromSize($size)
    {
        return substr($size, strpos($size, '/') + 1, 2);
    }

    public static function parseDiametrFromSize($size)
    {
        return substr($size, strrpos($size, 'R') + 1, 2);
    }

    public static function Equals(Tyre $a, Tyre $b)
    {
        return $a->brand == $b->brand && $a->model == $b->model && $a->index == $b->index && $a->width == $b->width &&
            $a->height == $b->height && $a->diametr == $b->diametr && $a->season == $b->season && $a->spikes == $b->spikes;
    }
}

abstract class BaseParser
{
    abstract function do_parse($file);

    abstract function getName();

    private $tyres = array();
    private $undefined_tyres = array();

    private $book;

    public function setBook(NamesBook $book)
    {
        $this->book = $book;
    }

    protected function Add(Tyre $item)
    {
        if (empty($item->name)) {
            $item->name = trim($item->brand) . " " . $item->model;
        }

        if (empty($item->spikes)) {
            $item->spikes = 'Нет';
        }

        if (trim($item->brand) === "") return;
        $this->tyres[] = $item;
    }

    private function prepare()
    {
        $tyres = array();
        $undefined_tyres = array();

        foreach ($this->tyres as &$tyre) {

            $tyre->brand = trim(str_replace(array(' P', 'LT', '31*'),array('','',''),$tyre->brand));

            $tyre->price = str_replace(' ', '', $tyre->price);

            $tyre->model = trim(str_replace(array('распр.','шип.', 'шип'), array('','',''), $tyre->model));

            if ($this->book->find($tyre)) {
                $tyres[] = $tyre;
            } else {
                $undefined_tyres[] = $tyre;
            }
        }


        $this->tyres = array();
        $this->undefined_tyres = array();

        for ($i = 0; $i < count($tyres); $i++) {
            for ($j = $i + 1; $j < count($tyres); $j++) {
                if (Tyre::Equals($tyres[$i], $tyres[$j])) {
                    $this->tyres[] = $tyres[$i]->price < $tyres[$j]->price ? $tyres[$i] : $tyres[$j];
                } else {
                    $this->tyres[] = $tyres[$i];
                }
            }
        }

        for ($i = 0; $i < count($undefined_tyres); $i++) {
            $found = false;
            for ($j = $i + 1; $j < count($undefined_tyres); $j++) {
                if (tolowercase($undefined_tyres[$i]->model) == tolowercase($undefined_tyres[$j]->model) && tolowercase($undefined_tyres[$j]->brand) == tolowercase($undefined_tyres[$i]->brand)) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->undefined_tyres[] = $undefined_tyres[$i];
            }
        }

        $this->tyres = $tyres;
    }

    public function parse($filename)
    {
        if (!$this->book) {
            throw new Exception("Book is not set");
        }

        prepareCSV($filename);
        $f = fopen($filename, 'r+');

        $this->do_parse($f);

        fclose($f);

        $this->prepare();
    }


    public function getTyres()
    {
        return array(
            'normal' => $this->tyres,
            'undefined' => $this->undefined_tyres
        );
    }


    protected function parseSizes($s)
    {
        preg_match('#(\d+)[/X]*([\d\.,]+)*\s*Z*R(.+?)(\s|$)#sui', $s, $info);
        if ($info) {
            return array(
                'w' => $info[1] ? $info[1] : '',
                'h' => $info[2] ? $info[2] : '',
                'd' => $info[3] ? $info[3] : '',
                'pos' => strpos($s, $info[0]) + strlen($info[0])
            );
        }


        return array('w' => '', 'h' => '', 'd' => '');
    }

}

?>