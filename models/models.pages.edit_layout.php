<?php
	namespace Thrixty\models;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Model;
	use Thrixty\database\Dao_Layouts;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Model_EditLayout extends Model {

		private $dao;

		public function __construct (){
			$this->dao = new Dao_Layouts();
		}

		public function get_autoincrement (){
			return $this->dao->get_autoincrement();
		}

		// DATA NEW PLAYER

		public function get_default_options (){
			$options = get_option(Thrixty::DEFAULT_OPTIONS);

			if ( $options != null ) {
				return $options;
			} else {
				return array();
			}
		}

		// DATA EDIT PLAYER

		public function get_player_options ( $id ){
			$options = $this->dao->get( $id );
			if ( $options != null ) {
				return $options;
			} else {
				return array();
			}
		}

		public function get_dao(){ return $this->dao; }

	}

?>
