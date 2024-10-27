<?php
	/**
	*
	* @package Thrixty Player
	* @subpackage database
	* @author Finn Reißmann
	* @version 3.0
	*/

	namespace Thrixty\database;
	use Thrixty\classes\DAO;
	use Thrixty\classes\Thrixty;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	/**
	*
	* Dao_Players class
	*
	* @author Finn Reißmann
	* @since 3.0
	* @extends DAO
	*/
	class Dao_Players extends DAO{

		/**
		*
		* Dao_Players constructor
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function __construct (){
			parent::__construct( Thrixty::TABLE_NAME_PLAYERS );
		}

		/**
		*
		* Create the player database
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public function create (){
			$query = sprintf("CREATE TABLE IF NOT EXISTS %s (
					id int not null auto_increment,
					player_name varchar (50),
					player_description varchar (300),

					basepath_use_standard boolean,
					basepath varchar (200) not null,

					object_name varchar (50) not null,

					filelist_path_small_use_standard boolean,
					filelist_path_small varchar (200),

					filelist_path_large_use_standard boolean,
					filelist_path_large varchar (200),

					use_basepath_use_standard boolean,
					use_basepath boolean,

					play_direction_use_standard boolean,
					play_direction enum('normal', 'reverse'),

					drag_direction_use_standard boolean,
					drag_direction enum('normal', 'reverse'),

					autoplay_use_standard boolean,
					autoplay boolean,

					autoload_use_standard boolean,
					autoload boolean,

					cycle_duration_use_standard boolean,
					cycle_duration int,

					sensitivity_x_use_standard boolean,
					sensitivity_x int,

					repetition_use_standard boolean,
					repetition int,

					zoom_active boolean,

					zoom_mode_use_standard boolean,
					zoom_mode enum('inbox', 'outbox'),

					zoom_control_use_standard boolean,
					zoom_control enum('classic', 'progressive'),

					zoom_pointer_use_standard boolean,
					zoom_pointer enum('minimap', 'marker'),

					outbox_position_use_standard boolean,
					outbox_position enum('top', 'right', 'bottom', 'left'),

					fullpage_active boolean,

					fullpage_mode_use_standard boolean,
					fullpage_mode enum('normal'),

					display_buttons_use_standard boolean,
					display_buttons boolean,

					enable_controls_use_standard boolean,
					enable_controls boolean,

					primary key (id) ) %s;",
				$this->get_table_name(), $this->get_charset_collate()
			);
			dbDelta( $query );
		}

		/**
		*
		* Update a existing player record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public function update ( $id = "", $options = "" ){
			$query = "UPDATE ".$this->get_table_name()." SET
					player_name='". $options["player_name"] ."',
					player_description='". $options["player_description"] ."',
					basepath_use_standard=". $options["basepath_use_standard"] .",
					basepath='". $options["basepath"] ."',
					object_name='". $options["object_name"] ."',
					filelist_path_small_use_standard=". $options["filelist_path_small_use_standard"] .",
					filelist_path_small='". $options["filelist_path_small"] ."',
					filelist_path_large_use_standard=". $options["filelist_path_large_use_standard"] .",
					filelist_path_large='". $options["filelist_path_large"] ."',
					use_basepath_use_standard=". $options["use_basepath_use_standard"] .",
					use_basepath=". $options["use_basepath"] .",
					play_direction_use_standard=". $options["play_direction_use_standard"] .",
					play_direction='". $options["play_direction"] ."',
					drag_direction_use_standard=". $options["drag_direction_use_standard"] .",
					drag_direction='". $options["drag_direction"] ."',
					autoplay_use_standard=". $options["autoplay_use_standard"] .",
					autoplay=". $options["autoplay"] .",
					autoload_use_standard=". $options["autoload_use_standard"] .",
					autoload=". $options["autoload"] .",
					cycle_duration_use_standard=". $options["cycle_duration_use_standard"] .",
					cycle_duration=". $options["cycle_duration"] .",
					sensitivity_x_use_standard=". $options["sensitivity_x_use_standard"] .",
					sensitivity_x=". $options["sensitivity_x"] .",
					repetition_use_standard=". $options["repetition_use_standard"] .",
					repetition=". $options["repetition"] .",
					zoom_active=". $options["zoom_active"] .",
					zoom_mode_use_standard=". $options["zoom_mode_use_standard"] .",
					zoom_mode='". $options["zoom_mode"] ."',
					zoom_control_use_standard=". $options["zoom_control_use_standard"] .",
					zoom_control='". $options["zoom_control"] ."',
					zoom_pointer_use_standard=". $options["zoom_pointer_use_standard"] .",
					zoom_pointer='". $options["zoom_pointer"] ."',
					outbox_position_use_standard=". $options["outbox_position_use_standard"] .",
					outbox_position='". $options["outbox_position"] ."',
					fullpage_active=". $options["fullpage_active"] .",
					fullpage_mode_use_standard=". $options["fullpage_mode_use_standard"] .",
					fullpage_mode='". $options["fullpage_mode"] ."',
					display_buttons_use_standard=". $options["display_buttons_use_standard"] .",
					display_buttons=". $options["display_buttons"] .",
					enable_controls_use_standard=". $options["enable_controls_use_standard"] .",
					enable_controls=". $options["enable_controls"]
				." WHERE id = " . $id . ";";

			dbDelta( $query );
		}

		/**
		*
		* Create a new player record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public function insert ( $options = "", $mode = "insert" ){
			$query = "INSERT INTO ".$this->get_table_name()." (
					player_name,
					player_description,
					basepath_use_standard,
					basepath,
					object_name,
					filelist_path_small_use_standard,
					filelist_path_small,
					filelist_path_large_use_standard,
					filelist_path_large,
					use_basepath_use_standard,
					use_basepath,
					play_direction_use_standard,
					play_direction,
					drag_direction_use_standard,
					drag_direction,
					autoplay_use_standard,
					autoplay,
					autoload_use_standard,
					autoload,
					cycle_duration_use_standard,
					cycle_duration,
					sensitivity_x_use_standard,
					sensitivity_x,
					repetition_use_standard,
					repetition,
					zoom_active,
					zoom_mode_use_standard,
					zoom_mode,
					zoom_control_use_standard,
					zoom_control,
					zoom_pointer_use_standard,
					zoom_pointer,
					outbox_position_use_standard,
					outbox_position,
					fullpage_active,
					fullpage_mode_use_standard,
					fullpage_mode,
					display_buttons_use_standard,
					display_buttons,
					enable_controls_use_standard,
					enable_controls
				) VALUES (
					'". $options["player_name"] ."',
					'". $options["player_description"] ."',
					". $options["basepath_use_standard"] .",
					'". $options["basepath"] ."',
					'". $options["object_name"] ."',
					". $options["filelist_path_small_use_standard"] .",
					'". $options["filelist_path_small"] ."',
					". $options["filelist_path_large_use_standard"] .",
					'". $options["filelist_path_large"] ."',
					". $options["use_basepath_use_standard"] .",
					". $options["use_basepath"] .",
					". $options["play_direction_use_standard"] .",
					'". $options["play_direction"] ."',
					". $options["drag_direction_use_standard"] .",
					'". $options["drag_direction"] ."',
					". $options["autoplay_use_standard"] .",
					". $options["autoplay"] .",
					". $options["autoload_use_standard"] .",
					". $options["autoload"] .",
					". $options["cycle_duration_use_standard"] .",
					". $options["cycle_duration"] .",
					". $options["sensitivity_x_use_standard"] .",
					". $options["sensitivity_x"] .",
					". $options["repetition_use_standard"] .",
					". $options["repetition"] .",
					". $options["zoom_active"] .",
					". $options["zoom_mode_use_standard"] .",
					'". $options["zoom_mode"] ."',
					". $options["zoom_control_use_standard"] .",
					'". $options["zoom_control"] ."',
					". $options["zoom_pointer_use_standard"] .",
					'". $options["zoom_pointer"] ."',
					". $options["outbox_position_use_standard"] .",
					'". $options["outbox_position"] ."',
					". $options["fullpage_active"] .",
					". $options["fullpage_mode_use_standard"] .",
					'". $options["fullpage_mode"] ."',
					". $options["display_buttons_use_standard"] .",
					". $options["display_buttons"] .",
					". $options["enable_controls_use_standard"] .",
					". $options["enable_controls"] .");";

				if ( $mode == "insert" ) {
					dbDelta( $query );
				} else if ( $mode == "get" ){
					return $query;
				}

		}

		/**
		*
		* Get a existing player record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public function get ( $id = "" ){
			global $wpdb;

			$query = sprintf("
				SELECT * FROM %s WHERE ID = %s",
				$this->get_table_name(), $id
			);

			$result = $wpdb->get_results( $query );
			if ( count( $result ) > 0 ) {
				return $result;
			} else {
				return null;
			}
		}

		/**
		*
		* Get all player records
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public function get_all (){
			global $wpdb;

			$query = sprintf("
				SELECT * FROM %s",
				$this->get_table_name()
			);

			$result = $wpdb->get_results( $query );

			if ( count( $result ) > 0 ) {
				return $result;
			} else {
				return "";
			}
		}
	}
?>
