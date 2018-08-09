<section class="list-section">

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
					<div class="col col-7-double">
						<h3 class="tp" data-sort="date">
							<span><?php _e('Date', 'typical') ?></span>
						</h3>
					</div>
					<div class="col col-7-double">
						<h3 class="tp" data-sort="cat">
							<span><?php
							if($type === 'portfolio')
								_e('Object', 'typical');
							else
								_e('Category', 'typical');
							?></span>
						</h3>
					</div>
					<div class="col col-7-double" data-sort="name">
						<h3 class="tp">
							<span><?php _e('Subject', 'typical') ?></span>
						</h3>
					</div>
					<div class="col col-7">
						<h3 class="tp control-toggle">
							<span><?php _e('Control', 'typical') ?></span>
						</h3>
					</div>
				</div>
			</div>

			<div class="list">
				<div class="container">
				<?php
					$args = array(
						'post_type' => $type,
						'posts_per_page' => -1
					);

					$queried_object = get_queried_object();
					if($queried_object && $queried_object->taxonomy){
						$args['tax_query'] = array(
							array(
								'taxonomy' => $queried_object->taxonomy,
								'field'    => 'term_id',
								'terms'    => $queried_object->term_id
							)
						);
					}

					$q = new WP_Query($args);
				?>
				<?php if ($q->have_posts()) : while ($q->have_posts()) : $q->the_post(); ?>
						<article>
							<a href="<?php the_permalink() ?>" class="full">
								<div class="row">
									<div class="col col-7-double" data-date="sort" data-time="<?php echo get_the_date('U') ?>">
										<?php echo get_the_date(); ?>
									</div>
									<div class="col col-7-double hidden-phone" data-cat="sort">
										<?php the_primary_category(get_the_ID(), ($type === 'portfolio' ? 'works' : 'category')); ?>
									</div>
									<div class="col col-7-double hidden-phone" data-name="sort">
										<?php the_title(); ?>
									</div>
									<div class="col col-7"></div>
								</div>
							</a>
						</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>

	</div>
</section>