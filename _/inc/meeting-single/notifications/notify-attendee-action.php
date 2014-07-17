<?php if (isset($_GET['action']) && $_GET['action'] == "notify") { 
$user = get_user_by('id', $_GET['user']);
$user_meta = get_user_meta($_GET['user']);
//echo '<pre>';print_r($booked_by->data->user_email);echo '</pre>';
$from_name = $booked_by->data->display_name;
$from_email = $booked_by->data->user_email;

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
$send_to = 	$user->data->user_email;
} else {
$send_to = 	"kwaddelltlw@icloud.com";
}

//echo '<pre>';print_r($send_to);echo '</pre>';
$default_tz = date_default_timezone_get();
date_default_timezone_set('Europe/London'); 
$now = strtotime("now");
		
$to = $send_to;
$subject = "TLW Solicitors meeting attendance request from ".$from_name;
$message = "<h3>You have been requested to attend a meeting by <font style=\"color: red;\">".$from_name."</font>.</h3>";
$message .= "<br>";
$message .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"10\"><tbody><thead>";
$message .= "<tr><th colspan=\"2\" bgcolor=\"#989898\">MEETING DETAILS</th></tr></thead>";
$message .= "<tbody><tr><td width=\"20%\" bgcolor=\"#C0C0C0\">Meeting description:</td><td bgcolor=\"#D8D8D8\"><strong>". $description ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Meeting room:</td><td bgcolor=\"#D8D8D8\"><strong>".  $room[0]->name ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Date:</td><td bgcolor=\"#D8D8D8\"><strong>".  date('D jS F Y', $date_convert) ."</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Time:</td><td bgcolor=\"#D8D8D8\"><strong>".  gmdate('H:i', $start_time) ." - ". gmdate('H:i', $end_time). "</strong></td></tr></tbody>";
$message .= "<tfoot><tr><td bgcolor=\"#C0C0C0\">Sent on:</td><td bgcolor=\"#D8D8D8\"><strong>". date('D jS F Y', $now) ." at ". date('H:i', $now)  . "</strong></td></tr>";
$message .= "<tr><td bgcolor=\"#C0C0C0\">Booked by:</td><td bgcolor=\"#D8D8D8\"><strong>". $from_name . "</strong></td></tr></tfoot>";
$message .= "</table><br><br>";
$message .= "Please use the link below to view meeting details and accept or reject the meeting invite.<br><br>";
$message .= "<a href=\"".get_permalink($post->ID)."?request=user_approval&user_key=".$_GET['user_key']."&user=".$_GET['user']."\" title=\"\">View Meeting details >></a><br>";
$headers = "From: $from_name <$from_email>";

function wps_set_content_type(){
	return "text/html";
	}
	
add_filter( 'wp_mail_content_type','wps_set_content_type' );

wp_mail( $to, $subject, $message, $headers );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

date_default_timezone_set($default_tz); 
?>


<div class="alert alert-success">
	<strong><?php echo $user->data->display_name; ?></strong> has been notified of the meeting.<br><br>

<div class="action-btns">
	<a href="<?php the_permalink(); ?>" class="btn btn-success btn-block">Continue</a>
</div>

</div>

<div class="rule"></div>

<?php }  ?>