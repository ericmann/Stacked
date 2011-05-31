<?php
/**
 * Template Name: Blog
 * This file handles blog pages.
 *
 * @package StackedTheme
 */

$include = genesis_get_option('blog_cat');
$exclude = genesis_get_option('blog_cat_exclude') ? explode(',', str_replace(' ', '', genesis_get_option('blog_cat_exclude'))) : '';
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$cf = genesis_get_custom_field('query_args'); /** Easter Egg **/
$showposts = apply_filters('stacked_show_posts', 2);
$args = array('cat' => $include, 'category__not_in' => $exclude, 'showposts' => $showposts, 'paged' => $paged);
$query_args = wp_parse_args($cf, $args);

Stacked_Theme::post_loop( $query_args );