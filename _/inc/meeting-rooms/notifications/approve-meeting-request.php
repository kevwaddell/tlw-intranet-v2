<?php if (isset($_GET['meetingid']) && $_GET['request'] == "approve") { 
$meeting = get_post($_GET['meetingid']);
$room = wp_get_post_terms( $meeting->ID, 'tlw_rooms_tax');
$booked_by = get_user_by('id', $meeting->post_author);
$description = get_field('meeting_description', $meeting->ID);
$meeting_date_raw = get_field('meeting_date', $meeting->ID);
$meeting_date = date('l jS F, Y', strtotime($meeting_date_raw));
$start_time = get_field('start_time', $meeting->ID);
$end_time = get_field('end_time', $meeting->ID);
?>

<div class="alert alert-danger">
	Do you want to approve booking of <strong><?php echo $room[0]->name; ?></strong><br>for <strong><?php echo $booked_by->data->display_name; ?></strong>.<br><br>

	<div class="action-btns">
	
		<div class="row">
			<div class="col-xs-6">
				<a href="<?php echo get_permalink($meetings->ID); ?>?action=approve&meetingid=<?php echo $_GET['meetingid'];?>" class="btn btn-danger btn-block action-btn"><i class="fa fa-check fa-lg"></i> Yes</a>
			</div>
			<div class="col-xs-6">
				<a href="<?php echo get_permalink($meetings->ID); ?>" class="btn btn-danger btn-block"><i class="fa fa-times fa-lg"></i> No</a>
			</div>
		</div>
		
	</div>
	
</div>

<div class="rule"></div>

<?php }  ?>
