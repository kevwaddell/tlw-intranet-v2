<?php 
$from_name = $rb_admin['display_name'];
$from_email = $rb_admin['user_email'];

$to = $send_to;
$subject = "Room booking confirmation";
$message = "<h3>Your room booking has been successful.</h3>";
$message .= "<hr><br>";
$message .= "This message is to confirm your room booking request has been approved by <strong>".$from_name."</strong>.<br>";
$message .= "You may now view your meeting details and add or notify meeting attendees.<br><br>";
$message .= "<a href=\"".get_permalink($_GET['meetingid'])."\" title=\"\">View Meeting details >></a><br>";
$headers = "From: $from_name <$from_email>";

function wps_set_content_type(){
	return "text/html";
	}
add_filter( 'wp_mail_content_type','wps_set_content_type' );

wp_mail( $to, $subject, $message, $headers );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

 ?>