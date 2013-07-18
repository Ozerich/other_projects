<?php get_header(); ?>

<div id="page_articles">
<?
	$articles = get_posts(array('post_type' => 'article'));
	if ($articles) {
		foreach ($articles as $ind => $article) {
			?>
			<div class="border-bottom">
				<article class="article content-width">
					<div class="image">
						<?=get_the_post_thumbnail($article->ID, 'article-thumb');?>
					</div>
					<div class="article-content">
						<h1 class="title"><?=apply_filters('the_title', $article->post_title);?></h1>
						<p><?=apply_filters('the_excerpt', $article->post_excerpt);?></p>
						<a href="<?=get_permalink( $article->ID )?>" class="button">Смотреть <i class="right"></i></a>
					</div>
				</article>
			</div>
		<?
		}
	}
?>

</div>

<?php get_footer(); ?>