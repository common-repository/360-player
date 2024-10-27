<?php
	namespace Thrixty\controllers;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Controller;
	use Thrixty\models\Model_Frontend;
	use Thrixty\views\View_Frontend;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_Frontend extends Controller{

		/**
		*
		* Blueprint for the options
		*/
		private $op_bp = array(
			"basepath" => null,
			"small_path" => null,
			"large_path" => null,
			"use_basepath" => null,
			"play_direction" => null,
			"drag_direction" => null,
			"autoplay" => null,
			"autoload" => null,
			"cycle_duration" => null,
			"sensitivity_x" => null,
			"repetition" => null,
			"enable_controls" => null,
			"display_buttons" => null,
			"zoom_mode" => null,
			"zoom_control" => null,
			"zoom_pointer" => null,
			"outbox_position" => null,
			"fullpage_mode" => null
		);

		public function __construct (){
			parent::__construct( new Model_Frontend(), new View_Frontend() );

			add_shortcode( Thrixty::SHORTCODE_PLAYERS, array( $this, "shortcode_handler_players" ) );
			add_shortcode( Thrixty::SHORTCODE_LAYOUTS, array( $this, "shortcode_handler_layouts" ) );
			
		}

		public function action (){ /* No actions necessary on the frontend */ }

		public function run ( $attributes = "", $type = "" ){
			/**
			*
			* Get all shortcode attributes values
			*/
			$id = isset( $attributes["id"] ) ? $attributes["id"] : null;
			
			/**
			*
			* Check if the id exists and is a number
			*/
			if ( $id != null && is_numeric( $id ) && $id >= 0 ) {
				$id = intval( $id );

				switch ( $type ) {
					case "player":

						/**
						*
						* Get the player from the database
						*/
						$options = $this->get_model()->get_player( $id );
						$default_options = get_option(Thrixty::DEFAULT_OPTIONS);
						if ( $options != null && $default_options != null ) {

							/**
							*
							* Check the paths options
							*/
							$this->op_bp["basepath"] = ( $options->basepath_use_standard == 1 ? $default_options["basepath"] : $options->basepath ) ."/". $options->object_name;

							$this->op_bp["basepath"] = str_replace("__SITE__", THRIXTY__SITE__, $this->op_bp["basepath"]);
							$this->op_bp["basepath"] = str_replace("__UPLOAD__", THRIXTY__UPLOAD__, $this->op_bp["basepath"]);
							$this->op_bp["basepath"] = str_replace("__PLUGIN__", THRIXTY__PLUGIN__, $this->op_bp["basepath"]);

							$this->op_bp["small_path"] = ( $options->filelist_path_small_use_standard == 1 ? $default_options["filelist_path_small"] : $options->filelist_path_small );
							$this->op_bp["large_path"] = ( $options->filelist_path_large_use_standard == 1 ? $default_options["filelist_path_large"] : $options->filelist_path_large );

							$this->op_bp["use_basepath"] = ( $options->use_basepath_use_standard == 1 ? $default_options["use_basepath"] : $options->use_basepath );

							/**
							*
							* Check the other options
							*/
							$this->op_bp["play_direction"] = ( $options->play_direction_use_standard == 1 ? $default_options["play_direction"] : $options->play_direction );
							$this->op_bp["drag_direction"] = ( $options->drag_direction_use_standard == 1 ? $default_options["drag_direction"] : $options->drag_direction );
							$this->op_bp["autoplay"] = ( $options->autoplay_use_standard == 1 ? $default_options["autoplay"] : $options->autoplay );
							$this->op_bp["autoload"] = ( $options->autoload_use_standard == 1 ? $default_options["autoload"] : $options->autoload );
							$this->op_bp["cycle_duration"] = ( $options->cycle_duration_use_standard == 1 ? $default_options["cycle_duration"] : $options->cycle_duration );
							$this->op_bp["sensitivity_x"] = ( $options->sensitivity_x_use_standard == 1 ? $default_options["sensitivity_x"] : $options->sensitivity_x );
							$this->op_bp["repetition"] = ( $options->repetition_use_standard == 1 ? $default_options["repetition"] : $options->repetition );

							$this->op_bp["enable_controls"] = ( $options->enable_controls_use_standard == 1 ? $default_options["enable_controls"] : $options->enable_controls );
							$this->op_bp["display_buttons"] = ( $options->display_buttons_use_standard == 1 ? $default_options["display_buttons"] : $options->display_buttons );

							$this->op_bp["zoom_control"] = ( $options->zoom_control_use_standard == 1 ? $default_options["zoom_control"] : $options->zoom_control );
							$this->op_bp["zoom_pointer"] = ( $options->zoom_pointer_use_standard == 1 ? $default_options["zoom_pointer"] : $options->zoom_pointer );
							$this->op_bp["outbox_position"] = ( $options->outbox_position_use_standard == 1 ? $default_options["outbox_position"] : $options->outbox_position );

							$this->op_bp["zoom_mode"] = ( $options->zoom_active == 0 ? "none" : $options->zoom_mode );
							$this->op_bp["fullpage_mode"] = ( $options->fullpage_active == 0 ? "none" : $options->fullpage_mode );
						}

					break;
					case "layout":
						/**
						*
						* Get all shortcode attributes values
						*/
						$basepath = isset( $attributes["basepath"] ) ? $attributes["basepath"] : null;
						$object_name = isset( $attributes["object_name"] ) ? $attributes["object_name"] : null;
						$small_path = isset( $attributes["small_path"] ) ? $attributes["small_path"] : null;
						$large_path = isset( $attributes["large_path"] ) ? $attributes["large_path"] : null;
						$use_basepath = isset( $attributes["use_basepath"] ) ? $attributes["use_basepath"] : null;

						/**
						*
						* Check if the id exists and is a number
						* Check if all other path options are set
						*/
						if ( $basepath != null && $object_name != null && $small_path != null && $large_path != null && $use_basepath != null ) {

							/**
							*
							* Get the player from the database
							*/
							$options = $this->get_model()->get_layout( $id );

							if ( $options != null ) {
								$default_options = get_option(Thrixty::DEFAULT_OPTIONS);

								if ( $default_options != null ) {

									/**
									*
									* Check the path options
									*/
									$this->op_bp["basepath"] = $basepath ."/". $object_name;

									$this->op_bp["basepath"] = str_replace("__SITE__", THRIXTY__SITE__, $this->op_bp["basepath"]);
									$this->op_bp["basepath"] = str_replace("__UPLOAD__", THRIXTY__UPLOAD__, $this->op_bp["basepath"]);
									$this->op_bp["basepath"] = str_replace("__PLUGIN__", THRIXTY__PLUGIN__, $this->op_bp["basepath"]);

									$this->op_bp["small_path"] = $small_path;
									$this->op_bp["large_path"] = $large_path;
									
									$this->op_bp["use_basepath"] = $use_basepath;

									/**
									*
									* Check the other options
									*/
									$this->op_bp["play_direction"] = $options->play_direction;
									$this->op_bp["drag_direction"] =  $options->drag_direction;
									$this->op_bp["autoplay"] = $options->autoplay;
									$this->op_bp["autoload"] = $options->autoload;
									$this->op_bp["cycle_duration"] = $options->cycle_duration;
									$this->op_bp["sensitivity_x"] = $options->sensitivity_x;
									$this->op_bp["repetition"] = $options->repetition;

									$this->op_bp["enable_controls"] = $options->enable_controls;
									$this->op_bp["display_buttons"] = $options->display_buttons;

									$this->op_bp["zoom_control"] = $options->zoom_control;
									$this->op_bp["zoom_pointer"] = $options->zoom_pointer;
									$this->op_bp["outbox_position"] = $options->outbox_position;

									$this->op_bp["zoom_mode"] = $options->zoom_mode;
									$this->op_bp["fullpage_mode"] = $options->fullpage_mode;
								}
							}
						}
					break;
				}
			}
			
			/**
			*
			* Convert booleans from 0 or 1 to on or off
			*/
			$this->op_bp["use_basepath"] = ( $this->op_bp["use_basepath"] == 0 ? "off" : "on" );
			$this->op_bp["autoplay"] = ( $this->op_bp["autoplay"] == 0 ? "off" : "on" );
			$this->op_bp["autoload"] = ( $this->op_bp["autoload"] == 0 ? "off" : "on" );
			$this->op_bp["enable_controls"] = ( $this->op_bp["enable_controls"] == 0 ? "off" : "on" );
			$this->op_bp["display_buttons"] = ( $this->op_bp["display_buttons"] == 0 ? "off" : "on" );

			/**
			*
			* Print the html elements
			*/
			$this->get_view()->assign( "id", $id );
			$this->get_view()->assign( "options", $this->op_bp );
			$this->get_view()->assign_all(false);

			return $this->get_view()->print();
		}

		public function shortcode_handler_players ( $attributes ){ return $this->run( $attributes, "player" ); }
		public function shortcode_handler_layouts ( $attributes ){ return $this->run( $attributes, "layout" ); }

	}

?>
