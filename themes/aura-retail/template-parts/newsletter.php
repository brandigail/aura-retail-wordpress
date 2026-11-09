<?php
/**
 * Newsletter block. Posts to admin-post.php with a nonce (see aura_handle_newsletter()).
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$aura_news = isset( $_GET['aura_news'] ) ? sanitize_key( wp_unslash( $_GET['aura_news'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Display-only flag.
?>
<section id="newsletter" class="aura-newsletter">
	<div class="aura-wrap">
		<h2><?php esc_html_e( 'Get deals in your inbox', 'aura-retail' ); ?></h2>
		<?php if ( 'ok' === $aura_news ) : ?>
			<p class="aura-notice" role="status"><?php esc_html_e( 'Thanks for subscribing.', 'aura-retail' ); ?></p>
		<?php elseif ( 'error' === $aura_news ) : ?>
			<p class="aura-notice" role="alert"><?php esc_html_e( 'Please enter a valid email address.', 'aura-retail' ); ?></p>
		<?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="aura_newsletter">
			<?php wp_nonce_field( 'aura_newsletter', 'aura_newsletter_nonce' ); ?>
			<label class="screen-reader-text" for="aura-email"><?php esc_html_e( 'Email address', 'aura-retail' ); ?></label>
			<input type="email" id="aura-email" name="aura_email" placeholder="<?php esc_attr_e( 'you@example.com', 'aura-retail' ); ?>" required>
			<button type="submit" class="aura-btn"><?php esc_html_e( 'Subscribe', 'aura-retail' ); ?></button>
		</form>
	</div>
</section>
