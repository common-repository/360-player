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
	* Dao_Layouts class
	*
	* @author Finn Reißmann
	* @since 3.0
	* @extends DAO
	*/
	class Dao_Layouts extends DAO{

		/**
		*
		* Dao_Layouts constructor
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function __construct (){
			parent::__construct( Thrixty::TABLE_NAME_LAYOUTS );
		}

		/**
		*
		* Create the layout database
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function create (){
			$query = sprintf("CREATE TABLE IF NOT EXISTS %s (
					id int not null auto_increment,
					player_name varchar (50),
					player_description varchar (300),

					play_direction enum('normal', 'reverse'),
					drag_direction enum('normal', 'reverse'),

					autoplay boolean,
					autoload boolean,

					cycle_duration int,
					sensitivity_x int,
					repetition int,

					zoom_active boolean,
					zoom_mode enum('inbox', 'outbox'),
					zoom_control enum('classic', 'progressive'),
					zoom_pointer enum('minimap', 'marker'),
					outbox_position enum('top', 'right', 'bottom', 'left'),

					fullpage_active boolean,
					fullpage_mode enum('normal'),
					display_buttons boolean,
					enable_controls boolean,

					primary key (id) ) %s;",
				$this->get_table_name(), $this->get_charset_collate()
			);
			dbDelta( $query );
		}

		/**
		*
		* Update a existing layout record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public function update ( $id = "", $options = "" ){
			$query = "UPDATE ".$this->get_table_name()." SET
					player_name='". $options["player_name"] ."',
					player_description='". $options["player_description"] ."',
					play_direction='". $options["play_direction"] ."',
					drag_direction='". $options["drag_direction"] ."',
					autoplay=". $options["autoplay"] .",
					autoload=". $options["autoload"] .",
					cycle_duration=". $options["cycle_duration"] .",
					sensitivity_x=". $options["sensitivity_x"] .",
					repetition=". $options["repetition"] .",
					zoom_active=". $options["zoom_active"] .",
					zoom_mode='". $options["zoom_mode"] ."',
					zoom_control='". $options["zoom_control"] ."',
					zoom_pointer='". $options["zoom_pointer"] ."',
					outbox_position='". $options["outbox_position"] ."',
					fullpage_active=". $options["fullpage_active"] .",
					fullpage_mode='". $options["fullpage_mode"] ."',
					display_buttons=". $options["display_buttons"] .",
					enable_controls=". $options["enable_controls"]
				." WHERE id = " . $id . ";";

			dbDelta( $query );
		}

		/**
		*
		* Create a new layout record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public function insert ( $options = "", $mode = "insert" ){
			$query = "INSERT INTO ".$this->get_table_name()." (
					player_name,
					player_description,
					play_direction,
					drag_direction,
					autoplay,
					autoload,
					cycle_duration,
					sensitivity_x,
					repetition,
					zoom_active,
					zoom_mode,
					zoom_control,
					zoom_pointer,
					outbox_position,
					fullpage_active,
					fullpage_mode,
					display_buttons,
					enable_controls
				) VALUES (
					'". $options["player_name"] ."',
					'". $options["player_description"] ."',
					'". $options["play_direction"] ."',
					'". $options["drag_direction"] ."',
					". $options["autoplay"] .",
					". $options["autoload"] .",
					". $options["cycle_duration"] .",
					". $options["sensitivity_x"] .",
					". $options["repetition"] .",
					". $options["zoom_active"] .",
					'". $options["zoom_mode"] ."',
					'". $options["zoom_control"] ."',
					'". $options["zoom_pointer"] ."',
					'". $options["outbox_position"] ."',
					". $options["fullpage_active"] .",
					'". $options["fullpage_mode"] ."',
					". $options["display_buttons"] .",
					". $options["enable_controls"]
				.");";
			if ( $mode == "insert" ) {
				dbDelta( $query );
			} else if ( $mode == "get" ){
				return $query;
			}
		}

		/**
		*
		* Get a existing layout record
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
				return "";
			}
		}

		/**
		*
		* Get all layout records
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
