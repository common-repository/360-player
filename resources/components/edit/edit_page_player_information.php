<?php
	use Thrixty\classes\Globals;
	use Thrixty\classes\Thrixty;
?>
<div class="thrixty_row" id="player_information">
	<div class="column">
		<fieldset class="thrixty_fieldset">
			<legend>
				<?php
					$current_page = Globals::GET("page");
					if ( $current_page == "thrixty_edit_player" ) { Globals::print_label( "page_edit_player_placeholder_headline.html" ); }
					else if ( $current_page == "thrixty_edit_layout" ){ Globals::print_label( "page_edit_layout_placeholder_headline.html" ); }
				?>
			</legend>
			<div class="thrixty_row thrixty_list_item">
				<div class="small-12 medium-4 large-3 column">
					<label for="name">Name</label>
				</div>
				<div class="small-12 medium-8 large-9 column">
					<input class="thrixty_input" type="text" name="player_name" id="name" placeholder="<?php
								if ( $current_page == "thrixty_edit_player" ) { Globals::print_label( "page_edit_player_placeholder_name.html" ); }
								else if ( $current_page == "thrixty_edit_layout" ){ Globals::print_label( "page_edit_layout_placeholder_name.html" ); }
							?>" value="<?php echo $this->player_name; ?>"
						>
				</div>
			</div>
			<div class="thrixty_row thrixty_list_item">
				<div class="small-12 medium-4 large-3 column">
					<label for="description">Beschreibung</label>
				</div>
				<div class="small-12 medium-8 large-9 column">
					<input class="thrixty_input" type="text" name="player_description" id="description" placeholder="<?php
								if ( $current_page == "thrixty_edit_player" ) { Globals::print_label( "page_edit_player_placeholder_description.html" ); }
								else if ( $current_page == "thrixty_edit_layout" ){ Globals::print_label( "page_edit_layout_placeholder_description.html" ); }
							?>" value="<?php echo $this->player_description; ?>"
						>
				</div>
			</div>
			<div class="thrixty_row thrixty_list_item">
				<div class="small-12 medium-4 large-3 column">
					<label>Shortcode</label>
				</div>
				<div class="small-12 medium-8 large-9 column">
					<code type="text" disabled="">
							[<?php echo Thrixty::SHORTCODE_PLAYERS?> id=<?php echo $this->current_id; ?> ]
						</code>
				</div>
			</div>
		</fieldset>
	</div>
</div>
