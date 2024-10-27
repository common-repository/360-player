"use strict";

if ( typeof thrixty !== "undefined" ) {

	thrixty.AutoloadPlugins.Import = function (){}
	thrixty.AutoloadPlugins.Import.prototype.init = function (){
		this.input = document.querySelector("#thrixty_view_import_file_input");
		this.output = document.querySelector("#thrixty_view_import_file_output");
		this.submit = document.querySelector("#thrixty_view_import_file_submit");

		if ( this.input != null && this.output != null && this.submit != null ) {

			this.check_submit();

			this.input.addEventListener("change", function (){
        var filename = "";
        if ( this.input.files != "undefined" && this.input.files.length == 1 ) {
          filename = this.input.files[0].name;
        }

        this.output.innerHTML = filename;

				this.check_submit();
			}.bind(this));

		}
	}

	thrixty.AutoloadPlugins.Import.prototype.check_submit = function (){
		if ( this.input.files.length <= 0 ) {
			this.submit.setAttribute( "readonly", "" );
		} else {
			this.submit.removeAttribute( "readonly" );
		}
	}
}
