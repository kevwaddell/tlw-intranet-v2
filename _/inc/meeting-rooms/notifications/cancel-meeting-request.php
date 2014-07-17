<?php if (isset($_GET['meetingid']) && $_GET['request'] == "cancel") { 
$meeting = get_post($_GET['meetingid']);
$room = wp_get_post_terms( $meeting->ID, 'tlw_rooms_tax');
$description = get_field('meeting_description', $meeting->ID);
?>

<div class="alert alert-danger">
	
	Are you sure you want to cancel <strong><?php echo $description; ?></strong> meeting.<br><br>

	<div class="action-btns">
	
		<div class="row">
			<div class="col-xs-6">
				<a href="<?php echo get_permalink($meetings->ID); ?>?action=cancel&meetingid=<?php echo $_GET['meetingid'];?>" class="btn btn-danger btn-block action-btn"><i class="fa fa-check fa-lg"></i> Yes</a>
			</div>
			<div class="col-xs-6">
				<a href="<?php echo get_permalink($meetings->ID); ?>" class="btn btn-danger btn-block cancel-btn"><i class="fa fa-times fa-lg"></i> No</a>
			</div>
		</div>
		
	</div>

</div>

<div class="rule"></div>

<?php }  ?>
