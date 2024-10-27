"use strict";

/*
*
* Create fuchsedv namespace if it not exists
*/
var thrixty = thrixty || {

	init: function (){
		var auto_load_plugins = new thrixty.AutoloadPlugins();
    		auto_load_plugins.init();
	},

	debounce: function (func, wait, immediate) {
		var timeout;

		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate){
					func.apply(context, args);
				}
			}

			var callNow = immediate && !timeout;

			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow){
				func.apply(context, args);
			}
		}
	},
	starts_with: function ( string, starts_with ){
		return string.indexOf(starts_with) == 0;
	},
	ends_with: function ( string, ends_with ){
		return string.indexOf(ends_with) == ( string.length - ends_with.length );
	}
};

thrixty.ManuallyLoadPlugins = function () {}

thrixty.AutoloadPlugins = function () {

	this.init = function(){
    var keys = Object.keys( thrixty.AutoloadPlugins );
		for( var i = 0; i < keys.length; i++ ){
			try{
				var current_plugin = new thrixty.AutoloadPlugins[keys[i]]();
					current_plugin.init();
			} catch(e) {
				console.log( "Thrixty Wordpress Plugin: There was an error in the module '" + keys[ i ] + "'." );
				console.log( e );
			}
		}
	}

}

document.addEventListener("DOMContentLoaded", thrixty.init);
