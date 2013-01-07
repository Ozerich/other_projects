<?
error_reporting(0);
session_start();

$calculators = array(
    '1' => array(
        'label' => 'Общая система налогообложения',
        'html' => 'Общая система налогообложения',
        'enabled' => array(1, 1),
    ),
    '2' => array(
        'label' => '«Упрощенка» с объектом «доходы минус расходы»',
        'html' => '«Упрощенка» с объектом «<strong>доходы минус расходы</strong>»',
        'enabled' => array(1, 1),
    ),
    '3' => array(
        'label' => '«Упрощенка» с объектом «доходы»',
        'html' => '«Упрощенка» с объектом «<strong>доходы</strong>»',
        'enabled' => array(1, 1),
    ),
    '4' => array(
        'label' => 'ЕНВД',
        'html' => 'ЕНВД',
        'enabled' => array(1, 1),
    ),
);

$calculator_results = isset($_SESSION['calculator_results_2']) ? $_SESSION['calculator_results_2'] : array();
for ($i = 1; $i <= 2; $i++) {
    if (!isset($calculator_results[$i])) {
        $calculator_results[$i] = array();
    }
    for ($j = 1; $j <= 5; $j++) {
        if (!isset($calculator_results[$i][$j])) {
            $calculator_results[$i][$j] = array(0, 0);
        }
    }
}


if (!isset($_SESSION['selected_type_2'])) {
    $_SESSION['selected_type_2'] = 0;
}

$selected_type = isset($_SESSION['selected_type_2']) ? $_SESSION['selected_type_2'] : 0;


$best_result = array('1' => 0, '2' => 0);

$all_count = 0;
foreach ($calculator_results as $type => $type_data) {
    $min = 0;
    $count = 0;
    foreach ($type_data as $calc_id => $calc_num) {
        if ($calc_num[1] != 0) {
            $count++;
            $all_count++;
            if ($min == 0 || $min > $calc_num[1]) {
                $min = $calc_num[1];
                $best_result[$type] = array($calc_id);
            }
            else if($min == $calc_num[1])
            {
                $best_result[$type][] = $calc_id;
            }
        }
    }

    if ($count < 2) {
        $best_result[$type] = 0;
    }

}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251;">

    <title>Agro</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.7.1.min.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 10]>
    <script type="text/javascript" src="js/jquery.pie.js"></script><![endif]-->
    <script src="js/jquery.colorbox-min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<body>
<div id="grid"></div>
<!-- This contains the hidden content for inline calls -->

