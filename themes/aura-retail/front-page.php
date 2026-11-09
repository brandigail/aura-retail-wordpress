<?php
/**
 * Home page (WordPress picks front-page.php first when a static front page is set).
 * Each block lives in template-parts/ and is pulled in with get_template_part().
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main">
	<?php
	get_template_part( 'template-parts/hero' );
	get_template_part( 'template-parts/categories' );
	get_template_part( 'template-parts/featured-products' );
	get_template_part( 'template-parts/newsletter' );
	?>
</main>
<?php
get_footer();
