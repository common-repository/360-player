<?php
	namespace Thrixty\controllers;
	use Thrixty\classes\Globals;
	use Thrixty\classes\Controller;
	use Thrixty\classes\Thrixty;
	use Thrixty\models\Model_EditLayout;
	use Thrixty\views\View_EditLayout;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_EditLayout extends Controller{

		private $mode_edit;
		private $id;

		public function __construct(){
			parent::__construct( new Model_EditLayout(), new View_EditLayout() );
		}

		public function run (){
			$this->mode_edit = Globals::GET("mode") == "edit";
			if ( $this->mode_edit ) {
				$this->id = intval( Globals::GET("id") );
			} else {
				$this->id = $this->get_model()->get_autoincrement();
			}

			/**
			*
			* Execute action:
			*/
			$this->action();

			if ( $this->mode_edit ) {
				$this->get_view()->assign( "mode", "edit" );
				$this->get_view()->assign( "current_id", $this->id );
				$this->get_view()->assign( "layout_options", $this->get_model()->get_player_options( $this->id ) );

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

			$this->get_view()->print();
		}

		public function action (){
			$action = Globals::POST("new_layout_action");

			switch ($action) {
				case "submit":
					$this->save();
				break;
			}
		}

		private function save (){
			$options = array(
				"player_name" => Globals::POST("player_name"),
				"player_description" => Globals::POST("player_description"),
				"play_direction" => Globals::POST("play_direction"),
				"drag_direction" => Globals::POST("drag_direction"),
				"autoplay" => Globals::POST("autoplay") == "on" ? "1" : "0",
				"autoload" => Globals::POST("autoload") == "on" ? "1" : "0",
				"cycle_duration" => intval(Globals::POST("cycle_duration")),
				"sensitivity_x" => intval(Globals::POST("sensitivity_x")),
				"repetition" => intval(Globals::POST("repetition")),
				"zoom_active" => Globals::POST("zoom_active") == "on" ? "1" : "0",
				"zoom_mode" => Globals::POST("zoom_mode"),
				"zoom_control" => Globals::POST("zoom_control"),
				"zoom_pointer" => Globals::POST("zoom_pointer"),
				"outbox_position" => Globals::POST("outbox_position"),
				"fullpage_active" => Globals::POST("fullpage_active") == "on" ? "1" : "0",
				"fullpage_mode" => Globals::POST("fullpage_mode"),
				"display_buttons" => Globals::POST("display_buttons") == "on" ? "1" : "0",
				"enable_controls" => Globals::POST("enable_controls") == "on" ? "1" : "0"
			);

			if ( Globals::POST("repetition_infinity") == "true" ) {
				$options["repetition"] = -1;
			}

			if ( !$this->mode_edit ) {
				$this->get_model()->get_dao()->insert( $options );
				Thrixty::$current_message = Globals::load_label("msg_layout_added_successfully.html");
			} else {
				$this->get_model()->get_dao()->update( $this->id, $options );
				Thrixty::$current_message = Globals::load_label("msg_layout_edited_successfully.html");
			}

		}

		private function cancel (){

		}

		private function back_to_standards (){

		}
	}

?>
