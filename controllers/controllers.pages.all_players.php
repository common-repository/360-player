<?php
	namespace Thrixty\controllers;
	use Thrixty\database\Dao_Players;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Globals;
	use Thrixty\classes\Validation;
	use Thrixty\classes\Controller;
	use Thrixty\models\Model_AllPlayers;
	use Thrixty\views\View_AllPlayers;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_AllPlayers extends Controller {

		public function __construct(){
			parent::__construct( new Model_AllPlayers(), new View_AllPlayers() );
		}

		public function run (){
			wp_enqueue_script("thrixty_export", THRIXTY_HOME . "resources/scripts/thrixty.export.js");
			wp_enqueue_script("thrixty_import", THRIXTY_HOME . "resources/scripts/thrixty.import.js");

			$this->action();

			$this->get_view()->assign( "list", $this->get_model()->get_all_players() );
			$this->get_view()->assign_all( false );

			/**
			*
			* Display the current message if it isn´t empty
			*/
			include Globals::print_component("message.php");

			$this->get_view()->print();
		}

		public function action (){
			$export = "";
			$action = Globals::POST("action");

			/**
			*
			* Check the action
			*/
			$dao_players = new Dao_Players();
			if ( $action == "delete" || $action == "export" ) {

				$player_actions_post = Globals::POST("player_action");
				if ( is_array($player_actions_post) ) {
					foreach ($player_actions_post as $key => $value) {
						switch ( $action ) {
							case "delete":
								$dao_players->delete($key);
								Thrixty::$current_message = Globals::load_label("msg_player_deleted_successfully.html");
							break;
							case "export":
								$export .= $dao_players->export($key);
							break;
						}
					}

				}

				/**
				*
				* Import
				*/
			} else if ( $action == "import" ){

				$file = Globals::FILE("import");
				if ( $file != NULL ) {

					/**
					*
					* Get and check the filetype
					*/
					$filetype = pathinfo( $file["name"], PATHINFO_EXTENSION );
					if ( $filetype == "sql" || $filetype == "txt" ) {
						$content = Globals::get_file_content( $file["tmp_name"] );

						/**
						*
						* Check if the sql dump is valid
						*/
						if ( Validation::is_import_valid( $content, "insert into " . $dao_players->get_table_name() ) ) {
							dbDelta( $content );
							Thrixty::$current_message = Globals::load_label("msg_player_imported_successfully.html");
						}
					}
				}
			}

			if ( $action == "export" ) {
				$this->get_view()->assign( "export", $export );
			}
		}

	}

?>
