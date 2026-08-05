<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Updates plugin database.
 *
 * @return void
 */
function ndmc_update_database() {

	$current_version = get_option(
		'ndmc_db_version',
		'0'
	);

	if ( version_compare(
		$current_version,
		NDMC_DB_VERSION,
		'>='
	) ) {
		return;
	}

	// Aktualizacja struktury.
	ndmc_create_database_table();

	// Aktualizacja danych.
	ndmc_import_database();

	update_option(
		'ndmc_db_version',
		NDMC_DB_VERSION
	);
}

add_action(
	'admin_init',
	'ndmc_update_database'
);