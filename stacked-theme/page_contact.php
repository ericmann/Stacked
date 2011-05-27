<?php
/**
 * Template Name: Contact
 * This file handles contact pages.
 *
 * @package StackedTheme
 */

if(!empty($_POST['send_mail']) && empty($_POST['e-mail'])) {
	$to = get_bloginfo('admin_email');
	$subject = "Contact Form Submission";

	$message = "Message from your website:\n\n";
	$message .= "From: " . stripslashes($_POST["cfname"]) . "\n";
	$message .= "Email: " . $_POST["cfemail"] . "\n";
	$message .= "Organization: " . $_POST["cforg"] . "\n";
	$message .= "Message: " . stripslashes($_POST["cfmessage"]) . "\n\n";
	$message .= "IP Address: " . $_SERVER["REMOTE_ADDR"] . "\n\n";
	$message .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n\n";

	$from = $_POST["cfemail"];
	$headers = "From: ".$_POST["cfemail"];

	wp_mail($to, $subject, $message, $headers);
	$sent = true;
}

?>
<div <?php post_class(); ?>>

	<?php do_action( 'genesis_before_post_title' ); ?>
	<?php do_action( 'genesis_post_title' ); ?>
	<?php do_action( 'genesis_after_post_title' ); ?>

	<?php do_action( 'genesis_before_post_content' ); ?>

	<div class="entry-content">
		<?php if($sent == true) { ?>
		<h2>Thank You!</h2>
		<p><strong>Your message has been sent.</strong></p>
		<?php }else{ ?>
		<?php the_content(); ?>
		<?php } ?>
		<p id="message" class="hidden"></p>
		<div class="contactForm">
			<form method="post" target="_self" action="" onsubmit="javascript:return validate(this);">
				<table>
					<tr>
					<td>
						<div class="field"><label>Name</label><input type="text" name="cfname" class="textbox" /></div>
					</td>
					<td>
						<div class="field"><label>Email</label><input type="text" name="cfemail" class="textbox" /></div>
					</td>
				</tr>
				<tr>
				<td valign="top">
					<div class="field"><label>Organization</label><input type="text" name="cforg" class="textbox" /></div>
				</td>
				<td>
					<div class="field"><label>Tell us what you're looking for</label><textarea cols="5" rows="5" class="textarea" name="cfmessage" tabindex="4"></textarea></div>
				</td>
				</tr>
				<tr align="center">
					<td colspan="2">
						<div class="field"><input type="submit" value="SEND MESSAGE" class="submit" name="send_mail" class="button" /></div>
					</td>
				</tr>
			</table>
				<input type="hidden" name="e-mail" />
			</form>
		</div>
	</div>
<?php do_action( 'genesis_after_post_content' ); ?>

</div><!-- end .postclass -->
<?php

do_action( 'genesis_after_post' );
?>