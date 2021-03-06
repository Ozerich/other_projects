﻿<?
session_start();

if ($_POST) {
    $calculator = $_POST['calculator'];
    $type = $_POST['type'];

    $_SESSION['selected_type_2'] = $type;

    if (!isset($_SESSION['calculator_vars_2']))
        $_SESSION['calculator_vars_2'] = array();

    if (!isset($_SESSION['calculator_vars_2'][$calculator]))
        $_SESSION['calculator_vars_2'][$calculator] = array();

    if (!isset($_SESSION['calculator_vars_2']['ins']))
        $_SESSION['calculator_vars_2']['ins'] = array();

    if(!isset($_POST['ins_c1']))$_POST['ins_c1'] = 0;
    if(!isset($_POST['ins_c2']))$_POST['ins_c2'] = 0;

    foreach ($_POST as $var => $value) {
        if ($var == 'calculator' || $var == 'type' || $var == 'prev_year' || $var == 'next_year') {
            continue;
        }

        if (substr($var, 0, 3) != 'ins') {
            $_SESSION['calculator_vars_2'][$calculator][$var] = $value;
        } else {
            $_SESSION['calculator_vars_2']['ins'][$var] = $value;
        }

    }


    $_SESSION['calculator_results_2'][$type][$calculator] = array($_POST['prev_year'], $_POST['next_year']);

    header("Location: index.php");
    exit;
}

$calculator_id = $_GET['calculator'];
$type = isset($_GET['type']) ? $_GET['type'] : 1;
if (!$calculator_id || $calculator_id < 1 || $calculator_id > 4 || !$type || ($type != 1 && $type != 2)) die;

$script = "proisvod_" . $calculator_id;
$template = "proisvod_" . $calculator_id;

$ins_vars = isset($_SESSION['calculator_vars_2']['ins']) ? $_SESSION['calculator_vars_2']['ins'] : array();
$vars = isset($_SESSION['calculator_vars_2'][$calculator_id]) ? $_SESSION['calculator_vars_2'][$calculator_id] : array();

function v($var, $default = '')
{
    global $vars, $ins_vars;

    $data = strpos($var, 'ins') !== false ? $ins_vars : $vars;

    if(!isset($data[$var]))
    {
        return $default;
    }

    $res = $data[$var];

    if($res === "on")
    {
        $res = 1;
    }


    return strpos($res, '.') === false && strpos($res, ',') === false ? ($res != '' ? (int)$res : '') : $res;
}


?>

<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251;">

    <title>Agro / Расчёт</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.7.1.min.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 10]>
    <script type="text/javascript" src="js/jquery.pie.js"></script><![endif]-->
    <script type="text/javascript" src="js/knockout-2.2.0.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>

    <script type="text/javascript" src="js/<?=$script?>.js"></script>

</head>
<body>

<div class="wrapper">

    <? include "calculators/" . $template . ".php"; ?>

</div>

<script type="text/javascript">
    ko.applyBindings(new ViewModel(<?=$type?>));
</script>

<!-- end_wrapper -->
<footer>
    <p class="center">«Расчет налогов»<br>2012 г. Все права защищены</p>
</footer>
</body>
</html>