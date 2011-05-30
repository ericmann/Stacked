<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', array( 'Stacked_Theme', 'stack_loop' ) );

genesis();