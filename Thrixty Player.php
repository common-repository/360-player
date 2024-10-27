<?php
	/**
	*
	* @package Thrixty
	* @author Finn Reißmann
	* @version 3.3.3
	*/

	/**
	*
	* Plugin Name: Thrixty Player
	* Plugin URI: http://www.360shots.de/
	* Description: Mit diesem Plugin können sie Thrixty Player Instanzen in ihre Seite einbinden
	* Version: 3.3.3
	* Author: 360 Shots
	* Author URI: http://www.fuchsedv.de/360shots-player/
	* Author email: support@fuchs-edv.de
	* License: GPL 3
	*/

	namespace thrixty;
	use Thrixty\classes\Thrixty;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	/**
	*
	* Include all required classes
	*/
	require_once( ABSPATH . "wp-admin/includes/upgrade.php" );

	//********** CLASSES **********//
	require_once "classes/class.thrixty.php";
	require_once "classes/class.globals.php";
	require_once "classes/class.validation.php";
	require_once "classes/class.ajax.php";
	require_once "classes/class.data-access-object.php";

	require_once "classes/class.mvc.model.php";
	require_once "classes/class.mvc.view.php";
	require_once "classes/class.mvc.controller.php";

	//********** MODELS **********//
	//***** PAGES *****//
	//*** MENU ***//
	require_once "models/models.pages.all_players.php";
	require_once "models/models.pages.all_layouts.php";
	require_once "models/models.pages.settings.php";
	require_once "models/models.pages.landing_page.php";

	//*** OTHER ***//
	require_once "models/models.pages.edit_player.php";
	require_once "models/models.pages.edit_layout.php";

	require_once "models/models.frontend.php";
	require_once "models/models.tutorial.php";

	//********** VIEWS **********//
	//***** PAGES *****//
	//*** MENU ***//
	require_once "views/views.pages.all_players.php";
	require_once "views/views.pages.all_layouts.php";
	require_once "views/views.pages.settings.php";
	require_once "views/views.pages.landing_page.php";

	//*** OTHER ***//
	require_once "views/views.pages.edit_player.php";
	require_once "views/views.pages.edit_layout.php";

	require_once "views/views.frontend.php";
	require_once "views/views.tutorial.php";

	//********** CONTROLLERS **********//

	//***** GLOBAL *****//
	require_once "controllers/controllers.backend.php";
	require_once "controllers/controllers.frontend.php";

	//***** PAGES *****//
	//*** MENU ***//
	require_once "controllers/controllers.pages.all_players.php";
	require_once "controllers/controllers.pages.all_layouts.php";
	require_once "controllers/controllers.pages.settings.php";
	require_once "controllers/controllers.pages.landing_page.php";

	//*** OTHER ***//
	require_once "controllers/controllers.pages.edit_player.php";
	require_once "controllers/controllers.pages.edit_layout.php";
	require_once "controllers/controllers.tutorial.php";

	//********** DATABASE **********//
	require_once "database/database.dao.players.php";
	require_once "database/database.dao.layouts.php";

	/**
	*
	* Define the plugin home direcory path (URL)
	* Define the plugin home direcory path (URI)
	*/
	define( "THRIXTY_HOME", plugin_dir_url( __FILE__ ) );
	define( "THRIXTY_HOME_PATH", plugin_dir_path( __FILE__ ) );

	/**
	*
	* Define the thrixty placeholder. Used to build the absolute filelist paths
	*/
	define( "THRIXTY__PLUGIN__", plugins_url( "", __FILE__ ) );
	define( "THRIXTY__UPLOAD__", wp_upload_dir()["baseurl"] );
	define( "THRIXTY__SITE__", get_site_url() );

	/**
	*
	* Create Thrixty object
	*/
	$thrixty = new Thrixty();


	/**
	*
	* Register Thrixty activation hook
	* The uninstallation methods are in the uninstall.php file located in the root folder
	*/
	register_activation_hook(__FILE__, array( $thrixty, "thrixty_activation"));

	/**
	*
	* Run Thrixty Wordpress plugin
	*/
	add_action( "init", array( $thrixty, "start" ) );
?>