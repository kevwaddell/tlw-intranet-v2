<?php if ( isset($_GET['holidayid']) && $_GET['action'] == "add_holiday") {
	
	$holiday_id = $_GET['holidayid'];
	$holiday = get_post($holiday_id);
	$start_date = get_field('holiday_start_date', $holiday_id);
	$end_date = get_field('holiday_end_date', $holiday_id);
	$numdays = get_field('number_of_days', $holiday_id);
	$booked_by = get_user_by('id', $holiday->post_author);
	
	/* SET POST META */
	if ( !($end_date < date('Ymd')) ) {
	//include (STYLESHEETPATH . '/_/inc/holiday-request/notifications/add-holiday-email.php');
	}

?>

<div class="alert alert-success">

	<?php if ( !($end_date < date('Ymd')) ) { ?>
	Your holiday request has been sent to<br><strong>Office Administration</strong> for approval.<br>
	You will receive an email when your request has been approved.<br><br>
	<?php } else { ?>
	Your holiday booking has been added successfully.<br><br>
	<?php } ?>
	
	<strong class="caps">Holiday details:</strong><br>
	<p>
		<span class="bold">Start date:</span> <?php echo date( 'D jS F Y', strtotime($start_date) ); ?><br>
		<span class="bold">End date:</span> <?php echo date( 'D jS F Y', strtotime($end_date) ); ?><br>
		<span class="bold">Number of days:</span>  <?php echo $numdays; ?><br>
	</p>
	<br>
	
	<div class="action-btns">

		<a href="<?php the_permalink(); ?>" class="btn btn-success btn-block"><i class="fa fa-check fa-lg"></i>Continue</a>
		
	</div>
	
</div>

<?php }  ?>

<?php if ( isset($_GET['holidayid']) && $_GET['action'] == "cancel_holiday") {
	
	$holiday_id = $_GET['holidayid'];
	wp_delete_post( $holiday_id, true );
	
?>
<div class="alert alert-danger">
	<?php if (!($end_date < date('Ymd'))) { ?>
	Your holiday request has been canceled.<br><br>
	<?php } else { ?>
	Your holiday booking has been canceled.<br><br>
	<?php } ?>
	<div class="action-btns">

		<a href="<?php the_permalink(); ?>" class="btn btn-danger btn-block"><i class="fa fa-check fa-lg"></i>Continue</a>
		
	</div>
	
</div>
<?php }  ?>
