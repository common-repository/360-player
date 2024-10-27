<?php
	namespace Thrixty\views;
	use Thrixty\classes\View;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();

	class View_Frontend extends View {

		public function print (){
			$html_output = "";

			if ( isset( $this->options ) ) {

				foreach ($this->options as $key => $value) {
					$this->$key = $value;
				}
				$this->options = array();

				$id =  ( isset($id) ? $id : 0 );
				$namespace = "data-thrixty-";
				
				/**
				*
				* Create the HTML code
				*/
				$html_output .= "<div class='thrixty' tabindex='" . $id . "' id='thrixty_player_" . $id . "' ";

					$html_output .= $namespace . "basepath='" . $this->basepath . "' ";
					$html_output .= $namespace . "filelist-path-small='" . $this->small_path . "' ";
					$html_output .= $namespace . "filelist-path-large='" . $this->large_path . "' ";
					$html_output .= $namespace . "use-basepath='" . $this->use_basepath . "' ";

					$html_output .= $namespace . "play-direction='" . $this->play_direction . "' ";
					$html_output .= $namespace . "drag-direction='" . $this->drag_direction . "' ";
					$html_output .= $namespace . "autoplay='" . $this->autoplay . "' ";
					$html_output .= $namespace . "autoload='" . $this->autoload . "' ";
					$html_output .= $namespace . "cycle-durection='" . $this->cycle_duration . "' ";
					$html_output .= $namespace . "sensitivity-x='" . $this->sensitivity_x . "' ";
					$html_output .= $namespace . "repetition='" . $this->repetition . "' ";
					$html_output .= $namespace . "enable-controls='" . $this->enable_controls . "' ";
					$html_output .= $namespace . "display-buttons='" . $this->display_buttons . "' ";
					$html_output .= $namespace . "zoom-mode='" . $this->zoom_mode . "' ";
					$html_output .= $namespace . "zoom-control='" . $this->zoom_control . "' ";
					$html_output .= $namespace . "zoom-pointer='" . $this->zoom_pointer . "' ";
					$html_output .= $namespace . "outbox-position='" . $this->outbox_position . "' ";
					$html_output .= $namespace . "fullpage-mode='" . $this->fullpage_mode . "'";

				$html_output .= "></div>";
			}

			return $html_output;
		}

	}
?>
