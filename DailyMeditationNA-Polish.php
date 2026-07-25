<?php
/**
 * Plugin Name: Daily Meditation NA (Polish)
 * Plugin URI: https://github.com/noniko99/DailyMeditationNA-Polish-wp-plugin
 * Description: Displays the Daily Meditation from Narcotics Anonymous in Polish.
 * Version: 1.0.3
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Noniko99
 * Author URI: https://github.com/noniko99
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: daily-meditation-na-polish
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin constants.
 */
define( 'DMNA_VERSION', '1.0.3' );
define( 'DMNA_DB_VERSION', '1.0.3' );

define( 'DMNA_PLUGIN_FILE', __FILE__ );
define( 'DMNA_PLUGIN_DIR', plugin_dir_path( DMNA_PLUGIN_FILE ) );
define( 'DMNA_PLUGIN_URL', plugin_dir_url( DMNA_PLUGIN_FILE ) );
define( 'DMNA_PLUGIN_BASENAME', plugin_basename( DMNA_PLUGIN_FILE ) );

/**
 * Plugin files.
 */
require_once DMNA_PLUGIN_DIR . 'database/schema.php';
require_once DMNA_PLUGIN_DIR . 'includes/install/config.php';
require_once DMNA_PLUGIN_DIR . 'includes/install/importer.php';
require_once DMNA_PLUGIN_DIR . 'includes/shortcode/meditation_pl.php';
require_once DMNA_PLUGIN_DIR . 'includes/admin/admin.php';
require_once DMNA_PLUGIN_DIR . 'includes/install/update.php';

/**
 * Runs on plugin activation.
 */
function wpdi_activate_plugin() {

    // Najpierw tworzymy strukturę tabeli
    if ( function_exists( 'dmna_create_database_table' ) ) {
        dmna_create_database_table();
	
    }

    // Potem importujemy dane
    if ( function_exists( 'wpdi_import_database' ) ) {
        wpdi_import_database();
    }

    update_option(
        'dmna_db_version',
        DMNA_DB_VERSION
    );
}

register_activation_hook(
	DMNA_PLUGIN_FILE,
	'wpdi_activate_plugin'
);

/**
 * Enqueue frontend styles.
 */
function wpdi_enqueue_styles() {

	wp_enqueue_style(
		'daily-meditation-style',
		DMNA_PLUGIN_URL . 'assets/css/style.css',
		array(),
		DMNA_VERSION
	);
}

add_action(
	'wp_enqueue_scripts',
	'wpdi_enqueue_styles'
);

/**
 * GitHub JSON updater.
 */
new DM_JSON_Updater( DMNA_PLUGIN_FILE );