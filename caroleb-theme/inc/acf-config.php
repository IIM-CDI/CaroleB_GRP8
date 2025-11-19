<?php
/**
 * Advanced Custom Fields (ACF) Configuration
 *
 * @package WP_B2
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set ACF JSON save point
 *
 * This function tells ACF to save field group JSON files to the theme's acf-json folder.
 * This allows version control of field groups.
 *
 * @param string $path The default ACF JSON save path.
 * @return string Modified path pointing to theme's acf-json folder.
 */
function wp_b2_acf_json_save_point( $path ) {
	return WP_B2_THEME_DIR . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'wp_b2_acf_json_save_point' );

/**
 * Set ACF JSON load point
 *
 * This function tells ACF to load field group JSON files from the theme's acf-json folder.
 *
 * @param array $paths Array of paths to load ACF JSON from.
 * @return array Modified array including theme's acf-json folder.
 */
function wp_b2_acf_json_load_point( $paths ) {
	// Remove original path.
	unset( $paths[0] );

	// Add new path.
	$paths[] = WP_B2_THEME_DIR . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'wp_b2_acf_json_load_point' );

/**
 * Add ACF Options Page
 *
 * Creates a theme options page in the WordPress admin.
 * Uncomment this function to enable theme options.
 */
// function wp_b2_acf_add_options_page() {
// if ( function_exists( 'acf_add_options_page' ) ) {
// acf_add_options_page(
// array(
// 'page_title' => __( 'Theme Options', 'wp-b2' ),
// 'menu_title' => __( 'Theme Options', 'wp-b2' ),
// 'menu_slug'  => 'theme-options',
// 'capability' => 'edit_posts',
// 'redirect'   => false,
// )
// );
// }
// }
// add_action( 'acf/init', 'wp_b2_acf_add_options_page' );

/**
 * Example: Get ACF field helper function
 *
 * Helper function to safely get ACF field values with a fallback.
 *
 * @param string $field_name The ACF field name.
 * @param mixed  $post_id    Optional. The post ID. Defaults to current post.
 * @param mixed  $default    Optional. Default value if field is empty.
 * @return mixed Field value or default.
 */
function wp_b2_get_field( $field_name, $post_id = false, $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $field_name, $post_id );

	return ! empty( $value ) ? $value : $default;
}
