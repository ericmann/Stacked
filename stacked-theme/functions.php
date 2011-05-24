<?php
if ( ! apply_filters( 'stacked-installed', false ) )
	add_action( 'admin_notices', 'stacked_plugin_not_installed' );

function stacked_plugin_not_installed() {
	echo '<div id="message" class="error">
		<p>This theme requires the Stacked Plugin for proper operation.  Please install it to ensure proper functionality!</p>
	</div>';
}

/** Start the engine **/
require_once(TEMPLATEPATH.'/lib/init.php');
?>