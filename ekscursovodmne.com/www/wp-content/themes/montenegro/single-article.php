<?php get_header(); ?>
<div id="page_article">
	<div class="border-bottom">
		<article class="content-width">
					<h1><? the_title(); ?></h1>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile;  ?>
		</article>
	</div>
	
	
	<div class="border-bottom">
		<div class="content-width buttons">
		<? $prev_post = get_adjacent_post(false, '', true); $next_post = get_adjacent_post(false, '', false); ?>
				<? if($prev_post): ?>
					<a class="left button" href="<?=get_permalink($prev_post->ID)?>"><i class="left"></i>Назад</a>
				<? endif; ?>
				<? if($next_post): ?>
				<a class="right button" href="<?=get_permalink($next_post->ID)?>"> Вперед <i class="right"></i></a>
				<? endif; ?>
				
		</div>
	</div>
</div>


<?php get_footer(); ?>