<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/reset.css">
    <link rel="stylesheet" type="text/less" href="<?=get_template_directory_uri();?>/css/styles.less">

    <script src="<?=get_template_directory_uri();?>/js/less-1.3.3.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	    <script src="<?=get_template_directory_uri();?>/js/scripts.js"></script>

	
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="top-header">
        <div class="content-width">
            <div class="left">
                <span class="calendar">
				<?
					$monthes = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
					echo date('j ').$monthes[date('n') - 1].date(' Y'); 
				?>
				</span>
            </div>
            <div class="right">
                <span class="mail">becici@bk.ru</span>
                <span class="phone">+382 67 424-711</span>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="gallery">
            <div class="background"></div>
            <div class="content">
                <h1>Черногория</h1>

                <h2>Индивидуальные экскурсии</h2>

                <h2>Групповые туры</h2>
            </div>

            <div class="slides">
                <img data-num="1" class="active" style="display: block" src="<?=get_template_directory_uri();?>/img/slides/slide2.jpg">
                <img data-num="2" style="display: none" src="<?=get_template_directory_uri();?>/img/slides/slide3.jpg">
                <img data-num="3" style="display: none" src="<?=get_template_directory_uri();?>/img/slides/slide4.jpg">
                <img data-num="4" style="display: none" src="<?=get_template_directory_uri();?>/img/slides/slide5.jpg">
            </div>
			
			<div class="navigation">
				<a href="#" data-num="1" class="active"></a>
				<a href="#" data-num="2"></a>
				<a href="#" data-num="3"></a> 
				<a href="#" data-num="4"></a>
			</div>
        </div>

        <nav>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/about">Обо мне</a></li>
                <li><a href="/trips">Экскурсии</a></li>
                <li><a href="/photoalbum">Фотоальбом</a></li>
                <li><a href="/articles">Всяко разно</a></li>
                <li><a href="/contacts">Контакты</a></li>
            </ul>
        </nav>

        <div class="nav-line"></div>
    </div>
</header>