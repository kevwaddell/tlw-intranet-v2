<?php if (isset($_GET['meetingid']) && $_GET['action'] == "approve") { 
$meeting = get_post($_GET['meetingid']);
$room = wp_get_post_terms( $meeting->ID, 'tlw_rooms_tax');
$booked_by = get_user_by('id', $meeting->post_author);
$meeting_date_raw = get_field('meeting_date', $meeting->ID);
$meeting_date = date('l jS F, Y', strtotime($meeting_date_raw));
$start_time = get_field('start_time', $meeting->ID);
//$start = date('g:ia', $start_time);
$end_time = get_field('end_time', $meeting->ID);
//$end = date('g:ia', $end_time);
//echo '<pre>';print_r($room);echo '</pre>';

if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
$send_to = 	$user->data->user_email;
} else {
$send_to = 	"kwaddelltlw@icloud.com";
}

	if ($meeting->post_status == 'pending' || $meeting->post_status == 'draft') {
		  
		include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/approve-meeting-email.php');
				
		 $meeting_args = array(
		 'ID'           => $meeting->ID,
		 'post_status'	=> 'publish'
		 );
		 
		 wp_update_post( $meeting_args );
		 
		 add_post_meta($meeting->ID, 'attendees_staff', '0', true);
		 add_post_meta($meeting->ID, '_attendees_staff', 'field_539877b3fecd7', true);
		 add_post_meta($meeting->ID, 'attendees_clients', '0', true);
		 add_post_meta($meeting->ID, '_attendees_clients', 'field_539878dcfecd9', true);

	} 

?>

<div class="alert alert-success">

	<strong><?php echo $room[0]->name; ?></strong> meeting room has been booked for <strong><?php echo $booked_by->data->display_name; ?></strong>.<br><br>

	<div class="action-btns">
		<a href="<?php echo get_permalink($meetings->ID); ?>" class="btn btn-success btn-block">Continue</a>
	</div>
	
</div>

<div class="rule"></div>

<?php }  ?>
