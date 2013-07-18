<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Vital Ozierski, ozicoder@gmail.com">

    <title>Leadmama.ru :: Современная мама</title>

    <link rel="stylesheet" type="text/css" href="/css/jquery.cleditor.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/css/highslide.css"/>
    <link rel="stylesheet" type="text/less" href="/css/common.less"/>
    <link rel="stylesheet" type="text/less" href="/css/all.less"/>
    <link rel="stylesheet" type="text/less" href="/fancybox/jquery.fancybox.css"/>

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

    <script type="text/javascript" src="/js/less-1.3.3.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/jquery.cleditor.min.js"></script>
    <script type="text/javascript" src="/js/highslide.js"></script>
    <script type="text/javascript" src="/js/kendo.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
    <script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="/js/share42.js"></script>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?96"></script>
    <script type="text/javascript">
      VK.init({apiId: 3697376, onlyWidgets: true});
    </script>

		<!--[if lt IE 9]>
<script src="/js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-42136388-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>


    <header>

        <a class="logo" href="/"></a>
    <ul class="icon">
        <li><a target="_blank" href="https://www.facebook.com/leadmama"><img src="/images/icon04.gif" alt=""/></a></li>
        <li><a target="_blank" href="http://vk.com/leadmamastudio"><img src="/images/icon01.gif" alt=""/></a></li>
        <li><a target="_blank" href="http://instagram.com/leadmama_studio#"><img src="/images/instagram-icon.png" alt=""/></a></li>
    </ul>
    <? if (Yii::app()->user->isGuest): ?>

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


        <nav>
            <ul>
            <li <?=$this->active_tab == 'diary' ? 'class="active"' : ''?>><a href="/diary/"><img src="/images/img09.png" alt=""> <span>ДНЕВНИК</span></a></li>
            <li <?=$this->active_tab == 'gallery' ? 'class="active"' : ''?>><a href="/gallery/"><img src="/images/img1.png" alt=""> <span>ГАЛЕРЕЯ</span></a></li>
            <li <?=$this->active_tab == 'baby' ? 'class="active"' : ''?>><a href="/baby/"><img src="/images/img2.png" alt=""> <span>О МАЛЫШЕ</span></a></li>
            <li <?=$this->active_tab == 'growth' ? 'class="active"' : ''?>><a href="/growth/"><img src="/images/img3.png" alt=""> <span>РАЗВИТИЕ</span></a></li>
            <li <?=$this->active_tab == 'health' ? 'class="active"' : ''?>><a href="/health/"><img src="/images/img4.png" alt=""> <span>ЗДОРОВЬЕ</span></a></li>
            <li <?=$this->active_tab == 'calendar' ? 'class="active"' : ''?>><a href="/calendar/"><img src="/images/img5.png" alt=""> <span>КАЛЕНДАРЬ</span></a></li>
            </ul>
        </nav>
		
	<? endif; ?>

    </header>

    <? if (isset($this->list_tabs) && count($this->list_tabs) > 0): ?>

    <div class="tab-block">
        <em class="bg"></em>

        <div class="block width">
            <ul class="list-tabs">
                <? foreach ($this->list_tabs as $tab): ?>
                <li <?=$tab['active'] ? 'class="active"' : ''?>><a href="<?=$tab['link']?>"><?=$tab['label']?></a>
                </li>
                <? endforeach; ?>
                <br clear="all"/>
            </ul>
        </div>

    </div>
    <? endif; ?>

                    <?=$content?>



        <footer>
            <p class="copy">&copy; 2013 «Современная мама»</p>

            <p class="logotip"><a href="http://www.madeinmed.ru"></a> Made in</p>
            <nav>
                <ul>
                    <li><a href="/page/about_company">О компании</a></li>
                    <li><a href="/news">Новости</a></li>
                    <li><a href="/page/services">Наши услуги</a></li>
                    <li><a href="/page/contact">Контакты</a></li>
                </ul>
            </nav>
        </footer>



</div>
</body>
</html>
