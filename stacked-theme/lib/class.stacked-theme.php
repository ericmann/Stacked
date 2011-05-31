<?php
 class Stacked_Theme {
	public static function plugin_not_installed() {
		echo '<div id="message" class="error">
			<p>This theme requires the Stacked Plugin for proper operation.  Please install it to ensure proper functionality!</p>
		</div>';
	}
	public static function enqueue_scripts(){
		if( ! is_admin() )
			wp_enqueue_script( 'stacked-script', get_bloginfo('stylesheet_directory') . '/scripts/stacked.js', array('jquery'), '1.0' );
	}

	public static function setting_custom($options, $setting) {
		if($setting == GENESIS_SETTINGS_FIELD) {
			$options['site_layout'] = 'full-width-content';
		}
		return $options;
	}

	public static function post_loop( $args = array() ) {
		global $wp_query, $more, $loop_counter;
		$loop_counter = 0;

		$defaults = array(); /** For forward compatibility **/
		$args = apply_filters('genesis_custom_loop_args', wp_parse_args($args, $defaults), $args, $defaults);

		/** save the original query **/
		$orig_query = $wp_query;

		$wp_query = new WP_Query($args);
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$more = 0;

		do_action( 'genesis_before_post' );
		?>
		<div <?php post_class(); ?>>

			<?php do_action( 'genesis_before_post_title' ); ?>
			<?php do_action( 'genesis_post_title' ); ?>
			<?php Stacked_Theme::more_less( get_the_ID() ); ?>
			<?php do_action( 'genesis_after_post_title' ); ?>

			<?php do_action( 'genesis_before_post_content' ); ?>
			<div class="entry-content post-<?php the_ID(); ?>">
				<?php do_action( 'genesis_post_content' ); ?>
			</div><!-- end .entry-content -->
			<?php do_action( 'genesis_after_post_content' ); ?>

		</div><!-- end .postclass -->
		<?php

		do_action( 'genesis_after_post' );
		$loop_counter++;

		endwhile; /** end of one post **/
		do_action( 'genesis_after_endwhile' );

		else : /** if no posts exist **/
		do_action( 'genesis_loop_else' );
		endif; /** end loop **/

		/** restore original query **/
		$wp_query = $orig_query; wp_reset_query();
	}

	public static function stack_loop() {
	$loop = new WP_Query(
		array(
			'post_type' => 'stack',
			'posts_per_page' => 1
		)
	);

	while( $loop->have_posts() ) : $loop->the_post();
		$postList = get_post_meta( get_the_ID(), 'stack', true );
	endwhile;

	$stackArray = explode(',', str_replace(' ', '', $postList));
	$stackCount = 0;

	foreach($stackArray as $slug) {
		$stackCount++;
		$pageLoop = new WP_Query(
			array(
				'name' => $slug,
				'post_type' => 'page'
			)
		);

		while( $pageLoop->have_posts() ) : $pageLoop->the_post();
			if($stackCount == 2)
				echo '<div class="stack-wrap">';

			echo '<a name="' . $slug . '"></a>';
			switch(get_post_meta( get_the_ID(), '_wp_page_template', true )) {
				case 'page_blog.php':
					include(get_stylesheet_directory() . '/page_blog.php');
					break;
				case 'page_team.php':
					include(get_stylesheet_directory() . '/page_team.php');
					break;
				case 'page_contact.php':
					include(get_stylesheet_directory() . '/page_contact.php');
					break;
				default:
					include(get_stylesheet_directory() . '/page_default.php');
			}

		endwhile;

		if( $stackCount == count($stackArray) )
			echo '</div>';

		do_action( 'genesis_after_endwhile' );
	}

	echo '<ul id="locked-navigation">';
	$stackCount = 0;
	foreach($stackArray as $slug){
		$stackCount++;
		$pageLoop = new WP_Query(
			array(
				'name' => $slug,
				'post_type' => 'any'
			)
		);

		while( $pageLoop->have_posts() ) : $pageLoop->the_post();
			if( $stackCount>1 )
			echo '<li class="navigation-el"><a href="#' . $slug . '">' . get_the_title() . '</a></li>';
		endwhile;
	}
	echo '</ul>';
}

	public static function post_info() {
		if ( is_page() || is_singular('stack') )
			return;

		$post_info = '[post_date format="m.j.y"]';
		printf( '<div class="post-info">%s</div>', apply_filters('genesis_post_info', $post_info) );
	}

	public static function more_less( $post_ID ){
		printf( '<div class="more-less less post-%s"></div>', $post_ID );
	}

	public static function more_less_filter( $classes ) {
		if( array_search('type-post', $classes) )
			$classes[] = 'less';
		
		return $classes;
	}

	public static function genesis_get_comments_template() {
		if ( is_singular('stack') )
			return;

		// Load comments only if we are on a page or post and only if comments or trackbacks are chosen
		if ( is_single() && ( genesis_get_option( 'trackbacks_posts' ) || genesis_get_option( 'comments_posts' ) ) )
			comments_template( '', true );
		elseif ( is_page() && ( genesis_get_option( 'trackbacks_pages' ) || genesis_get_option( 'comments_pages' ) ) )
			comments_template( '', true );
		return;
	}
}