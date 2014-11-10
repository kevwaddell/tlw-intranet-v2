<?php 
$holidays_check_args = array(
'post_type' => 'tlw_holiday',
'posts_per_page' => -1,
'post_status'	=> 'publish',
'author'	=> $curauth->ID,
'meta_query'	=> array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $start_of_year,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_year,
			'compare' => '<'
		)
	)
);

$holidays_check = get_posts($holidays_check_args);
$holidays_used = 0;
$holidays_booked = 0;

//echo '<pre>';

if (count($holidays_check) > 0) {

	foreach ($holidays_check as $holiday) {
	$start = get_field('holiday_start_date', $holiday->ID);
	$start_ts = strtotime($start);
	$end = get_field('holiday_end_date', $holiday->ID);
	$end_ts = strtotime($end);
	$numdays = get_field('number_of_days', $holiday->ID);
		
		if ($end_ts < $today) {
		$holidays_used += $numdays;	
		}
		
		if ($start_ts > $today) {
		$holidays_booked += $numdays;	
		}
		
		/*
print_r($start);
		echo '<br>';
*/
	}
}

//echo '</pre>';

if (($holidays_used + $holidays_booked) > 0) {
$number_of_holidays = $user_holidays - ($holidays_used + $holidays_booked);
update_user_meta( $curauth->ID, 'number_of_holidays', $number_of_holidays);		
$user_holidays = get_the_author_meta( "number_of_holidays", $curauth->ID );
}

//echo '<pre>';print_r($user_holidays);echo '</pre>';

/* NEXT YEARS HOLIDAYS */
$xty_holidays_check_args = array(
'post_type' => 'tlw_holiday',
'posts_per_page' => -1,
'post_status'	=> 'publish',
'author'	=> $curauth->ID,
'meta_query'	=> array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $end_of_year,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_nxt_year,
			'compare' => '<'
		)
	)
);

$xty_holidays_check = get_posts($xty_holidays_check_args);
$xty_holidays_booked = 0;

if (count($xty_holidays_check) > 0) {

	foreach ($xty_holidays_check as $xt_holiday) {
	$start = get_field('holiday_start_date', $xt_holiday->ID);
	$end = get_field('holiday_end_date', $xt_holiday->ID);
	$numdays = get_field('number_of_days', $xt_holiday->ID);
		
	$xty_holidays_booked += $numdays;	
	
	}
}

/*
echo '<pre>';
print_r($xty_holidays_booked);
echo '</pre>';
*/
 ?>