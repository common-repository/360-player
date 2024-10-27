"use strict";

if ( typeof thrixty !== "undefined" ) {

	thrixty.ManuallyLoadPlugins.ShortcodeConverter = function (){
		this.init = function (){
			tinymce.create( "tinymce.plugins.thrixty_shortcode_converter", {
				init: function ( editor, url ){

					// CONVERT SHORTCODE

					editor.onBeforeSetContent.add(function (d, e) { // Before Visuell View
						e.content = this.convert_into_preview(e.content, url);
					}.bind(this));

					editor.onSetContent.add(function (d, e) { // Visuell View
						e.content = this.convert_into_preview(e.content, url);
					}.bind(this));

					editor.onGetContent.add(function (d, e) { // Text View
						if (e.get) {
							e.content = this.convert_into_text(e.content);
						}
					}.bind(this));

					editor.onInit.add(function (editor){ // After Init
						editor.selection.onBeforeSetContent.add(function (d, e){ // After Init -> Before Insert Shortcode
							e.content = this.convert_into_preview(e.content, url);
						}.bind(this));
					}.bind(this));

				}.bind(this)
			});

			tinymce.PluginManager.add( "thrixty_shortcode_converter", tinymce.plugins.thrixty_shortcode_converter );
		}
	}

	/**
	*
	*	Convert the player shotcode and the layout shortcode
	*/
	thrixty.ManuallyLoadPlugins.ShortcodeConverter.prototype.convert_into_preview = function ( content, url ){ // Visuell
		content = this.convert_player_into_preview( content, url );
		content = this.convert_layout_into_preview( content, url );

		return content;
	}


	/**
	*
	*	Convert the player shotcode
	*/
	thrixty.ManuallyLoadPlugins.ShortcodeConverter.prototype.convert_player_into_preview = function ( content, url ){
		const regex = /\[thrixty-player id=["|']([0-9]*)["|']\]/g;
		const string = content; // !!!--- Its important to cast the content string into an constance ---!!!
		
		let match;
		while ((match = regex.exec(string)) !== null) {
			if (match.index === regex.lastIndex) {
				regex.lastIndex++;
			}

			var default_img_path = url + "/../images/PlayerThrixty_50px.png";
			var player_attribute = "data-thrixty-player-preview='" + match[1] + "'";

			var ajax_object = {
				player_attribute: player_attribute,
				default_img: "<img data-thrixty-preview-success='false' " + player_attribute + " src='" + default_img_path + "'" + ">",
				match: match
			};

			jQuery.ajax({
				url: ajaxurl,
				async: false,
				type: "POST",
				dataType: "json",
				data: {
					action: "thrixty_get_player_preview",
					id: match[1]
				},
				success: function ( response ){

					if ( response != 0 ) {
						if ( response.success ) {
							var preview_pic_path = response.data.pic_path;

							if ( preview_pic_path == "" && preview_pic_path == null ) {
								content = content.replace(ajax_object.match[0], ajax_object.default_img);
							} else {

								jQuery.ajax({
									url: preview_pic_path,
									async: false,
									type: "POST",
									success: function (){
										content = content.replace(match[0], "<img data-thrixty-preview-success='true' " + player_attribute + "src='" + preview_pic_path + "'" + ">");
									}.bind(ajax_object),
									error: function (){
										content = content.replace(match[0], ajax_object.default_img);
									}.bind(ajax_object)
								});

							}
						} else { content = content.replace(ajax_object.match[0], ajax_object.default_img); }
					} else { content = content.replace(ajax_object.match[0], ajax_object.default_img); }

				}.bind(ajax_object),
				error: function ( error ){
					content = content.replace(match[0], ajax_object.default_img);
				}.bind(ajax_object)
			});
		}
		return content;
	}


	/**
	*
	*	Convert the layout shortcode
	*/
	thrixty.ManuallyLoadPlugins.ShortcodeConverter.prototype.convert_layout_into_preview = function ( content, url ){
		const regex = /\[thrixty-layout id=["|']([0-9]*)["|'] basepath=["|']([\w\-\.\\\/\:\s]*)["|'] object_name=["|']([\w\-\.\\\/\:\s]*)["|'] small_path=["|']([\w\-\.\\\/\:\s]*)["|'] large_path=["|']([\w\-\.\\\/\:\s]*)["|'] use_basepath=["|']([on|off|true|false|1|0]*)["|']\]/g;
		const string = content; // !!!--- Its important to cast the content string into an constance ---!!!
		
		let match;
		while ((match = regex.exec(string)) !== null) {
			if (match.index === regex.lastIndex) {
				regex.lastIndex++;
			}

			var default_img_path = url + "/../images/PlayerThrixty_50px.png";
			var layout_attribute = "data-thrixty-layout-preview='" + match[1] + "'";

			var ajax_object = {
				layout_attribute: layout_attribute,
				default_img: "<img data-thrixty-preview-success='false' " + " src='" + default_img_path + "'" + layout_attribute + "data-thrixty-preview-basepath='" + match[2] + "' data-thrixty-preview-object-name='" + match[3] + "' data-thrixty-preview-small-path='" + match[4] + "' data-thrixty-preview-large-path='" + match[5] + "' data-thrixty-preview-use-basepath='" + match[6] + "'>",
				match: match
			};

			jQuery.ajax({
				url: ajaxurl,
				async: false,
				type: "POST",
				dataType: "json",
				data: {
					action: "thrixty_get_layout_preview",
					id: match[1],
					basepath: match[2],
					object_name: match[3],
					small_path: match[4],
					large_path: match[5],
					use_basepath: match[6]
				},
				success: function ( response ){

					if ( response != 0 ) {
						if ( response.success ) {
							var preview_pic_path = response.data.pic_path;

							if ( preview_pic_path == "" || preview_pic_path == null ) {
								content = content.replace(ajax_object.match[0], ajax_object.default_img);
							} else {

								jQuery.ajax({
									url: preview_pic_path,
									async: false,
									type: "POST",
									success: function (){
										content = content.replace(match[0], "<img data-thrixty-preview-success='true' " + layout_attribute + "src='" + preview_pic_path + "'" + " data-thrixty-preview-basepath='" + match[2] + "' data-thrixty-preview-object-name='" + match[3] + "' data-thrixty-preview-small-path='" + match[4] + "' data-thrixty-preview-large-path='" + match[5] + "' data-thrixty-preview-use-basepath='" + match[6] + "'>");
									}.bind(ajax_object),
									error: function (){
										content = content.replace(match[0], ajax_object.default_img);
									}.bind(ajax_object)
								});

							}
						} else { content = content.replace(ajax_object.match[0], ajax_object.default_img); }

					} else { content = content.replace(ajax_object.match[0], ajax_object.default_img); }

				}.bind(ajax_object),
				error: function ( error ){
					content = content.replace(match[0], ajax_object.default_img);
				}.bind(ajax_object)
			});
		}

		return content;
	}

	/**
	*
	*	Convert the player image and the layout image
	*/
	thrixty.ManuallyLoadPlugins.ShortcodeConverter.prototype.convert_into_text = function ( content ){ // Text
		content = this.convert_player_into_text( content );
		content = this.convert_layout_into_text( content );

		return content;
	}

	/**
	*
	*	Convert the player image
	*/
	thrixty.ManuallyLoadPlugins.ShortcodeConverter.prototype.convert_player_into_text = function ( content ){
		const regex = /<img [^>]*data-thrixty-player-preview=["|']([0-9]*)["|'][^>]*>/g;
		const string = content; // !!!--- Its important to cast the content string into an constance ---!!!
		
		let match;
		while ((match = regex.exec(string)) !== null) {
		    if (match.index === regex.lastIndex) {
		        regex.lastIndex++;
		    }
		    
		    content = content.replace(match[0], "[thrixty-player id='" + match[1] + "']");
		}

		return content;
	}


	/**
	*
	*	Convert the layout image
	*/
	thrixty.ManuallyLoadPlugins.ShortcodeConverter.prototype.convert_layout_into_text = function ( content ){
		var content_as_element = jQuery(content);
		var root_element = content_as_element;

		content_as_element = content_as_element.find("[data-thrixty-layout-preview]");
		if ( content_as_element.length ) {

			for (var i = 0; i < content_as_element.length; i++) {

				var id = content_as_element[i].getAttribute("data-thrixty-layout-preview");
				var basepath = content_as_element[i].getAttribute("data-thrixty-preview-basepath");
				var object_name = content_as_element[i].getAttribute("data-thrixty-preview-object-name");
				var small_path = content_as_element[i].getAttribute("data-thrixty-preview-small-path");
				var large_path = content_as_element[i].getAttribute("data-thrixty-preview-large-path");
				var use_basepath = content_as_element[i].getAttribute("data-thrixty-preview-use-basepath");

				var parent = content_as_element[i].parentElement;
				content_as_element[i].remove();
				parent.append("[thrixty-layout id='"+ id +"' basepath='"+ basepath +"' object_name='"+ object_name +"' small_path='"+ small_path +"' large_path='"+ large_path +"' use_basepath='"+ use_basepath +"']");

			}

		}

		content = "";
		for (var i = 0; i < root_element.length; i++) {
			content += root_element[i].outerHTML;
		}

		return content;
	}

	document.addEventListener("DOMContentLoaded", function (){
		var object = new thrixty.ManuallyLoadPlugins.ShortcodeConverter();
		object.init();
	});

}
