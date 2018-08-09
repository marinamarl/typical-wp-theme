<?php
/**
 * The Template for displaying all single products
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php
if ( !wp_doing_ajax() ){
	get_template_part( 'partials/shop-loop' );
}

$prev_post = get_adjacent_post( true, '', true, 'product_cat' );
$prev_post = empty($prev_post) ? get_previous_post() : $prev_post;
$prev_post_id = !empty($prev_post) ? $prev_post->ID : NULL;
$next_post = get_adjacent_post( true, '', false, 'product_cat' );
$next_post = empty($next_post) ? get_next_post() : $next_post;
$next_post_id = !empty($next_post) ? $next_post->ID : NULL;
$prev_post_link = has_text($prev_post_id) ? get_permalink( $prev_post_id ) : NULL;
$next_post_link = has_text($next_post_id) ? get_permalink( $next_post_id ) : NULL;

global $product;
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
							<div><?php _e('Item','typical') ?></div>
							<div><?php _e('Matter','typical') ?></div>
						</div>
						<div class="col col-7-five">

								<div class="head">
									<h2 class="nm"><?php the_title(); ?></h2>
									<h2 class="nm">
										<?php
										$terms = get_the_terms(get_the_ID(), 'product_cat');
										if($terms && count($terms)){ ?>
											<a href="<?php echo get_term_link($terms[0]) ?>"><?php _e($terms[0]->name); ?></a>
										<?php } ?>
									</h2>
								</div>

								<?php if ( has_post_thumbnail() ) : ?>
									<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
									<?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')?>
									<a href="<?php echo $thumbnail[0] ?>" target="_blank" class="no-ajax main-img gallery <?php if($attachment_ids && count($attachment_ids)){ echo 'arrowed'; } ?>" title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail('full') ?>
									</a>
									<div class="thumbnails">
										<?php
										if ( $attachment_ids ) {
											foreach ( $attachment_ids as $attachment_id ) {
												$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
												$attributes = array( 'title' => get_post_field( 'post_title', $attachment_id ) );
												$html  = '<a href="' . esc_url( $full_size_image[0] ) . '" class="no-ajax gallery">';
												$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
										 		$html .= '</a>';
												echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
											}
										}
										?>
									</div>
								<?php endif; ?>

						</div>
						<div class="col col-7 post-nav">
							<div>
								<a href="/shop" id="esc">
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
					<article id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
							/**
							 * woocommerce_single_product_summary hook.
							 *
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							do_action( 'woocommerce_single_product_summary' );
						?>
					</article>
				</div>
			</div>

		</div>
		<a href="<?php echo get_permalink( wc_get_page_id('shop') ) ?>" class="invisible-link"></a>
	</div>
</section>
<?php endwhile; endif; ?>

<?php get_footer( 'shop' );