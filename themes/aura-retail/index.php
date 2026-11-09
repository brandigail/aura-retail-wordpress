<?php
/**
 * Fallback template: blog index, archives and search (last stop in the template hierarchy).
 *
 * @package aura-retail
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="aura-main">
	<div class="aura-wrap">
		<?php if ( have_posts() ) : ?>
			<?php
			// The Loop: WordPress has already run the main query for this URL.
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			the_posts_pagination();
			?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
