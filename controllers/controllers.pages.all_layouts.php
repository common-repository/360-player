<?php
	namespace Thrixty\controllers;
	use Thrixty\database\Dao_Layouts;
	use Thrixty\classes\Globals;
	use Thrixty\classes\Validation;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Controller;
	use Thrixty\models\Model_AllLayouts;
	use Thrixty\views\View_AllLayouts;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_AllLayouts extends Controller {

		public function __construct(){
			parent::__construct( new Model_AllLayouts(), new View_AllLayouts() );
		}

		public function run (){
			wp_enqueue_script("thrixty_export", THRIXTY_HOME . "resources/scripts/thrixty.export.js");
			wp_enqueue_script("thrixty_import", THRIXTY_HOME . "resources/scripts/thrixty.import.js");

			$this->action();

			$this->get_view()->assign( "list", $this->get_model()->get_all_layouts() );
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

			$dao_layouts = new Dao_Layouts();
			$action = Globals::POST("action");

			if ( $action == "delete" || $action == "export" ) {
				$layout_actions_post = Globals::POST("layout_action");
				if ( is_array($layout_actions_post) ) {
					

					foreach ($layout_actions_post as $key => $value) {
						switch ( $action ) {
							case "delete":
								$dao_layouts->delete($key);
								Thrixty::$current_message = Globals::load_label("msg_layout_deleted_successfully.html");
							break;
							case "export":
								$export .= $dao_layouts->export($key);
							break;
						}
					}

				}

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
						if ( Validation::is_import_valid( $content, "insert into " . $dao_layouts->get_table_name() ) ) {
							dbDelta( $content );
							Thrixty::$current_message = Globals::load_label("msg_layout_imported_successfully.html");
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
