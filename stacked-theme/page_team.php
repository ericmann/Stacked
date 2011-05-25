<?php
/**
 * Template Name: Team
 * This file handles team listings pages.
 *
 * @package StackedTheme
 */
$args = array(
	'post_type' => 'person'
);

	global $wp_query, $more, $loop_counter;
	$loop_counter = 0;

	/** save the original query **/
	$orig_query = $wp_query;

	$wp_query = new WP_Query($args);
	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
	$more = 0;

	$title = get_post_meta(get_the_ID(), 'person_title', true);
	$email = get_post_meta(get_the_ID(), 'person_email', true);
	$phone = get_post_meta(get_the_ID(), 'person_phone', true);
	$linkedin = get_post_meta(get_the_ID(), 'person_linkedin', true);
	$twitter = get_post_meta(get_the_ID(), 'person_twitter', true);
	$website = get_post_meta(get_the_ID(), 'person_website', true);


	do_action( 'genesis_before_post' );
?>
	<div <?php post_class(); ?>>

	<div class="person-name"><?php the_title(); ?></div>

	<?php if( "" != $title ) { ?>
		<div class="person-title"><?php echo $title; ?></div>
	<?php } ?>

	<?php if( "" != $email ) { ?>
		<div class="person-email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
	<?php } ?>

	<?php if( "" != $phone ) { ?>
		<div class="person-phone"><?php echo $phone; ?></div>
	<?php } ?>

	<?php if( "" != $linkedin ) { ?>
		<div class="person-linkedin"><a href="http://linkedin.com/in/<?php echo $linkedin; ?>" target="_blank">LinkedIn</a></div>
	<?php } ?>

	<?php if( "" != $twitter ) { ?>
		<div class="person-twitter"><a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank">Twitter</a></div>
	<?php } ?>

	<div class="person-bio">
		<?php the_content(); ?>
	</div>

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