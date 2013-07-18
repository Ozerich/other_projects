<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>login</title>
    <link rel="stylesheet/less" type="text/css" href="/css/all.less"/>
    <link rel="stylesheet" type="text/css" href="/css/smoothness/jquery-ui-1.10.1.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-timepicker-addon.css"/>
    <link rel="stylesheet" type="text/css" href="/colorpicker/css/colorpicker.css"/>

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <?php Yii::app()->clientScript->registerCoreScript('yiiactiveform');?>

    <script type="text/javascript" src="/js/jquery-ui-1.10.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/js/jquery.simpleLightbox.js"></script>

    <script type="text/javascript" src="/js/html5shiv.js"></script>
    <script type="text/javascript" src="/js/less-1.3.3.min.js"></script>

    <script type="text/javascript" src="/js/jquery.main.js"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/colorpicker/js/colorpicker.js"></script>

    <script src="/js/scripts.js"></script>
    <script src="/js/navigator.js"></script>
    <script src="/js/folders.js"></script>

</head>
<body>
<div class="header-bg">
    <header>
        <a href="/" class="logo"></a>
        <a href="/logout" class="button logout">Выйти</a>
        <? if (Yii::app()->user->isAdmin() == false): ?>
        <a href="#" class="button"><img src="/images/button-img.gif" alt="">Пополнить</a>
        <span class="balans">Баланс <span><?=Yii::app()->user->model()->balance?> $</span></span>
        <? endif; ?>
    </header>
</div>
<div class="holder">
    <nav>
        <ul>
            <? if (Yii::app()->user->isAdmin()): ?>
            <li><a href="/companies">Компании</a><span class="shadow"></span></li>
            <li><a href="/adverts">Все объявления</a><span class="shadow"></span></li>
            <li><a href="/payments">Платежи и документы</a><span class="shadow"></span></li>
            <li><a href="/stats">Статистика</a><span class="shadow"></span></li>
            <? else: ?>
            <li><a href="/adverts">Объявления</a><span class="shadow"></span></li>
            <li><a href="/profile">Личные данные</a><span class="shadow"></span></li>
            <li><a href="/payments">Платежи и документы</a><span class="shadow"></span></li>
            <? endif; ?>
        </ul>
    </nav>
    <div id="page_ajax_loader"></div>
    <section>
        <?=$content?>
    </section>
</div>
</body>
</html>
