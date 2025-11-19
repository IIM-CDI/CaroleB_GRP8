<?php
/**
 * The template for displaying pages
 *
 * @package WP_B2
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>
	</div><!-- .container -->
</main><!-- #main-content -->

<?php
get_sidebar();
get_footer();
