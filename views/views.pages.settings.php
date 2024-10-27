<?php
	namespace Thrixty\views;
	use Thrixty\classes\Globals;
	use Thrixty\classes\View;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class View_Settings extends View {

		public function print (){
			Globals::print_label("page_default_settings_text.html");

			?>
				<form action="" method="post">
					<div class="thrixty_row">
						<div class="column small-12 medium-12 large-8">
					
							<fieldset class="thrixty_fieldset">
								<legend><?php Globals::print_label("player_options_category_paths.html"); ?></legend>

								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
									</div>
									<div class="column small-12 medium-9">
										<strong><?php Globals::print_label("pages_table_header_description.html"); ?></strong>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_basepath_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_basepath_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<input class="thrixty_input" name='default_options[basepath]' size='40' type='text'
											value='<?php echo $this->basepath; ?>' />
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_filelist_small_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_filelist_small_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<input class="thrixty_input" name='default_options[filelist_path_small]' size='40' type='text'
												value="<?php echo $this->filelist_path_small; ?>" />
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_filelist_large_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_filelist_large_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<input class="thrixty_input" name='default_options[filelist_path_large]' size='40' type='text'
												value="<?php echo $this->filelist_path_large; ?>" />
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_use_basepath_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_use_basepath_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<label for="plugin_use_basepath" class="thrixty_switch">
											<input type="checkbox" name="default_options[use_basepath]" id="plugin_use_basepath"
												<?php echo $this->use_basepath == "on" ? "checked" : "" ?>
											>
											<div>
												<div class="off"><?php Globals::print_label("off.html"); ?></div>
												<div class="off"><?php Globals::print_label("on.html"); ?></div>
											</div>
										</label>
									</div>
								</div>
							</fieldset>
						
							<fieldset class="thrixty_fieldset">
								<legend><?php Globals::print_label("player_options_category_player.html"); ?></legend>
								
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
									</div>
									<div class="column small-12 medium-9">
										<strong><?php Globals::print_label("pages_table_header_description.html"); ?></strong>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_play_direction_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_play_direction_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<select class="thrixty_select" name='default_options[play_direction]'>
											<option <?php $this->is_selected("play_direction", "normal"); ?> value="normal">
												Normal
											</option>
											<option <?php $this->is_selected("play_direction", "reverse"); ?> value="reverse">
												Reverse
											</option>
										</select>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_drag_direction_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_drag_direction_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<select class="thrixty_select" name='default_options[drag_direction]'>
											<option <?php $this->is_selected("drag_direction", "normal"); ?> value="normal">
												Normal
											</option>
											<option <?php $this->is_selected("drag_direction", "reverse"); ?> value="reverse">
												Reverse
											</option>
										</select>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_autoplay_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_autoplay_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<label for="plugin_autoplay" class="thrixty_switch">
											<input type="checkbox" name="default_options[autoplay]" id="plugin_autoplay"
												<?php echo $this->autoplay == "on" ? "checked" : "" ?>
											>
											<div>
												<div class="off"><?php Globals::print_label("off.html"); ?></div>
												<div class="off"><?php Globals::print_label("on.html"); ?></div>
											</div>
										</label>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_autoload_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_autoload_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<label for="plugin_autoload" class="thrixty_switch">
											<input type="checkbox" name="default_options[autoload]" id="plugin_autoload"
												<?php echo $this->autoload == "on" ? "checked" : "" ?>
											>
											<div>
												<div class="off"><?php Globals::print_label("off.html"); ?></div>
												<div class="off"><?php Globals::print_label("on.html"); ?></div>
											</div>
										</label>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_cycle_duration_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_cycle_duration_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<div class="thrixty_row">
											<div class="small-2 medium-2 large-2 column" data-thrixty-slider-value="thrixty_cycle_duration"></div>
											<div class="small-10 medium-10 large-10 column">
												<input class="thrixty_input" id='thrixty_cycle_duration' name='default_options[cycle_duration]' type='range' min="1" max="10" value="<?php echo $this->cycle_duration; ?>" />
											</div>
										</div>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_sensitivity_x_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_sensitivity_x_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<div class="thrixty_row">
											<div class="small-2 medium-2 large-2 column" data-thrixty-slider-value="thrixty_sensitivity_x"></div>
											<div class="small-10 medium-10 large-10 column">
												<input class="thrixty_input" id='thrixty_sensitivity_x' name='default_options[sensitivity_x]' type='range' min="1" max="100" value="<?php echo $this->sensitivity_x; ?>" />
											</div>
										</div>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_repetition_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_repetition_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<div class="thrixty_row">
											<div class="small-2 medium-2 large-2 column" data-thrixty-slider-value="thrixty_repetition" data-thrixty-slider-allow-infinity="true"></div>
											<div class="small-10 medium-10 large-10 column">
												<input data-thrixty-slider-infinity name="default_options[repetition_infinity]" type="hidden" value="<?php if( $this->repetition == "Infinity" ){ echo "true"; } else{ echo "false"; } ?>"/>
												<input id="thrixty_repetition" name="default_options[repetition]" type="range" min="1" max="11" class="thrixty_standard_input thrixty_input" value="<?php if( $this->repetition == "-1" ){ echo "11"; } else{ echo $this->repetition; } ?>"/>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						
							<fieldset class="thrixty_fieldset">
								<legend><?php Globals::print_label("player_options_category_view.html"); ?></legend>
								
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
									</div>
									<div class="column small-12 medium-9">
										<strong><?php Globals::print_label("pages_table_header_description.html"); ?></strong>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_enable_controls_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_enable_controls_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<label for="plugin_enable_controls" class="thrixty_switch">
											<input type="checkbox" name="default_options[enable_controls]" id="plugin_enable_controls"
												<?php echo $this->enable_controls == "on" ? "checked" : "" ?>
											>
											<div>
												<div class="off"><?php Globals::print_label("off.html"); ?></div>
												<div class="off"><?php Globals::print_label("on.html"); ?></div>
											</div>
										</label>
									</div>
								</div>
								<div class="thrixty_row thrixty_list_item">
									<div class="column small-12 medium-3">
										<div class="thrixty_tooltip">
											<span class="headline">
												<?php Globals::print_label("player_options_display_buttons_name.html"); ?>
											</span>
											<div class="tip">
												<?php Globals::print_label("player_options_display_buttons_description.html"); ?>
											</div>
										</div>
									</div>
									<div class="column small-12 medium-9">
										<label for="plugin_display_buttons" class="thrixty_switch">
											<input type="checkbox" name="default_options[display_buttons]" id="plugin_display_buttons"
												<?php echo $this->display_buttons == "on" ? "checked" : "" ?>
											>
											<div>
												<div class="off"><?php Globals::print_label("off.html"); ?></div>
												<div class="off"><?php Globals::print_label("on.html"); ?></div>
											</div>
										</label>
									</div>
								</div>
							</fieldset>
					
							<fieldset class="thrixty_fieldset toggle">
								<legend>
									<label for="thrixty_zoom_active" class="thrixty_switch_label"><?php Globals::print_label("player_options_category_zoom.html"); ?></label>&nbsp;

									<label for="thrixty_zoom_active" class="thrixty_switch with_label">
										<input type="checkbox" id="thrixty_zoom_active" class="toggle_input"
											<?php echo $this->zoom_active == "on" ? "checked" : "" ?>
										>
										<div>
											<div class="off"><?php Globals::print_label("off.html"); ?></div>
											<div class="off"><?php Globals::print_label("on.html"); ?></div>
										</div>
									</label>
								</legend>

								<div class="toggle_content">
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-12 medium-3">
											<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
										</div>
										<div class="column small-12 medium-9">
											<strong><?php Globals::print_label("pages_table_header_description.html"); ?></strong>
										</div>
									</div>
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-12 medium-3">
											<div class="thrixty_tooltip">
												<span class="headline">
													<?php Globals::print_label("player_options_zoom_mode_name.html"); ?>
												</span>
												<div class="tip">
													<?php Globals::print_label("player_options_zoom_mode_description.html"); ?>
												</div>
											</div>
										</div>
										<div class="column small-12 medium-9">
											<select class="thrixty_select" name='default_options[zoom_mode]'>
												<option <?php $this->is_selected("zoom_mode", "inbox"); ?> value="inbox">
													Inbox
												</option>
												<option <?php $this->is_selected("zoom_mode", "outbox"); ?> value="outbox">
													Outbox
												</option>
											</select>
											<input type="hidden" name="default_options[zoom_active]" value="on" class="toggle_output">
										</div>
									</div>
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-12 medium-3">
											<div class="thrixty_tooltip">
												<span class="headline">
													<?php Globals::print_label("player_options_zoom_control_name.html"); ?>
												</span>
												<div class="tip">
													<?php Globals::print_label("player_options_zoom_control_description.html"); ?>
												</div>
											</div>
										</div>
										<div class="column small-12 medium-9">
											<select class="thrixty_select" name='default_options[zoom_control]'>
												<option <?php $this->is_selected("zoom_control", "progressive"); ?> value="progressive">
													Progressive
												</option>
												<option <?php $this->is_selected("zoom_control", "classic"); ?> value="classic">
													Classic
												</option>
											</select>
										</div>
									</div>
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-12 medium-3">
											<div class="thrixty_tooltip">
												<span class="headline">
													<?php Globals::print_label("player_options_zoom_pointer_name.html"); ?>
												</span>
												<div class="tip">
													<?php Globals::print_label("player_options_zoom_pointer_description.html"); ?>
												</div>
											</div>
										</div>
										<div class="column small-12 medium-9">
											<select class="thrixty_select" name='default_options[zoom_pointer]'>
												<option <?php $this->is_selected("zoom_pointer", "minimap"); ?> value="minimap">
													Minimap
												</option>
												<option <?php $this->is_selected("zoom_pointer", "marker"); ?> value="marker">
													Marker
												</option>
												<option <?php $this->is_selected("zoom_pointer", "none"); ?> value="none">
													None
												</option>
											</select>
										</div>
									</div>
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-12 medium-3">
											<div class="thrixty_tooltip">
												<span class="headline">
													<?php Globals::print_label("player_options_outbox_position_name.html"); ?>
												</span>
												<div class="tip">
													<?php Globals::print_label("player_options_outbox_position_description.html"); ?>
												</div>
											</div>
										</div>
										<div class="column small-12 medium-9">
											<select class="thrixty_select" name='default_options[outbox_position]'>
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
						
							<fieldset class="thrixty_fieldset toggle">
								<legend>
								<label for="thrixty_fullpage_active" class="thrixty_switch_label"><?php Globals::print_label("player_options_category_fullpage.html"); ?></label>&nbsp;

									<label for="thrixty_fullpage_active" class="thrixty_switch with_label">
										<input type="checkbox" id="thrixty_fullpage_active" class="toggle_input"
											<?php echo $this->fullpage_active == "on" ? "checked" : "" ?>
										>
										<div>
											<div class="off"><?php Globals::print_label("off.html"); ?></div>
											<div class="off"><?php Globals::print_label("on.html"); ?></div>
										</div>
									</label>
								</legend>

								<div class="toggle_content">
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-12 medium-3">
											<strong><?php Globals::print_label("pages_table_header_option.html"); ?></strong>
										</div>
										<div class="column small-12 medium-9">
											<strong><?php Globals::print_label("pages_table_header_description.html"); ?></strong>
										</div>
									</div>
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-12 medium-3">
											<div class="thrixty_tooltip">
												<span class="headline">
													<?php Globals::print_label("player_options_fullpage_mode_name.html"); ?>
												</span>
												<div class="tip">
													<?php Globals::print_label("player_options_fullpage_mode_description.html"); ?>
												</div>
											</div>
										</div>
										<div class="column small-12 medium-9">
											<select class="thrixty_select" name='default_options[fullpage_mode]'>
												<option <?php $this->is_selected("fullpage_mode", "normal"); ?> value="normal">
													Normal
												</option>
											</select>
											<input type="hidden" name="default_options[fullpage_active]" value="on" class="toggle_output">
										</div>
									</div>
								</div>	
							</fieldset>
						</div>
					</div>		
					<div class="thrixty_row thrixty_button_container">
						<div class="small-12 column">
							<button name="submit" type="submit" class="thrixty_primary thrixty_button" value="save_standard_options">
								<i class="fa fa-check"></i> <?php Globals::print_label("button_save.html"); ?>
							</button>
						</div>	
					</div>
				</form>
			<?php
		}

	}

?>