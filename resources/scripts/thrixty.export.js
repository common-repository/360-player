"use strict";

if ( typeof thrixty !== "undefined" ) {

	thrixty.AutoloadPlugins.Export = function (){}
	thrixty.AutoloadPlugins.Export.prototype.init = function (){
		this.submit = document.querySelector("#thrixty_view_export_submit");
		this.text = document.querySelector("#thrixty_view_export_text");

		if ( this.submit != null && this.text != null ) {

	   	this.text.innerHTML = this.text.innerHTML.replace(/\s\s+/g, "");

			this.submit.addEventListener("click", function (){

				var today = new Date();

				var day = today.getDate();
				var month = today.getMonth() + 1; //January is 0!
				var year = today.getFullYear();
				var hour = today.getHours();
				var minute = today.getMinutes();

				var date_string = day + "." + month + "." + year + "_" + hour + "." + minute;

				this.submit.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent( this.text.value ));
				this.submit.setAttribute('download', "thrixty_export_" + date_string + ".sql");

			}.bind(this));

		}

	}
}