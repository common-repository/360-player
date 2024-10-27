<?php
	/**
	*
	* @package Thrixty Player
	* @subpackage classes
	* @author Finn Reißmann
	* @version 3.0
	*/
	
	namespace Thrixty\classes;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();


	/**
	*
	* Data access object class
	*
	* @author Finn Reißmann
	* @since 3.0
	*/
	abstract class DAO {

		private $tableName;
		private $charsetCollate;

		/**
		*
		* Data access object contructor
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String table_name
		*/
		public function __construct ( $table_name ){
			global $wpdb;

			$this->tableName = $wpdb->prefix . $table_name;
			$this->charsetCollate = $wpdb->get_charset_collate();
		}

		/**
		*
		* Get the current auto increment
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return the current autoincrement
		*/
		public function get_autoincrement (){
			global $wpdb;

			$query = sprintf("
				SELECT `AUTO_INCREMENT`
				FROM  INFORMATION_SCHEMA.TABLES
				WHERE TABLE_SCHEMA = '%s'
				AND   TABLE_NAME   = '%s';",
				DB_NAME, $this->tableName
			);

			$result = $wpdb->get_results( $query );

			if ( isset( $result[0]->AUTO_INCREMENT ) ) {
				return $result[0]->AUTO_INCREMENT;
			} else {
				return "";
			}
		}

		/**
		*
		* Delete the record with the given id
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param Int id
		*/
		public function delete ( $id ){
			global $wpdb;

			$query = sprintf("DELETE FROM %s WHERE id = %s;", $this->tableName, $id);
			$wpdb->query( $query );
		}

		/**
		*
		* Create a insert statement for the record with the given id
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String sql_statement
		*/
		public function export ( $id ){
			return $this->insert( json_decode( json_encode( $this->get($id)[0] ), true ), "get" );
		}
		
		/**
		*
		* Create the table
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function create ();

		/**
		*
		* Update one record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function update ();

		/**
		*
		* Create a new record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function insert ( $mode = "insert" );

		/**
		*
		* Get one record
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function get ();

		/**
		*
		* Get all records
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function get_all ();

		/**
		*
		* Get the tablename
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return String tablename
		*/
		public function get_table_name (){ return $this->tableName; }

		/**
		*
		* Get the charset
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return String charset
		*/
		public function get_charset_collate (){ return $this->charsetCollate; }
	}

?>
