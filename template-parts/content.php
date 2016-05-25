<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post__header">
		<h2 class="post-title"><a class="post-title__link" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="post-info">
		<a href="#" class="post-info__item category">Uncategorized</a>
		<?php motor_the_date(); ?>
	</div>

	<?php if ( has_post_thumbnail() ) :?>
		<div class="post-img">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="post-content"><?php the_content(); ?></div>

	<button type="button" class="button button--primary">Read more</button>
</article>
