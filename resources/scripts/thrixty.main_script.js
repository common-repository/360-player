"use strict";

if ( typeof thrixty !== "undefined" ) {

	//******************** TOGGLE ********************//
	thrixty.AutoloadPlugins.Toggles = function (){}
	thrixty.AutoloadPlugins.Toggles.prototype.init = function (){
		var toggle_objects = [];
		var toggle_elements = document.querySelectorAll(".toggle");

		for (var i =  0; i < toggle_elements.length; i++) {
			var toggle = new thrixty.AutoloadPlugins.Toggles.Toggle ( toggle_elements[i] );
			toggle_objects.push( toggle );
		}

		return toggle_objects;
	}

	thrixty.AutoloadPlugins.Toggles.Toggle = function ( toggle ){
		this.input = toggle.querySelector(".toggle_input");
		this.content = toggle.querySelector(".toggle_content");
		this.output = toggle.querySelector(".toggle_output");

		if ( this.input != null && this.content != null && this.output != null ) {

			this.check_single = function(){
				var is_checked = ( this.input.checked == true );
				var inputs = this.content.querySelectorAll("input, select")

				if ( is_checked ) {
					this.output.setAttribute("value", "on");
				} else{
					this.output.setAttribute("value", "off");
				}

				for ( var j = 0; j < inputs.length; j++ ){

					if ( is_checked ) {
						inputs[j].removeAttribute("readonly", "");
					} else {
						inputs[j].setAttribute("readonly", "");
					}

				}

			}

			this.check_single();
			this.input.addEventListener("change", this.check_single.bind(this) );
			
		}
	}

	//******************** SLIDER ********************//
	thrixty.AutoloadPlugins.Sliders = function (){
		this.init = function (){
			var sliders_output = document.querySelectorAll("[data-thrixty-slider-value]");

			for (var i = 0; i < sliders_output.length; i++) {
				new thrixty.AutoloadPlugins.Sliders.Slider(sliders_output[i]);
			}
		}
	}

	thrixty.AutoloadPlugins.Sliders.Slider = function ( slider_output ){
		this.slider_output = slider_output;

		this.slider = document.querySelector("#" + this.slider_output.getAttribute("data-thrixty-slider-value"));
		
		this.allow_infinity = ( this.slider_output.getAttribute( "data-thrixty-slider-allow-infinity" ) == "true" );
		this.infinity_input = document.querySelector( "[data-thrixty-slider-infinity]" );
		
		this.change();
		this.slider.addEventListener("input", this.change.bind(this) )
	}

	thrixty.AutoloadPlugins.Sliders.Slider.prototype.change = function (){
		if ( !this.allow_infinity ) {
			this.slider_output.innerHTML = this.slider.value;
		} else {

			if ( this.infinity_input != null ) {

				if ( this.slider.value == this.slider.max) {
					this.slider_output.innerHTML = "&infin;";
					this.infinity_input.value = true;
				} else {
					this.slider_output.innerHTML = this.slider.value;
					this.infinity_input.value = false;
				}

			}

		}
	}

	//******************** CHECKBOX ALL ********************//
	thrixty.AutoloadPlugins.CheckboxesAll = function (){
		this.init = function (){
			var checkbox_containers = document.querySelectorAll("[data-thrixty-checkbox-all]");
			for (var i = 0; i < checkbox_containers.length; i++) {
				new thrixty.AutoloadPlugins.CheckboxesAll.CheckboxAll( checkbox_containers[i] );
			}
		}
	}

	thrixty.AutoloadPlugins.CheckboxesAll.CheckboxAll = function ( container ){
		this.container = container;
		this.root = container.querySelector("[data-thrixty-checkbox-all-root]");
		this.items = container.querySelectorAll("[data-thrixty-checkbox-all-item]");

		this.root.addEventListener("change", this.change.bind(this));
	}

	thrixty.AutoloadPlugins.CheckboxesAll.CheckboxAll.prototype.change = function (){
		if ( this.root.checked ) {

			for (var i = 0; i < this.items.length; i++) {
				this.items[i].checked = true;
			}

		} else {

			for (var i = 0; i < this.items.length; i++) {
				this.items[i].checked = false;
			}

		}
	}

	//******************** THRIXTY STANDARD ********************//
	thrixty.AutoloadPlugins.ThrixtyStandards = function (){
		this.init = function (){
			var standards_containers = document.querySelectorAll(".thrixty_standard");
			for (var i = 0; i < standards_containers.length; i++) {
				new thrixty.AutoloadPlugins.ThrixtyStandards.ThrixtyStandard(standards_containers[i]);
			}
		}
	}

	thrixty.AutoloadPlugins.ThrixtyStandards.ThrixtyStandard = function ( thrixty_standard_container ){
	this.thrixty_standard_container = thrixty_standard_container;
	this.input = thrixty_standard_container.querySelector(".thrixty_standard_input");
	this.checkbox = thrixty_standard_container.querySelector(".thrixty_standard_check");

	if ( this.checkbox != null && this.input != null ) {
			this.checkbox.addEventListener("change", this.change.bind(this) );
			this.change();
		}
	}

	thrixty.AutoloadPlugins.ThrixtyStandards.ThrixtyStandard.prototype.change = function (){
		if ( this.checkbox.checked ) {
			this.input.setAttribute("readonly", "");
		} else {
			this.input.removeAttribute("readonly");
		}
	}

	//******************** CLOSE DIALOG ********************//
	thrixty.AutoloadPlugins.Close = function (){

		this.init = function (){

			jQuery( "#thrixty_overlay" ).bind( "click", this.close_all_dialogs );
			jQuery( document ).keyup(function ( event ){
				if( event.which == 27){ this.close_all_dialogs(); }
			}.bind(this));
		}
	}

	thrixty.AutoloadPlugins.Close.prototype.close_all_dialogs = function (){
		jQuery( "#thrixty_overlay" ).hide();
		
		var dialogs = jQuery( ".thrixty_dialog" );
		for (var i = 0; i < dialogs.length; i++) {
			jQuery( dialogs[i] ).hide();
		}
	}
}
