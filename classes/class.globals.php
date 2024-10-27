<?php
	/**
	*
	* @package Thrixty Player
	* @subpackage classes
	* @author Finn Reißmann
	* @version 3.0
	*/

	namespace Thrixty\classes;
	use Thrixty\classes\Thrixty;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();


	/**
	*
	* Globals class
	* Contain some global used functions
	*
	* @author Finn Reißmann
	* @since 3.0
	*/
	class Globals {

		/**
		*
		* Check if the requested GET param exists
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String key
		* @return the GET param if exists otherwise return empty string
		*/
		public static function GET ( $key ){
			if ( isset( $_GET[$key] ) ) {
				return Validation::strip_special_chars( $_GET[$key] );
			} else {
				return "";
			}
		}

		/**
		*
		* Check if the requested POST param exists
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String key
		* @return the POST param if exists otherwise return empty string
		*/
		public static function POST ( $key ){
			if ( isset( $_POST[$key] ) ) {
				return Validation::strip_special_chars( $_POST[$key] );
			} else {
				return "";
			}
		}

		/**
		*
		* Check if the requested FILE exists
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String key
		* @return the FILE param if exists otherwise return NULL
		*/
		public static function FILE ( $key ){
			if ( isset( $_FILES[$key] ) ) {
				return $_FILES[$key];
			} else {
				return NULL;
			}
		}

		/**
		*
		* Check if the requested file exists
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String path
		* @return the file content if its exists otherwise return a empty string
		*/
		public static function get_file_content ( $path ){
			if ( is_file( $path ) ) {
				$content = file_get_contents( $path );
				return $content != false ? $content : "";	
			}
		}

		/**
		*
		* Echo out the label content if the file exits
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String label (file name)
		*/
		public static function print_label ( $label ){
			$result_path = self::load_label( $label, true );
			if ( is_file( $result_path ) ) {
				include $result_path;
			}
		}

		/**
		*
		* Get the label content if the file exits
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String label
		* @param boolean return_path (or content)
		* @return the label content or path depending on the param: return_path
		*/
		public static function load_label ( $label, $return_path = false ){
			if ( Thrixty::is_german() ) {
				$result_path = self::search_file( THRIXTY_HOME_PATH . Thrixty::LABEL_PATH_DE . "/", $label );
			} else {
				$result_path = self::search_file( THRIXTY_HOME_PATH . Thrixty::LABEL_PATH_EN . "/", $label );
			}

			if ( $result_path != "" ) {

				if ( $return_path ) {
					return $result_path;
				} else {
					return self::get_file_content( $result_path );
				}

			} else {
				return "";
			}
		}

		/**
		*
		* Return the path of the requested component if the file exists
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String component
		* @return the component path
		*/
		public static function print_component ( $component ){
			$result_path = self::search_file( THRIXTY_HOME_PATH . Thrixty::COMPONENTS_PATH . "/", $component );

			if ( $result_path != "" &&  is_file( $result_path ) ) {
				return $result_path;
			}
		}

		/**
		*
		* Search for the requested file
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String dir
		* @param String label
		* @return the file path
		*/
		public static function search_file ( $dir, $label ){
			$result = "";

			if ( is_file( $dir . $label ) ) {
				$result = $dir . $label;
			} else {
				$dirs = scandir( $dir );

				foreach ($dirs as $key => $value) {

					/**
					*
					* Check if the path is a directory
					* Check if the subdirecory starts with a dot
					*/
					if ( is_dir( $dir . $value ) && strrpos( $value, "." ) === false ) {

						/**
						*
						* Call the same function with the new path given as parameter
						*/
						$path = self::search_file( $dir . $value . "/", $label );
						if ( $path != "" ) {
							$result = $path;
						}
					}

				}
			}

			return $result;
		}
	}

?>
