<section class="list-section shop-section">

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
						<h3 class="tp" data-sort="name">
							<span><?php _e('Item', 'typical') ?></span>
						</h3>
					</div>
					<div class="col col-7-double">
						<h3 class="tp" data-sort="cat">
							<span><?php _e('Matter', 'typical') ?></span>
						</h3>
					</div>
					<div class="col col-7-double" data-sort="name">
						<?php if(function_exists('wc_get_checkout_url')){ ?>
						<h3 class="basket-num">
							<a href="<?php echo wc_get_checkout_url() ?>" id="basket-link" <?php if(WC()->cart->get_cart_contents_count()){ echo 'class="has-prds"'; } ?> >
								<?php _e('Basket', 'typical') ?> <?php echo get_basket_count() ?>
							</a>
						</h3>
						<?php } ?>
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
							'post_type' => 'product',
							'posts_per_page' => -1
						);

						$queried_object = get_queried_object();

						if($queried_object && isset($queried_object->taxonomy)){
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
							<a href="<?php the_permalink() ?>" class="half">
								<div class="row">
									<div class="col col-7-double" data-name="sort">
										<?php the_title(); ?>
									</div>
									<div class="col col-7-double hidden-phone" data-cat="sort">
										<?php
										$terms = get_the_terms(get_the_ID(), 'product_cat' );
										if($terms && count($terms)){ _e($terms[0]->name); }
										?>
									</div>
									<div class="col col-7-double hidden-phone">

									</div>
									<div class="col col-7"></div>
								</div>
							</a>
						</article>
				<?php endwhile; endif; ?>
				</div>
			</div>
		</div>

	</div>
</section>