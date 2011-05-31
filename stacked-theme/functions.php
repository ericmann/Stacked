<?php
require_once('lib/class.stacked-theme.php');

if ( ! apply_filters( 'stacked-installed', false ) )
	add_action( 'admin_notices', array('Stacked_Theme', 'plugin_not_installed') );

/** Start the engine **/
require_once(TEMPLATEPATH.'/lib/init.php');

genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
remove_action( 'genesis_after_post', 'genesis_get_comments_template' );

add_editor_style();

add_action( 'genesis_before_post_title', array('Stacked_Theme', 'post_info') );
add_action( 'wp_enqueue_scripts', array('Stacked_Theme', 'enqueue_scripts') );
add_action( 'genesis_after_post', array( 'Stacked_Theme', 'genesis_get_comments_template' ) );

add_filter( 'post_class', array('Stacked_Theme', 'more_less_filter') );
add_filter( 'genesis_options', array('Stacked_Theme', 'setting_custom'), 10, 2 );

?>