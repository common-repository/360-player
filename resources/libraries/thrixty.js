 ;"use strict";
/***** Thrixty Namespace *****/
	/* start script by checking for already existing Thrixty namespace */
	if( typeof(Thrixty) !== "undefined" ){
		/* do nothing and break script */
		throw new Error("The Thrixty Namespace is already set. Aborting execution.");
	}
	/* now set a new Thrixty Namespace */
	var Thrixty = {
		/**** namespace properties ****/
			version: "3.0",
			players: [],
			logs: {
				main_log: [],
				player_logs: {},
			},
			icons: {
				fullsize_icon:   "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='18.5,18.5 42.566,18.5 42.566,25.72 25.72,25.72 25.72,42.566 18.5,42.566'/><polygon class='icon_polygons' points='81.5,18.5 81.5,42.566 74.283,42.566 74.283,25.72 57.435,25.72 57.435,18.5'/><polygon class='icon_polygons' points='18.5,81.5 18.5,57.435 25.72,57.435 25.72,74.283 42.566,74.283 42.566,81.5'/><polygon class='icon_polygons' points='81.5,81.5 57.435,81.5 57.435,74.283 74.283,74.283 74.283,57.435 81.5,57.435'/>",
				load_icon:       "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='35.481,12.501 35.481,87.501 81.519,50.217'/>",
				next_icon:       "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='44.587,87.5 90.641,50.217 44.587,12.5'/><polygon class='icon_polygons' points='37.139,87.5 28.156,87.5 28.156,12.5 37.139,12.5'/>",
				normalsize_icon: "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='35.348,18.5 42.565,18.5 42.565,42.566 18.5,42.566 18.5,35.348 35.348,35.348'/><polygon class='icon_polygons' points='18.5,64.652 18.5,57.435 42.565,57.435 42.565,81.5 35.348,81.5 35.348,64.652'/><polygon class='icon_polygons' points='64.652,81.5 57.435,81.5 57.435,57.435 81.5,57.435 81.5,64.652 64.652,64.652'/><polygon class='icon_polygons' points='81.5,35.348 81.5,42.566 57.435,42.566 57.435,18.5 64.652,18.5 64.652,35.348'/>",
				pause_icon:      "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='36.5,12.5 45.5,12.5 45.5,87.5 36.5,87.5'/><polygon class='icon_polygons' points='54.5,12.5 63.5,12.5 63.5,87.5 54.5,87.5'/>",
				play_icon:       "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='35.481,12.501 35.481,87.501 81.519,50.217'/>",
				prev_icon:       "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='55.413,12.5 9.359,50.217 55.413,87.5'/><polygon class='icon_polygons' points='62.862,12.5 71.844,12.5 71.844,87.5 62.862,87.5'/>",
				zoom_in_icon:    "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='45.5,12.5 54.5,12.5 54.5,45.5 87.5,45.5 87.5,54.5 54.5,54.5 54.5,87.5 45.5,87.5 45.5,54.5 12.5,54.5 12.5,45.5 45.5,45.5'/>",
				zoom_out_icon:   "<circle class='icon_backgrounds' stroke-width='3' cx='50' cy='50' r='47' fill='transparent' stroke='black'/><polygon class='icon_polygons' points='12.5,45.5 87.5,45.5 87.5,54.5 12.5,54.5'/>",
			},
			is_mobile: (function(){
				var mobile_user_agents = {
					Android: !!navigator.userAgent.match(/Android/i),
					BlackBerry: !!navigator.userAgent.match(/BlackBerry/i),
					iOS: !!navigator.userAgent.match(/iPhone|iPad|iPod/i),
					iPad: !!navigator.userAgent.match(/iPad/i),
					Opera: !!navigator.userAgent.match(/Opera Mini/i),
					Windows: !!navigator.userAgent.match(/IEMobile/i)
				};
				return ( mobile_user_agents.Android || mobile_user_agents.BlackBerry || mobile_user_agents.iOS || mobile_user_agents.Opera || mobile_user_agents.Windows );
			})(),
			cycle_duration: 5,
		/**** namespace properties ****/
		/**** namespace methods ****/
			log: function(msg, id){
				if( typeof(id) !== "number" ){
					/* main log */
					this.logs.main_log.push(msg);

				} else {
					/* player log */
					if( typeof(this.logs.player_logs[id]) === "undefined" ){
						this.logs.player_logs[id] = [msg];
					} else {
						this.logs.player_logs[id].push(msg);
					}
				};
			},
			export_logs: function(){
				return JSON.stringify(this.logs);
			},
			create_element: function(str){
				var el = document.createElement("div");
				el.innerHTML = str;
				return el.children[0];
			},
			insertAfter: function (newNode, referenceNode){
				referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
			},
			addTouchClickEvent: function(elem, callback){
				var is_clicked = false;
				elem.addEventListener( "touchstart", function(e){
					is_clicked = true;
					e.preventDefault();
				} );
				// TODO: folgendes &uuml;berpruefen
				//elem.addEventListener( "touchmove",function(e){
				//	is_clicked = false;
				//	e.preventDefault();
				//} );
				elem.addEventListener( "touchend", function(e){
					callback();
					is_clicked = false;
					e.preventDefault();
				} );
			},
			addMouseHoldEvent: function(elem, callback, interval, delay){
				var i_id = 0;
				elem.addEventListener( "mouseup",   function(e){ clearInterval(i_id); e.preventDefault(); } );
				elem.addEventListener( "mouseout",  function(e){ clearInterval(i_id); e.preventDefault(); } );
				elem.addEventListener( "mousedown", function(e){
					/* (maybe) create custom event object 'custom_e' here */
					var custom_e = e;
					callback(custom_e);
					/* start interval which calls 'callback(custom_e)' */
					i_id = setInterval(callback, interval);
					/**/
					e.preventDefault();
				} );
			},
			addTouchHoldEvent: function(elem, callback, interval, delay){
				var i_id = 0;
				elem.addEventListener( "touchend",   function(e){ clearInterval(i_id); e.preventDefault(); } );
				elem.addEventListener( "touchstart", function(e){
					/* (maybe) create custom event object 'custom_e' here */
					var custom_e = e;
					callback(custom_e);
					/* start interval which calls 'callback(custom_e)' */
					i_id = setInterval(callback, interval);
					/**/
					e.preventDefault();
				} );
			},
			debounce: function(callback, wait, immediate){
				immediate = immediate || false;
				var context = null;
				var args = null;
				var timeout_id = null;
				var exec_callback = function(){
					timeout_id = null;
					if( !immediate ){
						callback.apply(context, args);
					}
				};
				return function(){
					context = this;
					args = arguments;
					if( immediate && !timeout_id ){
						callback.apply(context, args);
					}
					clearTimeout(timeout_id);
					timeout_id = setTimeout(
						exec_callback,
						wait
					);
				};
			},
			throttle: function(callback, wait, trailing){
				trailing = trailing || false;
				var context = null;
				var args = null;
				var last_call_at = 0;
				var current_call_at = 0;
				var test_id = 0;
				var exec_func = function(){
					context = this;
					args = arguments;
					current_call_at = Date.now();
					if( current_call_at > (last_call_at + wait) ){
						callback.apply(context, args);
						last_call_at = current_call_at;
						if( trailing ){
							clearTimeout(test_id);
							test_id = setTimeout(
								function(){
									callback.apply(context, args);
									last_call_at = current_call_at - wait;
								},
								wait
							);
						}
					}
				}
				return exec_func;
			},
			startsWith: function( str, start ){
				return str.indexOf(start) == 0;
			},
			endsWith: function( str, end ){
				return str.indexOf(end) == ( str.length - end.length );
			},
		/**** /namespace methods ****/
		/**** init ****/
			init: function(){

				Thrixty.log("initializing Thrixty");
				var player_candidates = document.querySelectorAll("div.thrixty");
				var candidates_count = player_candidates.length;
				if( candidates_count > 0 ){
					/* init player */
					var i = 0;
					for( i; i<candidates_count; i++ ){
						var cur_candidate = player_candidates[i];
						var new_player_id = new Thrixty.Player(cur_candidate);
					}
				}
			},
		/**** /init ****/
	};
	/** Init Thrixty on load **/
	window.addEventListener( "DOMContentLoaded", Thrixty.init );
/***** /Thrixty Namespace *****/



