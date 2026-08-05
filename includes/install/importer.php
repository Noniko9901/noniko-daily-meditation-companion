<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get database import files.
 *
 * @return array
 */
function ndmc_get_database_files() {

	if ( ! defined( 'NDMC_DATABASE_DIR' ) ) {
		return array();
	}

	return array(
		'ndmc_meditations_pl' => NDMC_DATABASE_DIR . 'meditations_pl.sql',
		'ndmc_language'       => NDMC_DATABASE_DIR . 'language.sql',
	);
}


/**
 * Import plugin database.
 *
 * @return void
 */
function ndmc_import_database() {

	global $wpdb;

	$files = ndmc_get_database_files();

	if ( empty( $files ) ) {
		error_log( 'NDMC: database files list is empty.' );
		return;
	}

	foreach ( $files as $table => $file ) {

		if ( ! file_exists( $file ) ) {
			error_log( 'NDMC: missing database file: ' . $file );
			continue;
		}

		$table_name = $wpdb->prefix . $table;

		$count = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$table_name}"
		);

		if ( $count > 0 ) {
			error_log( 'NDMC: data already exists: ' . $table_name );
			continue;
		}

		$sql = file_get_contents( $file );

		if ( false === $sql ) {
			error_log( 'NDMC: cannot read file: ' . $file );
			continue;
		}

		$sql = str_replace(
			'{table}',
			$table_name,
			$sql
		);

		$queries = preg_split(
			'/;\s*(?:\r?\n|$)/',
			$sql
		);

		foreach ( $queries as $query ) {

			$query = trim( $query );

			if ( empty( $query ) ) {
				continue;
			}

			$result = $wpdb->query( $query );

			if ( false === $result ) {
				error_log(
					'NDMC SQL ERROR: ' . $wpdb->last_error
				);
			}
		}

		error_log(
			'NDMC: import completed: ' . $table_name
		);
	}
}