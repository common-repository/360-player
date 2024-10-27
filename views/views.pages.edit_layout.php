<?php
	namespace Thrixty\views;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\View;
	use Thrixty\classes\Globals;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class View_EditLayout extends View {

		public function print (){
			?>
				<div id="container">
					<form action="?page=thrixty_edit_layout<?php if ( $this->mode == "edit" ) { echo "&mode=edit&id=" . $this->current_id; }?>" method="POST">
						<div class="thrixty_row">
							<div class="column column-12">

								<div class="thrixty_row" id="player_information_text">
									<div class="column column-12">
										<?php
											if ( $this->mode == "edit" ){ Globals::print_label("page_edit_layout_text_edit.html"); }
											else { Globals::print_label("page_edit_layout_text_new.html"); }
										?>
									</div>
								</div>

								<?php include Globals::print_component("edit_page_player_information.php"); ?>

								<div id="player_settings">
									<div class="thrixty_row">
										<div class="column small-12 medium-12 large-6">
											<fieldset class="thrixty_fieldset">
												<legend><?php Globals::print_label("player_options_category_player.html"); ?></legend>

												<input id="player_minimizer" type="checkbox" class="thrixty_minimizer_checkbox">
												<label for="player_minimizer" class="thrixty_minimizer_label fa"></label>

												<div class="content">

													<div class="thrixty_row thrixty_list_item">
														<div class="medium-4 large-3 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
														</div>
														<div class="medium-8 large-9 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_value.html"); ?></strong>
														</div>
													</div>

													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_play_direction_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_play_direction_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<select class="thrixty_select" name="play_direction">
																<option <?php $this->is_selected("play_direction", "normal"); ?> value="normal">
																	Normal
																</option>
																<option <?php $this->is_selected("play_direction", "reverse"); ?> value="reverse">
																	Reverse
																</option>
															</select>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_drag_direction_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_drag_direction_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<select class="thrixty_select" name="drag_direction">
																<option <?php $this->is_selected("drag_direction", "normal"); ?> value="normal">
																	Normal
																</option>
																<option <?php $this->is_selected("drag_direction", "reverse"); ?> value="reverse">
																	Reverse
																</option>
															</select>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_autoplay_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_autoplay_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<label for="thrixty_autoplay" class="thrixty_switch">
																<input type="checkbox" class="thrixty_input" name="autoplay" id="thrixty_autoplay" class=""
																	<?php $this->is_checked("autoplay"); ?>
																>
																<div>
																	<div class="off"><?php Globals::print_label("off.html"); ?></div>
																	<div class="off"><?php Globals::print_label("on.html"); ?></div>
																</div>
															</label>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_autoload_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_autoload_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<label for="thrixty_autoload" class="thrixty_switch">
																<input type="checkbox" class="thrixty_input" name="autoload" id="thrixty_autoload" class=""
																	<?php $this->is_checked("autoload"); ?>
																>
																<div>
																	<div class="off"><?php Globals::print_label("off.html"); ?></div>
																	<div class="off"><?php Globals::print_label("on.html"); ?></div>
																</div>
															</label>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_cycle_duration_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_cycle_duration_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<div class="thrixty_row">
																<div class="small-2 medium-2 large-2 column" data-thrixty-slider-value="thrixty_cycle_duration"></div>
																<div class="small-10 medium-10 large-10 column">
																	<input id="thrixty_cycle_duration" name="cycle_duration" type="range" min="1" max="10" class="thrixty_input" value="<?php echo $this->cycle_duration; ?>"/>
																</div>
															</div>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_sensitivity_x_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_sensitivity_x_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<div class="thrixty_row">
																<div class="small-2 medium-2 large-2 column" data-thrixty-slider-value="thrixty_sensitivity_x"></div>
																<div class="small-10 medium-10 large-10 column">
																	<input id="thrixty_sensitivity_x" name="sensitivity_x" type="range" min="1" max="100" class="thrixty_input" value="<?php echo $this->sensitivity_x; ?>" />
																</div>
															</div>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_repetition_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_repetition_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<div class="thrixty_row">
																<div class="small-2 medium-2 large-2 column" data-thrixty-slider-value="thrixty_repetition" data-thrixty-slider-allow-infinity="true"></div>
																<div class="small-10 medium-10 large-10 column">
																	<input data-thrixty-slider-infinity name="repetition_infinity" type="hidden" value="<?php if( $this->repetition == "-1" ){ echo "true"; } else{ echo "false"; } ?>"/>
																	<input id="thrixty_repetition" name="repetition" type="range" min="1" max="11" class="thrixty_standard_input thrixty_input" value="<?php if( $this->repetition == "-1" ){ echo "11"; } else{ echo $this->repetition; } ?>"/>
																</div>
															</div>
														</div>
													</div>	
											</fieldset>
										</div>

										<div class="column small-12 medium-12 large-6">
											<fieldset class="thrixty_fieldset">
												<legend><?php Globals::print_label("player_options_category_view.html"); ?></legend>

												<input id="view_minimizer" type="checkbox" class="thrixty_minimizer_checkbox">
												<label for="view_minimizer" class="thrixty_minimizer_label fa"></label>

												<div class="content">
													<div class="thrixty_row thrixty_list_item">
														<div class="medium-4 large-3 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
														</div>
														<div class="medium-8 large-9 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_value.html"); ?></strong>
														</div>
													</div>

													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_enable_controls_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_enable_controls_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<label for="thrixty_enable_controls" class="thrixty_switch">
																<input type="checkbox" class="thrixty_input" name="enable_controls" id="thrixty_enable_controls" class=""
																	<?php $this->is_checked("enable_controls"); ?>
																>
																<div>
																	<div class="off"><?php Globals::print_label("off.html"); ?></div>
																	<div class="off"><?php Globals::print_label("on.html"); ?></div>
																</div>
															</label>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_display_buttons_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_display_buttons_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<label for="thrixty_display_buttons" class="thrixty_switch">
																<input type="checkbox" class="thrixty_input" name="display_buttons" id="thrixty_display_buttons" class=""
																	<?php $this->is_checked("display_buttons"); ?>
																>
																<div>
																	<div class="off"><?php Globals::print_label("off.html"); ?></div>
																	<div class="off"><?php Globals::print_label("on.html"); ?></div>
																</div>
															</label>
														</div>
													</div>
												</div>
											</fieldset>
										</div>
									</div>

									<div class="thrixty_row">
										<div class="column small-12 medium-12 large-6">
											<fieldset class="thrixty_fieldset toggle">
												<legend>
													<label for="thrixty_zoom_active" class="switch_label"><?php Globals::print_label("player_options_category_zoom.html"); ?></label>&nbsp;

													<label for="thrixty_zoom_active" class="thrixty_switch with_label">
														<input type="checkbox" class="toggle_input thrixty_input" id="thrixty_zoom_active" name="zoom_active"
															<?php $this->is_checked("zoom_active"); ?>
														>
														<div>
															<div class="off"><?php Globals::print_label("off.html"); ?></div>
															<div class="off"><?php Globals::print_label("on.html"); ?></div>
														</div>
													</label>
												</legend>

												<input id="zoom_minimizer" type="checkbox" class="thrixty_minimizer_checkbox">
												<label for="zoom_minimizer" class="thrixty_minimizer_label fa"></label>

												<div class="content toggle_content">
													<div class="thrixty_row thrixty_list_item">
														<div class="medium-4 large-3 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
														</div>
														<div class="medium-8 large-9 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_value.html"); ?></strong>
														</div>
													</div>

													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_zoom_mode_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_zoom_mode_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<select class="thrixty_select" name="zoom_mode">
																<option <?php $this->is_selected("zoom_mode", "inbox"); ?> value="inbox">
																	Inbox
																</option>
																<option <?php $this->is_selected("zoom_mode", "outbox"); ?> value="outbox">
																	Outbox
																</option>
															</select>
															<input type="hidden" name="zoom_active" value="on" class="toggle_output" class="">
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_zoom_control_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_zoom_control_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<select class="thrixty_select" name="zoom_control">
																<option <?php $this->is_selected("zoom_control", "prograssive"); ?> value="prograssive">
																	Progressive
																</option>
																<option <?php $this->is_selected("zoom_control", "classic"); ?> value="classic">
																	Classic
																</option>
															</select>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_zoom_pointer_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_zoom_pointer_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<select class="thrixty_select" name="zoom_pointer">
																<option <?php $this->is_selected("zoom_pointer", "minimap"); ?> value="minimap">
																	Minimap
																</option>
																<option <?php $this->is_selected("zoom_pointer", "marker"); ?> value="marker">
																	Marker
																</option>
																<option <?php $this->is_selected("zoom_pointer", "none"); ?> value="normal">
																	None
																</option>
															</select>
														</div>
													</div>
													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_outbox_position_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_outbox_position_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<select class="thrixty_select" name="outbox_position">
																<option <?php $this->is_selected("outbox_position", "right"); ?> value="right">
																	Right
																</option>
																<option <?php $this->is_selected("outbox_position", "bottom"); ?> value="bottom">
																	Bottom
																</option>
																<option <?php $this->is_selected("outbox_position", "left"); ?> value="left">
																	Left
																</option>
																<option <?php $this->is_selected("outbox_position", "top"); ?> value="top">
																	Top
																</option>
															</select>
														</div>
													</div>
												</div>
											</fieldset>
										</div>

										<div class="column small-12 medium-12 large-6">
											<fieldset class="thrixty_fieldset toggle">
												<legend>
												<label for="thrixty_fullpage_active" class="switch_label"><?php Globals::print_label("player_options_category_fullpage.html"); ?></label>&nbsp;

													<label for="thrixty_fullpage_active" class="thrixty_switch with_label">
														<input type="checkbox" class="toggle_input thrixty_input" id="thrixty_fullpage_active" name="fullpage_active"
															<?php $this->is_checked("fullpage_active"); ?>
														>
														<div>
															<div class="off"><?php Globals::print_label("off.html"); ?></div>
															<div class="off"><?php Globals::print_label("on.html"); ?></div>
														</div>
													</label>
												</legend>

												<input id="fullpage_minimizer" type="checkbox" class="thrixty_minimizer_checkbox">
												<label for="fullpage_minimizer" class="thrixty_minimizer_label fa"></label>

												<div class="content toggle_content">
													<div class="thrixty_row thrixty_list_item">
														<div class="medium-4 large-3 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
														</div>
														<div class="medium-8 large-9 column thrixty-hide-for-small">
															<strong><?php Globals::print_label("pages_table_header_value.html"); ?></strong>
														</div>
													</div>

													<div class="thrixty_row thrixty_list_item thrixty_standard">
														<div class="small-12 medium-4 large-3 column">
															<div class="thrixty_tooltip">
																<span class="headline">
																	<?php Globals::print_label("player_options_fullpage_mode_name.html"); ?>
																</span>
																<div class="tip">
																	<?php Globals::print_label("player_options_fullpage_mode_description.html"); ?>
																</div>
															</div>
														</div>
														<div class="small-12 medium-8 large-9 column">
															<select class="thrixty_select" name="fullpage_mode">
																<option value="normal"
																	<?php echo $this->fullpage_mode == 'normal' ? 'selected' : ''; ?>>Normal
																</option>
															</select>
															<input type="hidden" name="fullpage_active" value="on" class="toggle_output">
														</div>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>

								<div class="thrixty_row thrixty_button_container">
									<div class="column">
										<button name="new_layout_action" value="submit" class="thrixty_button thrixty_primary" type="submit">
											<i class="fa fa-check"></i> <?php Globals::print_label("button_save.html"); ?>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			<?php
		}

	}

?>
