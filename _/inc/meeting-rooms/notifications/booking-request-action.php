<?php if (is_user_logged_in()) { ?>

<?php 
$meeting = get_post($_GET['meetingid']);
$booked_by = get_user_by('id', $meeting->post_author);
$desc = get_field('meeting_description', $meeting->ID);
$room = wp_get_post_terms( $meeting->ID, 'tlw_rooms_tax');
$meeting_date = date('D jS F Y', strtotime(get_field('meeting_date', $meeting->ID)));
$start_time = get_field('start_time', $meeting->ID);
$end_time = get_field('end_time', $meeting->ID);
?>

<div class="alert alert-success">
	Approve or reject booking request by <strong><?php echo $booked_by->data->display_name; ?></strong><br><br>
	<span class="caps">Meeting Details:</span><br>
	<span class="bold">Description:</span> <?php echo $desc; ?><br>
	<span class="bold">Room:</span> <?php echo $room[0]->name; ?><br>
	<span class="bold">Date:</span> <?php echo $meeting_date; ?><br>
	<span class="bold">Time:</span> <?php echo date('H:i', $start_time); ?> - <?php echo date('H:i', $end_time); ?><br><br>

	<div class="action-btns">
		<div class="row">
			<div class="col-xs-6">
			<a href="<?php echo get_permalink($meetings->ID); ?>?request=approve&meetingid=<?php echo $meeting->ID;?>" class="btn btn-success btn-block action-btn"><i class="fa fa-thumbs-o-up"></i> Approve</a>
			</div>
			
			<div class="col-xs-6">
			<a href="<?php echo get_permalink($meetings->ID); ?>?request=reject&meetingid=<?php echo $meeting->ID;?>" class="btn btn-danger btn-block action-btn"><i class="fa fa-thumbs-o-down"></i> Reject</a>
			</div>
		</div>
	</div>

</div>	

<?php } else { ?>

<div class="alert alert-danger text-center">
<strong>Please login to approve booking requests <a href="#log-in-alert" data-toggle="modal" class="btn btn-default btn-danger"><i class="fa fa-lock"></i> Login</a></strong>
</div>	
	
<?php } ?>
