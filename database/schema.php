<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates or updates the plugin database table.
 *
 * @return void
 */
function dmna_create_database_table() {

	global $wpdb;

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$table_name      = $wpdb->prefix . 'DMNAPL_meditations_pl';
	$charset_collate = $wpdb->get_charset_collate();

$sql = "
CREATE TABLE {$table_name} (
	id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	date varchar(5) NOT NULL,
	med_day varchar(100) DEFAULT NULL,
	med_title varchar(255) DEFAULT NULL,
	med_page varchar(50) DEFAULT NULL,
	meditation longtext DEFAULT NULL,
	today_note longtext DEFAULT NULL,
	PRIMARY KEY  (id),
	KEY date (date)
) {$charset_collate};
";

	dbDelta( $sql );
}

