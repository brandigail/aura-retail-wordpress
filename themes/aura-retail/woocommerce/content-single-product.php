<?php
/**
 * Overrides woocommerce/templates/content-single-product.php.
 * Gallery and summary sit in a two-column grid; tabs and related products go below.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

// Lets WooCommerce print notices (e.g. "added to cart") and stops if the product is password protected.
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo wp_kses_post( get_the_password_form() );
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="aura-single">
		<?php
		// Sale badge and image gallery.
		do_action( 'woocommerce_before_single_product_summary' );
		?>
		<div class="summary entry-summary">
			<?php
			// Title, rating, price, excerpt, add to cart, meta.
			do_action( 'woocommerce_single_product_summary' );
			?>
		</div>
	</div>
	<?php
	// Description/reviews tabs, upsells, related products.
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>
