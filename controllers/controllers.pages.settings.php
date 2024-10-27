<?php
	namespace Thrixty\controllers;
	use Thrixty\classes\Globals;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Controller;
	use Thrixty\models\Model_Settings;
	use Thrixty\views\View_Settings;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_Settings extends Controller {

		public function __construct (){
			parent::__construct( new Model_Settings(), new View_Settings() );
		}

		public function run (){
			$this->action();

			$this->get_view()->assign( "default_options", $this->get_model()->get_default_options() );
			$this->get_view()->assign_all();

			/**
			*
			* Display the current message if it isn´t empty
			*/
			include Globals::print_component("message.php");

			$this->get_view()->print();

		}

		public function action (){
			$action = Globals::POST("submit");

			if ( $action == "save_standard_options" ) {
				$this->save();
			}
		}

		private function save (){
			$values = Globals::POST("default_options");

			if ( is_array($values) ) {
				$options = array(
						"basepath" => $values["basepath"],
						"filelist_path_small" => $values["filelist_path_small"],
						"filelist_path_large" => $values["filelist_path_large"],
						"use_basepath" => (isset($values["use_basepath"]) ? "on" : "off"),
						"outbox_position" => $values["outbox_position"],
						"reversion" => "",
						"cycle_duration" => $values["cycle_duration"],
						"sensitivity_x" => $values["sensitivity_x"],
						"repetition" => $values["repetition"],
						"autoplay" => (isset($values["autoplay"]) ? "on" : "off"),
						"autoload" => (isset($values["autoload"]) ? "on" : "off"),
						"play_direction" => $values["play_direction"],
						"drag_direction" => $values["drag_direction"],
						"enable_controls" => $values["enable_controls"],
						"display_buttons" => $values["display_buttons"],
						"zoom_active" => $values["zoom_active"],
							"zoom_control" => $values["zoom_control"],
							"zoom_mode" => $values["zoom_mode"],
							"zoom_pointer" => $values["zoom_pointer"],
						"fullpage_active" => $values["fullpage_active"],
							"fullpage_mode" => $values["fullpage_mode"]
				);

				if ( $values["repetition_infinity"] == "true" ) {
					$options["repetition"] = -1;
				}

				update_option( Thrixty::DEFAULT_OPTIONS, $options );

				Thrixty::$current_message = Globals::load_label("msg_settings_saved.html");
			}
		}

		private function convert (){

		}

	}

?>
