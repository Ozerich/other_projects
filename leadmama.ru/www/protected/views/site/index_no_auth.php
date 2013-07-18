<div class="page-block page-block-beige">
    <div class="top-bg"></div>

    <div class="width" id="home_about">

        <article>

			<? $page = Page::model()->find("alias='about_index'"); ?>
			<h2>Дорогие мамы!</h2>
			<p><?=$page->text; ?></p>

        </article>

        <aside class="news-block">

            <div class="news-top-bg">

                <div class="bg-sidebar">
                    <em class="left-bg"></em>
                    <em class="right-bg"></em>

                    <div class="news-content">
                        <h3 class="block-title">Новости</h3>

                        <ul class="news">
						
							<? foreach($news as $news_item): ?>
						
                            <li>
                                <? if($news_item->getImage()): ?>
									<a href="/news/<?=$news_item->id?>"><img src="<?=$news_item->getImage();?>"></a>
								<? endif; ?>

                                <div>
                                    <a class="news-title" href="/news/<?=$news_item->id?>"><?=$news_item->title?></a>
                                    <span class="date"><?=$news_item->date?></span>
                                </div>

                            </li>
							
							<? endforeach; ?>

                        </ul>

                        <a class="bullet" href="/news">все новости</a>

                    </div>
                </div>

            </div>

            <div class="news-bottom-bg"></div>

        </aside>

    </div>
</div>