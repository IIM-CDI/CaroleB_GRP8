<?php
/**
 * The template for displaying single posts
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

			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'wp-b2' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'wp-b2' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

		endwhile;
		?>
	</div><!-- .container -->
</main><!-- #main-content -->

<?php
get_sidebar();
get_footer();
