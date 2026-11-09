<?php
/**
 * Home hero.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$aura_shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>
<section class="aura-hero">
	<div class="aura-wrap">
		<p class="aura-eyebrow"><?php esc_html_e( 'Welcome to Aura Retail', 'aura-retail' ); ?></p>
		<h1><?php esc_html_e( 'Everything you need, in one place', 'aura-retail' ); ?></h1>
		<p><?php esc_html_e( 'Kitchen, toys, crafts, swim gear, home, garden, pets, stationery and tech. Fair prices, honest reviews and delivery to your door.', 'aura-retail' ); ?></p>
		<div class="aura-hero__actions">
			<a class="aura-btn" href="<?php echo esc_url( $aura_shop_url ); ?>"><?php esc_html_e( 'Shop now', 'aura-retail' ); ?></a>
			<a class="aura-btn aura-btn--ghost" href="<?php echo esc_url( $aura_shop_url ); ?>"><?php esc_html_e( "See today's deals", 'aura-retail' ); ?></a>
		</div>
	</div>
</section>
