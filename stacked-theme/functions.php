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

genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_footer', 'genesis_do_footer' );

add_filter('genesis_options', 'define_genesis_setting_custom', 10, 2);
function define_genesis_setting_custom($options, $setting) {
    if($setting == GENESIS_SETTINGS_FIELD) {
        $options['site_layout'] = 'full-width-content';
    }
    return $options;
}
?>