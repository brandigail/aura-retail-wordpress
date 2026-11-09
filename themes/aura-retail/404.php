<?php
/**
 * 404 template.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="aura-main">
	<div class="aura-wrap aura-404">
		<h1><?php esc_html_e( 'Page not found', 'aura-retail' ); ?></h1>
		<p><?php esc_html_e( "That page or product doesn't exist.", 'aura-retail' ); ?></p>
		<a class="aura-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the shop', 'aura-retail' ); ?></a>
	</div>
</main>
<?php
get_footer();
