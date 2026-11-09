<?php
/**
 * Aura Retail theme setup.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AURA_VERSION', '1.0.0' );

/**
 * Register theme features. Runs on the after_setup_theme hook.
 */
function aura_setup() {
	load_theme_textdomain( 'aura-retail', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );

	// WooCommerce support, including the product gallery features.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary menu', 'aura-retail' ),
			'footer'  => esc_html__( 'Footer menu', 'aura-retail' ),
		)
	);
}
add_action( 'after_setup_theme', 'aura_setup' );

/**
 * Enqueue styles and scripts (never hard-code <link>/<script> in templates).
 */
function aura_enqueue_assets() {
	// Geist is self-hosted: @font-face rules live in style.css, files in assets/fonts/.
	wp_enqueue_style( 'aura-style', get_stylesheet_uri(), array(), AURA_VERSION );
	wp_enqueue_script( 'aura-main', get_template_directory_uri() . '/assets/js/main.js', array(), AURA_VERSION, true ); // true = load in footer.
}
add_action( 'wp_enqueue_scripts', 'aura_enqueue_assets' );

/**
 * Preload the main (latin) font file so text renders in Geist sooner.
 * crossorigin is required for font preloads, even when self-hosted.
 */
function aura_preload_font() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( get_template_directory_uri() . '/assets/fonts/geist-latin.woff2' )
	);
}
add_action( 'wp_head', 'aura_preload_font', 1 );

/**
 * Register image sizes. "aura_card" is a hard-cropped 4:3 size that matches the
 * product photos (1200x900) and the CSS aspect-ratio on cards, so cards stay uniform.
 * Existing images need their thumbnails regenerated after this is added.
 */
function aura_image_sizes() {
	add_image_size( 'aura_card', 600, 450, true );
}
add_action( 'after_setup_theme', 'aura_image_sizes' );

/**
 * Use the 4:3 size for the main product image on single product pages.
 *
 * @param array $size Image size data WooCommerce will use.
 * @return array
 */
function aura_single_image_size( $size ) {
	return array(
		'width'  => 900,
		'height' => 675,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_single', 'aura_single_image_size' );

/**
 * Remove the Cart page from the primary menu. The header already shows a cart
 * link with the item count, so a menu item would show "Cart" twice.
 *
 * @param array    $items Menu item objects.
 * @param stdClass $args  wp_nav_menu() arguments.
 * @return array
 */
function aura_remove_cart_menu_item( $items, $args ) {
	if ( 'primary' !== $args->theme_location || ! function_exists( 'wc_get_page_id' ) ) {
		return $items;
	}

	$cart_id = wc_get_page_id( 'cart' );

	return array_filter(
		$items,
		function ( $item ) use ( $cart_id ) {
			return (int) $item->object_id !== $cart_id;
		}
	);
}
add_filter( 'wp_nav_menu_objects', 'aura_remove_cart_menu_item', 10, 2 );

/**
 * Drop WooCommerce's float-based layout stylesheet; the theme uses CSS grid instead.
 * (General and smallscreen stylesheets stay, so cart/checkout keep their base styling.)
 *
 * @param array $styles Registered WooCommerce stylesheets.
 * @return array
 */
function aura_wc_styles( $styles ) {
	unset( $styles['woocommerce-layout'] );
	return $styles;
}
add_filter( 'woocommerce_enqueue_styles', 'aura_wc_styles' );

/**
 * Number of items in the cart (0 when WooCommerce is inactive).
 *
 * @return int
 */
function aura_cart_count() {
	return function_exists( 'WC' ) && WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;
}

/**
 * Cart link markup. Used by the header and by the AJAX fragment below,
 * so both always render identically.
 *
 * @return string
 */
function aura_cart_link_html() {
	if ( ! function_exists( 'wc_get_cart_url' ) ) {
		return '';
	}

	ob_start();
	?>
	<a class="aura-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
		<?php esc_html_e( 'Cart', 'aura-retail' ); ?>
		<span class="aura-cart-count"><?php echo esc_html( aura_cart_count() ); ?></span>
	</a>
	<?php
	return ob_get_clean();
}

/**
 * Cart fragments: WooCommerce re-sends these snippets after an AJAX add-to-cart
 * and swaps the matching CSS selector in the page, so the count updates live.
 *
 * @param array $fragments Selector => HTML pairs.
 * @return array
 */
function aura_cart_fragments( $fragments ) {
	$fragments['a.aura-cart-link'] = aura_cart_link_html();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'aura_cart_fragments' );

/**
 * Shop grid: 12 products per page (4 columns x 3 rows on desktop).
 */
add_filter( 'loop_shop_per_page', function () {
	return 12;
} );

/**
 * Newsletter form handler (admin-post.php). Verifies the nonce and sanitises the
 * email, then redirects with a status. It does not store the address; a real
 * mailing-list integration would plug in here.
 */
function aura_handle_newsletter() {
	$status = 'error';

	if ( isset( $_POST['aura_newsletter_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['aura_newsletter_nonce'] ) ), 'aura_newsletter' ) ) {
		$email = isset( $_POST['aura_email'] ) ? sanitize_email( wp_unslash( $_POST['aura_email'] ) ) : '';
		if ( is_email( $email ) ) {
			$status = 'ok';
		}
	}

	wp_safe_redirect( add_query_arg( 'aura_news', $status, home_url( '/' ) ) . '#newsletter' );
	exit;
}
add_action( 'admin_post_nopriv_aura_newsletter', 'aura_handle_newsletter' );
add_action( 'admin_post_aura_newsletter', 'aura_handle_newsletter' );
