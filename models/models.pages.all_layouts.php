<?php
	namespace Thrixty\models;
	use Thrixty\classes\Model;
	use Thrixty\database\Dao_Layouts;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Model_AllLayouts extends Model {

		private $dao_layouts;

		public function __construct (){
			$this->dao_layouts = new Dao_Layouts();
		}

		public function get_all_layouts (){
			$layouts = $this->dao_layouts->get_all();

			if ( $layouts != null ) {
				return $layouts;
			} else {
				return array();
			}
		}

	}

?>
