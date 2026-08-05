<?php
/**
 * Uninstall Noniko Daily Meditation Companion.
 *
 * Removes plugin database tables and options.
 *
 * @package NDMC
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;


global $wpdb;


/**
 * Remove meditation table.
 */
$meditations_table = $wpdb->prefix . 'ndmc_meditations_pl';

$wpdb->query(
	"DROP TABLE IF EXISTS {$meditations_table}"
); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared



/**
 * Remove language table.
 */
$language_table = $wpdb->prefix . 'ndmc_language';

$wpdb->query(
	"DROP TABLE IF EXISTS {$language_table}"
); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared



/**
 * Remove plugin options.
 */
delete_option( 'ndmc_db_version' );