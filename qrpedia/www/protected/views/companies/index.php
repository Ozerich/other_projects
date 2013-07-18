<a href="#new_company" class="button-new popup-button">Создать новую</a>


<?
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_item',

    'pagerCssClass' => 'pager-box',
    'pager' => array(
        'firstPageLabel' => '',
        'prevPageLabel'  => '',
        'nextPageLabel'  => '',
        'lastPageLabel'  => '',
        'header' => '',
        'htmlOptions' => array('class' => 'pager'),
    ),

    'template' => "<table>
    <tbody>
    <tr>
        <th>ID</th>
        <th>Дата</th>
        <th>Название</th>
        <th>Баланс</th>
        <th>Форма</th>
        <th>Пакет</th>
        <th>Отрасль</th>
        <th>Статус</th>
        <th>Модератор</th>
    </tr>{items}

    </tbody>
</table>\n{summary}\n{pager}",

    'summaryText' => '<p class="summary"><span>Показано</span> {start}-{end} компаний из {count}</p>'
));
?>


<div class="popup cartochka" id="new_company">

<? $this->renderPartial('_item_form', array('model' => new Company())); ?>
</div>
<div class="popup paket" id="popup2">
<a href="#" class="close"></a>
<span class="h2">Настройка пакета</span>
<!--
<form action="#" onsubmit="saveFn()">
<fieldset>
    <div class="box">
        <label for="n10">Количество объявлений:</label>
        <input id="n10" type="text" class="input input5" value="1">
        <span>шт.</span>
    </div>
    <div class="box">
        <label>Тип объявлений:</label>
        <select class="select select2">
            <option>Расширенное</option>
            <option>Расширенное1</option>
            <option>Расширенное2</option>
            <option>Расширенное3</option>
            <option>Расширенное4</option>
            <option>Расширенное5</option>
        </select>
    </div>
    <div class="box">
        <label>Период действия объявления:</label>
        <select class="select select3">
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
        </select>
        <span>мес.</span>
    </div>
    <div class="links">
        <input type="submit" class="button-new" value="Сохранить">
    </div>
</fieldset>
</form>
</div>
<div class="popup grafik-pop" id="popup4">
<a href="#" class="close"></a>
<span class="h2">ООО "Название"</span>
<ul class="tabset">
<li class="active"><a href="#tab1">Частота просмотров</a></li>
<li>
    <a href="#tab2">География</a></li>
</ul>
<div id="tab1">
<div class="grafik" id="grafik"></div>
</div>
<div id="tab2">
<div class="grafik" id="grafik2"></div>
</div>
<script type="text/javascript">
var data = google.visualization.arrayToDataTable([
    ['2003', 10],
    ['2004', 20],
    ['2005', 30],
    ['2006', 40],
    ['2007', 40],
    ['2008', 60],
    ['2009', 70],
    ['2010', 80],
    ['2011', 70],
    ['2012', 80],
    ['2013', 100],
    ['2014', 110],
    ['2015', 120],
    ['2016', 130],
    ['2017', 140]
]);
var chart = new google.visualization.AreaChart(document.getElementById('grafik'));
chart.draw(data, options);

// additional charts
var data2 = google.visualization.arrayToDataTable([
    ['2003', 10],
    ['2004', 20],
    ['2007', 40],
    ['2008', 60],
    ['2009', 70],
    ['2010', 80],
    ['2011', 70],
    ['2012', 80],
    ['2013', 100],
    ['2014', 110],
    ['2015', 120],
    ['2016', 130],
    ['2017', 140]
]);
var chart2 = new google.visualization.AreaChart(document.getElementById('grafik2'));
chart2.draw(data2, options);
</script>
</div>
<div class="popup grafik-pop" id="popup3">
<a href="#" class="close"></a>
<span class="h2">Иванов Иван Иванович</span>
<ul class="tabset">
<li class="active"><a href="#tab3">Частота просмотров</a></li>
<li>
    <a href="#tab4">География</a></li>
</ul>
<div id="tab3">
<div class="grafik" id="grafik3"></div>
</div>
<div id="tab4">
<div class="grafik" id="grafik4"></div>
</div>
<script type="text/javascript">
var data = google.visualization.arrayToDataTable([
    ['2003', 10],
    ['2004', 20],
    ['2005', 30],
    ['2006', 40],
    ['2007', 40],
    ['2008', 60],
    ['2009', 70],
    ['2010', 80],
    ['2011', 70],
    ['2012', 80],
    ['2013', 100],
    ['2014', 110],
    ['2015', 120],
    ['2016', 130],
    ['2017', 140]
]);
var chart = new google.visualization.AreaChart(document.getElementById('grafik3'));
chart.draw(data, options);

// additional charts
var data2 = google.visualization.arrayToDataTable([
    ['2003', 10],
    ['2004', 20],
    ['2007', 40],
    ['2008', 60],
    ['2009', 70],
    ['2010', 80],
    ['2011', 70],
    ['2012', 80],
    ['2013', 100],
    ['2014', 110],
    ['2015', 120],
    ['2016', 130],
    ['2017', 140]
]);
var chart2 = new google.visualization.AreaChart(document.getElementById('grafik4'));
chart2.draw(data2, options);
</script>
</div>
-->