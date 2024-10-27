<?php
	/**
	*
	* @package Thrixty
	* @subpackage classes
	* @author Finn Reißmann
	* @version 3.0
	*/

	namespace Thrixty\classes;
	use Thrixty\controllers\Controller_Backend;
	use Thrixty\controllers\Controller_Frontend;
	use Thrixty\database\Dao_Players;
	use Thrixty\database\Dao_Layouts;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	/**
	*
	* Plugin main class
	*
	* @author Finn Reißmann
	* @since 3.0
	*/
	class Thrixty {

		/**
		*
		* Key of the Thrixty default options stored in the wordpress options table
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const DEFAULT_OPTIONS
		*/
		const DEFAULT_OPTIONS = "thrixty_default_options";

		/**
		*
		* Key of the Thrixty tutorial status stored in the wordpress options table
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const TUTORIAL_STATUS
		*/
		const TUTORIAL_STATUS = "thrixty_tutorial_status";

		/**
		*
		* Name of the database tabel for the players
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const TABLE_NAME_PLAYERS
		*/
		const TABLE_NAME_PLAYERS = "thrixty_players";

		/**
		*
		* Name of the database table for the layouts
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const TABLE_NAME_LAYOUTS
		*/
		const TABLE_NAME_LAYOUTS = "thrixty_layouts";

		/**
		*
		* Shortcode for the players
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const SHORTCODE_PLAYERS
		*/
		const SHORTCODE_PLAYERS = "thrixty-player";

		/**
		*
		* Shortcode for the layouts
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const SHORTCODE_LAYOUTS
		*/
		const SHORTCODE_LAYOUTS = "thrixty-layout";

		/**
		*
		* Path to the german labels
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const LABEL_PATH_DE
		*/
		const LABEL_PATH_DE = "resources/label/de";

		/**
		*
		* Path to the englisch labels
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const LABEL_PATH_EN
		*/
		const LABEL_PATH_EN = "resources/label/en";

		/**
		*
		* Path to the components
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const COMPONENTS_PATH
		*/
		const COMPONENTS_PATH = "resources/components";

		/**
		*
		* Thrixty default options
		* Used in the activation process and will be saved in the wordpress options table
		* Used to create a new Player or Layout
		*
		* @author Finn Reißmann
		* @since 3.0
		* @const DEFAULT_OPTIONS_VALUES
		*/
		const DEFAULT_OPTIONS_VALUES = array(
			"basepath" => "__SITE__/360shots_objekte/",
			"filelist_path_small" => "small/Filelist.txt",
			"filelist_path_large" => "large/Filelist.txt",
			"use_basepath" => "off",
			"outbox_position" => "right",
			"cycle_duration" => "5",
			"sensitivity_x" => "20",
			"autoplay" => "on",
			"autoload" => "on",
			"repetition" => "-1",
			"play_direction" => "normal",
			"drag_direction" => "normal",
			"enable_controls" => "on",
			"display_buttons" => "on",
			"zoom_active" => "on",
				"zoom_control" => "progressive",
				"zoom_mode" => "inbox",
				"zoom_pointer" => "minimap",
			"fullpage_active" => "on",
				"fullpage_mode" => "normal"
		);

		/**
		*
		* Language
		*
		* @author Finn Reißmann
		* @since 3.0
		* @var LANGUAGE
		*/
		public static $LANGUAGE;

		/**
		*
		* The current message
		* Displayed after creating, deleteing or editing a player or layout
		*
		* @author Finn Reißmann
		* @since 3.0
		* @var current_message
		*/
		public static $current_message;

		/**
		*
		* Thrixty wordpress plugin start function
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function start (){
			self::$LANGUAGE = get_locale();
			self::$current_message = "";

			/**
			*
			* Check if is back or frontend via is_admin wordpress function
			*/
			if ( is_admin() ) {
				/**
				*
				* Load the backend resources and the controller
				*/
				$this->load_resources_backend();
				new Controller_Backend();
			} else{

				/**
				*
				* Load the frontend resources and the controller
				*/
				$this->load_resources_frontend();
				new Controller_Frontend();
			}
		}

		/**
		*
		* Check if the current language is german
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return boolean is_german
		*/
		public static function is_german (){
			return substr( self::$LANGUAGE, 0, 2) === "de";
		}

		/**
		*
		* Check if the current language is englisch
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return boolean is_englisch
		*/
		public static function is_englisch (){
			return substr( self::$LANGUAGE, 0, 2) === "en";
		}

		/**
		*
		* Load resources for the backend
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		private function load_resources_backend (){
			global $pagenow;

			wp_enqueue_script('thrixty_wordpress_js_initialization', THRIXTY_HOME . "resources/scripts/thrixty.initialization.js");
			wp_enqueue_script('thrixty_wordpress_main_script', THRIXTY_HOME . "resources/scripts/thrixty.main_script.js");
			wp_enqueue_style('thrixty_wordpress_main_style', THRIXTY_HOME . "resources/styles/css/thrixty.main_style.css");
			wp_enqueue_style('thrixty_wordpress_icons', THRIXTY_HOME . "resources/libraries/font-awesome/thrixty.font_awesome.css");
			
			/**
			*
			* Tiny mce stuff
			* Only used on editor pages
			*/
			if ( $pagenow == "post.php" || $pagenow == "post-new.php" ) {

				wp_enqueue_script("thrixty_lables", THRIXTY_HOME . "resources/scripts/thrixty.tinymce.labels.js", array("jquery"));
				wp_enqueue_script("thrixty_shortcode_converter", THRIXTY_HOME . "resources/scripts/thrixty.tinymce.shortcode_converter.js", array("jquery"));
				wp_enqueue_script("thrixty_shortcode_generator", THRIXTY_HOME . "resources/scripts/thrixty.tinymce.shortcode_generator.js", array("jquery"));
				wp_enqueue_script('thrixty_path_status_js', THRIXTY_HOME . "resources/scripts/thrixty.path_status.js", array("jquery"));

			}
		}

		/**
		*
		* Load resources for the frontend
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		private function load_resources_frontend (){
			wp_enqueue_script('thrixty_player_js', THRIXTY_HOME . "resources/libraries/thrixty.js");
			wp_enqueue_style('thrixty_player_css', THRIXTY_HOME . "resources/libraries/thrixty.css");
		}

		/**
		*
		* Plugin activation
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function thrixty_activation (){
			/**
			*
			* Create the database table for the players
			* Create the database table for the layouts
			*/
			$dao_players = new Dao_Players();
			$dao_layouts = new Dao_Layouts();

			$dao_players->create();
			$dao_layouts->create();

			/**
			*
			* Create the default_options option
			*/
			if( !get_option( self::DEFAULT_OPTIONS ) ){
				add_option( self::DEFAULT_OPTIONS, self::DEFAULT_OPTIONS_VALUES );
			}

			/**
			*
			* Create the tutorial_status option
			*/
			if( !get_option( self::TUTORIAL_STATUS ) ){
				add_option( self::TUTORIAL_STATUS, array(
					"thrixty_about" => false,
					"thrixty_all_players" => false,
					"thrixty_all_layouts" => false,
					"thrixty_edit_player" => false,
					"thrixty_edit_layout" => false,
					"thrixty_settings" => false,
					"post" => false
				));
			}
		}

	}

?>
