<?php
	namespace Thrixty\models;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Model;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Model_Tutorial extends Model {

		public function get_tutorial_status (){
			if( is_array( get_option( Thrixty::TUTORIAL_STATUS ) ) ){
				return get_option( Thrixty::TUTORIAL_STATUS );
			} else {
				return null;
			}
		}

  }
?>
