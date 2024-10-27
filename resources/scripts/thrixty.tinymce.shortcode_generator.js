"use strict";

if ( typeof thrixty !== "undefined" ) {

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator = function (){
		this.editor;

		this.frame_new;
		this.frame_edit_player;
		this.frame_edit_layout;
		this.overlay;

		this.labels = new thrixty.ManuallyLoadPlugins.Tinymcelabels();

		this.init = function (){
			this.labels.init();

			tinymce.create( "tinymce.plugins.thrixty_shortcode_generator", {
				init: function ( editor, url ){

					this.editor = editor;
					this.generate_dialog();

					/**
					*
					*	Generate a button to insert the shortcode
					*/
					editor.addButton("thrixty_shortcode_generator_button", {
						title: "Thrixty Player",
						image: url + "/../images/PlayerThrixty_50px.png",
						onclick: this.show.bind(this)
					});

					/**
					*
					*	Fires after clicking on the visuell view tab
					*	Fires after the content was inserted
					*/
					editor.onSetContent.add(function (d, e) {
						this.assign_events();
					}.bind(this));

					/**
					*
					*	Fires after the initialization
					*/
					editor.onInit.add(function (editor){

						/**
						*
						*	Fires after the visuell type content was set
						*/
						editor.selection.onSetContent.add(function (d, e){
							this.assign_events();
						}.bind(this));

					}.bind(this));
				}.bind(this)
			});
			tinymce.PluginManager.add( "thrixty_shortcode_generator", tinymce.plugins.thrixty_shortcode_generator );
		}
	}

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.show = function (){
		this.change_type(jQuery("input[type=radio][name=thrixty_insert_type_radiogroup]:checked").val());
		this.overlay.show();
		this.frame_new.show();
	}

	//******************** GENERAL ********************//
	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.generate_dialog = function (){
		var output = "";

		this.frame_new = jQuery("<div id='thrixty_insert_dialog' class='thrixty_dialog'></div>");
		this.frame_edit_player = jQuery("<div id='thrixty_edit_dialog_player' class='thrixty_dialog'></div>");
		this.frame_edit_layout = jQuery("<div id='thrixty_edit_dialog_layout'class='thrixty_dialog'></div>");
		this.overlay = jQuery("<div id='thrixty_overlay' class='thrixty_dialog_overlay'></div>");

		jQuery("body").append(this.overlay);
		jQuery("body").append(this.frame_new);
		jQuery("body").append(this.frame_edit_player);
		jQuery("body").append(this.frame_edit_layout);

		this.overlay.bind( "click", function (){
			this.overlay.hide();
			this.frame_edit_player.hide();
			this.frame_edit_layout.hide();
			this.frame_new.hide();
		}.bind(this));

		// BUILD NEW FRAME

		output += "<div id='thrixty_insert_dialog_container'>";
			output += "<div class='thrixty_row thrixty_dialog_headline' id='thrixty_insert_player_dialog_headline'>"
				output += "<div class='column'>";
					output += "<h1>" + this.labels.get_label( "dialogs.main.headline" ) + "</h1>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_dialog_close' id='thrixty_insert_player_dialog_close'>"
				output += "<div class='column'>";
					output += "<i class='fa fa-close fa-2x close_button'></i>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_margin-50 thrixty_dialog_subheadline' id='thrixty_insert_player_dialog_subheadline'>";
				output += "<div class='column'>";
					output += "<h4>" + this.labels.get_label( "dialogs.main.text" ) + "</h4>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_margin-50'>";
				output += "<div class='column small-6'>";
					output += "<label class='thrixty_insert_dialog_radio_button' for='thrixty_insert_dialog_radio_player'>" + this.labels.get_label( "dialogs.main.radio_player" ) + "</label><input value='player' name='thrixty_insert_type_radiogroup' type='radio' id='thrixty_insert_dialog_radio_player' checked>";
				output += "</div>";
				output += "<div class='column small-6'>";
					output += "<label class='thrixty_insert_dialog_radio_button' for='thrixty_insert_player_dialog_radio'>" + this.labels.get_label( "dialogs.main.radio_layout" ) + "</label><input value='layout' name='thrixty_insert_type_radiogroup' type='radio' id='thrixty_insert_player_dialog_radio'>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_dialog_content'>";
				output += "<div class='column' id='thrixty_insert_player_dialog_content'>";
				output += "</div>";
			output += "</div>";
		output += "</div>";

		this.frame_new.append(output);

		this.radio_player = jQuery("#thrixty_insert_dialog_radio_player");
		this.radio_layout = jQuery("#thrixty_insert_player_dialog_radio");
		this.dialog_content = jQuery("#thrixty_insert_player_dialog_content");

		// CLOSE POPUPS
		jQuery("#thrixty_insert_dialog").find(".close_button").on("click", function ( element ){
			jQuery("#thrixty_insert_dialog").hide();
			this.overlay.hide();
		}.bind(this));

		// CHANAGE TYPE: EVENT TRIGGER
		jQuery("input[type=radio][name=thrixty_insert_type_radiogroup]").change(function ( element ){
			this.change_type(element.target.value);
		}.bind(this));

	}

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.change_type = function ( type ){
		if (type == "player") {
			this.generate_player_dialog();
		}
		else if (type == "layout") {
			this.generate_layout_dialog();
		}
	}

	//******************** PLAYER ********************//
	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.generate_player_dialog = function (){
		var output = "";
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			dataType: "json",
			data: {
				action: "thrixty_get_all_players"
			},
			success: function ( response ){

				if ( response != 0 ) {
					if ( response.success ) {

						var all_players = response.data;
						
						output += "<div class='thrixty_row thrixty_list_item header'>";
							output += "<div class='small-2 column'><strong>ID</strong></div>";
							output += "<div class='small-3 column'><strong>" + this.labels.get_label( "general.name" ) + "</strong></div>";
							output += "<div class='small-7 column'><strong>" + this.labels.get_label( "general.description" ) + "</strong></div>";
						output += "</div>";
						for (var i = 0; i < all_players.length; i++) {
							output += "<div class='thrixty_row thrixty_list_link_item'>";
								output += "<div class='small-2 column'>"+ all_players[i].id +"</div>";
								output += "<div class='small-3 column'>"+ all_players[i].name +"</div>";
								output += "<div class='small-4 column'>"+ all_players[i].description +"</div>";
								output += "<div class='small-12 medium-3 column'><div class='thrixty_button_container no_margin no_padding'><button type='button' class='thrixty_button thrixty_primary' data-thrixty-insert-button-player='" + all_players[i].id + "'>" + this.labels.get_label( "dialogs.insert_player.insert_shortcode" ) + "</button></div></div>";
							output += "</div>";
						}

					} else {
						output = "<i>" + this.labels.get_label( "dialogs.insert_player.error_no_players" ) + " <a href='" + thrixty_placeholder.admin_url + "?page=thrixty_edit_player'>" + this.labels.get_label( "dialogs.insert_player.error_no_players_create_player" ) + "</a></i>";
					}
				}

				this.dialog_content.html( output );
				/**
				*
				* Bind click events on the insert buttons
				*/
				this.insert_player();

			}.bind(this),
			error: function ( error ){
				return false;
			}
		});
	}

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.generate_player_edit_dialog = function ( id ){
		var output = "";

		/**
		*
		* Build the main html structure
		*/
		output += "<div id='thrixty_edit_player_dialog_container'>";
			output += "<div class='thrixty_row thrixty_dialog_headline' id='thrixty_edit_player_dialog_headline'>"
				output += "<h1>" + this.labels.get_label( "dialogs.edit_player.headline" ) + "</h1>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_dialog_subheadline' id='thrixty_edit_player_dialog_subheadline'>"
				output += "<div class='column' id='thirtxy_edit_player_dialog_message'>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row' id='thrixty_edit_player_dialog_close'>";
				output += "<div class='column thrixty_dialog_close'>";
					output += "<i class='fa fa-close fa-2x close_button'></i>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_dialog_content'>"
				output += "<div class='column' id='thrixty_edit_player_dialog_content'>";
				output += "</div>";
			output += "</div>";
		output += "</div>";
		this.frame_edit_player.html(output);

		/**
		*
		* Assign a click event to the close button
		*/
		jQuery("#thrixty_edit_dialog_player").find(".close_button").on("click", function ( element ){
			jQuery("#thrixty_edit_dialog_player").hide();
			this.overlay.hide();
		}.bind(this));

		/**
		*
		* Display the frame
		*/
		this.overlay.show();
		this.frame_edit_player.show();

		/**
		*
		* Load the data via ajax request
		*/
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			dataType: "json",
			data: {
				action: "thrixty_get_player",
				id: id
			},
			success: function ( response ){
				var data = "";
				var iframe = "";
				var message = "";

				if ( response != 0 ) {
					if ( response.success ) {

						var player = response.data[0];
						if ( player != null ) {
							/**
							*
							* Display the main data
							*/

							data += "<div class='thrixty_row thrixty_list_item header'>";
								data += "<div class='small-2 column'><strong>ID</strong></div>";
								data += "<div class='small-3 column'><strong>" + this.labels.get_label( "general.name" ) + "</strong></div>";
								data += "<div class='small-7 column'><strong>" + this.labels.get_label( "general.description" ) + "</strong></div>";
							data += "</div>";
							data += "<div class='thrixty_row thrixty_list_item'>";
									data += "<div class='small-2 column'>"+ player.id +"</div>";
									data += "<div class='small-3 column'>"+ player.name +"</div>";
									data += "<div class='small-4 column'>"+ player.description +"</div>";
									data += "<div class='small-12 medium-3 column'><div class='thrixty_button_container no_margin no_padding'><label for='thritxy_edit_player_open_iframe' class='thrixty_button thrixty_primary'>" + this.labels.get_label( "dialogs.edit_player.button_edit_player" ) + "</label></div></div>";
							data += "</div>";
							jQuery("#thrixty_edit_player_dialog_content").html(data);

							/**
							*
							* Create a iframe to edit the player settings
							* Display the iframe
							*
							* @src admin_url + ?page=thrixty_edit_player&mode=edit&id=[player_id]
							*/
							iframe += "<input type='checkbox' class='thrixty_open_input' id='thritxy_edit_player_open_iframe'>"
							iframe += "<div class='thrixty_row thrixty_open_content' id='thirtxy_edit_player_dialog_iframe'>";
								iframe += "<iframe src='" + thrixty_placeholder.admin_url + "?page=thrixty_edit_player&mode=edit&id=" + player.id + "'></iframe>";
							iframe += "</div>";
							jQuery("#thrixty_edit_player_dialog_container").append(iframe);

							/**
							*
							* Check player path settings
							*/
							jQuery.ajax({
								url: player.small_filelist_absolute_path,
								async: false,
								type: "POST",
								success: function ( response ){},
								error: function ( error ){

									/**
									*
									* Display the alert message box
									*/
									message = this.labels.get_label( "dialogs.edit_player.error_bad_configuration" );
								}.bind(this)
							});
						} else { message = this.labels.get_label( "dialogs.edit_player.error_no_data" ); }

					} else { message = this.labels.get_label( "dialogs.edit_player.error_no_data" ); }
				}

				if ( message != "" ) {
					jQuery("#thirtxy_edit_player_dialog_message").html( "<label class='thrixty_font_waring thrixty_dialog_message_headline'><i class='fa fa-warning'></i>&nbsp;" + message + "</label>");
				}
			}.bind(this),
			error: function ( error ){
				return false;
			}
		});
	}

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.insert_player = function (){
		var player_buttons = jQuery("[data-thrixty-insert-button-player]");

		for (var i = 0; i < player_buttons.length; i++) {
			player_buttons[i].onclick = function ( element ){
				this.editor.selection.setContent("[thrixty-player id='"+ element.target.getAttribute("data-thrixty-insert-button-player") +"']");

				this.overlay.hide();
				this.frame_new.hide();
			}.bind(this);
		}
	}

	//******************** LAYOUTS ********************//
	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.generate_layout_dialog = function (){
		var output = "";

		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			dataType: "json",
			data: {
				action: "thrixty_get_all_layouts"
			},
			success: function ( response ){

				if ( response != 0 ) {

					if ( response.success ) {
						var all_layouts = response.data;

						output += "<div class='thrixty_row thrixty_list_item header'>";
							output += "<div class='small-2 column'><strong>ID</strong></div>";
							output += "<div class='small-3 column'><strong>" + this.labels.get_label( "general.name" ) + "</strong></div>";
							output += "<div class='small-7 column'><strong>" + this.labels.get_label( "general.description" ) + "</strong></div>";
						output += "</div>";
						for (var i = 0; i < all_layouts.length; i++) {
							output += "<div class='thrixty_row thrixty_list_link_item'>";
								output += "<div class='column no_padding'>";
									output += "<div class='thrixty_row'>"
										output += "<div class='column small-2'>"+ all_layouts[i].id +"</div>";
										output += "<div class='column small-3'>"+ all_layouts[i].name +"</div>";
										output += "<div class='column small-4'>"+ all_layouts[i].description +"</div>";
										output += "<div class='column small-12 medium-3'><div class='thrixty_button_container no_margin no_padding'><label class='thrixty_button thrixty_secondary' for='thrixty_insert_layout_checkbox_" + all_layouts[i].id + "'>" + this.labels.get_label( "dialogs.insert_layout.pathsettings.button_edit" ) + "</label></div></div>";
									output += "</div>";

									output += "<input type='checkbox' class='thrixty_open_input' id='thrixty_insert_layout_checkbox_" + all_layouts[i].id + "'>";
									output += "<div class='thrixty_row thrixty_open_content' data-thrixty-insert-layout='" + all_layouts[i].id + "' data-thrixty-path-status='" + all_layouts[i].id + "' data-thrixty-path-status-autoload='false'>";
										output += "<div class='column'>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column small-3'>";
													output += "<label for='thrixty_insert_layout_basepath_" + all_layouts[i].id + "'>" + this.labels.get_label( "general.pathsettings.basepath" ) + "</label>";
												output += "</div>";
												output += "<div class='column small-9'>";
													output += "<input class='thrixty_input' data-thrixty-path-status-basepath='' data-thrixty-insert-layout-basepath='' type='text' id='thrixty_insert_layout_basepath_" + all_layouts[i].id + "' value='" + thrixty_placeholder.default_options.basepath + "'>";
												output += "</div>";
											output += "</div>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column small-3'>";
													output += "<label for='thrixty_insert_layout_object_name_" + all_layouts[i].id + "'>" + this.labels.get_label( "general.pathsettings.object_name" ) + "</label>";
												output += "</div>";
												output += "<div class='column small-9'>";
													output += "<input class='thrixty_input' data-thrixty-path-status-object-name='' data-thrixty-insert-layout-object-name='' type='text' id='thrixty_insert_layout_object_name_" + all_layouts[i].id + "'>";
												output += "</div>";
											output += "</div>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column small-3'>";
													output += "<label for='thrixty_insert_layout_small_filelist_" + all_layouts[i].id + "'>" + this.labels.get_label( "general.pathsettings.filelist_small" ) + "</label>";
												output += "</div>";
												output += "<div class='column small-9'>";
													output += "<input class='thrixty_input' data-thrixty-path-status-small-path='' data-thrixty-insert-layout-filelist-small='' type='text' id='thrixty_insert_layout_small_filelist_" + all_layouts[i].id + "' value='" + thrixty_placeholder.default_options.filelist_path_small + "'>";
												output += "</div>";
											output += "</div>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column small-3'>";
													output += "<label for='thrixty_insert_layout_large_filelist_" + all_layouts[i].id + "'>" + this.labels.get_label( "general.pathsettings.filelist_large" ) + "</label>";
												output += "</div>";
												output += "<div class='column small-9'>";
													output += "<input class='thrixty_input' data-thrixty-path-status-large-path='' data-thrixty-insert-layout-filelist-large='' type='text' id='thrixty_insert_layout_large_filelist_" + all_layouts[i].id + "' value='" + thrixty_placeholder.default_options.filelist_path_large + "'>";
												output += "</div>";
											output += "</div>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column small-3'>";
													output += "<label for='thrixty_insert_layout_use_basepath_" + all_layouts[i].id + "'>" + this.labels.get_label( "general.pathsettings.use_basepath" ) + "</label>";
												output += "</div>";
												output += "<div class='column small-9'>";
													output += "<label for='thrixty_insert_layout_use_basepath_" + all_layouts[i].id + "' class='thrixty_standard_input thrixty_switch'>";
														output += "<input data-thrixty-insert-layout-use-basepath='' data-thrixty-use-basepath='' type='checkbox' class='thrixty_input' " + ( thrixty_placeholder.default_options.use_basepath == "1" ? "checked" : "" ) + " id='thrixty_insert_layout_use_basepath_" + all_layouts[i].id + "'>";
														output += "<div>";
															output += "<div class='off'>0</div>";
															output += "<div class='on'>|</div>";
														output += "</div>";
													output += "</label>";
												output += "</div>";
											output += "</div>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column small-3'>";
													output += "Status Filelist small:";
												output += "</div>";
												output += "<div class='column small-9'>";
													output += "<label data-thrixty-path-status-output-small></label>";
												output += "</div>";
											output += "</div>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column small-3'>";
													output += "Status Filelist large:";
												output += "</div>";
												output += "<div class='column small-9'>";
													output += "<label data-thrixty-path-status-output-large></label>";
												output += "</div>";
											output += "</div>";
											output += "<br>";
											output += "<div class='thrixty_row'>";
												output += "<div class='column'>";
													output += "<div class='thrixty_button_container'><button class='thrixty_button thrixty_expanded thrixty_primary' data-thrixty-insert-layout-submit='" + all_layouts[i].id + "'>" + this.labels.get_label( "dialogs.insert_layout.insert_shortcode" ) + "</button></div>";
												output += "</div>";
											output += "</div>";
										output += "</div>";
									output += "</div>";
								output += "</div>";
							output += "</div>";
						}

					} else {
						output = "<i>Es sind keine Layouts vorhanden <a href='" + thrixty_placeholder.admin_url + "?page=thrixty_edit_layout'>Layout anlegen</a></i>";
					}

					this.dialog_content.html( output );

					/**
					*
					* Init the js library to check the entered path settings
					*/
					if ( typeof thrixty !== "undefined" ) {
						var object = new thrixty.ManuallyLoadPlugins.Filepaths();
						object.init();
					}

					/**
					*
					* Bind click events on the insert buttons
					*/
					this.insert_layout();
				}

			}.bind(this),
			error: function ( error ){
				return false;
			}
		});
	}

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.generate_layout_edit_dialog = function ( element ){
		var id = element.getAttribute("data-thrixty-layout-preview");
		var basepath = element.getAttribute("data-thrixty-preview-basepath");
		var object_name = element.getAttribute("data-thrixty-preview-object-name");
		var small_path = element.getAttribute("data-thrixty-preview-small-path");
		var large_path = element.getAttribute("data-thrixty-preview-large-path");
		var use_basepath = element.getAttribute("data-thrixty-preview-use-basepath");

		var output = "";

		/**
		*
		* Build the main html structure
		*/
		output += "<div id='thrixty_edit_layout_dialog_container'>";
			output += "<div class='thrixty_row thrixty_dialog_headline' id='thrixty_edit_layout_dialog_headline'>"
				output += "<h1>" + this.labels.get_label( "dialogs.edit_layout.headline" ) + "</h1>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_dialog_subheadline' id='thrixty_edit_layout_dialog_subheadline'>"
				output += "<div class='column' id='thirtxy_edit_layout_dialog_message'>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row' id='thrixty_edit_layout_dialog_close'>";
				output += "<div class='column thrixty_dialog_close'>";
					output += "<i class='fa fa-close fa-2x close_button'></i>";
				output += "</div>";
			output += "</div>";
			output += "<div class='thrixty_row thrixty_dialog_content' id='thrixty_edit_layout_dialog_data'>"
				output += "<div class='column'>";
				output += "</div>";
			output += "</div>";
		output += "</div>";

		this.frame_edit_layout.html(output);

		/**
		*
		* Assign a click event to the close button
		*/
		jQuery("#thrixty_edit_dialog_layout").find(".close_button").on("click", function ( element ){
			jQuery("#thrixty_edit_dialog_layout").hide();
			this.overlay.hide();
		}.bind(this));

		/**
		*
		* Display the frame
		*/
		this.overlay.show();
		this.frame_edit_layout.show();

		/**
		*
		* Load the data via ajax request
		*/
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			async: false,
			dataType: "json",
			data: {
				action: "thrixty_get_layout",
				id: id,
				basepath: basepath,
				object_name: object_name,
				small_path: small_path,
				large_path: large_path,
				use_basepath: use_basepath
			},
			success: function ( response ){
				var data = "";
				var iframe = "";
				var change_paths = "";
				var buttons = "";
				var message = "";

				if ( response != 0 ) {
					if ( response.success ) {

						var layout = response.data[0];
						if ( layout != null ) {

							/**
							*
							* Display the main data
							*/
							data += "<div class='thrixty_row thrixty_list_item header'>";
								data += "<div class='small-2 column'><strong>ID</strong></div>";
								data += "<div class='small-3 column'><strong>" + this.labels.get_label( "general.name" ) + "</strong></div>";
								data += "<div class='small-7 column'><strong>" + this.labels.get_label( "general.description" ) + "</strong></div>";
							data += "</div>";
							data += "<div class='thrixty_row thrixty_list_item'>";
									data += "<div class='small-2 column'>"+ layout.id +"</div>";
									data += "<div class='small-3 column'>"+ layout.name +"</div>";
									data += "<div class='small-4 column'>"+ layout.description +"</div>";
							data += "</div>";
							jQuery("#thrixty_edit_layout_dialog_data").html(data);

							/**
							*
							* Display the controll buttons
							*/
							buttons += "<div class='thrixty_row thrixty_margin_bottom thrixty_button_container'>"
								buttons += "<div class='column small-12 medium-6'>";
									buttons += "<label for='thritxy_edit_layout_open_paths' class='thrixty_button thrixty_secondary'>" + this.labels.get_label( "dialogs.edit_layout.button_edit_paths" ) + "</label>";
								buttons += "</div>";
								buttons += "<div class='column small-12 medium-6'>";
									buttons += "<label for='thritxy_edit_layout_open_iframe' class='thrixty_button thrixty_primary'>" + this.labels.get_label( "dialogs.edit_layout.button_edit_layout" ) + "</label>";
								buttons += "</div>";
							buttons += "</div>";
							jQuery("#thrixty_edit_layout_dialog_container").append(buttons);


							/**
							*
							* Create container to edit the layouts path settings
							* Display the container
							*
							* @src admin_url + ?page=thrixty_edit_layout&mode=edit&id=[layout_id]
							*/
							change_paths += "<input type='checkbox' class='thrixty_open_input' id='thritxy_edit_layout_open_paths'>"
							change_paths += "<div class='thrixty_row thrixty_open_content thrixty_margin_bottom' data-thrixty-path-status='edit_layout' data-thrixty-path-status-autoload='true'>";
								change_paths += "<div class='column'>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column small-3'>";
											change_paths += "<label for='thrixty_edit_layout_basepath'>" + this.labels.get_label( "general.pathsettings.basepath" ) + "</label>";
										change_paths += "</div>";
										change_paths += "<div class='column small-9'>";
											change_paths += "<input class='thrixty_input' data-thrixty-path-status-basepath='' type='text' id='thrixty_edit_layout_basepath' value='" + basepath + "'>";
										change_paths += "</div>";
									change_paths += "</div>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column small-3'>";
											change_paths += "<label for='thrixty_edit_layout_object_name'>" + this.labels.get_label( "general.pathsettings.object_name" ) + "</label>";
										change_paths += "</div>";
										change_paths += "<div class='column small-9'>";
											change_paths += "<input class='thrixty_input' data-thrixty-path-status-object-name='' type='text' id='thrixty_edit_layout_object_name' value='" + object_name + "'>";
										change_paths += "</div>";
									change_paths += "</div>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column small-3'>";
											change_paths += "<label for='thrixty_edit_layout_small_filelist'>" + this.labels.get_label( "general.pathsettings.filelist_small" ) + "</label>";
										change_paths += "</div>";
										change_paths += "<div class='column small-9'>";
											change_paths += "<input class='thrixty_input' data-thrixty-path-status-small-path='' type='text' id='thrixty_edit_layout_small_filelist' value='" + small_path + "'>";
										change_paths += "</div>";
									change_paths += "</div>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column small-3'>";
											change_paths += "<label for='thrixty_edit_layout_large_filelist'>" + this.labels.get_label( "general.pathsettings.filelist_large" ) + "</label>";
										change_paths += "</div>";
										change_paths += "<div class='column small-9'>";
											change_paths += "<input class='thrixty_input' data-thrixty-path-status-large-path='' type='text' id='thrixty_edit_layout_large_filelist' value='" + large_path + "'>";
										change_paths += "</div>";
									change_paths += "</div>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column small-3'>";
											change_paths += "<label for='thrixty_edit_layout_use_basepath'>" + this.labels.get_label( "general.pathsettings.use_basepath" ) + "</label>";
										change_paths += "</div>";
										change_paths += "<div class='column small-9'>";
											change_paths += "<label for='thrixty_edit_layout_use_basepath' class='thrixty_standard_input thrixty_switch'>";
												change_paths += "<input type='checkbox' class='thrixty_input' id='thrixty_edit_layout_use_basepath' value='" + ( basepath == "on" ? "checked" : "" ) + "'>";
												change_paths += "<div>";
													change_paths += "<div class='off'>0</div>";
													change_paths += "<div class='on'>|</div>";
												change_paths += "</div>";
											change_paths += "</label>";
										change_paths += "</div>";
									change_paths += "</div>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column small-3'>";
											change_paths += "Status Filelist small:";
										change_paths += "</div>";
										change_paths += "<div class='column small-9'>";
											change_paths += "<label data-thrixty-path-status-output-small></label>";
										change_paths += "</div>";
									change_paths += "</div>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column small-3'>";
											change_paths += "Status Filelist large:";
										change_paths += "</div>";
										change_paths += "<div class='column small-9'>";
											change_paths += "<label data-thrixty-path-status-output-large></label>";
										change_paths += "</div>";
									change_paths += "</div>";
									change_paths += "<div class='thrixty_row'>";
										change_paths += "<div class='column'>";
											change_paths += "<div class='thrixty_button_container'><button type='button' class='thrixty_button thrixty_expanded thrixty_primary' data-thrixty-edit-layout-update='" + id + "'>" + this.labels.get_label( "dialogs.edit_layout.button_refresh_paths" ) + "</button></div>";
										change_paths += "</div>";
									change_paths += "</div>";
								change_paths += "</div>";
								change_paths += "</div>";
							change_paths += "</div>";

							jQuery("#thrixty_edit_layout_dialog_container").append(change_paths);

							/**
							*
							* Create a iframe to edit the layout settings
							* Display the iframe
							*
							* @src admin_url + ?page=thrixty_edit_layout&mode=edit&id=[layout_id]
							*/
							iframe += "<input type='checkbox' class='thrixty_open_input' id='thritxy_edit_layout_open_iframe'>"
							iframe += "<div class='thrixty_row thrixty_open_content' id='thirtxy_edit_layout_dialog_iframe'>";
								iframe += "<iframe src='" + thrixty_placeholder.admin_url + "?page=thrixty_edit_layout&mode=edit&id=" + layout.id + "'></iframe>";
							iframe += "</div>";
							jQuery("#thrixty_edit_layout_dialog_container").append(iframe);

							/**
							*
							* Check layout path settings
							*/
							jQuery.ajax({
								url: layout.small_filelist_absolute_path,
								async: false,
								type: "POST",
								success: function ( response ){},
								error: function ( error ){

									/**
									*
									* Display the alert message box
									*/
									message = this.labels.get_label( "dialogs.edit_layout.error_bad_configuration" );
								}.bind(this)
							});

							/**
							*
							* Init the js library to check the entered path settings
							*/
							if ( typeof thrixty !== "undefined" ) {
								var object = new thrixty.ManuallyLoadPlugins.Filepaths().init();
							}

						} else {
							message = this.labels.get_label( "dialogs.edit_layout.error_no_data" );
						}
					} else {
						message = this.labels.get_label( "dialogs.edit_layout.error_no_data" );
					}

				}

				if ( message != "" ) {
					jQuery("#thirtxy_edit_layout_dialog_message").html( "<label class='thrixty_font_waring thrixty_dialog_message_headline'><i class='fa fa-warning'></i>&nbsp;" + message + "</label>" );
				}

				this.edit_layout();

			}.bind(this),
			error: function ( error ){
				return false;
			}
		});
	}

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.edit_layout = function (){
		var update_button = jQuery("[data-thrixty-edit-layout-update]");
		update_button.bind("click", function (){

			var id = update_button.attr("data-thrixty-edit-layout-update");
			var basepath = jQuery("#thrixty_edit_layout_basepath").val();
			var object_name = jQuery("#thrixty_edit_layout_object_name").val();
			var small_path = jQuery("#thrixty_edit_layout_small_filelist").val();
			var large_path = jQuery("#thrixty_edit_layout_large_filelist").val();
			var use_basepath = ( jQuery("#thrixty_edit_layout_use_basepath").is(":checked") ? "on" : "off" );

			var content = this.editor.getContent();

			if ( content != null && content != "" ){
				var regex = new RegExp("\\[thrixty\\-layout id=[\"|\']"+ id +"[\"|\'][^\\]]*\\]", "g");
				var match;

				while ((match = regex.exec(content)) !== null) {
					if (match.index === regex.lastIndex) {
						regex.lastIndex++;
					}
					var shortcode = "[thrixty-layout id='"+ id +"' basepath='"+ basepath +"' object_name='"+ object_name +"' small_path='"+ small_path +"' large_path='"+ large_path +"' use_basepath='"+ use_basepath +"']";
					this.editor.setContent( content.replace(match[0], shortcode) );

					this.overlay.hide();
					this.frame_edit_layout.hide();
				}
			}
		}.bind(this));
	}

	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.insert_layout = function (){
		var layout_buttons = jQuery("[data-thrixty-insert-layout-submit]");

		for (var i = 0; i < layout_buttons.length; i++) {
			layout_buttons[i].onclick = function ( element ){

				var id = element.target.getAttribute("data-thrixty-insert-layout-submit");
				if ( !isNaN(id) ) {
					id = parseInt(id);
					var container = jQuery("[data-thrixty-insert-layout='" + id + "']");

					var basepath = container.find("[data-thrixty-insert-layout-basepath]").val();
					var object_name = container.find("[data-thrixty-insert-layout-object-name]").val();
					var small_path = container.find("[data-thrixty-insert-layout-filelist-small]").val();
					var large_path = container.find("[data-thrixty-insert-layout-filelist-large]").val();
					var use_basepath = ( container.find("[data-thrixty-insert-layout-use-basepath]").is(":checked") ? "on" : "off" );

					this.editor.selection.setContent("[thrixty-layout id='"+ id +"' basepath='"+ basepath +"' object_name='"+ object_name +"' small_path='"+ small_path +"' large_path='"+ large_path +"' use_basepath='"+ use_basepath +"']");
				}
				this.overlay.hide();
				this.frame_new.hide();

			}.bind(this);
		}
	}

	//******************** EVENTS ******************//
	thrixty.ManuallyLoadPlugins.ShortcodeGenerator.prototype.assign_events = function (){
		var iframe_element = tinymce.activeEditor.iframeElement;
		var iframe_document = iframe_element.contentDocument || iframe_element.contentWindow.document;

		var player_icons = iframe_document.querySelectorAll("img[data-thrixty-player-preview]");
		var layout_icons = iframe_document.querySelectorAll("img[data-thrixty-layout-preview]");

		for (var i = 0; i < player_icons.length; i++) {
			player_icons[i].addEventListener("click", this.generate_player_edit_dialog.bind(this, player_icons[i].getAttribute("data-thrixty-player-preview")));
		}
		for (var i = 0; i < layout_icons.length; i++) {
			layout_icons[i].addEventListener("click", this.generate_layout_edit_dialog.bind(this, layout_icons[i]));
		}
	}

	document.addEventListener("DOMContentLoaded", function (){
		var object = new thrixty.ManuallyLoadPlugins.ShortcodeGenerator();
		object.init();
	});
}
