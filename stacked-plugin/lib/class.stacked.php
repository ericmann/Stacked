<?php
class Stacked {
	public static function register_people() {
		$labels = array(
			'name' => __('People', 'stacked'),
			'singular_name' => __('Person', 'stacked'),
			'add_new' => __('Add New', 'stacked'),
			'add_new_item' => __('Add New Person', 'stacked'),
			'edit_item' => __('Edit Person', 'stacked'),
			'new_item' => __('New Person', 'stacked'),
			'view_item' => __('View Person', 'stacked'),
			'search_items' => __('Search People', 'stacked'),
			'not_found' =>  __('No people found', 'stacked'),
			'not_found_in_trash' => __('No people found in Trash', 'stacked'),
			'parent_item_colon' => '',
			'menu_name' => 'People'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => 5,
			'menu_icon' => STACKED_PLUGIN_DIR . '/images/people.png',
			'supports' => array('title','editor')
		);

		register_post_type( 'person',$args );
	}

	public static function register_stacks() {
		$labels = array(
			'name' => __('Stacks', 'stacked'),
			'singular_name' => __('Stack', 'stacked'),
			'add_new' => __('Add New', 'stacked'),
			'add_new_item' => __('Add New Stack', 'stacked'),
			'edit_item' => __('Edit Stack', 'stacked'),
			'new_item' => __('New Stack', 'stacked'),
			'view_item' => __('View Stack', 'stacked'),
			'search_items' => __('Search Stacks', 'stacked'),
			'not_found' =>  __('No stacks found', 'stacked'),
			'not_found_in_trash' => __('No stacks found in Trash', 'stacked'),
			'parent_item_colon' => '',
			'menu_name' => 'Stacks'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'page',
			'has_archive' => false,
			'hierarchical' => true,
			'menu_position' => 20,
			'menu_icon' => STACKED_PLUGIN_DIR . '/images/stacks.png',
			'supports' => array('title')
		);

		register_post_type( 'stack',$args );
	}

	public static function enable_front_page_stacks( $query ){
		$query->query_vars['post_type'] = array( 'page', 'stack' );
	}

	public static function enter_name_here( $title ) {
		$screen = get_current_screen();

		if ( 'person' == $screen->post_type )
			$title = "Enter Team Member's Name";

		return $title;
	}

	public static function stack_pages($atts, $content = null) {
		return "Yay!";
	}

	public static function add_pages_to_dropdown( $pages, $r ){
		if('page_on_front' == $r['name']){
			$stackArgs = array(
				'post_type'=>'stack'
			);
			$stacks = get_posts($stackArgs);
			$pages = array_merge($pages, $stacks);
		}

		return $pages;
	}
}
