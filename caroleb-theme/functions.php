<?php
/**
 * WP-B2 Theme Functions
 *
 * @package WP_B2
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'WP_B2_VERSION', '1.0.0' );
define( 'WP_B2_THEME_DIR', get_template_directory() );
define( 'WP_B2_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function wp_b2_theme_setup() {
	// Enable translation support.
	load_theme_textdomain( 'wp-b2', WP_B2_THEME_DIR . '/languages' );

	// Add support for default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for HTML5 markup.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add support for post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Add support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add support for title tag.
	add_theme_support( 'title-tag' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'wp-b2' ),
			'footer'  => esc_html__( 'Footer Menu', 'wp-b2' ),
		)
	);
}
add_action( 'after_setup_theme', 'wp_b2_theme_setup' );

/**
 * Enqueue theme styles and scripts
 */
function wp_b2_enqueue_assets() {
	// Enqueue main stylesheet.
	wp_enqueue_style(
		'wp-b2-style',
		WP_B2_THEME_URI . '/style.css',
		array(),
		WP_B2_VERSION
	);

	// Enqueue compiled CSS from SCSS.
	wp_enqueue_style(
		'wp-b2-main',
		WP_B2_THEME_URI . '/assets/css/main.css',
		array(),
		WP_B2_VERSION
	);

	// Enqueue main JavaScript file.
	wp_enqueue_script(
		'wp-b2-script',
		WP_B2_THEME_URI . '/assets/js/main.js',
		array(),
		WP_B2_VERSION,
		true
	);

	// Add inline JavaScript variables for use in scripts.
	wp_localize_script(
		'wp-b2-script',
		'wpB2',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'wp_b2_nonce' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'wp_b2_enqueue_assets' );

/**
 * Include additional theme files
 */
// Include debug helpers (only load in development).
if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
	require_once WP_B2_THEME_DIR . '/inc/debug-helpers.php';
}

// Include ACF-related functions if ACF is active.
if ( class_exists( 'ACF' ) ) {
	require_once WP_B2_THEME_DIR . '/inc/acf-config.php';
}
