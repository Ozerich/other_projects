<div id="page_news_list">
    <div class="page-block page-block-blue">
        <div class="width">
<? foreach($news as $news_item): ?>
						
                            <div class="news-item">
                                <a href="/news/<?=$news_item->id?>"><img src="<?=$news_item->getImage();?>"></a>

                                <div>
                                    <a class="news-title" href="/news/<?=$news_item->id?>"><?=$news_item->title?></a>
                                    <span class="date"><?=$news_item->date?></span>
                                </div>

                            </div>
							
							<? endforeach; ?>

</div>
</div>
</div>