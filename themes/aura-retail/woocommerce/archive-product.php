<?php
/**
 * Overrides woocommerce/templates/archive-product.php: the shop page and category archives.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 * Outputs our wrapper (global/wrapper-start.php) and the breadcrumb.
 */
do_action( 'woocommerce_before_main_content' );
?>
<header class="aura-shop-head">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>
	<?php
	if ( woocommerce_product_loop() ) {
		woocommerce_catalog_ordering(); // Sort dropdown.
	}
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {
	woocommerce_result_count();
	woocommerce_product_loop_start();

	// The Loop over the main product query.
	while ( have_posts() ) {
		the_post();
		wc_get_template_part( 'content', 'product' );
	}

	woocommerce_product_loop_end();
	do_action( 'woocommerce_after_shop_loop' ); // Pagination.
} else {
	do_action( 'woocommerce_no_products_found' );
}

do_action( 'woocommerce_after_main_content' ); // Closes our wrapper.

get_footer( 'shop' );
