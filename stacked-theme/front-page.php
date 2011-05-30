<?php
/**
 * Template Name: Stacked
 * This file handles stacked/long-format pages
 *
 * @package StackedTheme
 */
if('stack'==get_post_type()){
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', array( 'Stacked_Theme', 'stack_loop' ) );
}

genesis();