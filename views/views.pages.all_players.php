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

	class View_AllPlayers extends View {

		private function print_players ( $list ){

			foreach( $list as $key => $player ) {
				$link = "?page=thrixty_edit_player&mode=edit&id=" . $player->id;
				?>	
					<a class="thrixty_row thrixty_list_link_item" href="<?php echo $link; ?>">
						<div class="column small-2 medium-1">
							<span><input class="thrixty_input" type="checkbox" name="player_action[<?php echo $player->id; ?>]" data-thrixty-checkbox-all-item=""></span>
						</div>
						<div class="column small-2 medium-2 large-2">
							<?php echo $player->id; ?>
						</div>
						<div class="column small-8 medium-3 large-2">
							<?php echo $player->player_name; ?>
						</div>
						<div class="column medium-3 large-4 thrixty-hide-for-small">
							<?php echo $player->player_description; ?>
							</td>
						</div>
						<div class="column medium-3 large-3 thrixty-hide-for-small">
							<code><?php echo "[". Thrixty::SHORTCODE_PLAYERS ." id='" . $player->id . "']"; ?></code>
						</div>
					</a>
				<?php
			}
			if ( count( $list ) <= 0 ) {
				?>
					<div class="row thrixty_list_item">
						<div class="column thrixty-text-center">
							<i><?php Globals::print_label("error_no_players.html"); ?></i>
						</div>	
					</div>
				<?php
			}
		}

		public function print (){
			include Globals::print_component("view_page_export.php");
			include Globals::print_component("view_page_import.php");

			?>
				<div id="container">
					<form action="" method="POST">
						<div class="thrixty_row">
							<div class="column" data-thrixty-checkbox-all>
								<form action="" method="POST">
									<h1><?php Globals::print_label("all_players_menu_title.html"); ?></h1>
									
									<div class="thrixty_row thrixty_list_item">
										<div class="column small-2 medium-1">
											<input class="thrixty_input" type="checkbox" data-thrixty-checkbox-all-root="">
										</div>
										<div class="column small-2 medium-2 large-2">
											ID
										</div>
										<div class="column small-8 medium-3 large-2">
											<?php Globals::print_label("pages_table_header_name.html"); ?>
										</div>
										<div class="column medium-3 large-4 thrixty-hide-for-small">
											<?php Globals::print_label("pages_table_header_description.html"); ?>
										</div>
										<div class="column medium-3 large-3 thrixty-hide-for-small">
											Shortcode
										</div>
									</div>

									<?php $this->print_players( $this->list ); ?>
									<?php include Globals::print_component("view_page_action_buttons.php"); ?>
								</form>
							</div>
						</div>
					</form>
				</div>
			<?php
		}

	}

?>