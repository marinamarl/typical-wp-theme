<?php
/**
 * Simple product add to cart
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;


do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype="multipart/form-data" data-product_id="<?php echo absint( $product->get_id() ); ?>">

	<div class="row">
		<div class="col col-7 mob-full">
			<h1 class="normal"><?php the_title(); ?></h1>
			<div class="single_variation"><?php woocommerce_template_single_price(); ?></div>
		</div>
		<div class="col col-7 mob-full">

			<?php
			if ( $product->is_purchasable() && $product->is_in_stock() ) {

				woocommerce_quantity_input( array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
				) );

			?>
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button block alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			<?php } ?>
			<div class="added-msg"><?php _e('Added to cart', 'typical') ?></div>
			<a href="<?php echo wc_get_checkout_url() ?>" class="button block single_checkout_button" style="display:none;"><?php _e('Checkout', 'woocommerce') ?></a>
		</div>
		<div class="col col-7-four mob-full">
			<div class="text cf" id="media-text"><?php the_content(); ?></div>
		</div>
		<div class="col col-7 hidden-phone">
		</div>
	</div>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

