<?php get_header(); ?>

<div id="page_photoalbums" class="border-bottom">  
    <div class="content-width">
		<ul class="previews-list">
           <?
                    $albums = get_posts(array('post_type' => 'photoalbum'));
                    if ($albums) {
                        foreach ($albums as $ind => $album) {
                            ?>
                            <li class="preview">
								<?=get_the_post_thumbnail($album->ID, '', array('class' => 'background'));?>
                                <h2 class="title"><?=apply_filters('the_title', $album->post_title);?></h2>
                                <a href="<?=get_permalink($album->ID)?>" class="play"></a>
                            </li>
                        <?
                        }
                    }
                    ?>
		</ul>
    </div>

</div>

<?php get_footer(); ?>