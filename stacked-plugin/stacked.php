<?php
/*
Plugin Name: Stacked Plugin
Plugin URI: http://www.jumping-duck.com
Description: Adds custom post types and shortcodes for the Stacked Theme.
Version: 1.0
Author: Eric Mann
Author URI: http://www.eamann.com
License: GPL3
*/

add_filter( 'stacked-installed', '__return_true' );

if( ! defined('STACKED_PLUGIN_DIR') )
	define( 'STACKED_PLUGIN_DIR', WP_PLUGIN_URL . '/stacked-plugin' );

require_once('/lib/class.stacked.php');

add_action( 'init', 'Stacked::register_people' );
?>