/***** Class Player *****/
	Thrixty.Player = function(root_el){
		Thrixty.players.push(this);

		this.root_element = root_el;
		this.player_id = Thrixty.players.indexOf(this);

		/* player_id needed for being focusable (actual id is not important) */
		if( this.root_element.getAttribute("player_id") === null ){
			this.root_element.setAttribute("player_id", this.player_id);
		}
		this.root_element.setAttribute("thrixty", "found");

		/** Options **/
			/* base values */
			this.settings = {
				basepath: "", /* => relative to current url */
				filelist_path_small: "small/Filelist.txt", /* => subfolder 'small', then look for Filelist.txt */
				filelist_path_large: "large/Filelist.txt", /* => subfolder 'large', then look for Filelist.txt */
				display_buttons: true,
				enable_controls: true,
				use_basepath: false,
				reversed_play_direction: false, /* false|true <=> left|right */
				reversed_drag_direction: false, /* false|true <=> left|right */
				autoplay: true,
				autoload: !Thrixty.is_mobile, /* false when mobile, true when not */
				repetition: Infinity,
				zoom_mode: "inbox",
				fullpage_mode: "normal",
				zoom_control: "progressive",
				zoom_pointer: "minimap",
				outbox_position: "right",
				sensitivity_x: 10,
				sensitivity_y: 50
			};
		/** /Options **/

		/** State Variables **/
			/* assigned events */
			this.events_assigned = false;
			/* zoom state */
			this.can_zoom = true;
			this.can_fullpage = true;
			this.canvas_size = null; /* null:N/A | 0:small | 1:large */
			this.is_zoomed = false;
			this.is_fullpage = false;
			/* rotation state */
			this.is_rotating = false;
			this.rotation_id = 0;
			this.rotation_count = -1;
			this.rotation_delay = 100;
			this.rotation_speed_modifiers = [0.1, 0.2, 0.4, 0.6, 0.8, 1, 1.4, 1.8, 2.2, 2.6];
			this.rotation_speed_selected = 5;
			this.pixel_per_image = 10;
		/** /State Variables **/

		/** HTML objects **/
			this.DOM_obj = {
				showroom: Thrixty.create_element("<div class='showroom'></div>"),
					canvas_container: Thrixty.create_element("<div class='canvas_container'></div>"),
						bg_canvas: Thrixty.create_element("<canvas class='bg_canvas canvas' width='0' height='0'></canvas>"),
						main_canvas: Thrixty.create_element("<canvas class='main_canvas canvas' width='0' height='0'></canvas>"),
						minimap_canvas: Thrixty.create_element("<canvas class='minimap_canvas canvas' width='0' height='0'></canvas>"),
						marker: Thrixty.create_element("<div class='marker'></div>"),
					progress_container: Thrixty.create_element("<div class='progress_container'></div>"),
						small_progress_bar: Thrixty.create_element("<div class='small_progress_bar progress_bar' thrixty-state='unloaded'></div>"),
				controls: Thrixty.create_element("<div class='controls'></div>"),
					control_container_one: Thrixty.create_element("<div class='control_container_one'></div>"),
					prev_btn: Thrixty.create_element("<button type='button' class='prev_btn ctrl_buttons'></button>"),
						prev_icon: Thrixty.create_element("<svg class='prev_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["prev_icon"]+"</svg>"),
					play_btn: Thrixty.create_element("<button type='button' class='play_btn ctrl_buttons' thrixty-state='pause'></button>"),
						play_icon: Thrixty.create_element("<svg class='play_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["play_icon"]+"</svg>"),
						pause_icon: Thrixty.create_element("<svg class='pause_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["pause_icon"]+"</svg>"),
					next_btn: Thrixty.create_element("<button type='button' class='next_btn ctrl_buttons'></button>"),
						next_icon: Thrixty.create_element("<svg class='next_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["next_icon"]+"</svg>"),
					zoom_btn: Thrixty.create_element("<button type='button' class='zoom_btn ctrl_buttons' thrixty-state='zoomed_out'></button>"),
						zoom_in_icon: Thrixty.create_element("<svg class='zoom_in_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["zoom_in_icon"]+"</svg>"),
						zoom_out_icon: Thrixty.create_element("<svg class='zoom_out_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["zoom_out_icon"]+"</svg>"),
					size_btn: Thrixty.create_element("<button type='button' class='size_btn ctrl_buttons' thrixty-state='normalsized'></button>"),
						fullsize_icon: Thrixty.create_element("<svg class='fullsize_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["fullsize_icon"]+"</svg>"),
						normalsize_icon: Thrixty.create_element("<svg class='normalsize_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["normalsize_icon"]+"</svg>"),
				load_overlay: Thrixty.create_element("<div class='load_overlay'></div>"),
					load_btn: Thrixty.create_element("<button type='button' class='load_btn'></button>"),
						load_icon: Thrixty.create_element("<svg class='load_icon icons' viewBox='0 0 100 100'>"+Thrixty.icons["load_icon"]+"</svg>"),
				zoom_canvas: Thrixty.create_element("<canvas class='zoom_canvas' width='0' height='0'></canvas>"),
			};
		/** /HTML objects **/

		/** Images **/
			this.small = {
				filepath: "",
				filelist_content: "",
				filelist_loaded: null,
				images_count: 0,
				images_loaded: 0,
				images_errored: 0,
				images: [],
				context: "small",
				image_width: 0,
				image_height: 0,
				image_ratio: 0,
				active_image_id: 0,
			};
			this.large = {
				filepath: "",
				filelist_content: "",
				filelist_loaded: null,
				images_count: 0,
				images_loaded: 0,
				images_errored: 0,
				images: [],
				context: "large",
				image_width: 0,
				image_height: 0,
				image_ratio: 0,
				active_image_id: 0,
			};

			/** "image Object" Blueprint:
				{
					id: 0,
					source: "www.testsource.de",
					element: jQuery("<img style=\"display: none;\" />"),
					elem_loaded: null,
					to_small: null,
					to_large: null,
				}
			/**/
		/** /Images **/

		/** HTML object event vars **/
			this.object_turn = {
				prepared: false,
				start_x: null,
				start_y: null,
				last_x: null,
				last_y: null,
			};
			this.is_click = false;
		/** /HTML object event vars **/

		/** drawing properties **/
			/* current mouseposition relative to the main_canvas's upper-left-hand-corner */
			this.relative_mouse = {
				x: 0,
				y: 0,
			};

			this.section_move = {
				prepared: false, /* prepared flag */
				minimap: false,  /* triggered-by-click-on-minimap flag */
			};
		/** /drawing properties **/


		/** Method Throttling **/
			this.draw_current_image = Thrixty.throttle( this.draw_current_image, 40, true );
		/** /Method Throttling **/


		/** log creation **/
		Thrixty.log("Player (id "+this.player_id+") initialising.");

		/* first part of init prozedure */
		this.init_a();

		return this.player_id;
	};
	Thrixty.Player.prototype.destruct = function(){
		this.root_element.innerHTML = "";
		this.root_element.removeAttribute("thrixty");
		this.root_element.removeAttribute("player_id");

		Thrixty.players.splice([this.player_id], 1);
	};


	/**** INITIALIZATION ****/
		/*** LOAD SETTINGS FROM HTML STRUCTURE AND LOAD FILELISTS ***/
			Thrixty.Player.prototype.init_a = function(){

				/* GET SETTINGS */
				this.parse_settings();
				this.check_settings();

				/* LOAD FILELISTS */
				this.load_small_filelist();
				if( this.can_zoom || this.can_fullpage ){
					this.load_large_filelist();
				}

				/* PARSE FILELIST AND LOAD IMAGES INSIDE "load_small_filelist AND load_large_filelist" FUNCTIONS */
			};
			Thrixty.Player.prototype.parse_settings = function(){
				/* loop through all attributes to get option values */
				var main_box_attributes = this.root_element.attributes;
				var main_box_attr_count = main_box_attributes.length;
				for( var i=0; i<main_box_attr_count; i++ ){
					var attr = main_box_attributes[i];

					attr_name = attr.name;
					attr_name = attr_name.indexOf( "data-" ) == 0 ? attr_name.substring( 5 ) : attr_name;

					attr_value = attr.value.trim();

					switch( attr_name ){
						case "thrixty-basepath":
								this.settings.basepath = attr_value;
							break;
						case "thrixty-filelist-path-small":
							if( attr_value != ""  ){
								var value_lowercase = attr_value.toLowerCase();

								if (Thrixty.endsWith(value_lowercase, ".txt")) {
									this.settings.filelist_path_small = attr_value;
								}
							}
							break;
						case "thrixty-filelist-path-large":
							if( attr_value != "" ){
								var value_lowercase = attr_value.toLowerCase();

								if (Thrixty.endsWith(value_lowercase, ".txt")) {
									this.settings.filelist_path_large = attr_value;
								}
							}
							break;
						case "thrixty-use-basepath":
							if( attr_value != "" ){
								this.settings.use_basepath = ( attr_value == "on" );
							}
							break;
						case "thrixty-play-direction":
							switch( attr_value ){
								case "normal":
									this.settings.reversed_play_direction = false;
									break;
								case "reverse":
								case "reversed":
									this.settings.reversed_play_direction = true;
									break;
							}
							break;
						case "thrixty-drag-direction":
							switch( attr_value ){
								case "normal":
									this.settings.reversed_drag_direction = false;
									break;
								case "reverse":
								case "reversed":
									this.settings.reversed_drag_direction = true;
									break;
							}
							break;
						case "thrixty-autoplay":
							this.settings.autoplay = ( attr_value !== "off" );
							break;
						case "thrixty-repetition":
							if ( !isNaN( attr_value ) ) {
								if ( parseInt( attr_value ) == -1 ) {
									this.settings.repetition = Infinity;
								} else{
									this.settings.repetition = parseInt( attr_value );
								}
							}
							break;
						case "thrixty-autoload":
							if( Thrixty.is_mobile ){
								this.settings.autoload = false;
							} else {
								switch( attr_value ){
									case "on":
										this.settings.autoload = true;
										break;
									case "off":
										this.settings.autoload = false;
										break;
								}
							}
							break;
						case "thrixty-cycle-duration":
							if( attr_value != "" ){
								attr_value = parseInt(attr_value);
								if( attr_value > 0 && attr_value < this.rotation_speed_modifiers.length + 1 ){
									this.rotation_speed_selected = this.rotation_speed_modifiers.length  - attr_value ;
								}
							}
							break;
						case "thrixty-zoom-mode":
							switch( attr_value ){
								case "inbox":
								case "outbox":
								case "none":
									this.settings.zoom_mode = attr_value;
									break;
							}
							break;
						case "thrixty-fullpage-mode":
							switch( attr_value ){
								case "normal":
								case "none":
									this.settings.fullpage_mode = attr_value;
									break;
							}
							break;
						case "thrixty-zoom-control":
							switch( attr_value ){
								case "progressive":
								case "classic":
									this.settings.zoom_control = attr_value;
									break;
							}
							break;
						case "thrixty-zoom-pointer":
							switch( attr_value ){
								case "minimap":
								case "marker":
									this.settings.zoom_pointer = attr_value;
									break;
								case "none":
								case "":
									this.settings.zoom_pointer = "";
									break;
							}
							break;
						case "thrixty-outbox-position":
							switch( attr_value ){
								case "right":
								case "left":
								case "top":
								case "bottom":
									this.settings.outbox_position = attr_value;
									break;
							}
							break;
						case "thrixty-sensitivity-x":
							if( attr_value != "" ){
								attr_value = parseInt(attr_value);
								if( attr_value >= 0 ){
									this.settings.sensitivity_x = attr_value;
									this.pixel_per_image = attr_value;
								}
							}
							break;
						case "thrixty-sensitivity-y":
							if( attr_value != "" ){
								attr_value = parseInt(attr_value);
								if( attr_value >= 0 ){
									this.settings.sensitivity_y = attr_value;
								}
							}
							break;
						case "thrixty-display-buttons":
							this.settings.display_buttons = ( attr_value !== "off" );
							break;
						case "thrixty-enable-controls":
							this.settings.enable_controls = ( attr_value !== "off" );
							break;
						default:
							/* ignore all other attributes */
							break;
					}
				}

				/* set the small and large filepaths to their settings-values */

				this.settings.basepath = this.settings.basepath.replace(/\/*$/g, "");

				this.settings.filelist_path_small = this.settings.filelist_path_small.replace(/^\/*/g, "");
				this.settings.filelist_path_large = this.settings.filelist_path_large.replace(/^\/*/g, "");

				this.small.filepath = this.settings.basepath + "/" + this.settings.filelist_path_small;
				this.large.filepath = this.settings.basepath + "/" + this.settings.filelist_path_large;

			};
			Thrixty.Player.prototype.check_settings = function(){
				/* TODO: actually check settings for mandatories etc. */
				if( this.settings.zoom_mode == "none" ){
					this.can_zoom = false;
				}
				if ( this.settings.fullpage_mode == "none" ) {
					this.can_fullpage = false;
				}

				if ( !this.settings.autoload ) {
					this.settings.autoplay = true;
				}

				if ( !this.settings.autoplay && isFinite( this.settings.repetition ) ) {
					this.settings.repetition = Infinity;
				}
			};
			Thrixty.Player.prototype.load_small_filelist = function(){
				var xhr = new XMLHttpRequest();
				xhr.open("get", this.small.filepath, true);
				xhr.onreadystatechange = function(){
					if( xhr.readyState == 4 ){
						if( xhr.status == 200 ){
							Thrixty.log("basic (small) filelist found", this.player_id);
							this.small.filelist_loaded = true;
							this.small.filelist_content = xhr.responseText;
						} else {
							Thrixty.log("basic (small) filelist not found", this.player_id);
							this.small.filelist_loaded = false;
						}
						/* continue with init part b? */
						this.check_init_b();
					}
				}.bind(this);
				xhr.send(null);
			};
			Thrixty.Player.prototype.load_large_filelist = function(){
				var xhr = new XMLHttpRequest();
				xhr.open("get", this.large.filepath, true);
				xhr.onreadystatechange = function(){
					if( xhr.readyState == 4 ){
						if( xhr.status == 200 ){
							Thrixty.log("large filelist found", this.player_id);
							this.large.filelist_loaded = true;
							this.large.filelist_content = xhr.responseText;
						} else {
							Thrixty.log("large filelist not found", this.player_id);
							this.large.filelist_loaded = false;
							this.can_zoom = false;
							this.can_fullpage = false;
						}
						/* continue with init part b? */
						this.check_init_b();
					}
				}.bind(this);
				xhr.send(null);
			};
			Thrixty.Player.prototype.check_init_b = function(){
				/* (gets called 2 times,; trying to load 2 filelists) */
				/* trigger function on the last call (when all filelist loads got a result */

				if( this.small.filelist_loaded && ( ( !this.can_zoom && !this.can_fullpage ) || this.large.filelist_loaded ) ){
					this.init_b();
				}
			};
		/*** /LOAD SETTINGS FROM HTML STRUCTURE AND LOAD FILELISTS ***/

		/*** PARSE FILELISTS AND LOAD PICURES, BUILD HTML STRUCTURE, ASSIGN EVENTS AND START TO PLAY ***/
			Thrixty.Player.prototype.init_b = function(){

				/* PARSE FILELISTS AND CREATE PICTURE OBJECTS */
				this.parse_small_filelist();
				if( this.can_zoom || this.can_fullpage ){
					this.parse_large_filelist();
				}

				/* BUILD HTML STRUCTURE AND ASSIGN EVENTS */
				this.build_html_structure();

				/* Set the values for the possibly different image count. */
				this.set_image_offsets();
				this.set_rotation_delay();

				/* LOAD IMAGES */
				if( this.settings.autoload ){
					this.load_all_small_images();
					if( this.can_zoom || this.can_fullpage ){
						this.load_all_large_images();
					}
				} else {
					this.load_small_image(0);
					if( this.can_zoom || this.can_fullpage ){
						this.load_large_image(0);
					}
				}
			};
			Thrixty.Player.prototype.parse_small_filelist = function(){
				this.small.images = [];

				var image_paths = this.parse_filelist_content(this.small.filelist_content);

				/* loop through all paths */
				this.small.images_count = image_paths.length;

				for( var i=0; i < this.small.images_count; i++ ){
					var new_image_object = {
						id: i,
						source: image_paths[i],
						elem_loaded: null,  /* null = not yet loaded, false = failed to load, true = is loaded */
						to_small: null,
						to_large: null,
						element: document.createElement("img"),
					};
					new_image_object.element.addEventListener(
						"load",
						this.init_small_all.bind(this, i) /* , e (addEventListener automatically adds it) */
					);
					new_image_object.element.addEventListener(
						"error",
						this.init_small_all.bind(this, i) /* , e (addEventListener automatically adds it) */
					);
					this.small.images.push( new_image_object );
				}
			};
			Thrixty.Player.prototype.parse_large_filelist = function(){
				this.large.images = [];

				var image_paths = this.parse_filelist_content(this.large.filelist_content);

				/* loop through all paths */
				this.large.images_count = image_paths.length;

				for( var i=0; i < this.large.images_count; i++ ){
					var new_image_object = {
						id: i,
						source: image_paths[i],
						elem_loaded: null,  /* null = not yet loaded, false = failed to load, true = is loaded */
						to_small: null,
						to_large: null,
						element: document.createElement("img"),
					};
					new_image_object.element.addEventListener(
						"load",
						this.init_large_all.bind(this, i) /* , e (addEventListener automatically adds it) */
					);
					new_image_object.element.addEventListener(
						"error",
						this.init_large_all.bind(this, i) /* , e (addEventListener automatically adds it) */
					);
					this.large.images.push( new_image_object );
				}
			};
			Thrixty.Player.prototype.build_html_structure = function(){
				/* pre-hide player */
				this.root_element.style.display = "none";
				this.DOM_obj.minimap_canvas.style.display = "none";
				this.DOM_obj.marker.style.display = "none";

				/* pre-disable buttons */
				this.DOM_obj.size_btn.setAttribute("disabled", "disabled");
				this.DOM_obj.prev_btn.setAttribute("disabled", "disabled");
				this.DOM_obj.play_btn.setAttribute("disabled", "disabled");
				this.DOM_obj.next_btn.setAttribute("disabled", "disabled");
				this.DOM_obj.zoom_btn.setAttribute("disabled", "disabled");
				/* put HTML into the DOM */
				this.root_element.appendChild(this.DOM_obj.showroom);
					this.DOM_obj.showroom.appendChild(this.DOM_obj.canvas_container);
						this.DOM_obj.canvas_container.appendChild(this.DOM_obj.bg_canvas);
						this.DOM_obj.canvas_container.appendChild(this.DOM_obj.main_canvas);
						if ( this.can_zoom ) {
							this.DOM_obj.canvas_container.appendChild(this.DOM_obj.minimap_canvas);
							this.DOM_obj.canvas_container.appendChild(this.DOM_obj.marker);
						}
					this.DOM_obj.showroom.appendChild(this.DOM_obj.progress_container);
						this.DOM_obj.progress_container.appendChild(this.DOM_obj.small_progress_bar);
				if ( this.settings.display_buttons && this.settings.enable_controls ) {
					this.root_element.appendChild(this.DOM_obj.controls);
					this.DOM_obj.controls.appendChild(this.DOM_obj.control_container_one);
						this.DOM_obj.control_container_one.appendChild(this.DOM_obj.prev_btn);
							this.DOM_obj.prev_btn.appendChild(this.DOM_obj.prev_icon);
						this.DOM_obj.control_container_one.appendChild(this.DOM_obj.play_btn);
							this.DOM_obj.play_btn.appendChild(this.DOM_obj.play_icon);
							this.DOM_obj.play_btn.appendChild(this.DOM_obj.pause_icon);
						this.DOM_obj.control_container_one.appendChild(this.DOM_obj.next_btn);
							this.DOM_obj.next_btn.appendChild(this.DOM_obj.next_icon);
						if ( this.can_zoom ) {
							this.DOM_obj.control_container_one.appendChild(this.DOM_obj.zoom_btn);
								this.DOM_obj.zoom_btn.appendChild(this.DOM_obj.zoom_in_icon);
								this.DOM_obj.zoom_btn.appendChild(this.DOM_obj.zoom_out_icon);
						}
						if ( this.can_fullpage ){
							this.DOM_obj.control_container_one.appendChild(this.DOM_obj.size_btn);
								this.DOM_obj.size_btn.appendChild(this.DOM_obj.fullsize_icon);
								this.DOM_obj.size_btn.appendChild(this.DOM_obj.normalsize_icon);
						}
				}
				if( !this.settings.autoload ){
					this.root_element.appendChild(this.DOM_obj.load_overlay);
						this.DOM_obj.load_overlay.appendChild(this.DOM_obj.load_btn);
							this.DOM_obj.load_btn.appendChild(this.DOM_obj.load_icon);
				}
				if ( this.can_zoom ) { this.root_element.appendChild(this.DOM_obj.zoom_canvas); }

				this.assign_events();
			};
			/** Init B Helpers **/
				/* returns ARRAY of parsed 'text' */
				Thrixty.Player.prototype.parse_filelist_content = function(content){
					var result = [];
					/* kill ['] and ["] (they are interfering with path handling) and split to array on each [,] */
					var result = content.replace(/['"\s]/g,"").split(",");

					/* reverse array, when option is turned on */
					/* (results in playing the animation reversely) */
					if( this.settings.reversed_drag_direction ){
						result.reverse();
					}

					for (var i = 0; i < result.length; i++) {

						// add basepath if nessesary
						if ( ( Thrixty.startsWith(result[i], "small/") || Thrixty.startsWith(result[i], "large/") ) || this.settings.use_basepath ){
							result[i] = this.settings.basepath + "/" + result[i];
						}

						// remove the protocol to load the pictures via both http and https
						if ( Thrixty.startsWith(result[i], "http://") ){
							result[i] = result[i].substring(5);
						}
					}

					return result;
				};
				Thrixty.Player.prototype.load_small_image = function(index){
					var src = this.small.images[index].source;
					this.small.images[index].element.src = src;
				};
				Thrixty.Player.prototype.load_all_small_images = function(){
					var count = this.small.images_count;
					for( var i = 0; i<count; i++ ){
						this.load_small_image(i);
					}
				};
				Thrixty.Player.prototype.load_large_image = function(index){
					var src = this.large.images[index].source;
					this.large.images[index].element.src = src;
				};
				Thrixty.Player.prototype.load_all_large_images = function(){
					var count = this.large.images_count;
					for( var i = 0; i<count; i++ ){
						this.load_large_image(i);
					}
				};
			/** /Init B Helpers **/
		/*** PARSE FILELISTS AND LOAD PICURES, BUILD HTML STRUCTURE, ASSIGN EVENTS AND START TO PLAY ***/

		/*** INITIALIZATION PART SMALL PICTURES ***/
			Thrixty.Player.prototype.init_small_first = function(index, e){
				if( e.type === "load" ){
					this.set_small_dimensions(index);
					this.set_canvas_dimensions_to_size(0);

					/* show player */
					this.root_element.style.display = "";
					/* refresh player sizings */
					this.refresh_player_sizings();

					this.draw_current_image();
				} else {
					/*? TODO: CRITICAL ERROR HANDLING!!!! ?*/
					Thrixty.log("SMALL SIZING IMAGE WAS NOT FOUND", this.player_id);
				}
			};
			Thrixty.Player.prototype.init_small_each = function(index, e){
				if( e.type === "load" ){
					this.small.images_loaded += 1;
					this.small.images[index].elem_loaded = true;
					Thrixty.log("small image "+index+" loaded ('"+this.small.images[index].element.src+"')", this.player_id);

				} else if( e.type === "error" ){
					this.small.images_errored += 1;
					this.small.images[index].elem_loaded = false;
					Thrixty.log("small image "+index+" errored ('"+this.small.images[index].element.src+"')", this.player_id);

				} else {
					/* ignored */
				}
				/* update (small) progress bar */
				this.refresh_small_progress_bar();
			};
			/* will be called from event listener with load or error status */
			Thrixty.Player.prototype.init_small_all = function(index, e){
				if( this.small.images[index].elem_loaded === null ){
					this.init_small_each(index, e);

					if( index === 0 ){
						this.init_small_first(index, e);
					}

					/* check for all small being loaded */
					if( (this.small.images_loaded + this.small.images_errored) == this.small.images_count ){
						/* enable controls */
						this.DOM_obj.prev_btn.removeAttribute("disabled");
						this.DOM_obj.play_btn.removeAttribute("disabled");
						this.DOM_obj.next_btn.removeAttribute("disabled");
						this.DOM_obj.zoom_btn.removeAttribute("disabled");
						this.DOM_obj.size_btn.removeAttribute("disabled");

						/* autostart / autoplay */
						/* start rotation (if autoplay is on) */
						if ( this.settings.autoplay ) {
							this.start_rotation( this.settings.repetition );
							Thrixty.log("Autoplay ", this.player_id);
						} else {
							Thrixty.log("No Autoplay.", this.player_id);
						}
					}
				}
			};
			/** Init Small Helpers **/
				Thrixty.Player.prototype.set_small_dimensions = function(index){
					var img = this.small.images[index].element;
					this.root_element.appendChild(img);
						img.style.display = "block";
							var w = img.naturalWidth;
							var h = img.naturalHeight;
							var ar = w/h;
							this.small.image_width = w;
							this.small.image_height = h;
							this.small.image_ratio = ar;
						img.style.display = "";
					this.root_element.removeChild(img);
					Thrixty.log("Small dimensions set to: ("+w+"|"+h+")", this.player_id);
				};
				Thrixty.Player.prototype.refresh_small_progress_bar = function(){
					var progress_bar = this.DOM_obj.small_progress_bar;
					var percentage = ( ( this.small.images_loaded + this.small.images_errored ) / this.small.images_count);

					/* NaN or negative   (-n...0) */
					if( isNaN(percentage) || percentage <= 0 ){
						progress_bar.setAttribute("thrixty-state", "unloaded");
						progress_bar.style.width = "0%";

					/* under 100%        (0,01...0,99) */
					} else if( percentage < 1 ){
						progress_bar.setAttribute("thrixty-state", "loading");
						progress_bar.style.width = (percentage * 100)+"%";

					/* over 100%         (1...n) */
					} else if( percentage >= 1 ){
						progress_bar.setAttribute("thrixty-state", "loaded");
						progress_bar.style.width = "100%";
					}
				};
			/** /Init Small Helpers **/
		/*** /INITIALIZATION PART SMALL PICTURES ***/

		/*** INITIALIZATION PART LARGE PICTURES ***/
			Thrixty.Player.prototype.init_large_first = function(index, e){
				if( e.type === "load" ){
					this.set_large_dimensions(0);
				} else {
					/*? TODO: CRITICAL ERROR HANDLING!!!! ?*/
					Thrixty.log("LARGE IMAGE WAS NOT FOUND", this.player_id);
				}
			};
			Thrixty.Player.prototype.init_large_each = function(index, e){
				if( e.type === "load" ){
					this.large.images_loaded += 1;
					this.large.images[index].elem_loaded = true;
					Thrixty.log("large image "+index+" loaded ('"+this.large.images[0].element.src+"')", this.player_id);

					/* when this image is supposed to be displayed, redraw to actuaklly show it */
					if( (this.is_zoomed || this.is_fullpage) && this.large.active_image_id === index ){
						this.draw_current_image();
					}

				} else if( e.type === "error" ){
					this.large.images_errored += 1;
					this.large.images[index].elem_loaded = false;
					Thrixty.log("large image "+index+" errored ('"+this.large.images[0].element.src+"')", this.player_id);

				} else {
					/* nothing */
				}
				/* (update large progress bar) */
				/* (...) */
			};
			Thrixty.Player.prototype.init_large_all = function(index, e){
				if( this.large.images[index].elem_loaded === null ){
					this.init_large_each(index, e);

					if( index === 0 ){
						this.init_large_first(index, e);
					}

					/* if all large were loaded */
					if( (this.large.images_loaded + this.large.images_errored) == this.large.images_count ){
						/* doing nothing yet */
					}
				}
			};
			Thrixty.Player.prototype.set_large_dimensions = function(index){
				var img = this.large.images[index].element;
				this.root_element.appendChild(img);
					img.style.display = "block";
						var w = img.naturalWidth;
						var h = img.naturalHeight;
						var ar = w/h;
						this.large.image_width = w;
						this.large.image_height = h;
						this.large.image_ratio = ar;
					img.style.display = "";
				this.root_element.removeChild(img);
				Thrixty.log("Large dimensions set to: ("+w+"|"+h+")", this.player_id);
			};
		/*** /INITIALIZATION PART LARGE PICTURES ***/
	/**** /INITIALIZATION ****/



	/**** EVENTS ****/
		Thrixty.Player.prototype.assign_events = function(){
			/* lock for only adding events once */
			if( !this.events_assigned && this.settings.enable_controls ){
				/* This is important, as no keydown events will be fired on unfocused elements. */
				this.root_element.addEventListener("mousedown", function(){
					this.focus();
				});
				this.root_element.addEventListener("touchstart", function(){
					this.focus();
				});
				/* Keypresses: */
				this.root_element.addEventListener("keydown", this.keypresses.bind(this));

				/* Buttons */
					Thrixty.addMouseHoldEvent( this.DOM_obj.prev_btn, this.prev_button_event_mousehold.bind(this), 100, 500 );
					Thrixty.addTouchHoldEvent( this.DOM_obj.prev_btn, this.prev_button_event_mousehold.bind(this), 100, 500 );

					/* TODO: touch */
					this.DOM_obj.play_btn.addEventListener("mousedown", this.play_button_event_mousedown.bind(this));
					Thrixty.addTouchClickEvent( this.DOM_obj.play_btn, this.play_button_event_mousedown.bind(this) );

					Thrixty.addMouseHoldEvent( this.DOM_obj.next_btn, this.next_button_event_mousehold.bind(this), 100, 500 );
					Thrixty.addTouchHoldEvent( this.DOM_obj.next_btn, this.next_button_event_mousehold.bind(this), 100, 500 );



					this.DOM_obj.zoom_btn.addEventListener("click", this.zoom_button_event_click.bind(this));
					this.DOM_obj.size_btn.addEventListener("click", this.size_button_event_click.bind(this));
				/* /Buttons */
				this.DOM_obj.main_canvas.addEventListener("dblclick", this.main_canvas_dblclick.bind(this));
				/* Loading Manager */
					this.DOM_obj.load_overlay.addEventListener("click", this.load_button_event_click.bind(this));
					this.DOM_obj.load_btn.addEventListener("click", this.load_button_event_click.bind(this));
				/* /Loading Manager */
				/* Mouse Interaction */;
					/* mousedown */
					document.addEventListener("mousedown", this.document_mousedown.bind(this));
					this.DOM_obj.main_canvas.addEventListener("mousedown", this.main_canvas_mousedown.bind(this));
					this.DOM_obj.minimap_canvas.addEventListener("mousedown", this.minimap_canvas_mousedown.bind(this));
					this.DOM_obj.marker.addEventListener("mousedown", this.marker_mousedown.bind(this));
					/* mousemove */
					document.addEventListener("mousemove", Thrixty.throttle(
						this.document_mousemove.bind(this),
					40, true ));
					this.DOM_obj.main_canvas.addEventListener("mousemove", Thrixty.throttle(
						this.main_canvas_mousemove.bind(this),
					40, true ));
					this.DOM_obj.minimap_canvas.addEventListener("mousemove", Thrixty.throttle(
						this.minimap_canvas_mousemove.bind(this),
					40, true ));
					this.DOM_obj.marker.addEventListener("mousemove", Thrixty.throttle(
						this.marker_mousemove.bind(this),
					40, true ));
					/* mouseup */
					document.addEventListener("mouseup", this.document_mouseup.bind(this));
					this.DOM_obj.main_canvas.addEventListener("mouseup", this.main_canvas_mouseup.bind(this));
					this.DOM_obj.minimap_canvas.addEventListener("mouseup", this.minimap_canvas_mouseup.bind(this));
					this.DOM_obj.marker.addEventListener("mouseup", this.marker_mouseup.bind(this));
				/* /Mouse Interaction */;
				/* Touch Interaction */
					/* touchstart */
					document.addEventListener("touchstart", this.document_touchstart.bind(this));
					this.DOM_obj.main_canvas.addEventListener("touchstart", this.main_canvas_touchstart.bind(this));
					this.DOM_obj.minimap_canvas.addEventListener("touchstart", this.minimap_canvas_touchstart.bind(this));
					this.DOM_obj.marker.addEventListener("touchstart", this.marker_touchstart.bind(this));
					/* touchmove */
					document.addEventListener("touchmove", this.document_touchmove.bind(this));
					this.DOM_obj.main_canvas.addEventListener("touchmove", this.main_canvas_touchmove.bind(this));
					this.DOM_obj.minimap_canvas.addEventListener("touchmove", this.minimap_canvas_touchmove.bind(this));
					this.DOM_obj.marker.addEventListener("touchmove", this.marker_touchmove.bind(this));
					/* touchend */
					document.addEventListener("touchend", this.document_touchend.bind(this));
					this.DOM_obj.main_canvas.addEventListener("touchend", this.main_canvas_touchend.bind(this));
					this.DOM_obj.minimap_canvas.addEventListener("touchend", this.minimap_canvas_touchend.bind(this));
					this.DOM_obj.marker.addEventListener("touchend", this.marker_touchend.bind(this));
				/* /Touch Interaction */
				/* Window Resize: */
					window.addEventListener("resize", Thrixty.throttle(
						this.resize_window_event.bind(this),
					40, true ));
				/* Scrolling: */
					this.root_element.addEventListener("wheel", this.scroll_event.bind(this));

				/* mark events as assigned */
				this.events_assigned = true;
			}
			else if( !this.settings.autoload ){
				this.DOM_obj.load_overlay.addEventListener("click", this.load_button_event_click.bind(this));
				this.DOM_obj.load_btn.addEventListener("click", this.load_button_event_click.bind(this));
			}
		};
		Thrixty.Player.prototype.keypresses = function(e){
			if( e.altKey || e.ctrlKey || e.metaKey ){
				/* do nothing, when these keys are pressed */
				return true;
			}
			/* get pressed key and check which one was pressed */
			var keycode = e.keyCode || e.which;
			switch( keycode ){
				case 32:  /* SPACEBAR */
					/* correlate to click on play/pause button */;
					this.play_button_event_mousedown();
					/* this.play_button_event_mouseup(); */
					e.preventDefault();
				break;
				case 37:  /* LEFT ARROW */
					/* correlate to click on left button */
					this.prev_button_event_mousehold();
					e.preventDefault();
				break;
				case 39:  /* RIGHT ARROW */
					/* correlate to click on right button */
					this.next_button_event_mousehold();
					e.preventDefault();
				break;
				case 38:  /* UP ARROW */
					/* doesnt have a correlating button */
					this.increase_rotation_speed();
					e.preventDefault();
				break;
				case 40:  /* DOWN ARROW */
					/* doesnt have a correlating button */
					this.decrease_rotation_speed();
					e.preventDefault();
				break;
				case 27:  /* ESCAPE */
					if ( this.is_zoomed ) {
						this.stop_zoom();
					}
					if( this.is_fullpage ){
						this.quit_fullpage();
					}
					e.preventDefault();

				break;
				case 70:  /* F */
					if ( this.can_fullpage ) {
						/* correlate to click on fullpage button */
						this.size_button_event_click();
						e.preventDefault();
					}
				break;
				case 71:  /* G */
					if ( this.can_zoom ) {
						/* correlate to click on zoom button */
						this.zoom_button_event_click();
						e.preventDefault();
					}
				break;
				case 33:  /* PAGEUP */
				case 34:  /* PAGEDOWN */
				case 35:  /* END */
				case 36:  /* HOME */
					/* prevent scrolling, when in fullpage mode */
					if( this.is_fullpage ){
						e.preventDefault();
					}
				break;
			}
		};
		/*** Buttons ***/
			Thrixty.Player.prototype.load_button_event_click = function(e){
				/* window.setTimeout( this.load_all_small_images.bind(this), 10 ); */
				this.load_all_small_images();
				this.root_element.removeChild(this.DOM_obj.load_overlay);
				e.stopPropagation();
			};
			Thrixty.Player.prototype.prev_button_event_mousehold = function(e){
				this.stop_rotation();
				this.draw_previous_image();
			};
			Thrixty.Player.prototype.play_button_event_mousedown = function(e){
				this.toggle_rotation();
			};
			Thrixty.Player.prototype.next_button_event_mousehold = function(e){
				this.stop_rotation();
				this.draw_next_image();
			};
			Thrixty.Player.prototype.zoom_button_event_click = function(e){
				this.toggle_zoom();
			};
			Thrixty.Player.prototype.size_button_event_click = function(e){
				this.toggle_fullpage();
			};
			Thrixty.Player.prototype.main_canvas_dblclick = function(e){
				this.toggle_zoom();
				e.preventDefault();
			};
		/*** /Buttons ***/
		/*** Interaction ***/
			/** mousedown **/
				Thrixty.Player.prototype.document_mousedown = function(e){/**/};
				Thrixty.Player.prototype.main_canvas_mousedown = function(e){
					/* A1 | user wants to turn the object */
					if( this.settings.zoom_control == "progressive" ){
						/* left click only */
						if( e.which == 1 ){
							this.prepare_object_turn(e.clientX, e.clientY);
							e.preventDefault();
						}
					}
					/* B1 | user wants to turn the object */
					if( this.settings.zoom_control == "classic" ){
						/* left click only */
						if( e.which == 1 ){
							this.prepare_object_turn(e.clientX, e.clientY);
							e.preventDefault();
						}
					}
					this.is_click = true;
				};
				Thrixty.Player.prototype.minimap_canvas_mousedown = function(e){
					/* A1 | user wants to turn the object */
					if( this.settings.zoom_control == "progressive" ){
						/* left click only */
						if( e.which == 1 ){
							this.prepare_object_turn(e.clientX, e.clientY);
							e.preventDefault();
						}
					}
					/* B2 | user wants to move the section | minimap variation */
					if( this.settings.zoom_control == "classic" ){
						/* left click only */
						if( e.which == 1 ){
							this.prepare_section_move("minimap");
							this.execute_section_move(e.clientX, e.clientY); /* instantly snap to target position */
							e.preventDefault();
						}
					}
				};
				Thrixty.Player.prototype.marker_mousedown = function(e){
					/* A1 | user wants to turn the object */
					if( this.settings.zoom_control == "progressive" ){
						/* left click only */
						if( e.which == 1 ){
							this.prepare_object_turn(e.clientX, e.clientY);
							e.preventDefault();
						}
					}
					/* B2 | user wants to move the section */
					if( this.settings.zoom_control == "classic" ){
						/* left click only */
						if( e.which == 1 ){
							this.prepare_section_move("marker");
							this.execute_section_move(e.clientX, e.clientY); /* instantly snap to target position */
							e.preventDefault();
						}
					}
				};
			/** /mousedown **/
			/** mousemove **/
				Thrixty.Player.prototype.document_mousemove = function(e){
					/* A1 | user turns the object */
					/* B1 | user turns the object */
					if( this.object_turn.prepared ){
						this.execute_object_turn(e.clientX, e.clientY);
						e.preventDefault();
					}
					/* B2 | user moves section */
					if( this.section_move.prepared ){
						this.execute_section_move(e.clientX, e.clientY);
						e.preventDefault();
					}
				};
				Thrixty.Player.prototype.main_canvas_mousemove = function(e){
					/* A2 | user moves section */
					if( this.is_zoomed && this.settings.zoom_control == "progressive" ){
						this.execute_section_move(e.clientX, e.clientY);
						e.preventDefault();
					}
				};
				Thrixty.Player.prototype.minimap_canvas_mousemove = function(e){
					/* A2 | user moves section */
					if( this.is_zoomed && this.settings.zoom_control == "progressive" ){
						this.execute_section_move(e.clientX, e.clientY);
						e.preventDefault();
					}
				};
				Thrixty.Player.prototype.marker_mousemove = function(e){
					/* A2 | user moves section */
					if( this.is_zoomed && this.settings.zoom_control == "progressive" ){
						this.execute_section_move(e.clientX, e.clientY);
						e.preventDefault();
					}
				};
			/** /mousemove **/
			/** mouseup **/
				Thrixty.Player.prototype.document_mouseup = function(e){
					/* A1 | user stops turning the object */
					/* B1 | user stops turning the object */
					if( this.object_turn.prepared ){
						this.execute_object_turn(e.clientX, e.clientY); /* do a final object turn */
						this.stop_object_turn();
						e.preventDefault();
					}
					/* if this is still a click, toggle object rotation */
					if( this.is_click ){
						this.toggle_rotation();
						this.is_click = false;
						e.preventDefault();
					}
					/* B2 | user stops moving section */
					if( this.section_move.prepared ){
						this.execute_section_move(e.clientX, e.clientY); /* do a final section move */
						this.stop_section_move();
						e.preventDefault();
					}
				};
				Thrixty.Player.prototype.main_canvas_mouseup = function(e){/**/};
				Thrixty.Player.prototype.minimap_canvas_mouseup = function(e){/**/};
				Thrixty.Player.prototype.marker_mouseup = function(e){/**/};
			/** /mouseup **/
			/** touchstart **/
				Thrixty.Player.prototype.document_touchstart = function(e){/**/};
				Thrixty.Player.prototype.main_canvas_touchstart = function(e){
					if( e.touches.length == 1 ){
						/* C1 | user wants to turn the object */
						this.prepare_object_turn(e.touches[0].clientX, e.touches[0].clientY);
						/* register this as starting a click */
						this.is_click = true;
						// e.preventDefault();
					}
				};
				Thrixty.Player.prototype.minimap_canvas_touchstart = function(e){
					if( e.touches.length == 1 ){
						/* C2 | user wants to move the section */
						if( this.is_zoomed ){
							this.prepare_section_move("minimap");
							this.execute_section_move(e.touches[0].clientX, e.touches[0].clientY); /* instantly snap to target position */
							e.preventDefault();
						}
					}
				};
				Thrixty.Player.prototype.marker_touchstart = function(e){
					if( e.touches.length == 1 ){
						/* C2 | user wants to move the section */
						if( this.is_zoomed ){
							this.prepare_section_move("marker");
							this.execute_section_move(e.touches[0].clientX, e.touches[0].clientY); /* instantly snap to target position */
							e.preventDefault();
						}
					}
				};
			/** /touchstart **/
			/** touchmove **/
				Thrixty.Player.prototype.document_touchmove = function(e){
					var distance_x = e.touches[0].clientx - this.object_turn.last_x;

					if( e.touches.length == 1 ){
						/* stop scrolling in fullpage mode */
						if( this.is_fullpage ){
							e.preventDefault();
						}
						/* C1 | user turns the object */
						if( this.object_turn.prepared ){
							this.execute_object_turn(e.touches[0].clientX, e.touches[0].clientY);

							// e.preventDefault();
						}
						/* C2 | user moves the section */
						if( this.section_move.prepared ){
							this.execute_section_move(e.touches[0].clientX, e.touches[0].clientY);
								e.preventDefault();
						}
					}
				};
				Thrixty.Player.prototype.main_canvas_touchmove = function(e){/**/};
				Thrixty.Player.prototype.minimap_canvas_touchmove = function(e){/**/};
				Thrixty.Player.prototype.marker_touchmove = function(e){/**/};
			/** /touchmove **/
			/** touchend **/
				Thrixty.Player.prototype.document_touchend = function(e){
					/* C1 | user stops turning the object */
					if( this.object_turn.prepared ){
						/* this.execute_object_turn(e.touches[0].clientX, e.touches[0].clientY); */ /* do a final object turn */
						this.stop_object_turn();
						e.preventDefault();
					}
					/* C2 | user stops moving section */
					if( this.section_move.prepared ){
						/* this.execute_section_move(e.touches[0].clientX, e.touches[0].clientY); */ /* do a final section move */
						this.stop_section_move();
						e.preventDefault();
					}
					/* if this is still a click, toggle object rotation */
					if( this.is_click ){
						this.toggle_rotation();
						this.is_click = false;
					}
				};
				Thrixty.Player.prototype.main_canvas_touchend = function(e){/**/};
				Thrixty.Player.prototype.minimap_canvas_touchend = function(e){/**/};
				Thrixty.Player.prototype.marker_touchend = function(e){/**/};
			/** /touchend **/
			/** object turn **/
				Thrixty.Player.prototype.prepare_object_turn = function(x, y){
					if( typeof(x) != "undefined" && typeof(y) != "undefined" ){
						/* prepare turn by memorizing important information */
						this.object_turn.prepared = true;

						this.object_turn.start_x = x;
						this.object_turn.start_y = y;

						this.object_turn.last_x = x;
						this.object_turn.last_y = y;
					}
				};
				Thrixty.Player.prototype.execute_object_turn = function(x, y){
					if( typeof(x) != "undefined" && typeof(y) != "undefined" ){
						/* distance travelled since last object turn call */
						var distance_x = x - this.object_turn.last_x;

						if( Math.abs( x - this.object_turn.start_x) >= this.settings.sensitivity_x ){
							this.is_click = false;
							this.stop_rotation();
						}
						if( !this.is_click ){
							/* memorize x and subtract the left-over pixels */
							this.object_turn.last_x = x - this.distance_rotation(distance_x);
						}
					}
				};
				Thrixty.Player.prototype.stop_object_turn = function(){
					/* forget the event data */
					this.object_turn.prepared = false;
					this.object_turn.last_x = null;
					/* this.object_turn.last_y = null; */ /* unused */
				};
			/** /object turn **/
			/** section move **/
				Thrixty.Player.prototype.prepare_section_move = function(mode){
					if( typeof(mode) != "undefined" ){
						/* flag prepared */
						this.section_move.prepared = true;
						if( mode === "minimap" ){
							/* flag as minimap */
							this.section_move.minimap = true;
						}
					}
				};
				Thrixty.Player.prototype.execute_section_move = function(x, y){
					if( typeof(x) != "undefined" && typeof(y) != "undefined" ){
						var coords = {x: x, y: y};

						/* if mode is minimap, convert minimap to main coordinates */
						if( this.section_move.minimap ){
							coords = this.minimap_to_main_coords(coords);
						}

						/* update mouseposition and redraw image */
						this.update_section_position( coords.x, coords.y );
						this.draw_current_image();
					}
				};
				Thrixty.Player.prototype.stop_section_move = function(){
					/* unflag prepared and unset mode*/
					this.section_move.prepared = false;
					this.section_move.minimap = false;
				};
			/** /section move **/
			/** window resize **/
				Thrixty.Player.prototype.resize_window_event = function(e){
					this.refresh_player_sizings();
				};
			/** /window resize **/
			/** scrolling **/
				Thrixty.Player.prototype.scroll_event = function(e){
					/* prevent the User from scrolling the content while in fullpage */
					if( this.is_fullpage ){
						e.preventDefault();
					}
				};
			/** /scrolling **/
		/*** /Interaction ***/
	/**** /EVENTS ****/



	/**** ROTATION METHODS ****/
		Thrixty.Player.prototype.rotation = function(){
			if( this.is_rotating ){

				if( this.rotation_count < 0 || !isFinite( this.rotation_count ) ){
					this.draw_next_image();
				} else if( this.rotation_count > 0 ){
					this.draw_next_image();
					this.rotation_count -= 1;
					if( this.rotation_count == 0 ){
						this.stop_rotation();
					}
				} else { /* == 0 */
					this.stop_rotation();
				}

			}
		};
		Thrixty.Player.prototype.start_rotation = function( times = Infinity ){
			if( !this.is_rotating ){

				if ( isFinite( times ) ) {
					this.rotation_count = this.small.images_count * times;
				} else {
					this.rotation_count = times;
					Thrixty.log("Infinity", this.player_id);
				}

				/* animation is playing */
				this.is_rotating = true;
				this.DOM_obj.play_btn.setAttribute("thrixty-state", "play");
				/**/
				this.rotation();
				this.rotation_id = setInterval(this.rotation.bind(this), this.rotation_delay);

			}
		};
		Thrixty.Player.prototype.stop_rotation = function(){
			if( this.is_rotating ){
				/**/
				clearInterval(this.rotation_id);
				this.rotation_id = 0;
				/* animation is paused */
				this.is_rotating = false;
				this.DOM_obj.play_btn.setAttribute("thrixty-state", "pause");
			}
		};
		Thrixty.Player.prototype.toggle_rotation = function(){
			if( this.is_rotating ){
				this.stop_rotation();
			} else {
				this.start_rotation();
			}
		};
		Thrixty.Player.prototype.distance_rotation = function(distance_x){

			var rest_distanz = ( distance_x % this.pixel_per_image );
			var anzahl_nextimages = ( distance_x - rest_distanz ) / this.pixel_per_image;

			/* invert the count, to adapt to the behavior of the finger (TODO: ausdruck...) */
			anzahl_nextimages = anzahl_nextimages * -1;
			this.change_active_image_id(anzahl_nextimages);

			/* update View */
			this.draw_current_image();

			return rest_distanz;
		};
		Thrixty.Player.prototype.set_rotation_delay = function(){
			var images_count = 0;
			if( !this.is_zoomed ){
				images_count = this.small.images_count;
			} else {
				images_count = this.large.images_count;
			}
			this.rotation_delay = Math.ceil( ( (1000 / images_count) * Thrixty.cycle_duration ) / this.rotation_speed_modifiers[this.rotation_speed_selected] );
			/* restart rotation? */
			if( this.is_rotating ){
				this.stop_rotation();
				this.start_rotation();
			}
		};
	/**** /ROTATION METHODS ****/



	/**** IMAGE STEERING METHODS ****/
		Thrixty.Player.prototype.change_active_image_id = function(amount){
			var id = 0;
			var count = 0;
			if( this.is_zoomed ){
				id = this.large.active_image_id;
				count = this.large.images_count;
				this.small.active_image_id = this.large.images[id].to_small;
			} else {
				id = this.small.active_image_id;
				count = this.small.images_count;
				this.large.active_image_id = this.small.images[id].to_large;
			}
			/* calc position */
			id = (id + amount) % count;
			if( id < 0 ){
				id = id + count;
			}
			/* asign position */
			if( this.is_zoomed ){
				this.small.active_image_id = this.large.images[id].to_small;
				this.large.active_image_id = id;
			} else {
				this.small.active_image_id = id;
				this.large.active_image_id = this.small.images[id].to_large;
			}
		};
		Thrixty.Player.prototype.draw_next_image = function(){
			if( (this.settings.reversed_drag_direction && this.settings.reversed_play_direction)
			 || (!this.settings.reversed_drag_direction && !this.settings.reversed_play_direction)
			){
				this.change_active_image_id( 1 );
			} else {
				this.change_active_image_id( -1 );
			}
			this.draw_current_image();
		};
		Thrixty.Player.prototype.draw_previous_image = function(){
			if( (this.settings.reversed_drag_direction && this.settings.reversed_play_direction)
			 || (!this.settings.reversed_drag_direction && !this.settings.reversed_play_direction)
			){
				this.change_active_image_id( -1 );
			} else {
				this.change_active_image_id( 1 );
			}
			this.draw_current_image();
		};
	/**** /IMAGE STEERING METHODS ****/



	/**** ZOOM METHODS ****/
		Thrixty.Player.prototype.start_zoom = function(){
			if( this.can_zoom ){
				var main_canvas = this.DOM_obj.main_canvas;
				var minimap_canvas = this.DOM_obj.minimap_canvas;

				/* set zoom flag */
				this.is_zoomed = true;

				/* do main_class's part of start_zoom routine: */
				/* set zoom button to zoomout */
				this.DOM_obj.zoom_btn.setAttribute("thrixty-state", "zoomed_in");

				/* simulate zoom start at the center of the canvas */
				var click_x = main_canvas.getBoundingClientRect().left + ( main_canvas.offsetWidth / 2 );
				var click_y = main_canvas.getBoundingClientRect().top + ( main_canvas.offsetHeight / 2 );
				this.update_section_position(click_x, click_y);

				/* check for position indicator wanted (for example a minimap) */
				if( this.settings.zoom_pointer == "minimap" ){
					minimap_canvas.style.display = "";
					minimap_canvas.style.width = (this.small.image_width*100 / this.large.image_width)+"%";
					minimap_canvas.style.height = (this.small.image_height*100 / this.large.image_height)+"%";
				} else if( this.settings.zoom_pointer == "marker" ){
					this.DOM_obj.marker.style.display = "";
				}

				if( this.settings.zoom_mode == "outbox" ){
					/* only setup zoom outbox, when not in fullpage mode */
					if( !this.is_fullpage ){
						this.setup_outbox();
					}
				}
			}
			this.draw_current_image();
		};
		Thrixty.Player.prototype.stop_zoom = function(){
			/* turn off zoom */
			this.is_zoomed = false;
			this.DOM_obj.zoom_btn.setAttribute("thrixty-state", "zoomed_out");
			/* hide zoombox */
			this.DOM_obj.zoom_canvas.style.display = "none";
			/* hide minimap_box */
			this.DOM_obj.minimap_canvas.style.display = "none";
			/* hide marker */
			this.DOM_obj.marker.style.display = "none";
			/* draw unzoomed picture */
			this.draw_current_image();
		};
		Thrixty.Player.prototype.toggle_zoom = function(){
			if( !this.is_zoomed ){
				/* if already rotating, stop it */
				if( this.is_rotating ){
					this.stop_rotation();
				}
				this.start_zoom();

			} else {
				this.stop_zoom();
			}
			/* refresh rotation delay */
			this.set_rotation_delay();
		};
		Thrixty.Player.prototype.setup_outbox = function(){
			/* show zoom box at the selected position */
			this.DOM_obj.zoom_canvas.style.display = "";

			/* get main_canvas info */
			var main_canvas = this.DOM_obj.main_canvas;
			var zoom_canvas = this.DOM_obj.zoom_canvas;

			/* set zoom_canvas width */
			zoom_canvas.width  = main_canvas.width;
			zoom_canvas.height = main_canvas.height;
			zoom_canvas.style.width = main_canvas.offsetWidth+"px";
			zoom_canvas.style.height = main_canvas.offsetHeight+"px";

			/* set zoom_canvas position */
			if( this.settings.outbox_position == "right" ){
				zoom_canvas.style.top = 0+"px";
				zoom_canvas.style.left = main_canvas.offsetWidth+"px";

			} else if( this.settings.outbox_position == "left" ){
				zoom_canvas.style.top = 0+"px";
				zoom_canvas.style.left = (main_canvas.offsetWidth * -1)+"px";

			} else if( this.settings.outbox_position == "top" ){
				zoom_canvas.style.top = (main_canvas.offsetHeight * -1)+"px";
				zoom_canvas.style.left = 0+"px";

			} else if( this.settings.outbox_position == "bottom" ){
				/* respect the control bar... */
				zoom_canvas.style.top = this.root_element.offsetHeight+"px";
				zoom_canvas.style.left = 0+"px";
			}
		};
	/**** /ZOOM METHODS ****/



	/**** FULLPAGE METHODS ****/
		Thrixty.Player.prototype.enter_fullpage = function(){
			/* set fullpage state */
			this.is_fullpage = true;
			this.DOM_obj.size_btn.setAttribute("thrixty-state", "fullpaged");

			/* set refreshing styles at start */
			this.refresh_player_sizings();

			this.draw_current_image();
		};
		Thrixty.Player.prototype.quit_fullpage = function(){
			/* reset fullpage state */
			this.is_fullpage = false;
			this.DOM_obj.size_btn.setAttribute("thrixty-state", "normalsized");

			/* unset canvas_container size modification */
			this.refresh_player_sizings();

			this.draw_current_image();
		};
		Thrixty.Player.prototype.toggle_fullpage = function(){
			if( this.is_fullpage ){
				this.stop_zoom();
				this.quit_fullpage();
			} else {
				this.stop_zoom();
				this.enter_fullpage();
			}
		};
	/**** /FULLPAGE METHODS ****/



	/**** DRAWING METHODS ****/
		Thrixty.Player.prototype.draw_current_image = function(){
			/* decide upon a drawing strategy */
			if( !this.is_zoomed ){
				if( !this.is_fullpage ){
					this.unzoomed();
				} else {
					this.fullpaged();
				}
			} else {
				if( !this.is_fullpage && this.settings.zoom_mode == "outbox" ){
					this.outbox_zoomed();
				} else {
					this.inbox_zoomed();
				}
				if( this.settings.zoom_pointer == "marker" ){
					this.set_marker_position();
				} else {
					this.draw_minimap();
				}
			}
		};
		Thrixty.Player.prototype.unzoomed = function(){
			/* Task: Draw the unzoomed image on the canvas */
			var main_canvas = this.DOM_obj.main_canvas;
			var main_ctx = main_canvas.getContext("2d");

			/* get image to draw */
			var small_image = this.get_current_small_image();

			/* reset canvas size attributes */
			if( this.canvas_size != 0 ){
				this.set_canvas_dimensions_to_size(0);
			}

			/* clear */
			main_ctx.clearRect(
				0,
				0,
				main_canvas.width,
				main_canvas.height
			);

			/* draw current small image */
			if( !!small_image ){
				main_ctx.drawImage(
					small_image,
					0,
					0
				);
			}
		};
		Thrixty.Player.prototype.fullpaged = function(){
			/* Task: Draw the unzoomed image on the canvas */
			var main_canvas = this.DOM_obj.main_canvas;
			var main_ctx = main_canvas.getContext("2d");

			/* get image to draw */
			var large_image = this.get_current_large_image();

			/* reset canvas size attributes */
			if( this.canvas_size != 1 ){
				this.set_canvas_dimensions_to_size(1);
			}

			/* clear */
			main_ctx.clearRect(
				0,
				0,
				main_canvas.width,
				main_canvas.height
			);

			/* draw current small image */
			if( !!large_image ){
				main_ctx.drawImage(
					large_image,
					0,
					0,
					main_canvas.width,
					main_canvas.height
				);
			}
		};
		Thrixty.Player.prototype.inbox_zoomed = function(){
			/* Task: Draw the enlarged image on the canvas */
			var main_canvas = this.DOM_obj.main_canvas;
			var main_ctx = main_canvas.getContext("2d");

			/* get current image */
			var large_image = this.get_current_large_image();

			/* reset canvas size attributes */
			if( this.canvas_size != 0 ){
				this.set_canvas_dimensions_to_size(0);
			}

			/* clear canvas */
			main_ctx.clearRect(
				0,
				0,
				main_canvas.width,
				main_canvas.height
			);

			if( !!large_image ){
				/* get current offsets */
				var offsets = this.get_zoom_offsets();
				/* draw current image */
				main_ctx.drawImage(
					large_image,
					0,
					0,
					large_image.naturalWidth, /* this needs to be calculated by the picture, as this varies from small to large */
					large_image.naturalHeight, /* this needs to be calculated by the picture, as this varies from small to large */
					-offsets.x,
					-offsets.y,
					this.large.image_width,
					this.large.image_height
				);
			}
		};
		Thrixty.Player.prototype.outbox_zoomed = function(){
			/* Task: draw the elarged image on the zoom_canvas and the small image on the main_canvas */
			var main_canvas = this.DOM_obj.main_canvas;
			var main_ctx = main_canvas.getContext("2d");
			var zoom_canvas = this.DOM_obj.zoom_canvas;
			var zoom_ctx = zoom_canvas.getContext("2d");

			/* get current image */
			var small_image = this.get_current_small_image();
			var large_image = this.get_current_large_image();

			/* reset canvas size attributes */
			if( this.canvas_size != 0 ){
				this.set_canvas_dimensions_to_size(0);
			}

			/* clear main_canvas and zoom_canvas */
			main_ctx.clearRect(
				0,
				0,
				main_canvas.width,
				main_canvas.height
			);
			zoom_ctx.clearRect(
				0,
				0,
				zoom_canvas.width,
				zoom_canvas.height
			);

			/* draw small_image on main_canvas */
			if( !!small_image ){
				main_ctx.drawImage(
					small_image,
					0,
					0
				);
			}

			if( !!large_image ){
				/* get current offsets */
				var offsets = this.get_zoom_offsets();
				/* draw large_image on zoom_canvas */
				zoom_ctx.drawImage(
					large_image,
					0,
					0,
					large_image.naturalWidth,
					large_image.naturalHeight,
					-offsets.x,
					-offsets.y,
					this.large.image_width,
					this.large.image_height
				);
			}
		};
		Thrixty.Player.prototype.draw_minimap = function(){
			/* Task: Draw the minimap on the minimap_canvas */

			/* width and height are already set globally in the HTML as inline-CSS. */
			var main_canvas = this.DOM_obj.main_canvas;
			/* var main_ctx = main_canvas.getContext("2d"); */ /* not needed */
			var minimap_canvas = this.DOM_obj.minimap_canvas;
			var minimap_ctx = minimap_canvas.getContext("2d");

			/* get image */
			var small_image = this.get_current_small_image();

			/* calculate cutout dimensions */
			cutout_w = minimap_canvas.width * (this.small.image_width / this.large.image_width);
			cutout_h = minimap_canvas.height * (this.small.image_height / this.large.image_height);
			cutout_x = ( this.relative_mouse.x / main_canvas.offsetWidth ) * ( minimap_canvas.width - cutout_w );
			cutout_y = ( this.relative_mouse.y / main_canvas.offsetHeight ) * ( minimap_canvas.height - cutout_h );



			/* first clear canvas */
			minimap_ctx.clearRect(
				0,
				0,
				minimap_canvas.width,
				minimap_canvas.height
			);

			/* second draw image */
			if( !!small_image ){
				minimap_ctx.drawImage(
					small_image,
					0,
					0
				);
			}

			/* third draw cutout */
			minimap_ctx.globalAlpha = 0.5;
				minimap_ctx.fillStyle = "black";
				minimap_ctx.beginPath();
					/* draw mask (rectangle clockwise) */
						minimap_ctx.moveTo(0, 0);
						minimap_ctx.lineTo(this.small.image_width, 0);
						minimap_ctx.lineTo(this.small.image_width, this.small.image_height);
						minimap_ctx.lineTo(0, this.small.image_height);
						minimap_ctx.lineTo(0, 0);
					/* "undraw" cutout (rectangle counterclockwise) */
						minimap_ctx.moveTo(cutout_x+0, cutout_y+0);
						minimap_ctx.lineTo(cutout_x+0, cutout_y+cutout_h);
						minimap_ctx.lineTo(cutout_x+cutout_w, cutout_y+cutout_h);
						minimap_ctx.lineTo(cutout_x+cutout_w, cutout_y+0);
						minimap_ctx.lineTo(cutout_x+0, cutout_y+0);
				minimap_ctx.closePath();
				minimap_ctx.fill();
			minimap_ctx.globalAlpha = 1;
		};
		Thrixty.Player.prototype.set_marker_position = function(){
			/* Dimensionate and position the marker correctly over the canvas */
			var W = this.DOM_obj.canvas_container.offsetWidth * this.small.image_width/this.large.image_width;
			var H = this.DOM_obj.canvas_container.offsetHeight * this.small.image_width/this.large.image_width;
			var X = ( this.relative_mouse.x / this.DOM_obj.canvas_container.offsetWidth ) * ( this.DOM_obj.canvas_container.offsetWidth - W );
			var Y = ( this.relative_mouse.y / this.DOM_obj.canvas_container.offsetHeight ) * ( this.DOM_obj.canvas_container.offsetHeight - H );
			/*  */
			this.DOM_obj.marker.style.width = W+"px";
			this.DOM_obj.marker.style.height = H+"px";
			this.DOM_obj.marker.style.left = X+"px";
			this.DOM_obj.marker.style.top = Y+"px";
		};
		Thrixty.Player.prototype.update_section_position = function(X, Y){
			var main_canvas = this.DOM_obj.main_canvas;
			/* calculate relative mouse position */;
			var cursor_x = (X - main_canvas.getBoundingClientRect().left);
			var cursor_y = (Y - main_canvas.getBoundingClientRect().top);

			/* Borders - min and max values - reset, when overstepped */
			if( cursor_x < 0 ){
				cursor_x = 0;
			}
			if( cursor_x > main_canvas.offsetWidth ){
				cursor_x = main_canvas.offsetWidth;
			}
			if( cursor_y < 0 ){
				cursor_y = 0;
			}
			if( cursor_y > main_canvas.offsetHeight ){
				cursor_y = main_canvas.offsetHeight;
			}
			/* assign calculated values */
			this.relative_mouse.x = cursor_x;
			this.relative_mouse.y = cursor_y;
		};
		Thrixty.Player.prototype.get_zoom_offsets = function(){
			var main_canvas = this.DOM_obj.main_canvas;
			var position_percentage_x = ( this.relative_mouse.x / main_canvas.offsetWidth );
			var position_percentage_y = ( this.relative_mouse.y / main_canvas.offsetHeight );
			return {
				x: position_percentage_x * ( this.large.image_width - this.small.image_width ),
				y: position_percentage_y * ( this.large.image_height - this.small.image_height ),
			}
		};
		Thrixty.Player.prototype.get_current_small_image = function(){
			/* get and return the current small image */

			var cur_image = this.small.images[this.small.active_image_id];
			if( cur_image.elem_loaded ){
				return cur_image.element;
			} else {
				/* There is nothing to show */
				return null;
			}
		};
		Thrixty.Player.prototype.get_current_large_image = function(){
			/* get images (small for fallback) */
			var base_small = this.small.images[this.small.active_image_id];
			var base_large = this.large.images[this.large.active_image_id];

			/* if the large one is already loaded, return it */
			if( base_large.elem_loaded === true ){
				return base_large.element;
			}

			/* request the large picture, that should have been loaded now */
			if( base_large.elem_loaded === null ){
				this.load_large_image(this.large.active_image_id);
			}

			/* the large one isnt yet loaded, so fall back to the small one */
			return this.get_current_small_image();
		};
	/**** /DRAWING METHODS ****/



	/**** GETTER & SETTER ****/
		Thrixty.Player.prototype.refresh_player_sizings = function(){
			/* root_element sizings are dependant on the fullpage state and the available space */
			if( this.is_fullpage ){
				/* TOCOME:
				 *   Right now there is no selector, that can put this code into the CSS file.
				 *   CSS4 is supposed to change that with its "$" notation.
				 *   That notation is able to select the element to receive the styles.
				 *   $.a > .b{ background:red;} <-- ".a" gets the red background
				 *
				 *   Same for the non-fullpage part
				 **/
				/* set root_element fullpage-styles */
				this.root_element.style.position = "fixed";
				this.root_element.style.top = "0";
				this.root_element.style.right = "0";
				this.root_element.style.bottom = "0";
				this.root_element.style.left = "0";
				this.root_element.style.width = "100%";
				this.root_element.style.height = "100%";
				this.root_element.style.maxWidth = "100%";
				this.root_element.style.maxHeight = "100%";
				this.root_element.style.border = "5px solid gray";
				this.root_element.style.background = "white";
				this.root_element.style.zIndex = "9999";
				this.DOM_obj.showroom.style.width = "";
				this.DOM_obj.showroom.style.height = "";
				this.DOM_obj.canvas_container.style.width = "";
				this.DOM_obj.canvas_container.style.height = "";
				this.DOM_obj.canvas_container.style.marginLeft = "";
				this.DOM_obj.canvas_container.style.marginTop = "";

				/* measure available space */
				var root_width  = this.root_element.clientWidth;
				var root_height = this.root_element.clientHeight;

				/* update the generated player parts */
				this.resize_dom_objects(root_width, root_height, this.large.image_ratio);
			} else {
				/* unset root_element fullscreeen-styles */
				this.root_element.style.position = "";
				this.root_element.style.top = "";
				this.root_element.style.right = "";
				this.root_element.style.bottom = "";
				this.root_element.style.left = "";
				this.root_element.style.width = "";
				this.root_element.style.height = "";
				this.root_element.style.maxWidth = "";
				this.root_element.style.maxHeight = "";
				this.root_element.style.border = "";
				this.root_element.style.background = "";
				this.root_element.style.zIndex = "";
				this.DOM_obj.showroom.style.width = "";
				this.DOM_obj.showroom.style.height = "";
				this.DOM_obj.canvas_container.style.width = "";
				this.DOM_obj.canvas_container.style.height = "";
				this.DOM_obj.canvas_container.style.marginLeft = "";
				this.DOM_obj.canvas_container.style.marginTop = "";

				/* calculate players sizing upon avaible space */
				var root_width = this.root_element.clientWidth;
				/* var root_height = "?px"; <== this value is being searched for */

				/* determine maximum width */
				var max_width = root_width;
				/* always limit to small image width */
				if( max_width > this.small.image_width ){
					max_width = this.small.image_width;
				}
				/* calculate height upon the width */
				root_height = (max_width / this.small.image_ratio);
				/* (do not forget the height of the control bar) */
				root_height += this.DOM_obj.controls.clientHeight;

				/* check for possible limitations by max-height or similar */
				this.root_element.style.width = root_width+"px";
				this.root_element.style.height = root_height+"px";
				/* measure the actual dimensions (max-height will shorten this) */
				root_width = this.root_element.clientWidth;
				root_height = this.root_element.clientHeight;
				/* reassign corrected values to the element */
				this.root_element.style.width = root_width+"px";
				this.root_element.style.height = root_height+"px";

				/* update the generated player parts */
				this.resize_dom_objects(root_width, root_height, this.small.image_ratio);
			}
		};
			/** only used in above function **/
			Thrixty.Player.prototype.resize_dom_objects = function(w, h, aspect_ratio){
				/* get controls dimensions */
				var controls_width = this.DOM_obj.controls.offsetWidth;
				var controls_height = this.DOM_obj.controls.offsetHeight;

				var showroom_width  = w;
				var showroom_height = h - controls_height;


				this.DOM_obj.showroom.style.width  = showroom_width  +"px";
				this.DOM_obj.showroom.style.height = showroom_height +"px";


				/* showroom aspect ratio for orientation */
				var showroom_aspect_ratio = showroom_width / showroom_height;

				/* portrait orientation []      => lower then 1 */
				/* landscape orientation [___]  => bigger then 1 */
				/* if image is "more portrait"  then the showroom, center it horizontally */
				/* if image is "more landscape" then the showroom, center it vertically */
				if( showroom_aspect_ratio > aspect_ratio ){
					var canvas_container_width  = showroom_height * aspect_ratio;
					var canvas_container_height = showroom_height;

					var canvas_container_x      = (showroom_width - canvas_container_width) / 2;
					var canvas_container_y      = 0;

				} else {
					var canvas_container_width  = showroom_width;
					var canvas_container_height = showroom_width/aspect_ratio;

					var canvas_container_x      = 0;
					var canvas_container_y      = (showroom_height-canvas_container_height)/2;

				}

				this.DOM_obj.canvas_container.style.width  = canvas_container_width +"px";
				this.DOM_obj.canvas_container.style.height = canvas_container_height+"px";
				this.DOM_obj.canvas_container.style.marginLeft = canvas_container_x+"px";
				this.DOM_obj.canvas_container.style.marginTop = canvas_container_y+"px";
			};
		Thrixty.Player.prototype.set_canvas_dimensions_to_size = function(size){
			var size_obj = null;

			switch( size ){
				default:
				case 0: /* small */
					size_obj = this.small;
				break;
				case 1: /* large */
					size_obj = this.large;
				break;
			}

			/* set width and height of canvas */
			var w = size_obj.image_width;
			var h = size_obj.image_height;
			/* background */
				this.DOM_obj.bg_canvas.width = w;
				this.DOM_obj.bg_canvas.height = h;
			/* main */
				this.DOM_obj.main_canvas.width = w;
				this.DOM_obj.main_canvas.height = h;
			/* minimap */
				this.DOM_obj.minimap_canvas.width = w;
				this.DOM_obj.minimap_canvas.height = h;
			/* zoom box */
				this.DOM_obj.zoom_canvas.width = w;
				this.DOM_obj.zoom_canvas.height = h;

			/* memorize set size */
			this.canvas_size = size;
		};
		Thrixty.Player.prototype.set_image_offsets = function(){
			/* get values */
			var small_images_count = this.small.images_count;
			var large_images_count = this.large.images_count;

			/* no need to set these settings, when there arent any large images */
			if( small_images_count  > 0 && large_images_count > 0 ){
				/* get proportion */
				var small_to_large = small_images_count/large_images_count;
				var large_to_small = large_images_count/small_images_count;

				/* set small image offset */
				for( var i=0; i<small_images_count; i++ ){
					this.small.images[i].to_large = Math.round(i/small_to_large);
				}

				/* set large image offset */
				for( var i=0; i<large_images_count; i++ ){
					this.large.images[i].to_small = Math.round(i/large_to_small);
				}
			}
		};
		Thrixty.Player.prototype.increase_rotation_speed = function(){
			var sp_sel = this.rotation_speed_selected;
			sp_sel += 1;
			/* upper limit */
			if( sp_sel > this.rotation_speed_modifiers.length-1 ){
				sp_sel = this.rotation_speed_modifiers.length-1;
			}
			this.rotation_speed_selected = sp_sel;
			this.set_rotation_delay();
		};
		Thrixty.Player.prototype.decrease_rotation_speed = function(){
			var sp_sel = this.rotation_speed_selected;
			sp_sel -= 1;
			/* lower limit */
			if( sp_sel < 0 ){
				sp_sel = 0;
			}
			this.rotation_speed_selected = sp_sel;
			this.set_rotation_delay();
		};
		Thrixty.Player.prototype.minimap_to_main_coords = function(coords){
			/* TODO: generalize size ratio */
			var size_ratio_w = this.small.image_width / this.large.image_width;
			var size_ratio_h = this.small.image_height / this.large.image_height;
			/* TODO: this fails in chrome, because they screwed up a part of the jquery function */;
			/* MARK: SHOULD BE FINE NOW! Now testing... */

			return {
				x: ( ( coords.x - this.DOM_obj.minimap_canvas.getBoundingClientRect().left ) / size_ratio_w ) + this.DOM_obj.minimap_canvas.getBoundingClientRect().left,
				y: ( ( coords.y - this.DOM_obj.minimap_canvas.getBoundingClientRect().top ) / size_ratio_h ) + this.DOM_obj.minimap_canvas.getBoundingClientRect().top,
			};
		};
	/**** /GETTER & SETTER ****/
/***** /Class Player *****/
