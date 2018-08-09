<?php
/**
 * Variable product add to cart
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<div class="row">
		<div class="col col-7 mob-full">
			<h1 class="normal"><?php the_title(); ?></h1>
			<?php woocommerce_single_variation(); ?>
		</div>
		<div class="col col-7">

			<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
				<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
			<?php else : ?>
				<div class="variations">
						<?php foreach ( $attributes as $attribute_name => $options ) : ?>
								<div class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></div>
								<div class="value">
									<?php
										$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );
										wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
									?>
								</div>
						<?php endforeach;?>
				</div>

				<div class="single_variation_wrap mob-full">
					<?php woocommerce_single_variation_add_to_cart_button(); ?>
				</div>
				<div class="added-msg"><?php _e('Added to cart', 'typical') ?></div>
				<a href="<?php echo wc_get_checkout_url() ?>" class="button block single_checkout_button" style="display:none;"><?php _e('Checkout', 'woocommerce') ?></a>
			<?php endif; ?>

		</div>
		<div class="col col-7-four mob-full">
			<div class="text cf" id="media-text"><?php the_content(); ?></div>
		</div>
		<div class="col col-7 hidden-phone">
		</div>
	</div>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );

?>