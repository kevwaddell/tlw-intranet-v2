<?php if ( isset($_GET['meetingid']) && $_GET['action'] == "add_booking") {
	
	if (is_page()) {
	$page_id = $post->ID;	
	} else {
	$page_id = $meetings->ID;
	}
	
	$meeting_id = $_GET['meetingid'];
	$meeting = get_post($meeting_id);
	$room = wp_get_post_terms($meeting_id,'tlw_rooms_tax');
	$description = get_field('meeting_description', $meeting_id);
	$meeting_date_convert = strtotime( get_field('meeting_date', $meeting_id) );
	$start_time = get_field('start_time', $meeting_id);
	$meeting_start = date('H:i', $start_time);
	$end_time = get_field('end_time', $meeting_id);
	$meeting_end = date('H:i', $end_time);
	$booked_by = get_user_by('id', $meeting->post_author);
	
	/* SET POST META */
	
	include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/add-meeting-email.php');

?>

<div class="alert alert-success">
	Your room booking request has been sent to<br><strong>Office Administration</strong> for approval.<br>
	You will receive an email when your request has been approved.<br><br>
	
	<strong class="caps">Meeting details:</strong><br>
	<p>
		<span class="bold">Description:</span> <?php echo $description; ?><br>
		<span class="bold">Room:</span> <?php echo $room[0]->name; ?><br>
		<span class="bold">Date:</span>  <?php echo date('D jS F Y', $meeting_date_convert); ?><br>
		<span class="bold">Time:</span>  <?php echo $meeting_start; ?> - <?php echo $meeting_end; ?>
	</p>
	<br>
	
	<div class="action-btns">

		<a href="<?php echo get_permalink($page_id); ?>" class="btn btn-success btn-block"><i class="fa fa-check fa-lg"></i>Continue</a>
		
	</div>
	
</div>

<?php }  ?>

<?php if ( isset($_GET['meetingid']) && $_GET['action'] == "cancel_booking") {
	
	$meeting_id = $_GET['meetingid'];
	wp_delete_post( $meeting_id, true );
	
?>
<div class="alert alert-danger">
	Your room booking request has been canceled.<br><br>
	
	<div class="action-btns">

		<a href="<?php echo get_permalink($page_id); ?>" class="btn btn-danger btn-block"><i class="fa fa-check fa-lg"></i>Continue</a>
		
	</div>
	
</div>
<?php }  ?>
