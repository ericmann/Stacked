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
			<?php do_action( 'genesis_after_post_title' ); ?>

			<?php do_action( 'genesis_before_post_content' ); ?>
			<div class="entry-content">
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

	public static function post_info() {
		if ( is_page() )
			return;

		$post_info = '[post_date format="m.j.y"]';
		printf( '<div class="post-info">%s</div>', apply_filters('genesis_post_info', $post_info) );
	}
}