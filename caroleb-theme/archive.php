<?php
/**
 * The template for displaying archive pages
 *
 * @package WP_B2
 * @since 1.0.0
 */

get_header();
?>

<main id="main-content" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

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
