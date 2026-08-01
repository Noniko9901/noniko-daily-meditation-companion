<?php
/**
 * Uninstall Daily Meditation NA - Polish.
 *
 * Removes plugin database table and options.
 *
 * @package DailyMeditationNAPolish
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

global $wpdb;

// Remove plugin table.
$table_name = $wpdb->prefix . 'dmna_meditations_pl';

$wpdb->query( "DROP TABLE IF EXISTS `{$table_name}`" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared

// Remove plugin options.
delete_option( 'dmna_db_version' );