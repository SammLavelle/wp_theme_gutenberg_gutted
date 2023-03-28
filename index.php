<?php get_header(); ?>
<main id="main" class="section">
	<div class="block blog__feed width--default">
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog__link">
				<div>
					<h2><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
					<span>Read More</span>
				</div>
				<?php the_post_thumbnail(); ?>	
			</a>
		<?php endwhile; endif?>
	</div>
	<div class="block blog__pagination width--narrow align--center">
		<?php the_posts_pagination(); ?>
	</div>
</main>
<?php get_footer(); ?>