<?php
	namespace Thrixty\controllers;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Globals;
	use Thrixty\classes\Controller;
	use Thrixty\models\Model_Tutorial;
	use Thrixty\views\View_Tutorial;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_Tutorial extends Controller {

		private $all_thrixty_pages = array(
			"thrixty_all_players",
			"thrixty_edit_player",
			"thrixty_all_layouts",
			"thrixty_edit_layout",
			"thrixty_settings",
			"thrixty_about"
		);

		public function __construct (){
			parent::__construct( new Model_Tutorial(), new View_Tutorial() );
		}

		public function run (){
			$this->action();
			$this->get_view()->print();
		}
		public function action (){
			global $pagenow;

			$tutorial_status = $this->get_model()->get_tutorial_status();

			if ( $tutorial_status != null ) {
				$current_page = Globals::GET("page");
				$action = Globals::POST("thrixty_tutorial_action");

				/**
				*
				* Redirect to the landing / about page only if the status for the thrixty_about page is false
				*/
				if ( isset( $tutorial_status["thrixty_about"] ) && !$tutorial_status["thrixty_about"] ) {
					if ( $current_page != "thrixty_about" && in_array( $current_page, $this->all_thrixty_pages ) ) {

						wp_redirect( admin_url( "admin.php" ) . "?page=thrixty_about" );
						exit();

					}
				}

				/**
				*
				* Check the current action
				*/
				switch ( $action ){
					case "cancle_tutorial":
						foreach ($tutorial_status as $key => $value) {
							$tutorial_status[ $key ] = true;
						}
						update_option( Thrixty::TUTORIAL_STATUS, $tutorial_status );
					break;
					case "step_done":
						$id = Globals::POST( "tutorial_step_done" );
						if ( isset( $tutorial_status[ $id ] ) ) {
							$tutorial_status[ $id ] = true;
						}
						update_option( Thrixty::TUTORIAL_STATUS, $tutorial_status );
					break;
				}

				/**
				*
				* Print the tutorial dialog
				*/
				if ( $pagenow == "admin.php" ) {
					if ( isset( $tutorial_status[ $current_page ] ) && !$tutorial_status[ $current_page ] ) {
						$this->get_view()->assign( "step", $current_page );
						$this->get_view()->assign_all();
						$this->get_view()->print();	
					}
					
				} else if ( $pagenow == "post-new.php" || $pagenow == "post.php" ){
					if ( isset( $tutorial_status[ "post" ] ) && !$tutorial_status[ "post" ] ) {
						$this->get_view()->assign( "step", "post" );
						$this->get_view()->assign_all();
						$this->get_view()->print();
					}	
				}

			}
		}
	}
?>
