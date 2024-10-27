<?php	
	namespace Thrixty\views;
	use Thrixty\classes\View;
	use Thrixty\classes\Globals;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class View_Tutorial extends View {


		public function print (){
			if ( $this->step != null ) {
				?>
					<div class="thrixty_dialog_overlay" id="thrixty_tutorial_overlay"></div>
					<div id='thrixty_tutorial_dialog' class='thrixty_dialog'>
						<div id='thrixty_tutorial_dialog_container'>
							<div class='thrixty_row thrixty_dialog_headline' id='thrixty_tutorial_dialog_headline'>
								<div class='column'>
									<h1>
										<?php
											switch ( $this->step ) {
												case "thrixty_about":
													Globals::print_label("headline_intro.html");
												break;
												case "thrixty_settings":
													Globals::print_label("headline_default_settings.html");
												break;
												case "thrixty_all_players":
													Globals::print_label("headline_all_players.html");
												break;
												case "thrixty_all_layouts":
													Globals::print_label("headline_all_layouts.html");
												break;
												case "thrixty_edit_player":
													Globals::print_label("headline_edit_player.html");
												break;
												case "thrixty_edit_layout":
													Globals::print_label("headline_edit_layout.html");
												break;
												case "post":
													Globals::print_label("headline_insert_shortcode.html");
												break;
											}
										?>
									</h1>
								</div>
							</div>
							<div class='thrixty_row thrixty_margin-50 thrixty_dialog_subheadline' id='thrixty_tutorial_dialog_subheadline'>
								<div class='column'>
									<span>
										<?php
											switch ( $this->step ) {
												case "thrixty_about":
													Globals::print_label("content_intro.html");
												break;
												case "thrixty_settings":
													Globals::print_label("content_default_settings.html");
												break;
												case "thrixty_all_players":
													Globals::print_label("content_all_players.html");
												break;
												case "thrixty_all_layouts":
													Globals::print_label("content_all_layouts.html");
												break;
												case "thrixty_edit_player":
													Globals::print_label("content_edit_player.html");
												break;
												case "thrixty_edit_layout":
													Globals::print_label("content_edit_layout.html");
												break;
												case "post":
													Globals::print_label("content_insert_shortcode.html");
												break;
											}
										?>
									</span>
								</div>
							</div>
							<div class='thrixty_row'>
								<form action="" method="post">
									<div class="thrixty_button_container">
										<?php
											if ( $this->step == "thrixty_about" ) {
												?>
													<div class="column small-12 medium-6">
														<button name="thrixty_tutorial_action" value="cancle_tutorial" class="thrixty_button inline thrixty_alert" type="submit">
															<?php Globals::print_label("tutorial_cancel.html"); ?>
														</button>
													</div>
													<div class="column small-12 medium-6 thrixty-text-right">
														<input type="hidden" name="tutorial_step_done" value="thrixty_about">
														<button name="thrixty_tutorial_action" value="step_done" class="thrixty_button inline thrixty_primary" type="submit">
															<?php Globals::print_label("tutorial_start.html"); ?>
														</button>
													</div>
												<?php
											} else {
												?>
													<div class="column thrixty-text-right">
														<input type="hidden" name="tutorial_step_done" value="<?php echo $this->step ?>">
														<button name="thrixty_tutorial_action" value="step_done" class="thrixty_button inline thrixty_primary" type="submit">
															<?php Globals::print_label("tutorial_step_done.html"); ?>
														</button>
													</div>
												<?php
											}
										?>
										
									</div>
								</form>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						document.addEventListener("DOMContentLoaded", function (){
							jQuery("#thrixty_tutorial_dialog").show();
							jQuery("#thrixty_tutorial_overlay").show();

							jQuery("#thrixty_tutorial_dialog").find(".close_button").on("click", function ( element ){
								jQuery("#thrixty_tutorial_dialog").hide();
								jQery("#thrixty_tutorial_overlay").hide();
							}.bind(this));
						});
					</script>
				<?php
			}
		}
	}
?>
