<?php 
//echo '<pre>';print_r($end_of_year);echo '</pre>';

$holidays_args = array(
'post_type' => 'tlw_holiday',
'posts_per_page' => -1,
'post_author'	=> $current_user->ID,
'order'	=> 'DESC',
'meta_key'	=> 'holiday_start_date',
'orderby' => 'meta_value_num',
);

if (!isset($_GET['holiday_sortby'])) {
	$holidays_args['post_status'] = 'publish';
	$holidays_args['meta_query'] = array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $start_of_year,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_year
			,
			'compare' => '<'
		)
	);
}
if (isset($_GET['holiday_sortby']) && $_GET['holiday_sortby'] == "next-year") {
	$holidays_args['post_status'] = 'publish';
	$holidays_args['order'] = 'ASC';
	$holidays_args['meta_query'] = array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $end_of_year,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_nxt_year
			,
			'compare' => '<'
		)
	);
}

if (isset($_GET['holiday_sortby']) && $_GET['holiday_sortby'] == "pending") {
	$holidays_args['post_status'] = 'pending';
	$holidays_args['order'] = 'ASC';
	$holidays_args['meta_query'] = array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $today,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_nxt_year
			,
			'compare' => '<'
		)
	);
}

if (isset($_GET['holiday_sortby']) && $_GET['holiday_sortby'] == "canceled") {
	$holidays_args['post_status'] = 'draft';
	$holidays_args['order'] = 'ASC';
	$holidays_args['meta_query'] = array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $start_of_year,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_nxt_year
			,
			'compare' => '<'
		)
	);
}

if (isset($_GET['holiday_sortby']) && $_GET['holiday_sortby'] == "all") {
	$holidays_args['post_status'] = array('draft', 'publish', 'pending');
	$holidays_args['meta_query'] = array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $start_of_year,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_nxt_year
			,
			'compare' => '<'
		)
	);
}

$holidays = get_posts($holidays_args);
//echo '<pre>';print_r($holidays);echo '</pre>';

$today_start = strtotime("Today 08:00");
$today_end = strtotime("Today 18:00");

$post_type = "tlw_meeting";
$your_meetings = array();

$meetings_args = array(
'post_type' => $post_type,
'posts_per_page' => -1,
'order'	=> 'ASC',
'meta_key'	=> 'start_time',
'orderby' => 'meta_value_num',
);

if (!isset($_GET['sortby'])) {
	$meetings_args['post_status'] = 'publish';
	$meetings_args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'start_time',
			'value' => $today_start,
			'compare' => '>'
		),
		array(
			'key' => 'end_time',
			'value' => $today_end,
			'compare' => '<'
		)
	);
}

/* PENDING ARGS */
if (isset($_GET['sortby']) && $_GET['sortby'] == "pending") {
	$meetings_args['post_status'] = 'pending';
	$meetings_args['meta_query'] = array(
		array(
			'key' => 'start_time',
			'value' => $today_start,
			'compare' => '>'
		)
	);
}

/* FUTURE ARGS */
if (isset($_GET['sortby']) && $_GET['sortby'] == "future") {
	$meetings_args['post_status'] = 'publish';
	$meetings_args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'start_time',
			'value' => $today_end,
			'compare' => '>'
		)
	);
}
/* PAST ARGS */
if (isset($_GET['sortby']) && $_GET['sortby'] == "past") {
	
	$meetings_args['post_status'] = 'publish';
	$meetings_args['order'] = 'DESC';
	
	$meetings_args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'start_time',
			'value' => $today_start,
			'compare' => '<'
		)
	);
}

/* CANCELED ARGS */
if (isset($_GET['sortby']) && $_GET['sortby'] == "canceled") {
	$meetings_args['post_status'] = 'draft';
	$meetings_args['order'] = 'ASC';
	
	$meetings_args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'start_time',
			'value' => $today_start,
			'compare' => '>'
		)
	);
}

/* ALL ARGS */
if (isset($_GET['sortby']) && $_GET['sortby'] == "all") {
	$meetings_args['post_status'] = array('publish','pending','draft');
	$meetings_args['order'] = 'DESC';	
}

$meetings = get_posts($meetings_args);

foreach ($meetings as $meeting) {
	
	$staff_attendees = get_field('attendees_staff', $meeting->ID);
	
	foreach ($staff_attendees as $staff_attendee) {
		if ($staff_attendee[attendee_staff][ID] == $user_id && $staff_attendee[status] == 'accepted') {
			if (!in_array($meeting, $your_meetings)) {
				array_push($your_meetings, $meeting);	
			}	
		}
	}
	
	//echo '<pre>';print_r($staff_attendees);echo '</pre>';
	
	if ($meeting->post_author == $user_id && !in_array($meeting, $your_meetings)) {
	array_push($your_meetings, $meeting);	
	}		
}

//echo '<pre>';print_r($your_meetings);echo '</pre>';

$news_args = array(
'post_type' => 'post',
'posts_per_page' => -1,
'order'	=> 'DESC',
'orderby' => 'date',
'author'=> $user_id,
'category_name'	=> 'company-news, office-news'
);

if (!isset($_GET['post_sortby'])) {
$news_args['post_status'] = array('pending', 'publish', 'draft');
}

if (isset($_GET['post_sortby']) && $_GET['post_sortby'] == 'publish') {
$news_args['post_status'] = 'publish';
}

if (isset($_GET['post_sortby']) && $_GET['post_sortby'] == 'pending') {
$news_args['post_status'] = 'pending';
}

if (isset($_GET['post_sortby']) && $_GET['post_sortby'] == 'draft') {
$news_args['post_status'] = 'draft';
}

$news_query = new WP_Query( $news_args );

//echo '<pre>';print_r($news_query);echo '</pre>';

 ?>