<?php

/**
 * This file should contain frontend JavaScript that 
 * will be applied to individual module instances.
 *
 * You have access to three variables in this file: 
 * 
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 *
 */

 ?>

(function($) {
	// For testing :)
	//	console.log('Module ID: <?php echo $id; ?>');
	//	console.log('Heading: <?php echo $settings->map_heading; ?>');

	// Initialize and add the map
	// The city of Toronto
	const toronto = { lat: 43.6534817, lng: -79.3839347 };
	// The map, centered at Toronto
	const map = new google.maps.Map(document.getElementById("<?php echo 'dale-google-map-' . $id; ?>"), {
		zoom: 12,
		center: toronto,
		mapTypeId: '<?php echo $settings->map_type; ?>'
	});

	<?php if ( !empty( $settings->map_pins ) ) { ?>

		// Create an info window to share between markers.
		const infoWindow = new google.maps.InfoWindow();

		<?php foreach ( $settings->map_pins as $i => $val ) { ?>

			<?php if ( isset( $val->restaurant_description ) ) { ?>
				var place_title_<?php echo $i; ?> = <?php echo "'" . esc_html( $val->restaurant_name ) . "';"; ?>
			<?php } ?>
			<?php if ( isset( $val->restaurant_description ) ) { ?>
				var place_description_<?php echo $i; ?> = <?php echo  "'" . esc_html( $val->restaurant_description ) . "';"; ?>
			<?php } ?>

			var latLng = { lat: <?php echo $val->latitude; ?>, lng: <?php echo $val->longitude; ?> };
		
			var marker_<?php echo $i; ?> = new google.maps.Marker({
				position: latLng,
				map,
				title: place_title_<?php echo $i; ?>,
				label: '',
				optimized: false,
			});
			
			<?php if ( count( $settings->map_pins ) > 1 ) { ?>
				// Bounds for the map
				var bounds = new google.maps.LatLngBounds();
				
				bounds.extend(marker_<?php echo $i; ?>.position);

				// Extend the map to fit the marker bounds
				//	map.fitBounds(bounds);
			<?php } ?>
			
			// Add a click listener for each marker, and set up the info window.
			marker_<?php echo $i; ?>.addListener("click", function() {
				infoWindow.close();
				infoWindow.setContent('<div class="dale-info-window"><h6>'+place_title_<?php echo $i; ?>+'</h6><p>'+place_description_<?php echo $i; ?>+'</p></div>');
				infoWindow.open(marker_<?php echo $i; ?>.getMap(), marker_<?php echo $i; ?>);
			});
		<?php } ?>
	<?php } ?>

})(jQuery);