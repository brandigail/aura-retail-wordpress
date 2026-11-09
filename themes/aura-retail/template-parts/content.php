<?php
/**
 * Post summary used by index.php.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'aura-entry' ); ?>>
	<h2 class="aura-entry__title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
	<?php the_excerpt(); ?>
</article>
