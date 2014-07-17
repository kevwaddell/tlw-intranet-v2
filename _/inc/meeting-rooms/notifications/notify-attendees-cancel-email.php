<?php 
$default_tz = date_default_timezone_get();
date_default_timezone_set('Europe/London'); 
$now = strtotime("now");
	
$from_name = $current_user->data->display_name;
$from_email = $current_user->data->user_email;

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
$send_to = implode(", ", $to_arr);
} else {
$send_to = 	"kevwaddell@icloud.com, kwaddelltlw@icloud.com, kwaddellTLW@gmail.com";
}

$to = $send_to;
$subject = "Meeting cancelation.";
$message = "<h3>This message is to notify you that the <font style=\"color:red\">".$description."</font> meeting has been canceled.</h3>";
$message .= "<br>";
$message .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"10\"><tbody><thead>";
$message .= "<tr><th colspan=\"2\" bgcolor=\"#989898\">MEETING DETAILS</th></tr></thead>";
$message .= "<tbody><tr><td bgcolor=\"#C0C0C0\">Meeting room:</td><td bgcolor=\"#D8D8D8\"><strong>".  $room[0]->name ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Date:</td><td bgcolor=\"#D8D8D8\"><strong>".  date('D jS F Y', $meeting_date_convert) ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Time:</td><td bgcolor=\"#D8D8D8\"><strong>".  gmdate('H:i', $start_time) ." - ". gmdate('H:i', $end_time). "</strong></td></tr></tbody>";
$message .= "<tfoot><tr><td bgcolor=\"#C0C0C0\">Canceled on:</td><td bgcolor=\"#D8D8D8\"><strong>". date('D jS F Y', $now) ." at ". date('H:i', $now)  . "</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Canceled by:</td><td bgcolor=\"#D8D8D8\"><strong>". $from_name . "</strong></td></tr></tfoot>";
$message .= "</table><br><br>";
$headers = "From: $from_name <$from_email>";

//echo '<pre>';print_r($message);echo '</pre>';

function wps_set_content_type(){
	return "text/html";
	}
add_filter( 'wp_mail_content_type','wps_set_content_type' );

wp_mail( $to, $subject, $message, $headers );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

date_default_timezone_set($default_tz); 
?>