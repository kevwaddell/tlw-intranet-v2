<?php if ( isset($_POST['userid']) ) { 
$user_id = $_POST['userid'];
$current_user = get_user_by('id', $user_id);
$start_date_raw = trim($_POST['start_date']);
$start_date = new DateTime( $start_date_raw );
$end_date = new DateTime();
$ts = $start_date->getTimestamp();
$numdays = trim($_POST['num_days']);
	
	if ( $start_date_raw == "") {
	$errors[] = "Please select a start date.";
	}
	
	if ( $numdays == "") {
	$errors[] = "Please enter the number of days.";
	}
	
	if (count($errors) == 0) {
	$addDay = 86400;
	
		for($i=1; $i<$numdays; $i++){
	
	    // get what day it is next day
	    $nextDay = date('w', ($ts+$addDay));
	
	    // if it's Saturday or Sunday get $i-1
	    if($nextDay == 0 || $nextDay == 6) {
	        $i--;
	    }
	
	    // modify timestamp, add 1 day
	    $ts = $ts+$addDay;
		}

	$end_date->setTimestamp($ts);
	
	/*
echo '<pre>';
	print_r($start_date->format( 'Ymd' ));
	echo '<br>';
	print_r($end_date->format( 'Ymd' ));
	echo '<br>';
	print_r($post_title);
	echo '</pre>';
*/
	
	$post_title = $current_user->data->display_name;
	
	$post_args = array(
	'post_name' => sanitize_title($post_title. ' ' .$start_date->format( 'Ymd' ). ' '.$end_date->format( 'Ymd' )),
	'post_title' => $post_title,
	'post_status'   => 'pending',
	'post_author'   => $user_id,
	'post_type'     => 'tlw_holiday'
	);
	
	//echo '<pre>';print_r($post_args);echo '</pre>';
	
	$post_id = wp_insert_post($post_args);
	
	/* SET META */
	update_post_meta($post_id, '_holiday_start_date', 'field_53c67357805e5'); 
	update_post_meta($post_id, 'holiday_start_date', $start_date->format( 'Ymd' )); 
	update_post_meta($post_id, '_holiday_end_date', 'field_53c673b0805e6');  
	update_post_meta($post_id, 'holiday_end_date', $end_date->format( 'Ymd' ));  
	update_post_meta($post_id, '_number_of_days', 'field_53c673d9805e7');  
	update_post_meta($post_id, 'number_of_days', $numdays);  
	
	}
?>

<?php if (count($errors) == 0) { ?>

<div class="alert alert-success">
	Please confirm your holiday details below.<br><br>
	
	<strong class="caps">Holiday details:</strong><br>
	<p>
		<span class="bold">Start date:</span> <?php echo $start_date->format( 'D jS F Y' ) ?><br>
		<span class="bold">End date:</span> <?php echo $end_date->format( 'D jS F Y' ); ?><br>
		<span class="bold">Number of days:</span>  <?php echo $numdays; ?><br>
	</p>
	<br>
	
	<div class="action-btns">
		<div class="row">
		<div class="col-xs-6">
			<a href="<?php echo get_permalink($page_id); ?>?action=add_holiday&holidayid=<?php echo $post_id; ?>" class="btn btn-success btn-block"><i class="fa fa-check fa-lg"></i>Confirm</a>
		</div>
		<div class="col-xs-6">
			<a href="<?php echo get_permalink($page_id); ?>?action=cancel_holiday&holidayid=<?php echo $post_id; ?>" class="btn btn-danger btn-block"><i class="fa fa-times fa-lg"></i>Cancel</a>
		</div>
	</div>
	
</div>

<?php } else { ?>

<div class="alert alert-info">
	
	<h4>Holiday request</h4>
	
	<div class="well well-sm errors">
	    <p>Errors!</p>
		<ul>
		<?php foreach ($errors as $error) { ?>
		<li><?php echo $error; ?></li>
		<?php } ?>
		</ul>
	</div>

	<?php include (STYLESHEETPATH . '/_/inc/holiday-request/notifications/add-form.php'); ?>
	
</div>

<?php } ?>
 
<?php }  ?>