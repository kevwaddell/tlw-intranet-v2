<?php
$to = $send_to;
$subject = "Your Room Booking has been canceled.";
$message = "<h3>This message is to notify you that your room booking has been canceled.</h3>";
$message .= "<br>";
$message .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"10\"><tbody><thead>";
$message .= "<tr><th colspan=\"2\" bgcolor=\"#989898\">MEETING DETAILS</th></tr></thead>";
$message .= "<tbody><tr><td width=\"20%\" bgcolor=\"#C0C0C0\">Meeting description:</td><td bgcolor=\"#D8D8D8\"><strong>". $description ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Meeting room:</td><td bgcolor=\"#D8D8D8\"><strong>".  $room[0]->name ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Date:</td><td bgcolor=\"#D8D8D8\"><strong>".  date('D jS F Y', $meeting_date_convert) ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Time:</td><td bgcolor=\"#D8D8D8\"><strong>".  gmdate('H:i', $start_time) ." - ". gmdate('H:i', $end_time). "</strong></td></tr></tbody>";
$message .= "<tfoot><tr><td bgcolor=\"#C0C0C0\">Canceled on:</td><td bgcolor=\"#D8D8D8\"><strong>". date('D jS F Y', $now) ." at ". date('H:i', $now)  . "</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Canceled by:</td><td bgcolor=\"#D8D8D8\"><strong>". $from_name . "</strong></td></tr></tfoot>";
$message .= "</table><br><br>";
$headers = "From: $admin_name <$admin_email>";

$am_to = $admin_email;
$am_subject = "Room booking cancelation.";
$am_message = "<h3>A room booking has been canceled.</h3>";
$am_message .= "<br>";
$am_message .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"10\"><tbody><thead>";
$am_message .= "<tr><th colspan=\"2\" bgcolor=\"#989898\">MEETING DETAILS</th></tr></thead>";
$am_message .= "<tbody><tr><td width=\"20%\" bgcolor=\"#C0C0C0\">Meeting description:</td><td bgcolor=\"#D8D8D8\"><strong>". $description ."</strong></td></tr>";
$am_message .= "<tr><td bgcolor=\"#C0C0C0\">Meeting room:</td><td bgcolor=\"#D8D8D8\"><strong>".  $room[0]->name ."</strong></td></tr>";
$am_message .= "<tr><td bgcolor=\"#C0C0C0\">Date:</td><td bgcolor=\"#D8D8D8\"><strong>".  date('D jS F Y', $meeting_date_convert) ."</strong></td></tr>";
$am_message .= "<tr><td bgcolor=\"#C0C0C0\">Time:</td><td bgcolor=\"#D8D8D8\"><strong>".  gmdate('H:i', $start_time) ." - ". gmdate('H:i', $end_time). "</strong></td></tr></tbody>";
$am_message .= "<tfoot><tr><td bgcolor=\"#C0C0C0\">Canceled on:</td><td bgcolor=\"#D8D8D8\"><strong>". date('D jS F Y', $now) ." at ". date('H:i', $now)  . "</strong></td></tr>";
$am_message .= "<tr><td bgcolor=\"#C0C0C0\">Canceled by:</td><td bgcolor=\"#D8D8D8\"><strong>". $from_name . "</strong></td></tr></tfoot>";
$am_message .= "</table><br><br>";
$am_headers = "From: $from_name <$from_email>";

//echo '<pre>';print_r($message);echo '</pre>';

function wps_set_content_type(){
	return "text/html";
	}
add_filter( 'wp_mail_content_type','wps_set_content_type' );

wp_mail( $to, $subject, $message, $headers );
wp_mail( $am_to, $am_subject, $am_message, $am_headers );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
?>