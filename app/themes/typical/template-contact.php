<?php
/*
Template Name: Contact
*/

get_header(); ?>

<section class="list-section page-section" id="ajax-content">

	<div class="wrap">
		<div class="icon-toggle">+</div>

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

		<div class="list-wrap">

			<div class="container sticky-head hidden-phone">
				<div class="row">
					<div class="col col-7-three">
						<h3>
							<span><?php _e('Contact', 'typical') ?></span>
						</h3>
					</div>
					<div class="col col-7-three">
						<h3>
							<span><?php _e('Social Medea', 'typical') ?></span>
						</h3>
					</div>
					<div class="col col-7">
						<h3 class="control-toggle">
							<span><?php _e('Control', 'typical') ?></span>
						</h3>
					</div>
				</div>
			</div>

			<div class="list">
				<div class="container">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article>
							<div class="row">
								<div class="col col-7-three">
									<div class="text"><?php the_content(); ?></div>
								</div>
								<div class="col col-7-three">
									<div class="text"><?php the_field('social_media'); ?></div>
								</div>
								<div class="col col-7"></div>
							</div>
					</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>

	</div>
</section>

<?php get_footer(); ?>
