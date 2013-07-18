<? get_header(); ?>

    <div id="page_tours">
        <div class="border-bottom">
            <section class="content-width">
                <h1 class="one-line">Выбираем <em>маршрут</em></h1>
                <?php while (have_posts()) : the_post(); ?>
                    <p><? the_content(); ?></p>
                <? endwhile ?>
            </section>
        </div>

        <div class="border-bottom">
            <div class="content-width">
                <ul class="tours-list">
                    <?
                    $tours = get_posts(array('post_type' => 'tour', 'posts_per_page' => 1000));
                    if ($tours) {
                        foreach ($tours as $ind => $tour) {
                            ?>
                            <li class="preview">
                                <?php if (class_exists('MultiPostThumbnails')) : echo MultiPostThumbnails::get_the_post_thumbnail('tour', 'tour-video-thumb', $tour->ID, 'tour-video-thumb', array('class' => 'background')); endif; ?>
                                <h2 class="title"><?=apply_filters('the_title', $tour->post_title);?></h2>
                                <a href="<?=get_permalink($tour->ID)?>" class="play"></a>
                            </li>
                        <?
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <? foreach (get_children(array('post_parent' => $post->ID)) as $page): ?>
            <div class="border-bottom">
                <section class="content-width">
                    <h1 class="one-line"><?=preg_replace('#(.+?)\s(.+?)$#sui', '\\1 <em>\\2</em>', apply_filters('the_title', $page->post_title));?></h1>

                    <p><?=apply_filters('the_excerpt', $page->post_content);?></p>
                    <a href="/contacts" class="button">Забронировать <i class="right"></i></a>
                </section>
            </div>

        <? endforeach; ?>

    </div>

<? get_footer(); ?>