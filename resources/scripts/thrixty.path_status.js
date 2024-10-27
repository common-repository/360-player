"use strict";

if ( typeof thrixty !== "undefined" ) {

	thrixty.ManuallyLoadPlugins.Filepaths = function (){
		this.init = function (){
			var thrixty_path_status_elements = jQuery("[data-thrixty-path-status]");
			for (var i = 0; i < thrixty_path_status_elements.length; i++) {
				new thrixty.ManuallyLoadPlugins.Filepaths.Filepath( thrixty_path_status_elements[i] );
			}
		}
	}

	thrixty.ManuallyLoadPlugins.Filepaths.Filepath = function ( container ){
		this.container = container;

		this.input_basepath = this.container.querySelector("[data-thrixty-path-status-basepath]");
		this.input_small_path = this.container.querySelector("[data-thrixty-path-status-small-path]");
		this.input_large_path = this.container.querySelector("[data-thrixty-path-status-large-path]");
		this.input_object = this.container.querySelector("[data-thrixty-path-status-object-name]");

		this.status_small_output = this.container.querySelectorAll("[data-thrixty-path-status-output-small]");
		this.status_large_output = this.container.querySelectorAll("[data-thrixty-path-status-output-large]");

		this.autoload = this.container.getAttribute( "data-thrixty-path-status-autoload" ) == "true";

		this.path_small= "";
		this.path_large= "";

		/*
		*
		* Bind input(change) events on all path settings inputs
		*/
		this.input_basepath.addEventListener("input", thrixty.debounce(this.changed.bind(this), 300));
		this.input_small_path.addEventListener("input", thrixty.debounce(this.changed.bind(this), 300));
		this.input_large_path.addEventListener("input", thrixty.debounce(this.changed.bind(this), 300));
		this.input_object.addEventListener("input", thrixty.debounce(this.changed.bind(this), 300));

		this.generate_absolute_path();
		if ( this.autoload ) {
			this.changed();
		}
	}

	thrixty.ManuallyLoadPlugins.Filepaths.Filepath.prototype.generate_absolute_path = function (){
		var basepath = this.input_basepath.value;
		var small_path = this.input_small_path.value;
		var large_path = this.input_large_path.value;
		var object = this.input_object.value;

		basepath = basepath.replace("__SITE__", thrixty_placeholder.__SITE__); // Replace the thrixty placeholder
		basepath = basepath.replace("__PLUGIN__", thrixty_placeholder.__PLUGIN__); // Replace the thrixty placeholder
		basepath = basepath.replace("__UPLOAD__", thrixty_placeholder.__UPLOAD__); // Replace the thrixty placeholder

		basepath = basepath.replace(/\/*$/g, ""); // Strip all slashed at the end

		object = object.replace(/\/*$/, ""); // Strip all slashes at the end
		object = object.replace(/^\/*/, ""); // Strip all slashes at the start

		small_path = small_path.replace(/^\/*/, ""); // Strip all slashes at the start
		large_path = large_path.replace(/^\/*/, ""); // Strip all slashes at the start

		this.path_small = basepath + "/" + object + "/" + small_path; // Create the full small path
		this.path_large = basepath + "/" + object + "/" + large_path; // Create the full large path

		/*
		*
		* Set the absolute path
		*/
		for (var i = 0; i < this.status_small_output.length; i++) {
			this.status_small_output[i].innerHTML = this.path_small;
		}

		for (var i = 0; i < this.status_large_output.length; i++) {
			this.status_large_output[i].innerHTML = this.path_large;
		}
	}

	thrixty.ManuallyLoadPlugins.Filepaths.Filepath.prototype.changed = function (){
		this.generate_absolute_path();

		/*
		*
		* Check if the small filelist path is correct and change the color into red or green
		*/
		jQuery.ajax({
			url: this.path_large,
			success: function(){
				for (var i = 0; i < this.status_small_output.length; i++) {
					this.status_small_output[i].setAttribute("thrixty_path_status", "success");
				}
			}.bind(this),
			error: function(){
				for (var i = 0; i < this.status_small_output.length; i++) {
					this.status_small_output[i].setAttribute("thrixty_path_status", "alert");
				}
			}.bind(this)
		});

		/*
		*
		* Check if the large filelist path is correct and change the color into red or green
		*/
		jQuery.ajax({
			url: this.path_large,
			success: function(){
				for (var i = 0; i < this.status_large_output.length; i++) {
					this.status_large_output[i].setAttribute("thrixty_path_status", "success");
				}
			}.bind(this),
			error: function(){
				for (var i = 0; i < this.status_large_output.length; i++) {
					this.status_large_output[i].setAttribute("thrixty_path_status", "alert");
				}
			}.bind(this)
		});
	}

}
