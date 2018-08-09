<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! $order = wc_get_order( $order_id ) ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
?>

<div class="col col-7 hidden-phone"></div>
<div class="col col-7-three mob-full">
	<div class="text">

		<?php
		if ( $show_downloads ) {
			wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
		}
		?>
		<section class="woocommerce-order-details">
			<h2 class="woocommerce-order-details__title"><?php _e( 'Order details', 'woocommerce' ); ?></h2>

			<div class="woocommerce-table woocommerce-table--order-details shop_table order_details cf">

				<div class="in-row p-b">
					<div class="woocommerce-table__product-name product-name"><?php _e( 'Product', 'woocommerce' ); ?></div>
					<div class="woocommerce-table__product-table product-total"><?php _e( 'Total', 'woocommerce' ); ?></div>
				</div>

				<div class="cf">
					<?php
						foreach ( $order_items as $item_id => $item ) {
							$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

							wc_get_template( 'order/order-details-item.php', array(
								'order'			     => $order,
								'item_id'		     => $item_id,
								'item'			     => $item,
								'show_purchase_note' => $show_purchase_note,
								'purchase_note'	     => $product ? $product->get_purchase_note() : '',
								'product'	         => $product,
							) );
						}
					?>
					<?php do_action( 'woocommerce_order_items_table', $order ); ?>
				</div>

				<div class="totals">
					<?php
						foreach ( $order->get_order_item_totals() as $key => $total ) {
							?>
							<div class="tr">
								<div class="h"><?php echo $total['label']; ?></div>
								<div class="bc"><?php echo $total['value']; ?></div>
							</div>
							<?php
						}
					?>
					<?php if ( $order->get_customer_note() ) : ?>
						<div class="tr">
							<div class="h"><?php _e( 'Note:', 'woocommerce' ); ?></div>
							<div class="bc"><?php echo wptexturize( $order->get_customer_note() ); ?></div>
						</div>
					<?php endif; ?>
				</div>

			</div>

			<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
		</section>

	</div>
</div>