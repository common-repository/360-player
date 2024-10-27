<?php
	namespace Thrixty\controllers;
	use Thrixty\classes\Globals;
	use Thrixty\classes\Controller;
	use Thrixty\classes\Thrixty;
	use Thrixty\models\Model_EditPlayer;
	use Thrixty\views\View_EditPlayer;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_EditPlayer extends Controller{

		private $mode_edit;
		private $id;

		public function __construct(){
			parent::__construct( new Model_EditPlayer(), new View_EditPlayer() );
		}

		public function run (){
			wp_enqueue_script('thrixty_path_status_js', THRIXTY_HOME . "resources/scripts/thrixty.path_status.js", array("jquery"));

			/**
			*
			* Get the mode (new or edit)
			* Get the id
			*/
			$this->mode_edit = Globals::GET("mode") == "edit";
			if ( $this->mode_edit ) {
				$this->id = intval( Globals::GET("id") );
			} else {
				$this->id = $this->get_model()->get_autoincrement();
			}

			/**
			*
			* Execute action: create player || reset standards
			*/
			$this->action();

			/**
			*
			* Get the data from the model
			* Assign the data to the view
			*/
			if ( $this->mode_edit ) {
				$this->get_view()->assign( "mode", "edit" );
				$this->get_view()->assign( "current_id", $this->id );
				$this->get_view()->assign( "player_options", $this->get_model()->get_player_options( $this->id ) );

			} else {
				$this->get_view()->assign( "mode", "new" );
				$this->get_view()->assign( "current_id", $this->id );
				$this->get_view()->assign( "default_options", $this->get_model()->get_default_options() );
			}
			$this->get_view()->assign_all();

			/**
			*
			* Display the current message if it isn´t empty
			*/
			include Globals::print_component("message.php");

			/**
			*
			* Print
			*/
			$this->get_view()->print();

		}

		public function action (){
			$action = Globals::POST("new_player_action");

			switch ($action) {
				case "submit":
					$this->save();
				break;
				case "back_to_standards":
					$this->back_to_standards();
				break;
			}
		}

		private function save (){
			$options = array(
				"player_name" => Globals::POST("player_name"),
				"player_description" => Globals::POST("player_description"),
				"basepath_use_standard" => Globals::POST("basepath_use_standard") == "on" ? "1" : "0",
				"basepath" => Globals::POST("basepath"),
				"object_name" => Globals::POST("object_name"),
				"filelist_path_small_use_standard" => Globals::POST("filelist_path_small_use_standard") == "on" ? "1" : "0",
				"filelist_path_small" => Globals::POST("filelist_path_small"),
				"filelist_path_large_use_standard" => Globals::POST("filelist_path_large_use_standard") == "on" ? "1" : "0",
				"filelist_path_large" => Globals::POST("filelist_path_large"),
				"use_basepath_use_standard" => Globals::POST("use_basepath_use_standard") == "on" ? "1" : "0",
				"use_basepath" => Globals::POST("use_basepath") == "on" ? "1" : "0",
				"play_direction_use_standard" => Globals::POST("play_direction_use_standard") == "on" ? "1" : "0",
				"play_direction" => Globals::POST("play_direction"),
				"drag_direction_use_standard" => Globals::POST("drag_direction_use_standard") == "on" ? "1" : "0",
				"drag_direction" => Globals::POST("drag_direction"),
				"autoplay_use_standard" => Globals::POST("autoplay_use_standard") == "on" ? "1" : "0",
				"autoplay" => Globals::POST("autoplay") == "on" ? "1" : "0",
				"autoload_use_standard" => Globals::POST("autoload_use_standard") == "on" ? "1" : "0",
				"autoload" => Globals::POST("autoload") == "on" ? "1" : "0",
				"cycle_duration_use_standard" => Globals::POST("cycle_duration_use_standard") == "on" ? "1" : "0",
				"cycle_duration" => intval(Globals::POST("cycle_duration")),
				"sensitivity_x_use_standard" => Globals::POST("sensitivity_x_use_standard") == "on" ? "1" : "0",
				"sensitivity_x" => intval(Globals::POST("sensitivity_x")),
				"repetition_use_standard" => Globals::POST("repetition_use_standard") == "on" ? "1" : "0",
				"repetition" => intval(Globals::POST("repetition")),
				"zoom_active" => Globals::POST("zoom_active") == "on" ? "1" : "0",
				"zoom_mode_use_standard" => Globals::POST("zoom_mode_use_standard") == "on" ? "1" : "0",
				"zoom_mode" => Globals::POST("zoom_mode"),
				"zoom_control_use_standard" => Globals::POST("zoom_control_use_standard") == "on" ? "1" : "0",
				"zoom_control" => Globals::POST("zoom_control"),
				"zoom_pointer_use_standard" => Globals::POST("zoom_pointer_use_standard") == "on" ? "1" : "0",
				"zoom_pointer" => Globals::POST("zoom_pointer"),
				"outbox_position_use_standard" => Globals::POST("outbox_position_use_standard") == "on" ? "1" : "0",
				"outbox_position" => Globals::POST("outbox_position"),
				"fullpage_active" => Globals::POST("fullpage_active") == "on" ? "1" : "0",
				"fullpage_mode_use_standard" => Globals::POST("fullpage_mode_use_standard") == "on" ? "1" : "0",
				"fullpage_mode" => Globals::POST("fullpage_mode"),
				"display_buttons_use_standard" => Globals::POST("display_buttons_use_standard") == "on" ? "1" : "0",
				"display_buttons" => Globals::POST("display_buttons") == "on" ? "1" : "0",
				"enable_controls_use_standard" => Globals::POST("enable_controls_use_standard") == "on" ? "1" : "0",
				"enable_controls" => Globals::POST("enable_controls") == "on" ? "1" : "0"
			);

			if ( Globals::POST("repetition_infinity") == "true" ) {
				$options["repetition"] = -1;
			}


			if ( !$this->mode_edit ) {
				$this->get_model()->get_dao()->insert( $options );
				Thrixty::$current_message = Globals::load_label("msg_player_added_successfully.html");
			} else {
				$this->get_model()->get_dao()->update( $this->id, $options );
				Thrixty::$current_message = Globals::load_label("msg_player_edited_successfully.html");
			}

		}

		private function cancel (){

		}

		private function back_to_standards (){

		}
	}

?>
