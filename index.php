<?php get_header(); ?>
<main id="main">
	<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div>
				<h2><?php the_title(); ?></h2>
				<p><?php echo get_excerpt(150); ?></p>
				<span>Read More</span>
			</div>
			<figure>
				<?php the_post_thumbnail(); ?>
			</figure>  	
		</a>
	<?php endwhile; endif?>
	<nav class="pagination"><?php bnine_pagination(); ?></nav>
</main>
<?php get_footer(); ?>