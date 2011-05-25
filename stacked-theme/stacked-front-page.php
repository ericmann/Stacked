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
		$pageLoop = new WP_Query(
			array(
				'name' => $slug,
				'post_type' => 'page'
			)
		);

		while( $pageLoop->have_posts() ) : $pageLoop->the_post();

			do_action( 'genesis_before_post' ); ?>

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
		endwhile;

		do_action( 'genesis_after_endwhile' );
	}
}

genesis();