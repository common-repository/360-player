<?php
	/**
	*
	* @package Thrixty Player
	* @subpackage classes
	* @author Finn Reißmann
	* @version 3.0
	*/
	
	namespace Thrixty\admin;
	use Thrixty\database\Dao_Players;
	use Thrixty\database\Dao_Layouts;
	use Thrixty\classes\Globals;
	use Thrixty\classes\Thrixty;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();


	/**
	*
	* Ajax class
	* Used in the shortcode_generator.js and the shortcode_converter.js files
	*
	* @author Finn Reißmann
	* @since 3.0
	*/
	class Ajax {

		/**
		*
		* To use the shortcode insert tool (build with javascript) also in all languages I created a json file with all labels for this tool
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return the current language file (JSON)
		*/
		public function ajax_get_tinymce_label (){

			if ( Thrixty::is_german() ) {
				return wp_send_json_success( Globals::get_file_content( THRIXTY_HOME_PATH . Thrixty::LABEL_PATH_DE . "/tinymce.json" ) );
			} else {
				return wp_send_json_success( Globals::get_file_content( THRIXTY_HOME_PATH . Thrixty::LABEL_PATH_EN . "/tinymce.json" ) );
			}
		}	

		/**
		*
		* Get all players from the database and return them
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function ajax_get_all_players (){
			$dao_players = new Dao_Players();
			$players = $dao_players->get_all();

			if ( is_array($players) ) {
				$data = array();

				foreach ($players as $key => $value) {
					array_push(
						$data,
						array(
							"id" => $value->id,
							"name" => $value->player_name,
							"description" => $value->player_description
						)
					);
				}

				wp_send_json_success( $data );
			} else { wp_send_json_error( "Es sind keine Player vorhanden" ); }
		}

		/**
		*
		* Get one player from the database and return the player
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function ajax_get_player (){
			$id = Globals::POST("id");

			$dao_players = new Dao_Players();
			$players = $dao_players->get($id);

			if ( is_array($players) ) {
				$data = array(array(
					"id" => $players[0]->id,
					"name" => $players[0]->player_name,
					"description" => $players[0]->player_description,
					"small_filelist_absolute_path" => self::convert_absolute_filelist_path(
						$players[0]->basepath,
						$players[0]->object_name,
						$players[0]->filelist_path_small,
						$players[0]->filelist_path_large
					)["small"]
				));

				wp_send_json_success( $data );
			} else { wp_send_json_error(); }
		}

		/**
		*
		* Get one player from the database
		* Check if the player is correctly configured and
		* return the path of the first small image
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function ajax_get_player_preview (){
			$id = Globals::POST("id");

			$dao_players = new Dao_Players();
			$players = $dao_players->get($id);

			if ( is_array($players) ) {

				$path_elements = self::convert_absolute_filelist_path(
					$players[0]->basepath,
					$players[0]->object_name,
					$players[0]->filelist_path_small,
					$players[0]->filelist_path_large
				);
				$path = file_get_contents( $path_elements["small"] );
				if ( $path != false ) {
					$path = str_replace( "'", "", $path );
					$path = explode(",", $path);
					$path = $path[0];
					if (
						strpos($path, "small/") === 0 ||
						strpos($path, "large/") === 0 ||
						intval( $players[0]->use_basepath ) == 1
					){
						$data = array( "pic_path" => $path_elements["basepath"] . "/" . $path_elements["object_name"] . "/" . $path );
					} else {
						$data = array( "pic_path" => $path );
					}
					wp_send_json_success( $data );

				} else { wp_send_json_error( "Achtung der Player ist falsch konfiguriert" ); }
			} else { wp_send_json_error( "Achtung dieser Datensatz existiert nicht mehr" ); }
		}

		/**
		*
		* Get all layouts from the database and return them
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function ajax_get_all_layouts (){
			$dao_layouts = new Dao_Layouts();
			$layouts = $dao_layouts->get_all();

			if ( is_array($layouts) ) {
				$data = array();

				foreach ($layouts as $key => $value) {
					array_push(
						$data,
						array(
							"id" => $value->id,
							"name" => $value->player_name,
							"description" => $value->player_description
						)
					);
				}

				wp_send_json_success( $data );
			} else { wp_send_json_error( "Es sind keine Player vorhanden" ); }
		}

		/**
		*
		* Get one layout from the database and return the layout
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function ajax_get_layout (){
			$id = Globals::POST("id");

			$dao_layouts = new Dao_Layouts();
			$layout = $dao_layouts->get($id);

			$path_elements = self::convert_absolute_filelist_path(
				Globals::POST("basepath"),
				Globals::POST("object_name"),
				Globals::POST("small_path"),
				Globals::POST("large_path")
			);

			if ( is_array($layout) ) {
				$data = array(array(
					"id" => $layout[0]->id,
					"name" => $layout[0]->player_name,
					"description" => $layout[0]->player_description,
					"small_filelist_absolute_path" => $path_elements["small"]
				));

				wp_send_json_success( $data );
			} else {
				wp_send_json_error( "Der Datensatz existiert nicht!" );
			}
		}

		/**
		*
		* Get one layout from the database
		* Check if the layout is correctly configured and
		* return the path of the first small image
		*
		* @author Finn Reißmann
		* @since 3.0
		*/
		public function ajax_get_layout_preview (){
			$id = Globals::POST("id");

			$dao_layouts = new Dao_Layouts();
			$layout = $dao_layouts->get($id);

			if ( is_array($layout) ) {

				$path_elements = self::convert_absolute_filelist_path(
					Globals::POST("basepath"),
					Globals::POST("object_name"),
					Globals::POST("small_path"),
					Globals::POST("large_path")
				);

				$path = file_get_contents( $path_elements["small"] );
				if ( $path != false ) {

					$path = str_replace( "'", "", $path );
					$path = explode(",", $path);
					$path = $path[0];

					if (
						strpos($path, "small/") === 0 ||
						strpos($path, "large/") === 0 ||
						intval( Globals::POST("use_basepath") ) == 1
					){
						$data = array( "pic_path" => $path_elements["basepath"] . "/" . $path_elements["object_name"] . "/" . $path );
					} else {
						$data = array( "pic_path" => $path );
					}

					wp_send_json_success( $data );

				} else { wp_send_json_error( "Achtung der Player ist falsch konfiguriert" ); }
			} else { wp_send_json_error( "Achtung dieser Datensatz existiert nicht mehr" ); }
		}

		/**
		*
		* Create the absolute path of both filelists
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return the corrected basepath, objectname, small_list, large_list and the absolute path of both filelists
		*/
		public function convert_absolute_filelist_path ( $basepath, $object_name, $filelist_path_small, $filelist_path_large ){
			/**
			*
			*	Replace the __SITE__, __UPLOAD__ and __PLUGIN__ placeholders
			*/
			$basepath = str_replace("__SITE__", THRIXTY__SITE__, $basepath);
			$basepath = str_replace("__UPLOAD__", THRIXTY__UPLOAD__, $basepath);
			$basepath = str_replace("__PLUGIN__", THRIXTY__PLUGIN__, $basepath);

			/**
			*
			*	Delete all slashes at the end of the basepath
			*	Delete all slashes at the end of the object name
			*	Delete all slashes at the start of the object name
			*	Delete all slashes at the start of the filelistpaths
			*/
			$basepath = preg_replace("/\/*$/", "", $basepath);

			$object_name = preg_replace("/\/*$/", "", $object_name);
			$object_name = preg_replace("/^\/*/", "", $object_name);

			$filelist_path_small = preg_replace("/^\/*/", "", $filelist_path_small);
			$filelist_path_large = preg_replace("/^\/*/", "", $filelist_path_large);

			/**
			*
			*	Return the absolute paths and the corrected basepath, object name and the filelist paths
			*/
			return array(
				"small" => $basepath . "/" . $object_name . "/" . $filelist_path_small,
				"large" => $basepath . "/" . $object_name . "/" . $filelist_path_small,
				"basepath" => $basepath,
				"object_name" => $object_name,
				"small_path" => $filelist_path_small,
				"large_path" => $filelist_path_large
			);
		}
	}

?>
