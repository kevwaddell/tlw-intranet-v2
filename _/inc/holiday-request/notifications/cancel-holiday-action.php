<?php if ( isset($_GET['holidayid']) && $_GET['action'] == "cancel_holiday") {
	
	$cur_url = explode("?", $_SERVER['REQUEST_URI']);
	$holiday_id = $_GET['holidayid'];
	$end_date = get_field('holiday_end_date', $holiday_id);
	wp_delete_post( $holiday_id, true );
	
?>
<div class="alert alert-danger">
	<?php if (!($end_date < date('Ymd'))) { ?>
	Your holiday request has been canceled.<br><br>
	<?php } else { ?>
	Your holiday booking has been canceled.<br><br>
	<?php } ?>
	<div class="action-btns">

		<a href="<?php echo get_option('home'); ?><?php echo $cur_url[0]; ?>" class="btn btn-danger btn-block"><i class="fa fa-check fa-lg"></i>Continue</a>
		
	</div>
	
</div>
<?php }  ?>
