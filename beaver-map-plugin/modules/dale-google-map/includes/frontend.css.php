<?php 
/**
 * This file should contain frontend styles that 
 * will be applied to individual module instances.
 *
 * You have access to three variables in this file: 
 * 
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 *
 * Example: 
 */

// Height
FLBuilderCSS::responsive_rule( array(
	'settings'     => $settings,
	'setting_name' => 'map_height',
	'selector'     => "#dale-google-map-$id, #dale-google-map-$id iframe",
	'prop'         => 'height',
) );

?>

.fl-node-<?php echo $id; ?> h3 {
    font-size: <?php echo $settings->map_heading_font_size; ?>px;
}