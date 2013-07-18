<? $this->renderPartial(Yii::app()->user->isGuest ? '//site/index_no_auth' : '//site/index_auth', array('news' => $news)); ?>

<div class="page-block page-block-yellow">

    <div class="width" id="home_services">

        <div class="photo-block girl">
            <div>
                <img src="images/img07.png" alt=""/>
                <span class="ramka"></span>
            </div>
            <h4><a href="/page/aliсe">Алиса</a></h4>
            <em class="years">6 месяцев</em>
        </div>

        <article>
			<? $page = Page::model()->find("alias='uslugi'"); ?>
			<h2><?=$page->title; ?></h2>
			<p><?=$page->text; ?></p>
        </article>

        <div class="photo-block boy">
            <div>
                <img src="images/img08.png" alt=""/>
                <span class="ramka"></span>
            </div>
            <h4><a href="/page/vanya">Ваня</a></h4>
            <em class="years">1 год</em>
        </div>

    </div>
</div>

<div class="page-block page-block-green">
    <div class="width" id="home_useful_info">
		
	  <? $page = Page::model()->find("alias='information'"); ?>
        <h2><?=$page->title; ?></h2>
        <?=$page->text; ?>
 
    </div>
</div>