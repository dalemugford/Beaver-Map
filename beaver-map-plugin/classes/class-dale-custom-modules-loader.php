<?php
	
/**
 * Custom Class to Load our custom BB Modules
 */
class Dale_Custom_Module_Loader {
	
	/**
	 * Initializes the class once all plugins have loaded.
	 */
	static public function init() {
		add_action( 'plugins_loaded', __CLASS__ . '::setup_hooks' );
	}
	
	/**
	 * Setup hooks if BB is installed and activated.
	 */
	static public function setup_hooks() {
		if ( ! class_exists( 'FLBuilder' ) ) {
			return;	
		}
		
		// Load custom modules.
		add_action( 'init', __CLASS__ . '::load_modules' );

	}
	
	/**
	 * Loads our custom module.
	 */
	static public function load_modules() {
		// require_once DALE_MODULE_EXAMPLES_DIR . 'modules/basic-example/basic-example.php';
		require_once DALE_MODULE_EXAMPLES_DIR . 'modules/dale-google-map/dale-google-map.php';
	}

}

Dale_Custom_Module_Loader::init();