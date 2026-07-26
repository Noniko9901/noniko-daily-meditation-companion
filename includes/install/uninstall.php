<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

$table_name = $wpdb->prefix . 'dmna_meditations_pl';

$wpdb->query( "DROP TABLE IF EXISTS `{$table_name}`" );

delete_option( 'dmna_db_version' );