<?php
/**
 * Featured products: a WP_Query on the product post type, filtered by the
 * "featured" term in WooCommerce's product_visibility taxonomy.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) || ! class_exists( 'WooCommerce' ) ) {
	return;
}

$aura_featured = new WP_Query(
	array(
		'post_type'           => 'product',
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => true,
		'tax_query'           => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
			),
		),
	)
);

if ( ! $aura_featured->have_posts() ) {
	return;
}
?>
<section class="aura-section" aria-labelledby="aura-featured-title">
	<div class="aura-wrap">
		<h2 id="aura-featured-title" class="aura-section__title"><?php esc_html_e( 'Customer favourites', 'aura-retail' ); ?></h2>
		<?php /* WooCommerce's (and our) card CSS is scoped to ".woocommerce", which shop pages get from their body class. The home page needs this wrapper to match. */ ?>
		<div class="woocommerce">
			<?php
			woocommerce_product_loop_start();
			while ( $aura_featured->have_posts() ) {
				$aura_featured->the_post();
				wc_get_template_part( 'content', 'product' ); // Resolves to our woocommerce/content-product.php.
			}
			woocommerce_product_loop_end();
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
