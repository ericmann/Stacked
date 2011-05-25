<?php
/**
 * Template Name: Contact
 * This file handles contact pages.
 *
 * @package StackedTheme
 */

if(!empty($_POST['send_mail']) && empty($_POST['e-mail'])) {
	$to = get_option('admin_email');
	$subject = "Contact Form Submission";

	$message = "Message from your website:\n\n";
	$message .= "From: " . stripslashes($_POST["cfname"]) . "\n";
	$message .= "Email: " . $_POST["cfemail"] . "\n";
	$message .= "Phone: " . $_POST["cfphone"] . "\n";
	$message .= "Message: " . stripslashes($_POST["cfmessage"]) . "\n\n";
	$message .= "IP Address: " . $_SERVER["REMOTE_ADDR"] . "\n\n";
	$message .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n\n";

	$from = $_POST["cfemail"];
	$headers = "From: ".$_POST["cfemail"];

	wp_mail($to, $subject, $message, $headers);
	$sent = true;
}

?>

<?php if($sent == true) { ?>
	<h2>Thank You!</h2>
	<p><strong>Your message has been sent.</strong></p>
<?php }else{ ?>
	<h2>Contact Form</h2>
<?php } ?>
<p id="message" class="hidden"></p>
<div class="contactForm">
	<form method="post" target="_self" action="" onsubmit="javascript:return validate(this);">
		<div class="field"><label>Your Name</label><input type="text" name="cfname" class="textbox" /></div>
		<div class="field"><label>Your Email</label><input type="text" name="cfemail" class="textbox" /></div>
		<div class="field"><label>Your Phone</label><input type="text" name="cfphone" class="textbox" /></div>
		<div class="field"><label>Message</label><textarea cols="5" rows="5" class="textarea" name="cfmessage" tabindex="4">Enter your message...</textarea></div>
		<div class="field"><input type="submit" value="SEND MESSAGE" class="submit" name="send_mail" class="button" /></div>
		<input type="hidden" name="e-mail" />
	</form>
</div>