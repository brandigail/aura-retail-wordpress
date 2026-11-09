<?php
/**
 * Overrides woocommerce/templates/content-product.php: one product card.
 * Used by the shop, category archives, related products and the home page.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'aura-card', $product ); ?>>
	<a class="aura-card__image" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true">
		<?php echo wp_kses_post( $product->get_image( 'aura_card' ) ); // 4:3 crop; includes lazy-loading attributes. ?>
	</a>
	<?php woocommerce_show_product_loop_sale_flash(); ?>
	<div class="aura-card__body">
		<h2 class="aura-card__title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
		<?php woocommerce_template_loop_rating(); ?>
		<?php woocommerce_template_loop_price(); ?>
		<?php woocommerce_template_loop_add_to_cart(); ?>
	</div>
</li>
