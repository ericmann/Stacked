<?php
class Stacked {
	public static function init() {
		add_image_size( 'headshot', 120, 140, true );
	}

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
			'supports' => array('title','editor', 'thumbnail')
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
		if('' == $query->query_vars['post_type'] && 0 != $query->query_vars['page_id'])
			$query->query_vars['post_type'] = array( 'page', 'stack' );
	}

	public static function enter_name_here( $title ) {
		$screen = get_current_screen();

		if ( 'person' == $screen->post_type )
			$title = "Enter Team Member's Name";

		return $title;
	}

	public static function person_meta_box() {
		global $post;
		$title = get_post_meta($post->ID, 'person_title', true);
		$email = get_post_meta($post->ID, 'person_email', true);
		$phone = get_post_meta($post->ID, 'person_phone', true);
		$linkedin = get_post_meta($post->ID, 'person_linkedin', true);
		$twitter = get_post_meta($post->ID, 'person_twitter', true);
		$website = get_post_meta($post->ID, 'person_website', true);

		echo'<input type="hidden" name="person_meta_nonce" id="person_meta_nonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

		echo '<table><tbody>';
	  	echo '<tr><td><label for="person_title" style="margin-right: 10px;">Team Member Title:</label></td>';
	  	echo '<td><input type="text" name="person_title" value="' . $title . '" size="100" /></td></tr>';

		echo '<tr><td><label for="person_email" style="margin-right: 10px;">Team Member Email:</label></td>';
		echo '<td><input type="text" name="person_email" value="' . $email . '" size="100" /></td></tr>';

		echo '<tr><td><label for="person_phone" style="margin-right: 10px;">Team Member Phone:</label></td>';
		echo '<td><input type="text" name="person_phone" value="' . $phone . '" size="100" /></td></tr>';

		echo '<tr><td><label for="person_linkedin" style="margin-right: 10px;">LinkedIn Profile:</label></td>';
		echo '<td><input type="text" name="person_linkedin" value="' . $linkedin . '" size="100" /></td></tr>';

		echo '<tr><td><label for="person_twitter" style="margin-right: 10px;">Twitter Profile:</label></td>';
		echo '<td><input type="text" name="person_twitter" value="' . $twitter . '" size="100" /></td></tr>';

		echo '<tr><td><label for="person_website" style="margin-right: 10px;">Website:</label></td>';
		echo '<td><input type="text" name="person_website" value="' . $website . '" size="100" /></td></tr>';

		echo '</tbody></table>';
	}

	public static function save_person_meta( $post_id ) {
		global $post;

		if( ! wp_verify_nonce( $_POST["person_meta_nonce"], plugin_basename(__FILE__) ) )
			return $post_id;

		if( 'person' == $_POST['post_type'] && ! current_user_can( 'edit_post', $post_id ))
			return $post_id;

		$meta = array(
			'person_title' => $_POST['person_title'],
			'person_email' => $_POST['person_email'],
			'person_phone' => $_POST['person_phone'],
			'person_linkedin' => $_POST['person_linkedin'],
			'person_twitter' => $_POST['person_twitter'],
			'person_website' => $_POST['person_website']
		);

		foreach($meta as $key=>$value){
			if( "" == $value) {
				delete_post_meta( $post_id, $key );
			} else if( "" == get_post_meta($post_id, $key, true) ) {
				add_post_meta( $post_id, $key, $value, true );
			} else if( get_post_meta($post_id, $key, true) != $value ) {
				update_post_meta($post_id, $key, $value);
			}
		}
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

	public static function add_meta_boxes(){
		add_meta_box('person-additional-info', 'Additional Information', array('Stacked', 'person_meta_box'), 'person', 'normal', 'high');
	}

	public static function add_headshot() {
		remove_meta_box( 'postimagediv', 'person', 'side' );
		add_meta_box( 'postimagediv', __('Headshot', 'stacked'), 'post_thumbnail_meta_box', 'person', 'side' );
	}

	public static function rename_headshot( $featured ) {
		if( strpos($featured, 'Set featured image') != 0 )
			$featured = str_replace('Set featured image', 'Set team member headshot', $featured);

		if( strpos($featured, 'Remove featured image') != 0 )
			$featured = str_replace('Remove featured image', 'Remove team member headshot', $featured);
		return $featured;
	}
}
