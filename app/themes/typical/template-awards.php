<?php
/*
Template Name: Awards
*/

get_header(); ?>

<section class="list-section" id="ajax-content">

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
					<div class="col tp col-7-six">
						<h3>
							<?php _e('Public Image (selective)', 'typical') ?>
						</h3>
					</div>
					<div class="col col-7">
						<h3 class="control-toggle">
							<span><?php _e('Control', 'typical') ?></span>
						</h3>
					</div>
				</div>
			</div>

			<div class="list awards">
				<div class="container">
				<?php if (have_rows('awards_list')) :
				while (have_rows('awards_list') ) : the_row();
					$link = get_sub_field('link');
					?>
					<article>
							<?php if($link){ ?><a href="<?php the_sub_field('link') ?>" target="_blank" class="full"><?php } ?>
								<div class="row">
									<div class="col col-7 hidden-phone">
										<?php the_sub_field('date') ?>
									</div>
									<div class="col col-7 hidden-phone">
										<?php the_sub_field('type') ?>
									</div>
									<div class="col col-7-four" data-name="sort">
										<?php the_sub_field('name') ?>
									</div>
									<div class="col col-7"></div>
								</div>
							<?php if($link){ ?></a><?php } ?>
					</article>
				<?php endwhile; endif; ?>
				</div>
			</div>
		</div>

	</div>
</section>

<?php get_footer(); ?>
