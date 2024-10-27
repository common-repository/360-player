<?php
	use Thrixty\classes\Globals;
?>

<?php
	if ( isset( $this->export ) && $this->export != "" ) {
		?>
			<div id="thrixty_view_export_dialog" class='thrixty_dialog'>
				<div class='thrixty_row thrixty_dialog_headline' id='thrixty_view_export_dialog_headline'>
					<div class='column'>
						<h1><?php Globals::print_label("tool_export_headline.html"); ?></h1>
					</div>
				</div>
				<div class='thrixty_row thrixty_dialog_close' id='thrixty_view_export_dialog_close'>
					<div class='column'>
						<i class='fa fa-close fa-2x close_button'></i>
					</div>
				</div>
				<div class='thrixty_row thrixty_margin-50 thrixty_dialog_subheadline' id='thrixty_view_export_dialog_subheadline'>
					<div class='column'>
						<span>
							<?php Globals::print_label("tool_export_text.html"); ?>
						</span>
					</div>
				</div>
				<div class="thrixty_row">
					<div class="column">
						<textarea class="thrixty_textarea" id="thrixty_view_export_text">
							<?php echo $this->export; ?>
						</textarea>
					</div>
				</div>
				<div class="thrixty_row">
					<div class="thrixty_button_container column">
						<a class="thrixty_button thrixty_primary" id="thrixty_view_export_submit"><?php Globals::print_label("button_save_as_file.html"); ?></a>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function (){

					/**
					*
					* Open the dialog and the overlay
					* Bind click event on the close button
					*/
					jQuery("#thrixty_view_export_dialog").show();
					jQuery("#thrixty_overlay").show();

					jQuery("#thrixty_view_export_dialog_close").find(".close_button").on("click", function ( element ){
						jQuery("#thrixty_view_export_dialog").hide();
						jQuery("#thrixty_overlay").hide();
					});
					
				});
			</script>
		<?php
	}
?>