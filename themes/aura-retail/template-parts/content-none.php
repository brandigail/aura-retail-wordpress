<?php
/**
 * Shown when a query returns nothing.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section>
	<h1><?php esc_html_e( 'Nothing found', 'aura-retail' ); ?></h1>
	<p><?php esc_html_e( 'Try a different search.', 'aura-retail' ); ?></p>
	<?php get_search_form(); ?>
</section>
