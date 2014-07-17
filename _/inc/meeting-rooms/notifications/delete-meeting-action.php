<?php if (isset($_GET['meetingid']) && $_GET['action'] == "delete") { 
$meeting = get_post($_GET['meetingid']);
$room = wp_get_post_terms( $meeting->ID, 'tlw_rooms_tax');
$description = get_field('meeting_description', $meeting->ID);

	if ($meeting->post_status == 'draft') {
		wp_delete_post( $meeting->ID, true );
	} 

?>

<div class="alert alert-success">
	Booking of <strong><?php echo $room[0]->name; ?></strong> for <strong><?php echo $description; ?></strong> meeting has been deleted.</strong><br><br>

	<div class="action-btns">
		<a href="<?php echo get_permalink($meetings->ID); ?>" class="btn btn-success btn-block">Continue</a>
	</div>
</div>

<div class="rule"></div>

<?php }  ?>
