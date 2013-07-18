<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>index</title>

    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="/css/reset.css"/>
    <link rel="stylesheet" type="text/less" href="/css/common.less"/>
    <link rel="stylesheet" type="text/less" href="/css/admin.less"/>

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

    <script type="text/javascript" src="/js/less-1.3.3.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
	<!--[if lt IE 9]>
		<script src="/js/html5shiv.js"></script>
	<![endif]-->
</head>

<body class="admin">

<div class="main">

    <header>

        <a class="logo" href="/"></a>
        <ul class="icon">
            <li><a href="#"><img src="/images/icon04.gif" alt=""/></a></li>
            <li><a href="#"><img src="/images/icon01.gif" alt=""/></a></li>
            <li><a href="#"><img src="/images/icon02.gif" alt=""/></a></li>
        </ul>

        <? if (Yii::app()->user->getIsGuest()): ?>

        <ul class="links">
            <li><span class="vhod"><a href="/login">Войти</a></span></li>
            <li><a class="registr" href="/register">Зарегистрироваться</a></li>
        </ul>

        <? else: ?>

        <div class="user">
            <p>Здравствуйте, <?=Yii::app()->user->getName()?>!</p>

            <? if (Yii::app()->user->isAdmin()): ?>
            <a class="admin-link" href="/admin/">Панель управления</a>
            <? endif; ?>
            <a href="/logout">Выход</a>
        </div>


        <? endif; ?>


    </header>


    <div class="page">

        <h1><?=$this->page_name?></h1>

        <ul class="admin-menu">
            <li><a href="/admin/pages/">Управление страницами</a></li>
            <li><a href="/admin/pages/item">Новая страница</a></li>
            <li><a href="/admin/news/">Управление новостями</a></li>
            <li><a href="/admin/news/item">Новая новость</a></li>
            <li><a href="/admin/users">Пользователи</a></li>
        </ul>

        <?=$content?>
    </div>

    <div class="footer-bg">

        <footer>
            <p class="copy">&copy; 2013 «Современная мама»</p>

            <p class="logotip"><a href="http://www.madeinmed.ru"></a> Made in</p>
            <nav>
                <ul>
                    <li><a href="/about_company">О компании</a></li>
                    <li><a href="/news">Новости</a></li>
                    <li><a href="/services">Наши услуги</a></li>
                    <li><a href="/contact">Контакты</a></li>
                </ul>
            </nav>
        </footer>

    </div>


</div>
</body>
</html>
