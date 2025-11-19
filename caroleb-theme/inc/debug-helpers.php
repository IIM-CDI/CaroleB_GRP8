<?php
/**
 * Debug Helper Functions
 *
 * Visual debugging tools for development
 *
 * @package WP_B2
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'dump' ) ) {
	/**
	 * Dump variable(s) with visual formatting
	 *
	 * @param mixed ...$vars Variables to dump.
	 * @return void
	 */
	function dump( ...$vars ) {
		echo '<div style="
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: #fff;
			padding: 20px;
			margin: 20px 0;
			border-radius: 8px;
			font-family: \'SF Mono\', Monaco, \'Cascadia Code\', \'Roboto Mono\', Consolas, \'Courier New\', monospace;
			font-size: 14px;
			line-height: 1.6;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
			position: relative;
			z-index: 999999;
		">';

		// Dump header.
		$backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 1 );
		$file      = isset( $backtrace[0]['file'] ) ? $backtrace[0]['file'] : 'unknown';
		$line      = isset( $backtrace[0]['line'] ) ? $backtrace[0]['line'] : 'unknown';

		echo '<div style="
			background: rgba(0, 0, 0, 0.2);
			padding: 10px 15px;
			margin: -20px -20px 15px -20px;
			border-radius: 8px 8px 0 0;
			font-weight: 600;
			font-size: 12px;
			letter-spacing: 0.5px;
			text-transform: uppercase;
		">';
		echo '🐛 Debug Output';
		echo '</div>';

		// File location.
		echo '<div style="
			background: rgba(0, 0, 0, 0.15);
			padding: 8px 12px;
			margin-bottom: 15px;
			border-radius: 4px;
			font-size: 11px;
			opacity: 0.9;
		">';
		echo '<strong>📍 Location:</strong> ' . esc_html( basename( $file ) ) . ':' . esc_html( $line );
		echo '</div>';

		// Dump each variable.
		foreach ( $vars as $index => $var ) {
			if ( count( $vars ) > 1 ) {
				echo '<div style="
					background: rgba(255, 255, 255, 0.1);
					padding: 6px 10px;
					margin-bottom: 10px;
					border-radius: 4px;
					font-size: 11px;
					font-weight: 600;
				">';
				echo '📦 Variable #' . ( $index + 1 );
				echo '</div>';
			}

			echo '<pre style="
				background: rgba(0, 0, 0, 0.3);
				padding: 15px;
				border-radius: 4px;
				overflow-x: auto;
				margin: 0 0 10px 0;
				border-left: 3px solid rgba(255, 255, 255, 0.3);
			">';

			// Use var_export for better readability with arrays and objects.
			if ( is_array( $var ) || is_object( $var ) ) {
				echo esc_html( print_r( $var, true ) ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_print_r
			} else {
				var_dump( $var ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_var_dump
			}

			echo '</pre>';
		}

		echo '</div>';
	}
}

if ( ! function_exists( 'dd' ) ) {
	/**
	 * Dump variable(s) and die
	 *
	 * @param mixed ...$vars Variables to dump.
	 * @return void
	 */
	function dd( ...$vars ) {
		echo '<div style="
			background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
			color: #fff;
			padding: 20px;
			margin: 20px 0;
			border-radius: 8px;
			font-family: \'SF Mono\', Monaco, \'Cascadia Code\', \'Roboto Mono\', Consolas, \'Courier New\', monospace;
			font-size: 14px;
			line-height: 1.6;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
			position: relative;
			z-index: 999999;
		">';

		// Header with die indicator.
		$backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 1 );
		$file      = isset( $backtrace[0]['file'] ) ? $backtrace[0]['file'] : 'unknown';
		$line      = isset( $backtrace[0]['line'] ) ? $backtrace[0]['line'] : 'unknown';

		echo '<div style="
			background: rgba(0, 0, 0, 0.2);
			padding: 10px 15px;
			margin: -20px -20px 15px -20px;
			border-radius: 8px 8px 0 0;
			font-weight: 600;
			font-size: 12px;
			letter-spacing: 0.5px;
			text-transform: uppercase;
		">';
		echo '💀 Debug & Die';
		echo '</div>';

		// File location.
		echo '<div style="
			background: rgba(0, 0, 0, 0.15);
			padding: 8px 12px;
			margin-bottom: 15px;
			border-radius: 4px;
			font-size: 11px;
			opacity: 0.9;
		">';
		echo '<strong>📍 Location:</strong> ' . esc_html( basename( $file ) ) . ':' . esc_html( $line );
		echo '</div>';

		// Warning message.
		echo '<div style="
			background: rgba(255, 255, 255, 0.15);
			padding: 10px 12px;
			margin-bottom: 15px;
			border-radius: 4px;
			border-left: 3px solid rgba(255, 255, 255, 0.5);
			font-size: 12px;
		">';
		echo '⚠️ <strong>Execution stopped here</strong> - Script will terminate after output';
		echo '</div>';

		// Dump each variable.
		foreach ( $vars as $index => $var ) {
			if ( count( $vars ) > 1 ) {
				echo '<div style="
					background: rgba(255, 255, 255, 0.1);
					padding: 6px 10px;
					margin-bottom: 10px;
					border-radius: 4px;
					font-size: 11px;
					font-weight: 600;
				">';
				echo '📦 Variable #' . ( $index + 1 );
				echo '</div>';
			}

			echo '<pre style="
				background: rgba(0, 0, 0, 0.3);
				padding: 15px;
				border-radius: 4px;
				overflow-x: auto;
				margin: 0 0 10px 0;
				border-left: 3px solid rgba(255, 255, 255, 0.3);
			">';

			// Use var_export for better readability with arrays and objects.
			if ( is_array( $var ) || is_object( $var ) ) {
				echo esc_html( print_r( $var, true ) ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_print_r
			} else {
				var_dump( $var ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_var_dump
			}

			echo '</pre>';
		}

		echo '</div>';

		die();
	}
}
