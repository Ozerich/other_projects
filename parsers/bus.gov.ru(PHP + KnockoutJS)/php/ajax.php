<?php
set_time_limit(0);
ini_set('mbstring.func_overload', 0);
//phpinfo();


require_once "downloader.php";
require_once "PHPExcel.php";

function translit($str)
{
    $tr = array(
        "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
        "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
        "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
        "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
        "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
        "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
        "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
        "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
        "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
        "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
        "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
        "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
        "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya"
    );
    return strtr($str, $tr);
}

function deleteFile($filename)
{
    $file_lines = file($_SERVER['DOCUMENT_ROOT'] . '/db.txt');
    $new_file_lines = array();
    foreach ($file_lines as $line) {
        $line_data = explode(';;', $line);
        if (trim($line_data[8]) == $filename) {
            continue;
        }
        $new_file_lines[] = $line;
    }

    $f = fopen($_SERVER['DOCUMENT_ROOT'] . '/db.txt', 'w+');
    foreach ($new_file_lines as $line) {
        fwrite($f, $line);
    }
    fclose($f);
}

if (!isset($_GET['cmd'])) die('command is empty');
$cmd = trim($_GET['cmd']);

$response = array();

switch ($cmd) {

    case "GetFilterData":

        $response = array(
            'types' => array(),
            'okrugs' => array(),
        );

        $downloader = new Downloader();
        $text = $downloader->download('http://bus.gov.ru/public/agency/extendedSearch.html?action=extendedForm');

        preg_match('#<label for="type">Тип учреждения</label>(.+?)</div>#sui', $text, $types_text);
        preg_match_all('#<option value="(.*?)">(.+?)</option>#sui', $types_text[1], $types, PREG_SET_ORDER);

        foreach ($types as $type) {
            $response['types'][] = array(
                'id' => $type[1],
                'label' => $type[2]
            );
        }

        preg_match('#<label for="districts">Федеральный округ</label>(.+?)</tr>#sui', $text, $okrugs_text);
        preg_match_all('#type="checkbox" value="(.+?)"/><label for=".+?">(.+?)</label>#sui', $okrugs_text[1], $okrugs, PREG_SET_ORDER);

        foreach ($okrugs as $okrug) {

            $okrug_id = $okrug[1];
            $okrug_name = $okrug[2];
            $subjects = array();

            $text = $downloader->download('http://bus.gov.ru/public/agency/2.0/changeDistricts.html?id=' . $okrug_id);
            preg_match_all('#type="checkbox" value="(.+?)"/><label for=".+?">(.+?)</label>#sui', $text, $_subjects, PREG_SET_ORDER);

            foreach ($_subjects as $subject) {
                $subject_id = $subject[1];
                $subject_name = $subject[2];
                $cities = array();

                $text = $downloader->download('http://bus.gov.ru/public/agency/2.0/changeRegions.html?id=' . $subject_id);
                preg_match_all('#type="checkbox" value="(.+?)"/><label for=".+?">(.+?)</label>#sui', $text, $_cities, PREG_SET_ORDER);

                foreach ($_cities as $city) {
                    $cities[] = array(
                        'id' => (int)$city[1],
                        'label' => $city[2]
                    );
                }

                $subjects[] = array(
                    'id' => (int)$subject_id,
                    'label' => $subject_name,
                    'cities' => $cities
                );
            }

            $response['okrugs'][] = array(
                'id' => (int)$okrug_id,
                'label' => $okrug_name,
                'subjects' => $subjects
            );
        }

        break;

    case "ParseCity":

        if (isset($_POST['subjects'])) {
            $subject_name = $_POST['subjects'][0]['label'];
            $subject_name = strpos($subject_name, ' ') !== false ? substr($subject_name, 0, strpos($subject_name, ' ')) : $subject_name;
        } else {
            $subject_name = '';
        }

        $okrug_name = $_POST['okrug']['label'];
        $okrug_name = strpos($okrug_name, ' ') !== false ? substr($okrug_name, 0, strpos($okrug_name, ' ')) : $okrug_name;

        $filename = translit($okrug_name) . (!empty($subject_name) ? '_' . translit($subject_name) : '') . '_' . (date('d.m.y')) . '.xls';
        $folder = date('d.m.y');

        @mkdir($_SERVER['DOCUMENT_ROOT'] . '/data');
        @mkdir($_SERVER['DOCUMENT_ROOT'] . '/data/' . $folder);

        $file = 'data/' . $folder . '/' . $filename;

        $num = 1;
        while (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $file)) {

            if (strpos($file, '(') !== false) {
                $file = substr($file, 0, strpos($file, '(')) . '.xls';
            }

            $file = substr($file, 0, strlen($file) - 4) . '(' . $num . ')' . '.xls';
            $num++;
        }

        $f = fopen($_SERVER['DOCUMENT_ROOT'] . '/' . $file, 'w+');
        fclose($f);

        $objPHPExcel = new PHPExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'id');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'name');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, 'inn');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, 'kpp');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, 'phone');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, 'postal');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, 'contacts');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, 'email');

        $objWriter->save($_SERVER['DOCUMENT_ROOT'] . '/' . $file);

        $response = array('file' => $file, 'start_time' => time(), 'ids' => array());

        $type = $_POST['type'];


        $downloader = new Downloader();

        $ids = array();
        if (isset($_POST['cities'])) {
            foreach ($_POST['cities'] as $_city) {
                $ids[] = 'areas=' . $_city['id'];
            }
        } else if (isset($_POST['subjects'])) {
            foreach ($_POST['subjects'] as $_city) {
                $ids[] = 'regions=' . $_city['id'];
            }
        } else {
            $ids[] = 'districts=' . $okrug['id'];
        }

        $get_params = implode('&', $ids);

        $type = $type['id'];

        $text = $downloader->download('http://bus.gov.ru/public/agency/extendedSearch.html?type=' . $type . '&' . $get_params);

        $page_code = null;
        if (preg_match('#\?d\-(\d+)\-#sui', $text, $page_code)) {
            $page_code = $page_code[1];
        }

        $page = 1;

        while ($page < 10000) {
            $url = 'http://bus.gov.ru/public/agency/extendedSearch.html?' . ($page_code != null ? 'd-' . $page_code . '-p=' . $page . '&' : '') . 'type=' . $type . '&' . $get_params;
            $text = $downloader->download($url);

            if (!preg_match_all('#<div class="result-element">.+?data-num="(\d+)"#sui', $text, $items)) break;
            $response['ids'] = array_merge($response['ids'], $items[1]);

            $page++;
            if ($page_code == null) break;
        }

        break;

    case "ParseItem":
        $id = $_POST['id'];
        $file = $_POST['file'];

        $downloader = new Downloader();
        $text = $downloader->download('http://bus.gov.ru/public/agency/agency.html?agency=' . $id);

        preg_match('#<td>Наименование учреждения</td>.*?<td>(.+?), ИНН (\d+?), КПП (\d+?),#sui', $text, $fullname);

        $name = trim(strip_tags(html_entity_decode($fullname[1])));
        $inn = trim(strip_tags(html_entity_decode($fullname[2])));
        $kpp = trim(strip_tags(html_entity_decode($fullname[3])));

        preg_match('#<td>Тип учреждения</td>\s*<td>(.+?)</td>#sui', $text, $type);
        $type = trim(strip_tags(html_entity_decode($type[1])));

        if (preg_match('#<td>Контактный телефон</td>\s*<td>(.+?)</td>#sui', $text, $phone))
            $phone = trim(strip_tags(html_entity_decode($phone[1])));
        else
            $phone = '';

        if (strlen($phone) > 0) {
            $first_char = substr($phone, 0, 1);
            if ($first_char == '8' || $first_char == '7') {
                $phone = substr($phone, 1);
            }
        }

        if (substr_count($phone, '-') == 2) {
            if (substr($phone, 0, 1) == '-') {
                $phone = '(' . substr($phone, 1);
                $phone = str_replace('-', ')', $phone);
            }
        }

        if (preg_match('#<td>Адрес фактического местонахождения</td>\s*<td>(.+?)</td>#sui', $text, $postal))
            $postal = trim(strip_tags(html_entity_decode($postal[1])));
        else
            $postal = '';

        if (preg_match('#<td>Руководитель</td>\s*<td>(.+?)</td>#sui', $text, $contacts))
            $contacts = trim(strip_tags(html_entity_decode($contacts[1])));
        else
            $contacts = '';

        if (preg_match('#<td>Адрес электронной почты</td>\s*<td>(.+?)</td>#sui', $text, $email))
            $email = trim(strip_tags(html_entity_decode($email[1])));
        else
            $email = '';

        while (strpos($contacts, chr(32) . chr(32))) {
            $contacts = str_replace(chr(32) . chr(32), "", $contacts);
        }

        while (strpos($contacts, chr(10))) {
            $contacts = str_replace(chr(10), "", $contacts);
        }


        $file = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['file'];

        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $maxRow = $objPHPExcel->getActiveSheet()->getHighestRow() + 1;

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $maxRow, $id);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $maxRow, $name);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $maxRow, $inn);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $maxRow, $kpp);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $maxRow, $phone);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $maxRow, $postal);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $maxRow, $contacts);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $maxRow, $email);

        $objWriter->save($file);


        break;

    case 'CheckDoneCity':

        $okrug = $_POST['okrug']['label'];
        $type = $_POST['type']['label'];
        $count = $_POST['count'];

        $cities = $subjects = '';

        if (isset($_POST['cities'])) {
            $cities = array();
            foreach ($_POST['cities'] as $city) {
                $cities[] = $city['label'];
            }
            $cities = implode(', ', $cities);
        }

        if (isset($_POST['subjects'])) {
            $subjects = array();
            foreach ($_POST['subjects'] as $subject) {
                $subjects[] = $subject['label'];
            }
            $subjects = implode(', ', $subjects);
        }

        deleteFile($_POST['file']);

        $row = array(date('d.m.y'), date('H:i:s', $_POST['start_time']), date('H:i:s', time()), $count, $okrug, $subjects, $cities, $type, $_POST['file']);

        $f = fopen($_SERVER['DOCUMENT_ROOT'] . '/db.txt', 'a+');
        fwrite($f, implode(';;', $row) . "\n");
        fclose($f);

        break;

    case "GetHistory":

        $filename = $_SERVER['DOCUMENT_ROOT'] . '/db.txt';
        $data = file_exists($filename) ? file($filename) : array();
        $response = array();

        foreach ($data as $line) {
            $line_data = explode(';;', $line);
            $response[] = array(
                'date' => $line_data[0],
                'time_start' => $line_data[1],
                'time_finish' => $line_data[2],
                'count' => $line_data[3],
                'okrug' => $line_data[4],
                'subject' => $line_data[5],
                'city' => $line_data[6],
                'type' => $line_data[7],
                'url' => '/' . $line_data[8],
            );
        }

        $response = array_reverse($response);

        break;

    case "DeleteFile":

        $file = substr(trim($_POST['file']), 1);
        @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $file);

        $filename = $_SERVER['DOCUMENT_ROOT'] . '/db.txt';
        if (!file_exists($filename)) die;

        deleteFile($file);

        break;

    case "CreateSession":
        $f = fopen($_SERVER['DOCUMENT_ROOT'] . '/session', 'w+');
        fclose($f);

        break;

    case "DestroySession":
        @unlink($_SERVER['DOCUMENT_ROOT'] . '/session');
        break;

    case "CheckSession":
        $response = file_exists($_SERVER['DOCUMENT_ROOT'] . '/session') ? 1 : 0;
}


echo json_encode($response);
?>