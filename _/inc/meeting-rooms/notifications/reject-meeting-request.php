<?php if (isset($_GET['meetingid']) && $_GET['request'] == "reject") { 
$meeting = get_post($_GET['meetingid']);
$room = wp_get_post_terms( $meeting->ID, 'tlw_rooms_tax');
$booked_by = get_user_by('id', $meeting->post_author);
?>

<div class="alert alert-danger">
	Are you sure you want to reject booking of <strong><?php echo $room[0]->name; ?></strong><br>for <strong><?php echo $booked_by->data->display_name; ?></strong>.<br><br>

	<div class="row">
		<div class="col-xs-6">
			<a href="<?php echo get_permalink($meetings->ID); ?>?action=reject&meetingid=<?php echo $_GET['meetingid'];?>" class="btn btn-danger btn-block action-btn"><i class="fa fa-check fa-lg"></i> Yes</a>
		</div>
		<div class="col-xs-6">
			<a href="<?php echo get_permalink($meetings->ID); ?>" class="btn btn-danger btn-block"><i class="fa fa-times fa-lg"></i> No</a>
		</div>
	</div>

</div>

<div class="rule"></div>

<?php }  ?>
