<?php get_header(); ?>

<div class="border-bottom">
	<article class="content-width">
		
			<h1><? the_title(); ?></h1>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile;  ?>
	</article>
</div>


<?php get_footer(); ?>