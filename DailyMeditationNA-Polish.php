<?php
/*
Plugin Name: Daily Meditation NA - Polish
Description: Wyświetla codzienną medytację z bazy SQL.
Version: 1.0.2
Author: Noniko99
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin constants.
 */
define( 'DMNA_VERSION', '1.0.2' );
define( 'DMNA_DB_VERSION', '1.0.1' );

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