<?php
	/**
	*
	* The wordpress plugin uninstallation file
	*
	* @package Thrixty Player
	* @author Finn Reißmann
	* @version 3.0
	*/

	/**
	*
	* Block direct access to this file
	*/
	defined( "WP_UNINSTALL_PLUGIN" ) or die();

	/**
	*
	* Delete the database table for the players
	* Delete the database table for the layouts
	*/
	global $wpdb;
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}thrixty_players" );
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}thrixty_layouts" );

	/**
	*
	* Delete the default_options option
	* Delete the tutorial_status option
	*/
	if( get_option( "thrixty_default_options" ) ){
		delete_option( "thrixty_default_options" );
	}
	
	if( get_option( "thrixty_tutorial_status" ) ){
		delete_option( "thrixty_tutorial_status" );
	}
?>