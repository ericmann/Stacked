<?php
/**
 * Template Name: Stacked
 * This file handles stacked/long-format pages
 *
 * @package StackedTheme
 */

if('stack'==get_post_type()){
	include('stacked-front-page.php');
} else {
	include('standard-front-page.php');
}