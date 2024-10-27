"use strict";

if ( typeof thrixty !== "undefined" ) {

	thrixty.ManuallyLoadPlugins.Tinymcelabels = function (){
		this.labels = {};
	}
	thrixty.ManuallyLoadPlugins.Tinymcelabels.prototype.init = function (){
		jQuery.ajax({
			url: ajaxurl,
			async: false,
			type: "POST",
			dataType: "json",
			data: {
				action: "thrixty_get_tinymce_label"
			},
			success: function ( response ){
				if ( response.data != undefined ) {
					this.labels = JSON.parse( response.data );
				}
			}.bind(this)
		});
	}

	thrixty.ManuallyLoadPlugins.Tinymcelabels.prototype.get_label = function ( key ){
		var elements = key.split( "." );
		var result = this.labels;

		for (var i = 0; i < elements.length; i++) {
			if ( result[ elements[ i ] ] != undefined ) {
				result = result[ elements[ i ] ];
			}	
		}

		if ( typeof( result ) == "object" || typeof( result ) == "array" ) { return ""; }
		else if ( typeof( result ) == "integer" ){ return intval( result ); }
		else { return result; }
	}
}