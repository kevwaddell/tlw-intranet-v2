<?php 
$default_tz = date_default_timezone_get();
date_default_timezone_set('Europe/London'); 
$now = strtotime("now");
$meetings = get_page_by_title("Meetings");

$from_name = $booked_by->data->display_name;
$from_email = $booked_by->data->user_email;

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
$send_to = $rb_admin['user_email'];
} else {
$send_to = "kevwaddell@mac.com";
}

$to = $send_to;
$subject = "Meeting room booking request from $from_name";
$message = "<h3><font style=\"color: red;\">$from_name</font> has requested a holiday to be approved.</h3>";
$message .= "<br>";
$message .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"10\"><tbody><thead>";
$message .= "<tr><th colspan=\"2\" bgcolor=\"#989898\">HOLIDAY DETAILS</th></tr></thead>";
$message .= "<tbody><tr><td bgcolor=\"#C0C0C0\">Date start:</td><td bgcolor=\"#D8D8D8\"><strong>".  date('D jS F Y', $meeting_date_convert ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Date end:</td><td bgcolor=\"#D8D8D8\"><strong>".  date('D jS F Y', $meeting_date_convert) ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Number of days:</td><td bgcolor=\"#D8D8D8\"><strong>". . "</strong></td></tr></tbody>";
$message .= "<tfoot><tr><td bgcolor=\"#C0C0C0\">Requested on:</td><td bgcolor=\"#D8D8D8\"><strong>". date('D jS F Y', $now) ." at ". date('H:i', $now)  . "</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Requested by:</td><td bgcolor=\"#D8D8D8\"><strong>". $from_name . "</strong></td></tr></tfoot>";
$message .= "</table><br><br>";
$message .= "Please use the link below to view holiday request details and accept or reject the request.<br><br>";
$message .= "<a href=\"".the_permalink()."?request=holiday_request&holidayid=".$meeting_id."\">View request >></a><br><br>";
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