<?php get_header(); ?>

<?php
if ( !wp_doing_ajax() ){
	set_query_var( 'type', 'portfolio' );
	get_template_part( 'partials/loop' );
}

$prev_post = get_previous_post();
$prev_post_id = !empty($prev_post) ? $prev_post->ID : NULL;
$next_post = get_next_post();
$next_post = empty($next_post) ? get_next_post() : $next_post;
$next_post_id = !empty($next_post) ? $next_post->ID : NULL;
$prev_post_link = has_text($prev_post_id) ? get_permalink( $prev_post_id ) : NULL;
$next_post_link = has_text($next_post_id) ? get_permalink( $next_post_id ) : NULL;
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="block-item" id="front-content">
	<div class="plus-sign">+</div>

	<div class="wrap">
		<div class="inner">

			<div class="grid-lines">
				<div class="container full-h">
					<div class="row">
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
					<div class="row">
						<div class="col col-7 meta-headers">
							<div><?php _e('Date','typical') ?></div>
							<div><?php _e('Object','typical') ?></div>
							<div><?php _e('Subject','typical') ?></div>
						</div>
						<div class="col col-7-five">
							<article>

								<div class="head">
									<time><?php echo get_the_date(); ?></time>
									<h2 class="nm">
										<?php the_primary_category(get_the_ID(), 'works', TRUE); ?>
									</h2>
									<h1 class="nm"><?php the_title(); ?></h1>
								</div>

								<div class="text cf" id="media-text"><?php the_content(); ?></div>

							</article>
						</div>
						<div class="col col-7 post-nav">
							<div>
								<a href="/" id="esc">
									<span class="hidden-phone"><?php _e('Escape','typical') ?></span>
									<span class="visible-phone plus">+</span>
								</a>
							</div>
							<?php if(has_text($prev_post_link)){ ?>
								<div>
									<a href="<?php echo $prev_post_link ?>">
										<span class="hidden-phone"><?php _e('Past','typical') ?></span>
										<span class="visible-phone"><</span>
									</a>
								</div>
							<?php } ?>
							<?php if(has_text($next_post_link)){ ?>
								<div>
									<a href="<?php echo $next_post_link ?>">
										<span class="hidden-phone"><?php _e('Future','typical') ?></span>
										<span class="visible-phone">></span>
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

		</div>
		<a href="/" class="invisible-link"></a>
	</div>
</section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
