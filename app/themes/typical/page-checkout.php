<?php get_header(); ?>

<?php
if ( !wp_doing_ajax() ){
	get_template_part( 'partials/shop-loop' );
}
?>

<section class="block-item" id="front-content">
	<div class="wrap checkout-page">
		<div class="inner">

			<div class="grid-lines">
				<div class="container full-h">
					<div class="row xs">
						<div class="col col-7 bordered"></div>
						<div class="col col-7 bordered"></div>
						<div class="col col-7 bordered"></div>
						<div class="col col-7 bordered hidden-phone"></div>
						<div class="col col-7 bordered hidden-phone"></div>
						<div class="col col-7 bordered hidden-phone"></div>
						<div class="col col-7 bordered hidden-phone"></div>
					</div>
				</div>
			</div>

			<div class="article-wrap">
				<div class="container">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>

		</div>
		<a href="<?php echo get_permalink( wc_get_page_id('shop') ) ?>" class="invisible-link"></a>
	</div>
</section>

<?php get_footer(); ?>
