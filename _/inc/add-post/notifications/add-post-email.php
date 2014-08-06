<?php 
$default_tz = date_default_timezone_get();
date_default_timezone_set('Europe/London'); 
$now = strtotime("now");

$from_name = $added_by->data->display_name;
$from_email = $added_by->data->user_email;

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
$send_to = $rb_admin['user_email'];
} else {
$send_to = "kevwaddell@mac.com";
}

$to = $send_to;
$subject = "TLW intranet article submission from $from_name";
$message = "<h3><font style=\"color: red;\">$from_name</font> has submitted an article for review.</h3>";
$message .= "<br>";
$message .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"10\"><tbody><thead>";
$message .= "<tr><th colspan=\"2\" bgcolor=\"#989898\">ARTICLE DETAILS</th></tr></thead>";
$message .= "<tbody><tr><td bgcolor=\"#C0C0C0\" width=\"20%\">Title:</td><td bgcolor=\"#D8D8D8\"><strong>".  $new_post->post_title ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Category:</td><td bgcolor=\"#D8D8D8\"><strong>". $cats[0]->name ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Tags:</td><td bgcolor=\"#D8D8D8\"><strong>".  $tags ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\" valign=\"top\">Content:</td><td bgcolor=\"#D8D8D8\"><strong>".  $email_content . "</strong></td></tr></tbody>";
$message .= "<tfoot><tr><td bgcolor=\"#C0C0C0\">Requested on:</td><td bgcolor=\"#D8D8D8\"><strong>". date('D jS F Y', $now) ." at ". date('H:i', $now)  . "</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Added by:</td><td bgcolor=\"#D8D8D8\"><strong>". $from_name . "</strong></td></tr></tfoot>";
$message .= "</table><br><br>";
$message .= "Please use the link below to view article details and edit, publish or delete the article.<br><br>";
$message .= "<a href=\"".$edit_post_link."\">View article details >></a><br><br>";
$headers = "From: $from_name <$from_email>";

//echo '<pre>';print_r( $edit_post_link  );echo '</pre>';

function wps_set_content_type(){
	return "text/html";
	}
add_filter( 'wp_mail_content_type','wps_set_content_type' );

wp_mail( $to, $subject, $message, $headers );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

date_default_timezone_set($default_tz); 
?>