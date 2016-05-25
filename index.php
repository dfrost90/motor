<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article class="post">
				<header class="post__header">
					<h2 class="post-title"><a class="post-title__link" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
				</header>
				<div class="post-info">
					<a href="#" class="post-info__item category">Uncategorized</a>
					<a href="#" class="post-info__item date">01 March 2016</a>
				</div>
				<div class="post-img">
					<img src="http://lorempixel.com/800/600/food/" alt="">
				</div>
				<div class="post-content">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, non repudiandae facere adipisci beatae voluptatum ipsum rem perferendis dolorem, eaque, aliquid odit. Quia eveniet incidunt dicta quasi dignissimos officia nobis.
				</div>
				<button type="button" class="button button--primary">Read more</button>
			</article>

		<?php endwhile; ?>

	<?php else : ?>

		<p>ololo</p>

	<?php endif; ?>

<?php get_footer(); ?>
