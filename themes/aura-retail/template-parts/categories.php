<?php
/**
 * Category tiles. Reads WooCommerce's product_cat taxonomy with get_terms().
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$aura_cats = taxonomy_exists( 'product_cat' ) ? get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ), // Hide "Uncategorized".
	)
) : array();

if ( empty( $aura_cats ) || is_wp_error( $aura_cats ) ) {
	return;
}
?>
<section class="aura-section" aria-labelledby="aura-cats-title">
	<div class="aura-wrap">
		<h2 id="aura-cats-title" class="aura-section__title"><?php esc_html_e( 'Shop by category', 'aura-retail' ); ?></h2>
		<ul class="aura-cats">
			<?php foreach ( $aura_cats as $aura_cat ) : ?>
				<li><a href="<?php echo esc_url( get_term_link( $aura_cat ) ); ?>"><?php echo esc_html( $aura_cat->name ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
