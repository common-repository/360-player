<?php
	namespace Thrixty\views;
	use Thrixty\classes\View;
	use Thrixty\classes\Thrixty;
	use Thrixty\classes\Globals;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class View_LandingPage extends View {

		public function print (){
			?>
				<?php Globals::print_label("page_landing_page_text.html"); ?>

				<div class="thrixty_row">
					<div class="column small-12 medium-8">
						<fieldset class="thrixty_fieldset" id="thrixty_options_paths">
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
									<?php Globals::print_label("player_options_basepath_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_basepath_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_filelist_small_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_filelist_small_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_filelist_large_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_filelist_large_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_basepath_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_use_basepath_description.html"); ?>
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
									<?php Globals::print_label("player_options_play_direction_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_play_direction_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_drag_direction_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_play_direction_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_drag_direction_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_drag_direction_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_autoplay_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_autoplay_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_autoload_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_autoload_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_cycle_duration_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_cycle_duration_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_sensitivity_x_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_sensitivity_x_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_repetition_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_repetition_description.html"); ?>
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
									<?php Globals::print_label("player_options_enable_controls_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_enable_controls_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_display_buttons_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_display_buttons_description.html"); ?>
								</div>
							</div>
						</fieldset>

						<fieldset class="thrixty_fieldset">
							<legend><?php Globals::print_label("player_options_category_zoom.html"); ?></legend>
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
									<?php Globals::print_label("player_options_zoom_mode_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_zoom_mode_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_zoom_control_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_zoom_control_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_zoom_pointer_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_zoom_pointer_description.html"); ?>
								</div>
							</div>
							<div class="thrixty_row thrixty_list_item">
								<div class="column small-12 medium-3">
									<?php Globals::print_label("player_options_outbox_position_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_outbox_position_description.html"); ?>
								</div>
							</div>
						</fieldset>

						<fieldset class="thrixty_fieldset">
							<legend><?php Globals::print_label("player_options_category_fullpage.html"); ?></legend>
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
									<?php Globals::print_label("player_options_fullpage_mode_name.html"); ?>
								</div>
								<div class="column small-12 medium-9">
									<?php Globals::print_label("player_options_fullpage_mode_description.html"); ?>
								</div>
							</div>
						</fieldset>
					</div>	
				</div>
				<br>
				<div class="thrixty_row">
					<div class="column">
						<h1><?php Globals::print_label("page_landing_page_about.html"); ?></h1>
						<?php include Globals::print_component("address.html"); ?>
					</div>
				</div>
				<br>
				<div class="thrixty_row">
					<div class="column">
						<h1><?php Globals::print_label("page_landing_page_license.html"); ?></h1>
						<pre><?php echo file_get_contents( THRIXTY_HOME_PATH . "license.txt" ); ?></pre>
					</div>
				</div>
			<?php
		}

	}

?>
