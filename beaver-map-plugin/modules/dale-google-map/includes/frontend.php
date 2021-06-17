<?php
/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 * 
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 */

?>
<div class="dale-google-map">
    <h3 class="dale-google-title dale-google-title-<?php echo $id; ?>">
		<?php echo $settings->map_heading; ?>
	</h3>

	<br />

	<div id="<?php echo 'dale-google-map-' . $id; ?>" class="dale-google-map-div"></div>

</div>