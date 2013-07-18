<div id="page_page" class="page">
    <div class="page-block page-block-blue">
        <div class="width">
<div class="news-header">
            <h1><?=$news->title?></h1>
            <span class="news-date"><?=$news->date?></span>
            <br clear="all"/>
        </div>
        <article>
            <? if ($news->image): ?>
                <img class="news-image" src="<?=$news->getImage();?>"/>
            <? endif; ?>
            <?=$news->text?>
        </article>
        </div>
    </div>
</div>


