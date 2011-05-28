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

/*
 * Copyright 2011  Eric Mann, Jumping Duck Media
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 3 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

add_filter( 'stacked-installed', '__return_true' );

if( ! defined('STACKED_PLUGIN_DIR') )
	define( 'STACKED_PLUGIN_DIR', WP_PLUGIN_URL . '/stacked-plugin' );

require_once('lib/class.stacked.php');

add_action( 'init', array('Stacked', 'init') );
add_action( 'init', array('Stacked', 'register_people') );
add_action( 'init', array('Stacked', 'register_stacks') );
add_action( 'admin_init', array('Stacked', 'add_meta_boxes') );
add_action( 'save_post', array('Stacked', 'save_person_meta') );
add_action( 'save_post', array('Stacked', 'save_stack_meta') );
add_action( 'do_meta_boxes', array('Stacked', 'add_headshot') );
add_action( 'pre_get_posts', array('Stacked', 'enable_front_page_stacks') );

add_filter( 'enter_title_here', array('Stacked', 'enter_name_here') );
add_filter( 'get_pages', array('Stacked', 'add_pages_to_dropdown'), 10, 2 );
add_filter( 'admin_post_thumbnail_html', array('Stacked', 'rename_headshot'), 10 );
?>