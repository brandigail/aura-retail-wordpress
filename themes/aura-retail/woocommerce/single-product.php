<?php
/**
 * Overrides woocommerce/templates/single-product.php: wrapper for one product page.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' ); // Wrapper + breadcrumb.

while ( have_posts() ) {
	the_post();
	wc_get_template_part( 'content', 'single-product' ); // Our override below.
}

do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
