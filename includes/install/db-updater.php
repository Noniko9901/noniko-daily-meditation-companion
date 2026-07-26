<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Updates plugin database.
 *
 * @return void
 */
function dmna_update_database() {

	$current_version = get_option(
		'dmna_db_version',
		'0'
	);

	if ( version_compare(
		$current_version,
		DMNA_DB_VERSION,
		'>='
	) ) {
		return;
	}

	// Aktualizacja struktury.
	dmna_create_database_table();

	// Aktualizacja danych.
	wpdi_update_database_data();

	update_option(
		'dmna_db_version',
		DMNA_DB_VERSION
	);
}

add_action(
	'admin_init',
	'dmna_update_database'
);