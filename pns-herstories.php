<?php
/*
 * x-release-please-start-version
 */
/**
 * Plugin Name: PNS Herstories
 * Description: Project-owned Herstories content model for Protests and Suffragettes.
 * Version: 0.1.0
 * Author: Protests and Suffragettes
 * Text Domain: pns-herstories
 *
 * @package PNS_Herstories
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PNS_HERSTORIES_VERSION', '0.1.0' );
/*
 * x-release-please-end
 */
define( 'PNS_HERSTORIES_PLUGIN_FILE', __FILE__ );
define( 'PNS_HERSTORIES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once PNS_HERSTORIES_PLUGIN_DIR . 'includes/PostTypes.php';
require_once PNS_HERSTORIES_PLUGIN_DIR . 'includes/Taxonomies.php';
require_once PNS_HERSTORIES_PLUGIN_DIR . 'includes/Admin.php';
require_once PNS_HERSTORIES_PLUGIN_DIR . 'includes/Queries.php';
require_once PNS_HERSTORIES_PLUGIN_DIR . 'includes/Permalinks.php';
require_once PNS_HERSTORIES_PLUGIN_DIR . 'includes/Migration.php';

add_action( 'init', array( \PNS\Herstories\PostTypes::class, 'register' ) );
add_action( 'init', array( \PNS\Herstories\Taxonomies::class, 'register' ) );
add_action( 'init', array( \PNS\Herstories\Permalinks::class, 'register' ) );
add_action( 'admin_init', array( \PNS\Herstories\Admin::class, 'register' ) );
\PNS\Herstories\Queries::register();

register_activation_hook( __FILE__, array( \PNS\Herstories\Permalinks::class, 'activate' ) );
register_deactivation_hook( __FILE__, array( \PNS\Herstories\Permalinks::class, 'deactivate' ) );
