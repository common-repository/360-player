<?php	
	namespace Thrixty\classes;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Validation {

		public static $not_allowed_keys_database = array(
			"#",
			"*",
			";",
			",",
			'"',
			"'"
		);

		public static $not_allowed_keys_import = array(
			"delete",
			"update",
			"drop",
			"create",
			"table",
			"truncate",
			"*"
		);

		public static function strip_special_chars ( $input ){
			if ( is_array( $input ) ) {
				foreach ($input as $key => $value) {
					$input[ $key ] = self::strip_special_chars( $value );
				}

			} else {
				
				foreach (self::$not_allowed_keys_database as $value) {
					$input = str_replace( $value, "", $input );
				}

			}
			return $input;
		}

		public static function is_import_valid ( $input, $must_have_key ){
			$result = true;

			$input = strtolower($input);

			for ($i = 0; $i < count(self::$not_allowed_keys_import); $i++) {

				if ( strpos( $input, self::$not_allowed_keys_import[$i] ) != false ) {
					$result = false;
				}
			}

			if ( strpos( $input, $must_have_key ) !== false ) {
				return $result;
			} else {
				return false;
			}

		}

	}

?>
