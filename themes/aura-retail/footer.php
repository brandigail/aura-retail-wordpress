<?php
/**
 * Site footer.
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="aura-footer">
	<div class="aura-wrap">
		<div class="aura-footer__cols">
			<div>
				<h2><?php bloginfo( 'name' ); ?></h2>
				<p><?php esc_html_e( 'Everything you need, in one place.', 'aura-retail' ); ?></p>
			</div>
			<div>
				<h2><?php esc_html_e( 'Help', 'aura-retail' ); ?></h2>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>
			<div>
				<h2><?php esc_html_e( 'Get in touch', 'aura-retail' ); ?></h2>
				<?php /* Placeholder contact details only. */ ?>
				<p>hello@example.com<br>000 000 0000<br><?php esc_html_e( 'Monday to Friday, 08:00 to 17:00', 'aura-retail' ); ?></p>
			</div>
		</div>
		<p class="aura-footer__copy">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
			<?php esc_html_e( 'A demo rebuild as a custom WordPress theme.', 'aura-retail' ); ?>
		</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
