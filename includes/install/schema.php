<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates or updates plugin database tables.
 *
 * @return void
 */
function ndmc_create_database_table() {

	global $wpdb;

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$charset_collate = $wpdb->get_charset_collate();

	$meditations_table_pl = $wpdb->prefix . 'ndmc_meditations_pl';
	$language_table       = $wpdb->prefix . 'ndmc_language';

	$sql = "

CREATE TABLE {$meditations_table_pl} (
	id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	date varchar(5) NOT NULL,
	med_day varchar(100) DEFAULT NULL,
	med_title varchar(255) DEFAULT NULL,
	med_page varchar(50) DEFAULT NULL,
	meditation longtext DEFAULT NULL,
	today_note longtext DEFAULT NULL,
	PRIMARY KEY (id),
	KEY date (date)
) {$charset_collate};


CREATE TABLE {$language_table} (
	id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	jezyk varchar(10) NOT NULL,
	title varchar(255) NOT NULL,

	info_title varchar(255) DEFAULT NULL,
	info longtext DEFAULT NULL,

	configuration_title varchar(255) DEFAULT NULL,
	configuration longtext DEFAULT NULL,

	shortcode_title varchar(255) DEFAULT NULL,
	shortcode_meditation varchar(255) DEFAULT NULL,

	description_title varchar(255) DEFAULT NULL,
	description longtext DEFAULT NULL,

	support_title varchar(255) DEFAULT NULL,
	support longtext DEFAULT NULL,

	error longtext DEFAULT NULL,
	just_for_day longtext DEFAULT NULL,

	PRIMARY KEY (id),
	KEY jezyk (jezyk)
) {$charset_collate};

";

	dbDelta( $sql );
}