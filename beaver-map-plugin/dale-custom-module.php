<?php
/**
 * Plugin Name: Dale's Beaver Builder Custom Modules
 * Plugin URI: http://www.flowpress.com
 * Description: Custom BB Map Module
 * Version: 1.0
 * Author: Dale Mugford
 * Author URI: http://www.flowpress.com
 */
define( 'DALE_MODULE_EXAMPLES_DIR', plugin_dir_path( __FILE__ ) );
define( 'DALE_MODULE_EXAMPLES_URL', plugins_url( '/', __FILE__ ) );

require_once DALE_MODULE_EXAMPLES_DIR . 'classes/class-dale-custom-modules-loader.php';

/* Adding my own debug log writing ability if debug is enabled */
if ( !function_exists( 'debug_log' ) ) {
    function debug_log( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        } else { 
			return;
		}
    }
}