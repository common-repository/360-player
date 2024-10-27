<?php
	/**
	*
	* @package Thrixty Player
	* @subpackage classes.mvc
	* @author Finn Reißmann
	* @version 3.0
	*/
	
	namespace Thrixty\classes;

	/**
	*
	* Block direct access to this file
	*/
	defined( "ABSPATH" ) or die();


	/**
	*
	* MVC Controller
	*
	* @author Finn Reißmann
	* @since 3.0
	*/
	abstract class Controller {

		private $model;
		private $view;

		/**
		*
		* MVC Controller constructor
		*
		* @author Finn Reißmann
		* @since 3.0
		* @param Model model
		* @param View view
		*/
		public function __construct ( Model $model, View $view ){
			$this->model = $model;
			$this->view = $view;
		}

		/**
		*
		* Get the model
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return Model model
		*/
		public function get_model (){ return $this->model; }

		/**
		*
		* Get the view
		*
		* @author Finn Reißmann
		* @since 3.0
		* @return View view
		*/
		public function get_view (){ return $this->view; }

		/**
		*
		* Run the controller
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function run ();

		/**
		*
		* Execute the actions
		*
		* @author Finn Reißmann
		* @since 3.0
		* @abstract
		*/
		public abstract function action();
	}

?>
