<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'wpdi_get_database_files' ) ) {

	function wpdi_get_database_files() {

		if ( ! defined( 'DMNA_DATABASE_DIR' ) ) {
			return array();
		}

		return array(
			'dmnapl_meditations_pl'  => DMNA_DATABASE_DIR . 'meditations_pl.sql',
			'dmnapl_language'  => DMNA_DATABASE_DIR . 'language.sql',
			
		);
	}
}


if ( ! function_exists( 'wpdi_import_database' ) ) {

	function wpdi_import_database() {

	global $wpdb;

	$files = wpdi_get_database_files();

	if ( empty( $files ) ) {
		error_log( 'DMNA: brak listy plików bazy' );
		return;
	}


	foreach ( $files as $table => $file ) {

		error_log( 'DMNA: sprawdzam plik: ' . $file );


		if ( ! file_exists( $file ) ) {
			error_log( 'DMNA: brak pliku: ' . $file );
			continue;
		}


		$table_name = $wpdb->prefix . $table;


		error_log( 'DMNA: tabela: ' . $table_name );


		$count = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$table_name}"
		);


		error_log( 'DMNA: rekordow: ' . $count );


		if ( $count > 0 ) {
			error_log( 'DMNA: pomijam, dane juz istnieja' );
			continue;
		}


		$sql = file_get_contents( $file );


		if ( false === $sql ) {
			error_log( 'DMNA: nie mozna odczytac pliku' );
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
					'DMNA SQL ERROR: ' . $wpdb->last_error
				);
			}
		}

		error_log( 'DMNA: import zakonczony dla ' . $table_name );
	}
}
}