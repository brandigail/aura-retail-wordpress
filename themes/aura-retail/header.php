<?php
/**
 * Site header.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text aura-skip-link" href="#main"><?php esc_html_e( 'Skip to main content', 'aura-retail' ); ?></a>

<div class="aura-announce">
	<div class="aura-wrap"><?php esc_html_e( 'Free delivery on orders over R1,000.', 'aura-retail' ); ?></div>
</div>

<header class="aura-header">
	<div class="aura-wrap aura-header__inner">
		<a class="aura-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

		<button class="aura-nav-toggle" aria-expanded="false" aria-controls="aura-nav">
			<?php esc_html_e( 'Menu', 'aura-retail' ); ?>
		</button>

		<nav id="aura-nav" class="aura-nav" aria-label="<?php esc_attr_e( 'Primary', 'aura-retail' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => 'wp_page_menu',
				)
			);
			?>
		</nav>

		<?php echo wp_kses_post( aura_cart_link_html() ); ?>
	</div>
</header>
