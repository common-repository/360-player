<?php
	/**
	*
	* @package Thrixty Player
	* @subpackage classes.mvc
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
	* MVC View class
	*
	* @author Finn Reißmann
	* @since 3.0
	*/
	abstract class View {

		/**
		*
		* An array with all variables the view needs
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		private $variables = array();

		/**
		*
		* Assign a new variable
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String key
		* @param Any value
		*/
		public function assign ( $key, $value ){
			if ( !isset( $this->variables[$key] ) ) {
				$this->variables[$key] = $value;
			}
		}

		/**
		*
		* Start the variable conversion proccess
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param boolean convert_arrays (default = true)
		*/
		public function assign_all ( $convert_arrays = true ){
			$this->create_variables( $this->variables, $convert_arrays );
		}

		/**
		*
		* Convert the array elements into real variables (variable variables)
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param Array variables
		* @param boolean convert_arrays
		*/
		public function create_variables ( $array, $convert_arrays ){
			foreach ($array as $key => $value) {

				if ( !$convert_arrays ) {
					$this->$key = $value;
				} else {

					if ( is_object( $value ) ) {
						$value = (array) $value;
					}

					if ( is_array( $value ) ) {
						$this->create_variables( $value, $convert_arrays );
					} else {
						$this->$key = $value;
					}

				}
			}
			$this->variables = array();
		}

		/**
		*
		* Check if the selectbox option is selected and print the "selected" attribute
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String key
		* @param String value_to_check
		*/
		public function is_selected ( $key, $value_to_check ){
			echo $this->$key == $value_to_check ? "selected" : "";
		}

		/**
		*
		* Check if the checkbox is checked and print the "checked" attribute
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param String key
		*/
		public function is_checked ( $key ){
			echo ( $this->$key == "1" || $this->$key == "on" ) ? "checked" : "";
		}

		/**
		*
		* Print the content
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function print ();
	}

?>
