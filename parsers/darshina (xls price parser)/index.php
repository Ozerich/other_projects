<?
set_time_limit(0);
ini_set('memory_limit', '1024M');

define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASSWORD", '');
define("DB_NAME", 'darshina');

require_once "names_parser.php";
require_once "parsers/parser.php";
require_once "names_book.php";
require_once "parsers/imidz_summer.php";
require_once "parsers/leto2_parser.php";
require_once "parsers/imidz_winter.php";
require_once "parsers/zima2_parser.php";
require_once "parsers/laserta_parser.php";
require_once "parsers/kuper_parser.php";
require_once "parsers/letozima4_winter_parser.php";
require_once "parsers/kamteh_parser.php";

function tolowercase($str)
{
    $str = mb_convert_case(strtolower($str), MB_CASE_LOWER, "UTF-8");
    $str = str_replace(array('а', 'о', 'с'), array('a', 'o', 'c'), $str);

    return $str;
}


function prepareCSV($filename)
{
    $f = fopen($filename, 'r+');

    $result = array();
    $delimetr = count(fgetcsv($f, 1000, ';')) > 1 ? ';' : ',';

    rewind($f);
    while (($data = fgetcsv($f, 1000, $delimetr)) !== FALSE) {
        foreach ($data as &$item) {
            $item = iconv('Windows-1251', 'UTF-8', $item);
        }
        $result[] = $data;
    }

    fclose($f);

    $f = fopen($filename, 'w+');

    foreach ($result as $item) {
        fputcsv($f, $item, ';');
    }

    fclose($f);
}

function cmp($a, $b)
{

    if ($a->brand < $b->brand) return -1;
    if ($a->brand > $b->brand) return 1;

    if ($a->model < $b->model) return -1;
    if ($a->model > $b->model) return 1;

    if ($a->width < $b->width) return -1;
    if ($a->width > $b->width) return 1;

    if ($a->height < $b->height) return -1;
    if ($a->height > $b->height) return 1;

    if ($a->diametr < $b->diametr) return -1;
    if ($a->diametr > $b->diametr) return 1;

    if ($a->season < $b->season) return -1;
    if ($a->season > $b->season) return 1;

    return 0;
}



$parsers = array(
    new ImidzSummerParser(), new ImidzWinterParser(), new KamtehParser(), new LasertaParser(), new KuperParser(), new Letozima4WinterParser(), new Leto2Parser(), new Zima2Parser()
);

