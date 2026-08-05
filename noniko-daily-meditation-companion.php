<?php
/**
 * Plugin Name: Noniko Daily Meditation Companion
 * Plugin URI: https://github.com/noniko9901/noniko-daily-meditation-companion
 * Description: Displays the daily Narcotics Anonymous meditation with multilingual support.
 * Version: 1.0.8
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Noniko9901
 * Author URI: https://github.com/noniko9901
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: noniko-daily-meditation-companion
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin constants.
 */
define( 'NDMC_VERSION', '1.0.8' );
define( 'NDMC_DB_VERSION', '1.0.8' );

define( 'NDMC_PLUGIN_FILE', __FILE__ );
define( 'NDMC_PLUGIN_DIR', plugin_dir_path( NDMC_PLUGIN_FILE ) );
define( 'NDMC_PLUGIN_URL', plugin_dir_url( NDMC_PLUGIN_FILE ) );
define( 'NDMC_PLUGIN_BASENAME', plugin_basename( NDMC_PLUGIN_FILE ) );

/**
 * Plugin files.
 */
require_once NDMC_PLUGIN_DIR . 'includes/install/schema.php';
require_once NDMC_PLUGIN_DIR . 'includes/install/config.php';
require_once NDMC_PLUGIN_DIR . 'includes/install/importer.php';
require_once NDMC_PLUGIN_DIR . 'includes/install/db-updater.php';

require_once NDMC_PLUGIN_DIR . 'includes/shortcode/meditation_pl.php';

require_once NDMC_PLUGIN_DIR . 'includes/admin/admin.php';

/**
 * Plugin activation.
 *
 * @return void
 */
function ndmc_activate_plugin() {

	if ( function_exists( 'ndmc_create_database_table' ) ) {
		ndmc_create_database_table();
	}

	if ( function_exists( 'ndmc_import_database' ) ) {
		ndmc_import_database();
	}

	update_option(
		'ndmc_db_version',
		NDMC_DB_VERSION
	);
}

register_activation_hook(
	NDMC_PLUGIN_FILE,
	'ndmc_activate_plugin'
);

/**
 * Load plugin translations.
 *
 * @return void
 */
function ndmc_load_textdomain() {

	load_plugin_textdomain(
		'noniko-daily-meditation-companion',
		false,
		dirname( NDMC_PLUGIN_BASENAME ) . '/languages'
	);
}

add_action(
	'plugins_loaded',
	'ndmc_load_textdomain'
);

/**
 * Enqueue frontend styles.
 *
 * @return void
 */
function ndmc_enqueue_styles() {

	wp_enqueue_style(
		'ndmc-style',
		NDMC_PLUGIN_URL . 'assets/css/style.css',
		array(),
		NDMC_VERSION
	);
}

add_action(
	'wp_enqueue_scripts',
	'ndmc_enqueue_styles'
);