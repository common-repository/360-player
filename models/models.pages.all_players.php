<?php
	namespace Thrixty\models;
	use Thrixty\classes\Model;
	use Thrixty\database\Dao_Players;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Model_AllPlayers extends Model {

		private $dao_players;

		public function __construct (){
			$this->dao_players = new Dao_Players();
		}

		public function get_all_players (){
			$players = $this->dao_players->get_all();

			if ( $players != null ) {
				return $players;
			} else {
				return array();
			}
		}

	}

?>
