<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'stack_loop' );

function stack_loop() {
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
			switch(get_post_meta( get_the_ID(), '_wp_page_template', true )) {
				case 'page_blog.php':
					include('page_blog.php');
					break;
				case 'page_team.php':
					include('page_team.php');
					break;
				case 'page_contact.php':
					include('page_contact.php');
					break;
				default:
					include('page_default.php');
			}

		endwhile;

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

genesis();