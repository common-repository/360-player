<?php
	namespace Thrixty\controllers;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Controller;
	use Thrixty\classes\Globals;
	use Thrixty\admin\Ajax;
	use Thrixty\models\Model_EditPlayer;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class Controller_Backend {

		private $controller_settings;
		private $controller_edit_player;
		private $controller_edit_layout;
		private $controller_all_players;
		private $controller_all_layouts;
		private $controller_landing_page;
		private $controller_tutorial;

		public function __construct (){
			global $pagenow;

			$this->controller_settings = new Controller_Settings();
			$this->controller_edit_player = new Controller_EditPlayer();
			$this->controller_edit_layout = new Controller_EditLayout();
			$this->controller_all_players = new Controller_AllPlayers();
			$this->controller_all_layouts = new Controller_AllLayouts();
			$this->controller_landing_page = new Controller_LandingPage();
			$this->controller_tutorial = new Controller_Tutorial();

			/**
			*
			*	Create the thrixty wordpress plugin menu
			*/
			add_action('admin_menu', array( $this, "add_menu_items"));

			/**
			*
			*	Register custome ajax hooks
			* Used in the shortcode_converter and shortcode_generator js files
			*/
			$ajax = new Ajax();
			add_action("wp_ajax_thrixty_get_all_players", array( $ajax, "ajax_get_all_players" ));
			add_action("wp_ajax_thrixty_get_player", array( $ajax, "ajax_get_player" ));
			add_action("wp_ajax_thrixty_get_player_preview", array( $ajax, "ajax_get_player_preview" ));

			add_action("wp_ajax_thrixty_get_all_layouts", array( $ajax, "ajax_get_all_layouts" ));
			add_action("wp_ajax_thrixty_get_layout", array( $ajax, "ajax_get_layout" ));
			add_action("wp_ajax_thrixty_get_layout_preview", array( $ajax, "ajax_get_layout_preview" ));
			
			add_action("wp_ajax_thrixty_get_tinymce_label", array( $ajax, "ajax_get_tinymce_label" ));

			/**
			*
			*	Print javascript code to use it in tiny mce functions;
			*/
			add_action("wp_print_scripts", array( $this, "print_scripts" ));

			/**
			*
			* Tiny mce stuff
			* Only used on editor pages
			*/
			if ( $pagenow == "post.php" || $pagenow == "post-new.php" ) {

				/**
				*
				* Register styles to use it inside the tiny mce editor iframe;
				*/
				add_editor_style(THRIXTY_HOME . "resources/libraries/font-awesome/thrixty.font_awesome.css");
				add_editor_style(THRIXTY_HOME . "resources/styles/css/thrixty.tinymce_styles.css");

				/**
				*
				* Register tinymce plugins and the button to insert the shortcode
				*/
				add_filter("mce_external_plugins", array( $this, "add_tinymce_plugins" ));
				add_filter("mce_buttons", array( $this, "add_shortcode_generator_button"));

			}

			/**
			*
			* Start the tutorial
			*/
			$this->controller_tutorial->run();

		}

		public function add_tinymce_plugins ( $plugin_array ){
			/**
			*
			* Convert from the text view into visuell view and reversed
			*/
			$plugin_array["thrixty_shortcode_converter"] = THRIXTY_HOME . "resources/scripts/thrixty.tinymce.shortcode_converter.js";

			/**
			*
			* Creates the dialogs to insert and edit the shortcodes
			*/
			$plugin_array["thrixty_shortcode_generator"] = THRIXTY_HOME . "resources/scripts/thrixty.tinymce.shortcode_generator.js";

			return $plugin_array;
		}

		public function add_shortcode_generator_button( $buttons ) {
			/**
			*
			* Add a button to open the current dialog
			*/
			array_push($buttons, "|", "thrixty_shortcode_generator_button");

			return $buttons;
		}

		public function print_scripts (){
			$model_edit_player = new Model_EditPlayer();
			$default_options = $model_edit_player->get_default_options();
			?>
				<script type="text/javascript">
					var thrixty_placeholder = {
						"__SITE__": "<?php echo THRIXTY__SITE__; ?>",
						"__PLUGIN__": "<?php echo THRIXTY__PLUGIN__; ?>",
						"__UPLOAD__": "<?php echo THRIXTY__UPLOAD__; ?>",
						"admin_url": "<?php echo admin_url("admin.php"); ?>",
						"default_options": <?php echo json_encode($default_options); ?>
					};
				</script>
			<?php
		}

		public function add_menu_items (){
			/**
			*
			*	Create the thrixty wordpress plugin main menu item
			*/
			add_menu_page(
				Globals::load_label("main_page_title.html"),				// Page title
				Globals::load_label("main_menu_title.html"), 				// Menu title
				"activate_plugins",											// Capability ( For administrators )
				"thrixty_main_page",										// Slug
				array( $this->controller_landing_page, "run" ),				// Callback
				THRIXTY_HOME . "resources/images/PlayerThrixty_16px.png",			// Icon
				1000														// Position
			);
				/**
				*
				*	Register pages they are visible in the menu
				*/
				add_submenu_page(
					"thrixty_main_page",									// Parent slug
					Globals::load_label("all_players_page_title.html"),		// Page title
					Globals::load_label("all_players_menu_title.html"),		// Menu title
					"activate_plugins",										// Capability ( For administrators )
					"thrixty_all_players",									// Slug
					array( $this->controller_all_players, "run" ),			// Callback
					array( $this->controller_all_players, "run" )			// Callback
				);
				add_submenu_page(
					"thrixty_main_page",
					Globals::load_label("all_layouts_page_title.html"),
					Globals::load_label("all_layouts_menu_title.html"),
					"activate_plugins",
					"thrixty_all_layouts",
					array( $this->controller_all_layouts, "run" )
				);
				add_submenu_page(
					"thrixty_main_page",
					Globals::load_label("default_settings_page_title.html"),
					Globals::load_label("default_settings_menu_title.html"),
					"activate_plugins",
					"thrixty_settings",
					array( $this->controller_settings, "run" )
				);
				add_submenu_page(
					"thrixty_main_page",
					Globals::load_label("landing_page_page_title.html"),
					Globals::load_label("landing_page_menu_title.html"),
					"activate_plugins",
					"thrixty_about",
					array( $this->controller_landing_page, "run" )
				);

				/**
				*
				*	Register pages they are NOT visible in the menu
				*/
				add_submenu_page(
					null,
					Globals::load_label("edit_player_page_title.html"),
					Globals::load_label("edit_player_menu_title.html"),
					"activate_plugins",
					"thrixty_edit_player",
					array( $this->controller_edit_player, "run" )
				);
				add_submenu_page(
					null,
					Globals::load_label("edit_layout_page_title.html"),
					Globals::load_label("edit_layout_menu_title.html"),
					"activate_plugins",
					"thrixty_edit_layout",
					array( $this->controller_edit_layout, "run" )
				);

				/**
				*
				* IMPORTANT
				* If you have created submenuitems, wordpress will create a additional submemnuitem automatically.
				* This submenuitem have the same options as the main menuitem.
				*
				* The statement beolow will delete this additional submenuitem.
				*/
				remove_submenu_page( "thrixty_main_page", "thrixty_main_page" );
		}

	}

?>
