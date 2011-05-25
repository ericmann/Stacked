<?php
do_action( 'genesis_before_post' );

if($stackCount > 1)
	echo '<hr />';
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