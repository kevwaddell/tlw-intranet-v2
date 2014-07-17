<!-- REJECT NOTIFICATION -->
<?php if (isset($_GET['action']) && $_GET['action'] == 'reject') { 

$user = get_user_by('id', $_GET['user']);
$user_meta = get_user_meta($_GET['user']);
$from_name = $user->data->display_name;
$from_email = $user->data->user_email;

	if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
	$send_to = 	$booked_by->data->user_email;
	} else {
	$send_to = 	"kwaddelltlw@icloud.com";
	}
	
update_post_meta(get_the_ID(), "attendees_staff_".$_GET['user_key']."_status", "rejected");	

$to = $send_to;
$subject = "TLW Solicitors meeting notification from ".$from_name;
$message = "<h3>This is a notification from ".$from_name.".</h3>";
$message .= "<strong>".$user_meta['first_name'][0]."</strong> will <strong>not</strong> be available to attend the <strong>'". $description ."'</strong> meeting ";
$message .= "on <strong>".  date('D jS F Y', $date_convert) ."</strong>.";
$headers = "From: $from_name <$from_email>";

function wps_set_content_type(){
	return "text/html";
	}
	
add_filter( 'wp_mail_content_type','wps_set_content_type' );

wp_mail( $to, $subject, $message, $headers );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
?>
<div class="alert alert-danger">
	<strong><?php echo $booked_by->data->display_name; ?></strong> has been notified that you are unavailable for the meeting.<br><br>
	
	<div class="action-btns">
	<a href="<?php the_permalink(); ?>" class="btn btn-danger btn-block refresh"><i class="fa fa-refresh fa-lg"></i>Refresh attendees list</a>
	</div>
</div>
<?php } ?>