<div class="wrapper">
    <header>
        <h1>Выбор налогового режима</h1>
    </header>
    <section class="middle">
        <p class="inf">Дорогие друзья!
            <br/><br/>
            Рады предложить вам новый сервис «Выбор налогового режима» - программу, которая позволит производственному предприятию сравнить общую сумму платежей в бюджет в 2013 году при различных режимах налогообложения по заданным параметрам. Кроме того, справочно выдается информация о сумме налогов и взносов при тех же показателях, но для тарифов 2012 года. Результат - возможность оптимизировать налоговую нагрузку.
            <br/><br/>
            Обратите внимание: программа выполняет автоматический расчет начислений с заданной базы, который применим для общей системы налогообложения. Однако при уплате единого «упрощенного» налога используется кассовый метод учета доходов и расходов. Поэтому данные нужно вносить исходя из сумм, которые предприятие фактически получит или уплатит в течение 2013 года.
            <br/><br/>

            Желаем вам успехов в работе!<br/>
            С уважением, редакция журнала «Учет производстве»</p>

        <? if ($all_count == 0): ?>
        <div class="align-center">
            <a href="#" title="Подобрать режим" class="btn-green" id="pick-up">Подобрать режим</a>
        </div>
        <? endif; ?>
        <!-- end_align-center -->
        <div class="mode" style="display: <?=$all_count == 0 ? 'none' : 'block'?>">
            <ul class="step-list">

                <li class="step" id="step-2">
                    <div class="step-title">
                        <span class="step-number">1</span><!-- end_step-number -->
                        <h2>Просчитайте размер налогов для интересующих вариантов систем налогообложения</h2>
                    </div>
                    <!-- end_step-title -->
                    <ul id="calculators_buttons" class="step-action">
                        <? foreach ($calculators as $id => $calc): ?>
                        <li>
                            <a href="calculation.php?calculator=<?=$id?>" title="<?=$calc['label']?>"
                               class="calculator-link btn <?=$selected_type > 0 && $calc['enabled'][$selected_type - 1] == 0 ? 'disabled' : ''?>">
                                <span class="item-165"><?=$calc['html']?></span>
                            </a>
                        </li>
                        <? endforeach; ?>
                    </ul>
                    <!-- end_step-action -->
                    <div class="step-sum">
                        <span class="step-sum-year">2012 г.</span>
                        <ul class="step-sum-list">
                            <? foreach ($calculator_results as $type => $type_data): ?>
                            <? for($i = 1; $i <= 5; $i++): $val = $type_data[$i]; ?>
                                <? if ($val[0] > 0): ?>
                                    <li style="display: <?=$type == $selected_type ? '' : 'none'?>"
                                        data-type="<?=$type?>"><?=$val[0]?> руб.
                                    </li>
                                    <? else: ?>
                                    <li style="display: <?=$type == $selected_type ? '' : 'none'?>"
                                        data-type="<?=$type?>"></li>
                                    <? endif; ?>
                                <? endfor; ?>
                            <? endforeach; ?>
                        </ul>
                        <!-- end_step-sum-list -->
                    </div>
                    <!-- end_step-sum -->
                    <div class="step-sum">
                        <span class="step-sum-year">2013 г.</span>
                        <ul class="step-sum-list">
                            <? foreach ($calculator_results as $type => $type_data): ?>
                                <? for($i = 1; $i <= 5; $i++): $val = $type_data[$i]; ?>
                                <? if ($val[1] > 0): ?>
                                    <li style="display: <?=$type == $selected_type ? '' : 'none'?>"
                                        data-type="<?=$type?>"><?=$val[1]?> руб.
                                    </li>
                                    <? else: ?>
                                    <li style="display: <?=$type == $selected_type ? '' : 'none'?>"
                                        data-type="<?=$type?>"></li>
                                    <? endif; ?>
                                <? endfor; ?>
                            <? endforeach; ?>
                        </ul>
                        <!-- end_step-sum-list -->
                    </div>
                    <!-- end_step-sum -->
                </li>

                <li class="step" id="step_3" style="display: <?=$best_result[$selected_type] != 0 ? 'block' : 'none'?>">
                    <div class="step-title">
                        <span class="step-number">2</span><!-- end_step-number -->
                        <h2>Рекомендация по выбору системы налогообложения</h2>
                    </div>
                    <!-- end_step-title -->
                    <div class="step-block">
                        <p>Оптимальная схема налогообложения на 2013 год:</p>

                        <? foreach ($best_result[''] as  $calc_id): ?>
                        <? if ($calc_id != 0): ?>
                            <h3 data-type="<?=$type_id?>"><?=$calculators[$calc_id]['label']?></h3>
                            <? endif; ?>
                        <? endforeach; ?>

                    </div>
                    <!-- end_step-block -->
                </li>

            </ul>
            <!-- end_step-list -->
            <div class="step-action" id="buttons" style="display: <?=$selected_type == 0 ? 'none' : 'block'?>">
                <a href="#" onClick="window.print(); return false" title="Распечатать" class="ico-print">Распечатать</a>

            </div>
            <!-- end_step-action -->
        </div>
        <!-- end_mode -->
    </section>
    <!-- middle-->
</div>
<!-- end_wrapper -->
<footer>
    <p class="center">«Расчет налогов»<br>2012 г. Все права защищены</p>
</footer>
</body>
</html>