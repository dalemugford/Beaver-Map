<?php

/**
 * @class FLExampleModule
 */
class FLExampleModule extends FLBuilderModule {

	// Where we'll assign the API key
	private $api_key = 'AIzaSyCGnR8WuTgw90AOCeSbDU-IptgadLGgkEc';

	// The Google Maps URL
	private $google_url = 'https://maps.googleapis.com/maps/api/js?key=';

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct() {
        parent::__construct(
			array(
				'name'          => __('Custom Google Maps', 'fl-builder'),
				'description'   => __('A custom Google Maps Module with pins.', 'fl-builder'),
				'category'		=> __('Media', 'fl-builder'),
				'dir'           => DALE_MODULE_EXAMPLES_DIR . 'modules/dale-google-map/',
				'url'           => DALE_MODULE_EXAMPLES_URL . 'modules/dale-google-map/',
				'editor_export' => true, // Defaults to true and can be omitted.
				'enabled'       => true, // Defaults to true and can be omitted.
				'icon'			=> 'location.svg'
       		)
		);

		// Setting the API Key, defaults to my key for now
		$this->api_key = isset( $settings->map_api_key ) ? $settings->map_api_key : 'AIzaSyCGnR8WuTgw90AOCeSbDU-IptgadLGgkEc';
        
        // Register and enqueue Google Maps
        $this->add_js('dale-google-maps', $this->google_url . $this->api_key, array(), '', true);
    }

    /** 
     * Use this method to work with settings data before 
     * it is saved. You must return the settings object. 
     *
     * @method update
     * @param $settings {object}
     */      
    public function update($settings){
        // $settings->textarea_field .= ' - this text was appended in the update method.';
        
        return $settings;
    }

    /** 
     * This method will be called by the builder
     * right before the module is deleted. 
     *
     * @method delete
     */      
    public function delete(){
		// Nothing yet
    }

    /** 
     * Add additional methods to this class for use in the 
     * other module files such as preview.php, frontend.php
     * and frontend.css.php.
     * 
     *
     * @method example_method
     */   
    public function example_method(){
		// some custom stuff here
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLExampleModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Custom Google Map Settings', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
					// Google Maps API Key
                    'map_api_key'     => array(
                        'type'          => 'text',
                        'label'         => __('Google Maps Key', 'fl-builder'),
                        'default'       => '',
                        'maxlength'     => '100',
                        'size'          => '40',
                        'placeholder'   => '',
                        'class'         => 'dale-google-map-key',
                        'description'   => '',
                        'help'          => __('Your Google Maps API Key', 'fl-builder'),
                    ),
					// Heading of the map
					'map_heading'     => array(
                        'type'          => 'text',
                        'label'         => __('Map Heading', 'fl-builder'),
                        'default'       => __('My Custom Map', 'fl-builder'),
                        'maxlength'     => '100',
                        'size'          => '40',
                        'placeholder'   => '',
                        'class'         => 'dale-google-map-heading',
                        'description'   => '',
                        'help'          => __('The title for your map', 'fl-builder'),
                        'preview'         => array(
                            'type'             => 'css',
                            'selector'         => '.dale-google-map',
                            'property'         => 'font-size',
                            'unit'             => 'px'
						),
                    ),
					// Heading font size
					'map_heading_font_size' => array(
						'type'        => 'unit',
						'label'       => __('Map Heading Font Size', 'fl-builder'),
						'description' => 'px',
						'placeholder' => 32,
						'responsive'  => true,
					),
					// Google Maps tile type
                    'map_type'   => array(
                        'type'          => 'select',
                        'label'         => __('Map Type', 'fl-builder'),
                        'default'       => 'roadmap',
                        'options'       => array(
                            'roadmap'     => __('Roadmap', 'fl-builder'),
                            'satellite'   => __('Satellite', 'fl-builder'),
                        )
                    ),
					'map_height' => array(
						'type'       => 'unit',
						'label'      => __( 'Map Height', 'fl-builder' ),
						'default'    => '400',
						'sanitize'   => 'absint',
						'responsive' => true,
						'units'      => array( 'px', 'vh' ),
						'slider'     => array(
							'px' => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 10,
							),
						),
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.dale-google-map-div',
							'property' => 'height',
						),
					),
					// The pins on the map
                    'map_pins'     => array(
                        'type'          => 'form',
                        'label'         => __('Map Pin', 'fl-builder'),
                        'form'          => 'dale_settings_form', // ID from registered form below
						'multiple'		=> true
                    ),
                )
            )
        )
    )
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('dale_settings_form', array(
    'title' => __('Map Pins', 'fl-builder'),
    'tabs'  => array(
        'general'      => array( // Tab
            'title'         => __('Pins', 'fl-builder'), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => '', // Section Title
                    'fields'        => array( // Section Fields
                        'restaurant_name'       => array(
                            'type'          => 'text',
                            'label'         => __('Restaurant Name', 'fl-builder'),
                            'default'       => 'Richmond Station'
						),
						'restaurant_description'   => array(
							'type'          => 'textarea',
							'label'         => __('Restaurant Description', 'fl-builder'),
							'default'       => 'A great place to chill.',
							'rows'          => 4
						),
						'latitude'       => array(
                            'type'          => 'text',
                            'label'         => __('Latitude', 'fl-builder'),
                            'default'       => '43.6514803'
						),
						'longitude'       => array(
                            'type'          => 'text',
                            'label'         => __('Longitude', 'fl-builder'),
                            'default'       => '-79.3795117'
						),
						)
                )
            )
        )
    )
));