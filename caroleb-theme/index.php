<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package WP_B2
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main">
	<div class="container">
		<?php
		if ( have_posts() ) :

			// Check if this is the blog home page.
			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="page-header">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/**
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, include a file
				 * called content-___.php (where ___ is the Post Type name) and that
				 * will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => __( 'Previous', 'wp-b2' ),
					'next_text'          => __( 'Next', 'wp-b2' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wp-b2' ) . ' </span>',
				)
			);

		else :

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</div><!-- .container -->
</main><!-- #main-content -->

<?php
get_sidebar();
get_footer();
