<?php get_header(); ?>

    <div id="page_home">
        <div class="content-width">
            <section class="welcome-block">
                <h1>Добро <em>пожаловать!</em></h1>
                <p><?php  $post = get_post(11); echo apply_filters('the_content', $post->post_content);  ?></p>
            </section>
            <section class="tours-block">
                <h1>Экскурсионные <em>программы</em></h1>
                <ul>
                    <?
                    $tours = get_posts(array('post_type' => 'tour'));
                    if ($tours) {
                        foreach ($tours as $ind => $tour) { if($ind >= 3)break;

                    ?>
                            <li <?=$ind % 2 == 1 ? 'class="right"' : ''?>>
                               <?php if (class_exists('MultiPostThumbnails')) : echo MultiPostThumbnails::get_the_post_thumbnail('tour', 'tour-thumb', $tour->ID, 'tour-thumb'); endif; ?>

                                <div class="tour-content">

                                    <h2><?=apply_filters('the_title', $tour->post_title);?></h2>
                                    <p><?=apply_filters('the_excerpt', $tour->post_excerpt);?></p>

                                    <a href="<?=get_permalink($tour->ID)?>">Смотреть</a>
                                </div>
                            </li>


                    <?    }
                    }
                    ?>


                </ul>
                <a href="/trips" class="button">Все экскурсии <i class="right"></i></a>
            </section>
        </div>

        <section class="photoalbum-block">
            <h1>Фотоальбом <em>по странам</em></h1>
			
			<div id="slider" class="slider">
				<div class="slider-carousel">
					<ul>
					
						<? $countries = get_posts(array('post_type' => 'country', 'posts_per_page' => 111111)); foreach ($countries as $country):?>
					
						<li><a href="<?=get_permalink($country->ID);?>"><div class="overlay"></div><?=get_the_post_thumbnail($country->ID, 'country-thumb')?><h2><?=$country->post_title?></h2></a></li>
						<? endforeach; ?>					
					</ul>
					<a href="#" class="left arrow"></a>
					<a href="#" class="right arrow"></a>
				</div>
			</div>
        </section>




<?php get_footer(); ?>