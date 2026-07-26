<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Imports initial meditation data.
 *
 * @return void
 */
function wpdi_import_database() {

	global $wpdb;

	$table_name = $wpdb->prefix . 'DMNAPL_meditations_pl';


	// Nie importuj ponownie danych.
	$count = (int) $wpdb->get_var(
		"SELECT COUNT(*) FROM {$table_name}"
	);

	if ( $count > 0 ) {
		return;
	}


	if ( ! defined( 'DMNA_DATABASE_FILE' ) ) {
		return;
	}


	if ( ! file_exists( DMNA_DATABASE_FILE ) ) {
		return;
	}


	$sql = file_get_contents( DMNA_DATABASE_FILE );


	if ( false === $sql ) {
		return;
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

		$wpdb->query( $query );
	}
}

/**
 * Updates database data.
 *
 * @return void
 */
function wpdi_update_database_data() {

	global $wpdb;

	$table_name = $wpdb->prefix . 'DMNAPL_meditations_pl';

	if ( ! defined( 'DMNA_DATABASE_FILE' ) ) {
		return;
	}

	if ( ! file_exists( DMNA_DATABASE_FILE ) ) {
		return;
	}

	$sql = file_get_contents(
		DMNA_DATABASE_FILE
	);

	if ( false === $sql ) {
		return;
	}

	$sql = str_replace(
		'{table}',
		$table_name,
		$sql
	);

	// usuwamy stare rekordy
	$wpdb->query(
		"TRUNCATE TABLE {$table_name}"
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

		$wpdb->query( $query );
	}
}