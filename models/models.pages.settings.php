<?php
	namespace Thrixty\models;
	use Thrixty\classes\Model;
	use Thrixty\classes\Thrixty;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Model_Settings extends Model {

		public function get_default_options (){
			$options = get_option(Thrixty::DEFAULT_OPTIONS);

			if ( $options != null ) {
				return $options;
			} else {
				return array();
			}
		}

	}

?>
