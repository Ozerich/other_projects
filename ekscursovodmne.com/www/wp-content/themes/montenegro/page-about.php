<?php get_header(); ?>

    <div id="page_about">

    <div class="border-bottom">
        <div class="content-width">
            <section class="author-block">
                <h1>Виктор <em>Лиходиевский</em></h1>
                <?php while (have_posts()) : the_post(); ?>
                    <p><? the_content(); ?></p>
                <? endwhile ?>
            </section>

            <section class="services-block">
                <h1><em>Услуги</em></h1>
                <ul>
                    <?
                    $services = get_posts(array('post_type' => 'service'));
                    if ($services) {
                        foreach ($services as $service) {
                            echo "<li>";
                            echo get_the_post_thumbnail($service->ID, 'service-thumb', array('class' => 'service-thumb'));
                            echo apply_filters('the_title', $service->post_title);
                            echo "</li>";
                        }
                    }
                    ?>
                </ul>
            </section>
        </div>
    </div>

    <div class="border-bottom">
        <section class="portfolio-block content-width">
            <h1 class="black">Портфолио</h1>

            <div class="magazines">

                <a class="highslide-image" onclick="return hs.expand(this);" href="<?= get_template_directory_uri(); ?>/img/portfolio/magazine-1.big.jpg"><img src="<?= get_template_directory_uri(); ?>/img/portfolio/magazine-1.png"    alt=""></a>
                <a class="highslide-image" onclick="return hs.expand(this);" href="<?= get_template_directory_uri(); ?>/img/portfolio/magazine-2.big.jpg"><img src="<?= get_template_directory_uri(); ?>/img/portfolio/magazine-2.png"    alt=""></a>

                <p>Автор путеводителей «Полиглот»<br>
                    по Румынии.</p>
            </div>

            <div class="programs">

                <div class="program">
					<iframe width="420" height="315" src="http://www.youtube.com/embed/FG7AvXrGWJw" frameborder="0" allowfullscreen></iframe>
				</div>
				
				<div class="program">
