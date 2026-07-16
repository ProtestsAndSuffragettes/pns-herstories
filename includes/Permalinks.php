<?php
/**
 * Permalink and rewrite helpers.
 *
 * @package PNS_Herstories
 */

namespace PNS\Herstories;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Owns Herstories rewrite lifecycle.
 */
final class Permalinks {
	/**
	 * Register permalink-related hooks.
	 *
	 * @return void
	 */
	public static function register() {
		// CPT routes are owned by register_post_type(); page routes remain native.
	}

	/**
	 * Flush rewrites on activation after registering plugin-owned structures.
	 *
	 * @return void
	 */
	public static function activate() {
		PostTypes::register();
		Taxonomies::register();
		flush_rewrite_rules();
	}

	/**
	 * Flush rewrites on deactivation.
	 *
	 * @return void
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