$book = new NamesBook(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
foreach ($parsers as $parser) {
    $parser->setBook($book);
}

$result = array();
$undefined_tyres = array();

if (isset($_GET['ajax'])) {

    switch ($_GET['action']) {

        case 'data':
            echo json_encode($book->getData());
            break;

        case 'add':

            $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
            $model = isset($_POST['model']) ? $_POST['model'] : '';
            $alt_model = isset($_POST['alt_model']) ? $_POST['alt_model'] : '';
            $new_brand = isset($_POST['new_brand']) ? $_POST['new_brand'] : '';
            $alt_brand = isset($_POST['alt_brand']) ? $_POST['alt_brand'] : '';
            $new_model = isset($_POST['new_model']) ? $_POST['new_model'] : '';
            $spikes = isset($_POST['spikes']) ? $_POST['spikes'] : '';

            if ($new_brand == '') {

                if ($model == '0') {
                    $model = $book->addModel($brand, $new_model, $spikes);
                    if ($new_model != $alt_model) {
                        $book->addAltModel($model, $alt_model);
                    }
                } else {
                    $book->addAltModel($model, $new_model);
                }
            } else {

                if ($brand == '0') {
                    $brand = $book->addBrand($new_brand);
                    $model = $book->addModel($brand, $new_model, $spikes);
                    if ($new_model != $alt_model) {
                        $book->addAltModel($model, $alt_model);
                    }
                    if ($new_brand != $alt_brand) {
                        $book->addAltBrand($brand, $alt_brand);
                    }
                } else {

                    $book->addAltBrand($brand, $new_brand);

                    if ($model == '0') {
                        $model = $book->addModel($brand, $new_model, $spikes);
                        if ($new_model != $alt_model) {
                            $book->addAltModel($model, $alt_model);
                        }
                    } else {
                        $book->addAltModel($model, $new_model);
                    }
                }


            }

            break;

    }

    die;
}





if ($_FILES) {

    if (isset($_GET['names'])) {
        if (!isset($_FILES['file']) || empty($_FILES['file'])) die('Файл не выбран');
        $file = $_FILES['file'];

        $file_name = $file['name'];
        $file_ext = substr($file_name, strrpos($file_name, '.') + 1);

        if ($file_ext !== 'csv') die("Файл должен иметь расширение CSV");

        $parser = new NamesParser(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $parser->parse($file['tmp_name']);

        header("Location: index.php");
    }

    foreach ($parsers as $ind => $parser) {
        $file_ind = "parser_" . $ind;

        if (!isset($_FILES[$file_ind]) || empty($_FILES[$file_ind]['name'])) continue;
        $file_name = $_FILES[$file_ind]['name'];

        $file_ext = substr($file_name, strrpos($file_name, '.') + 1);

        if ($file_ext !== 'csv') continue;


        $parser->parse($_FILES[$file_ind]['tmp_name']);

        $items = $parser->getTyres();

        $undefined_tyres = array_merge($undefined_tyres, $items['undefined']);

        $items = $items['normal'];


        foreach ($items as &$tyre) {
            $tyre->file = $parser->getName();
        }

        $result = array_merge($result, $items);

    }

    uasort($undefined_tyres, 'cmp');


    uasort($result, 'cmp');

    $filename = "tmp/" . uniqid() . ".csv";
    $f = fopen($filename, "w+");

    foreach ($result as $tyre) {
        fputcsv($f, array(
            $tyre->file, $tyre->brand, $tyre->model, $tyre->index, $tyre->width, $tyre->height, $tyre->diametr, $tyre->season, $tyre->spikes, $tyre->price, $tyre->count
        ));
    }

    fclose($f);
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>

    <link rel="stylesheet" type="text/css" href="css/styles.css"/>

    <script src="js/jquery.js"></script>
</head>
<body>

<? if (!$_FILES): ?>
    <div class="form">

        <form action="index.php?names" method="post" enctype="multipart/form-data">
            <div class="parser-item">
                <label for="names_file">Справочник имен</label>
                <input type="file" id="names_file" name="file"/>
            </div>
            <div class="form-submit">
                <input type="submit" value="Загрузить"/>
            </div>
        </form>

        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="parsers">
                <? foreach ($parsers as $ind => $parser): ?>
                    <div class="parser-item">
                        <label for="parser_<?= $ind ?>"><?=$parser->getName();?>:</label>
                        <input type="file" id="parser_<?= $ind ?>" name="parser_<?= $ind ?>"/>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="form-submit"><input type="submit" value="Загрузить"/></div>
        </form>
    </div>
<? else: ?>

    <script src="js/script.js"></script>

    <? if (!empty($undefined_tyres)): ?>
        <div class="table">
            <div class="overlay" id="undefined_overlay"></div>
            <h1>Не найденные в справочнике:</h1>

            <table class="non-found">
                <thead>
                <tr>
                    <th>Производитель</th>
                    <th>Модель</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>

                <? foreach ($undefined_tyres as $tyre): ?>
                    <tr class="item-line">
                        <td class="brand"><?=$tyre->brand?></td>
                        <td class="model"><?=$tyre->model?></td>
                        <td class="col-actions"><a href="#" class="open-addform-btn">Добавить</a></td>
                    </tr>
                    <tr style="display: none" class="form-add item-line-form">
                        <td colspan="100">
                            <div class="form-add">

                                <div class="param param-manufacture">
                                    <label>Производитель:</label>
                                    <select class="manufactures">
                                        <option value="0">Новый производитель</option>
                                    </select>
                                </div>

                                <div class="param param-brandname">
                                    <label>Название модели:</label>
                                    <input type="text" class="brand_name" value=""/>
                                </div>

                                <div class="param">
                                    <label>Модель:</label>
                                    <select class="models">
                                        <option spikes="0" value="0">Новая модель</option>
                                    </select>
                                </div>

                                <div class="param param-modelname">
                                    <label>Название модели:</label>
                                    <input type="text" class="model_name" value=""/>
                                </div>

                                <div class="param">
                                    <label>Шипы:</label>
                                    <input type="checkbox" class="spikes"/>
                                </div>

                                <button class="add_button">Добавить</button>
                            </div>
                        </td>
                    </tr>
                <? endforeach; ?>

                </tbody>
            </table>
        </div>

    <? endif; ?>

    <div class="table">
        <h1>Результат:</h1>

        <div class="header">
            <a href="index.php">Назад</a>
            <button onclick="document.location.href='<?= $filename ?>'; return false;">Сохранить в CSV</button>
            <br clear="all"/>
        </div>
        <table>
            <thead>
            <tr>
                <th>Файл</th>
                <th>Производитель</th>
                <th>Модель</th>
                <th>Индекс нагрузки</th>
                <th>Ширина профиля</th>
                <th>Высота профиля</th>
                <th>Диаметр</th>
                <th>Сезонность</th>
                <th>Шипы</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($result as $tyre): ?>
                <tr>
                    <td><?=$tyre->file?></td>
                    <td><?=$tyre->brand?></td>
                    <td><?=$tyre->model?></td>
                    <td><?=$tyre->index?></td>
                    <td><?=$tyre->width?></td>
                    <td><?=$tyre->height?></td>
                    <td><?=$tyre->diametr?></td>
                    <td><?=$tyre->season?></td>
                    <td><?=$tyre->spikes?></td>
                    <td><?=$tyre->price?></td>
                    <td><?=$tyre->count?></td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>

<? endif; ?>
</body>
</html>