<?php
	use Thrixty\classes\Globals;
?>

<div class="thrixty_dialog_overlay" id="thrixty_overlay"></div>
<div id="thrixty_view_import_dialog" class='thrixty_dialog'>
	<div class='thrixty_row thrixty_dialog_headline' id='thrixty_view_import_dialog_headline'>
		<div class='column'>
			<h1><?php Globals::print_label("tool_import_headline.html"); ?></h1>
		</div>
	</div>
	<div class='thrixty_row thrixty_dialog_close' id='thrixty_view_import_dialog_close'>
		<div class='column'>
			<i class='fa fa-close fa-2x close_button'></i>
		</div>
	</div>
	<div class='thrixty_row thrixty_margin-50 thrixty_dialog_subheadline' id='thrixty_view_import_dialog_subheadline'>
		<div class='column'>
			<span>
					<?php Globals::print_label("tool_import_text.html"); ?>
			</span>
		</div>
	</div>
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="thrixty_row">
			<div class="column">
				<label for="thrixty_view_import_file_input" id="thrixty_view_import_overlay_file" class="thrixty_button_container">
					<input class="input" type="file" name="import" value="filepath" accept=".sql,.txt" id="thrixty_view_import_file_input">
					<span class="label thrixty_button thrixty_secondary"><?php Globals::print_label("button_choose_file.html"); ?></span>
					<span class="filename" id="thrixty_view_import_file_output"></span>
				</label>
			</div>
		</div>
		<div class="thrixty_row">
			<div class="thrixty_button_container column">
				<button class="thrixty_button thrixty_expanded thrixty_primary" name="action" value="import" id="thrixty_view_import_file_submit"><?php Globals::print_label("button_import.html"); ?></button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	document.addEventListener( "DOMContentLoaded", function (){

		/**
		*
		* Bind click event on the close button
		*/
		jQuery("#thrixty_view_import_dialog_close").find(".close_button").on("click", function ( element ){
			jQuery("#thrixty_view_import_dialog").hide();
			jQuery("#thrixty_overlay").hide();
		});

		/**
		*
		* Bind click event on the open button
		*/
		jQuery("[data-thrixty-open-dialog='thrixty_view_import_dialog_close']").on("click", function ( element ){
			jQuery("#thrixty_view_import_dialog").show();
			jQuery("#thrixty_overlay").show();
		});
	});
</script>