<iframe width="420" height="315" src="http://www.youtube.com/embed/v9UNrdmhkSA" frameborder="0" allowfullscreen></iframe>
				</div>
				
				<a class="highslide-image" onclick="return hs.expand(this);" href="<?= get_template_directory_uri(); ?>/img/video.jpg">
					<img class="video" src="<?= get_template_directory_uri(); ?>/img/video_small.jpg">
				</a>

                <p>Организация и участие в съемках программы Дмитрия Крылова<br> «Непутевые заметки» по Румынии.</p>
            </div>
		
		

            <div class="guests">
                <h1>В числе гостей обслуженных в Черногории </h1>
                <ul>
				    <?
                    $guests = get_posts(array('post_type' => 'guest'));
                    if ($guests) {
                        foreach ($guests as $guest) {
						?>
						<li>
						<a href="<?=get_permalink($guest->ID)?>"><?=get_the_post_thumbnail($guest->ID, 'tour-thumb');?></a>
                        <label><?=apply_filters('the_title', $guest->post_title);?></span>
                            <span class="job"><?=apply_filters('the_excerpt', $guest->post_excerpt);?></label>
                        <a class="link" href="<?=get_permalink($guest->ID)?>">Смотреть</a>
						</li>
						<?
                    }
					}
                    ?>
                 
                </ul>
            </div>
        </section>
    </div>

    <div class="border-bottom">
        <section class="hobby-block content-width">
            <h1 class="black">Интересы и увлечения</h1>

            <div class="hobby-item">
                <i class="photo-icon"></i>

                <h2>Фотография</h2>
                <a href="/photoalbum/">Смотреть фото</a>
            </div>

            <div class="hobby-item">
                <i class="video-icon"></i>

                <h2>Создание рекламных роликов от идеи до воплощения</h2>

                <ul class="line4">
                    <li>
                        <audio controls preload="none">
                            <source src="/wp-content/uploads/2013/05/03-Za-more_da-za-sinee17.mp3" type="audio/mpeg">
                        </audio>
                        <label>“За море, да за синее…”</label>
                        <a href="/wp-content/uploads/2013/05/03-Za-more_da-za-sinee17.mp3" target="_blank">скачать</a>
                    </li>
                    <li>
                        <audio controls preload="none">
                            <source src="/wp-content/uploads/2013/05/04-Noch-s-Draculoi-016.mp3" type="audio/mpeg">
                        </audio>
                        <label>“Ночь с Дракулой”</label>
                        <a href="/wp-content/uploads/2013/05/04-Noch-s-Draculoi-016.mp3" target="_blank">скачать</a>
                    </li>
                    <li>
                        <audio controls preload="none">
                            <source src="/wp-content/uploads/2013/05/02-Avtobusom-po-Evrope-018.mp3" type="audio/mpeg">
                        </audio>
                        <label>“Автобусом по Европе”</label>
                        <a href="/wp-content/uploads/2013/05/02-Avtobusom-po-Evrope-018.mp3" target="_blank">скачать</a>
                    </li>
					<li>
                        <audio controls preload="none">
                            <source src="/wp-content/uploads/2013/05/01-Uzhasnye-kurorty-043.mp3" type="audio/mpeg">
                        </audio>
                        <label>“Ужасные курорты”</label>
                        <a href="/wp-content/uploads/2013/05/01-Uzhasnye-kurorty-043.mp3" target="_blank">скачать</a>
                    </li>
                </ul>

            </div>


            <div class="hobby-item video-block">
                <i class="songer-icon"></i>

                <h2>Автор и исполнитель песен</h2>

                <div class="video">
   <iframe width="420" height="315" src="http://www.youtube.com/embed/J-BoRUxbTLM" frameborder="0" allowfullscreen></iframe>
                </div>

                <ul>
					<li>
						<audio controls preload="none">
                              <source src="/wp-content/uploads/2013/05/01-Mne-tak-bylo-zhalj-3-56.mp3" type="audio/mpeg">
                        </audio>
						<label>“Мне так было жаль”</label>         
                        <a href="/wp-content/uploads/2013/05/01-Mne-tak-bylo-zhalj-3-56.mp3" target="_blank">скачать</a>						
					</li>
                    <li>
                        <audio controls preload="none">
                            <source src="/wp-content/uploads/2013/05/02-V-dome-moem-3-53.mp3" type="audio/mpeg">
                        </audio>
                        <label>“В доме моем”</label>
                        <a href="/wp-content/uploads/2013/05/02-V-dome-moem-3-53.mp3" target="_blank">скачать</a>
                    </li>
                </ul>

            </div>


            <div class="hobby-item songer-block">
                <i class="songer-icon"></i>

                <h2>Вокалист группы <a href="/accent" target="_blank">«АКЦЕНТ»</a></h2>
                <!--<a href="/accent" target="_blank">Подробнее о группе</a>-->

                <h3>Композиции группы «АКЦЕНТ» с альбома «KEEPSAKE»:</h3>

                <ul>
				
					<?
						
						$music = array(
' EYES OF A STRANGER ' => '/wp-content/uploads/2013/05/01_AKCENT_EYES-OF-A-STRANGER.mp3',
       ' DREAMING OF YOU ' => '/wp-content/uploads/2013/05/02_AKCENT_DREAMING-OF-YOU.mp3',
       ' YOU DRIVE ME CRAZY ' => '/wp-content/uploads/2013/05/03_AKCENT_YOU-DRIVE-ME-CRAZY.mp3',
       ' PICTURE ON THE WALL ' => '/wp-content/uploads/2013/05/04_AKCENT_PICTURE-ON-THE-WALL.mp3',
       ' EVERYTHING ALL RIGHT ' => '/wp-content/uploads/2013/05/05_AKCENT_EVERYTHING-ALL-RIGHT.mp3',
       ' SO LONG ' => '/wp-content/uploads/2013/05/06_AKCENT_SO-LONG.mp3',
       ' MEMORIES ' => '/wp-content/uploads/2013/05/07_AKCENT_MEMORIES.mp3',
       ' MINE ALL- MINE ' => '/wp-content/uploads/2013/05/08_AKCENT_MINE-ALL-MINE.mp3',
       ' NOW AND ONLY ' => '/wp-content/uploads/2013/05/09_AKCENT_NOW-AND-ONLY.mp3',
       ' KEEPSAKE ' => '/wp-content/uploads/2013/05/10_AKCENT_KEEPSAKE.mp3',
						);
						
						foreach($music as $label => $link){
?>
<li>
                        <audio controls preload="none">
                            <source src="<?=$link?>" type="audio/mpeg">
                        </audio>
                        <label>“<?=$label?>”</label>
                        <a href="<?=$link?>" target="_blank">скачать</a>
</li>
<?
						
						}
					?>
					
                </ul>
            </div>

        </section>
    </div>

    </div>

<?php get_footer(); ?>