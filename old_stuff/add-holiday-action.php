<?php //echo '<pre>';print_r($_POST);echo '</pre>'; ?>

<?php if ( isset($_POST['add_holiday']) ) { 
	
	/* VARS */
	$user_id = $_POST['userid'];
	$current_user = get_user_by('id', $user_id);
	$hol_start_date_raw = trim($_POST['holiday_start_date']);
	$hol_end_date_raw = trim($_POST['holiday_end_date']);
	$start_year = date("Y", strtotime($hol_start_date_raw));
	//echo '<pre>';print_r( strtotime($hol_start_date_raw) );echo '</pre>';
	$s_date = new DateTime($hol_start_date_raw);
	$e_date = new DateTime($hol_end_date_raw);
	$sts = $s_date->getTimestamp();
	$ts = $s_date->getTimestamp();
	$numdays = trim($_POST['num_days']);
	$addDay = 86400;
	
	/* ERRORS CHECK */
	if ( $hol_start_date_raw == "") {
	$errors[] = "Please select a start date.";
	}
	
	if ( $hol_end_date_raw == "") {
	$errors[] = "Please select an end date.";
	}

	if ( $numdays == "") {
	$errors[] = "Please enter the number of days.";
	}
		
	/* CHECK FOR WEEKEND DAYS */
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
	
	if ($s_date->format( 'Y' ) < $e_date->format( 'Y' )) {
	$errors[] = "Your end date <strong>(".$e_date->format( 'l jS F' ).")</strong> falls into the <strong>".$e_date->format( 'Y' )."</strong> holiday quota.<br><small>*Please book <strong>". $e_date->format( 'Y' ) ."</strong> dates separately.</small>";
	}
	
	/* IF NO ERRORS ADD POST */
	if ( count($errors) == 0 ) {

		$post_title = $current_user->data->display_name;
		
		$post_args = array(
		'post_name' => sanitize_title($post_title. ' ' .$s_date->format( 'Ymd' ). ' '.$e_date->format( 'Ymd' )),
		'post_title' => $post_title,
		'post_status'   => 'pending',
		'post_author'   => $user_id,
		'post_type'     => 'tlw_holiday'
		);
		
		if ( $e_date->format( 'Ymd' ) < date('Ymd') ) {
		$post_args['post_status'] = 'publish';
		}
		
		//echo '<pre>';print_r($post_args);echo '</pre>';
		
		$h_id = wp_insert_post($post_args);
		
		/* SET META */
		update_post_meta($h_id, '_holiday_start_date', 'field_53c67357805e5'); 
		update_post_meta($h_id, 'holiday_start_date', $s_date->format( 'Ymd' )); 
		update_post_meta($h_id, '_holiday_end_date', 'field_53c673b0805e6');  
		update_post_meta($h_id, 'holiday_end_date', $e_date->format( 'Ymd' ));  
		update_post_meta($h_id, '_number_of_days', 'field_53c673d9805e7');  
		update_post_meta($h_id, 'number_of_days', $numdays);  
	
	}
?>

<?php if (count($errors) == 0) { 
//echo '<pre>';print_r($cur_url);echo '</pre>';
?>

<div class="alert alert-success">
	Please confirm your holiday details below.<br><br>
	
	<strong class="caps">Holiday details:</strong><br>
	<p>
		<span class="bold">Start date:</span> <?php echo $s_date->format( 'D jS F Y' ) ?><br>
		<span class="bold">End date:</span> <?php echo $e_date->format( 'D jS F Y' ); ?><br>
		<span class="bold">Number of days:</span>  <?php echo $numdays; ?><br>
	</p>
	<br>
	
	<div class="action-btns">
		<div class="row">
		<div class="col-xs-6">
			<a href="?action=confirm_holiday&holidayid=<?php echo $h_id; ?>" class="btn btn-success btn-block btn-action"><i class="fa fa-check fa-lg"></i>Confirm</a>
		</div>
		<div class="col-xs-6">
			<a href="?request=cancel_holiday&holidayid=<?php echo $h_id; ?>" class="btn btn-danger btn-block btn-action"><i class="fa fa-times fa-lg"></i>Cancel</a>
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