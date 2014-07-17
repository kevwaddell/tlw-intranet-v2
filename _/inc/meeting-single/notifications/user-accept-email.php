<!-- ACCEPTANCE NOTIFICATION -->
<?php if (isset($_GET['action']) && $_GET['action'] == 'accept') { 

$user = get_user_by('id', $_GET['user']);
$user_meta = get_user_meta($_GET['user']);
$from_name = $user->data->display_name;
$from_email = $user->data->user_email;

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
$send_to = 	$booked_by->data->user_email;
} else {
$send_to = 	"kwaddelltlw@icloud.com";
}
	
update_post_meta(get_the_ID(), "attendees_staff_".$_GET['user_key']."_status", "accepted");	

$to = $send_to;
$subject = "TLW Solicitors meeting attendance accepted from ".$from_name;
$message = "<h3>This is a meeting acceptance notification from <font style=\"color: red;\">".$from_name."</font>.</h3>";
$message .= "<strong>".$user_meta['first_name'][0]."</strong> will be available to attend the <strong>'". $description ."'</strong> meeting ";
$message .= "on <strong>".  date('D jS F Y', $date_convert) ."</strong> at <strong>".  date('H:i', $start_time) ."</strong> - <strong>". date('H:i', $end_time). "</strong>.";
$headers = "From: $from_name <$from_email>";

function wps_set_content_type(){
	return "text/html";
	}
	
add_filter( 'wp_mail_content_type','wps_set_content_type' );

wp_mail( $to, $subject, $message, $headers );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
?>
<div class="alert alert-success">
	Thank you for your confirmation <strong><?php echo $user_meta['first_name'][0]; ?></strong>.<br>
	<strong><?php echo $booked_by->data->display_name; ?></strong> has been notified of your acceptance.<br><br>
	
	<div class="action-btns">
	<a href="<?php the_permalink(); ?>" class="btn btn-success btn-block refresh"><i class="fa fa-refresh fa-lg"></i>Refresh attendees list</a>
	</div>
	
</div>
<?php } ?>
