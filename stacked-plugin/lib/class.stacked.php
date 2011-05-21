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

	public static function enter_name_here( $title ) {
		$screen = get_current_screen();

		if ( 'person' == $screen->post_type )
			$title = "Enter Team Member's Name";

		return $title;
	}

	public static function stack_pages($atts, $content = null) {
		return "Yay!";
	}
}
