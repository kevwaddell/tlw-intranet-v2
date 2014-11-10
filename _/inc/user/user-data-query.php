<?php 
/* HOLIDAYS QUERY */

$holidays_args = array(
'post_type' => 'tlw_holiday',
'posts_per_page' => -1,
'author'	=> $curauth->ID,
'order'	=> 'DESC',
'meta_key'	=> 'holiday_start_date',
'orderby' => 'meta_value_num',
);

//echo '<pre>';print_r($holidays_args);echo '</pre>';

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
			'value' => $end_of_year,
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
			'value' => $end_of_nxt_year,
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
			'value' => $end_of_nxt_year,
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
			'value' => $end_of_nxt_year,
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
			'value' => $end_of_nxt_year,
			'compare' => '<'
		)
	);
}

$holidays = get_posts($holidays_args);
//echo '<pre>';print_r($holidays_args);echo '</pre>';


/* MEETINGS QUERY */
$today_start = strtotime("Today 08:00");
$today_end = strtotime("Today 18:00");

$post_type = "tlw_meeting";
$your_meetings = array();
$your_meeting_ids = array();

$meetings_args = array(
'post_type' => $post_type,
'posts_per_page' => -1,
'order'	=> 'ASC',
'meta_key'	=> 'start_time',
'orderby' => 'meta_value_num'
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

foreach ($meetings as $meet) {
	
	$staff_attendees = get_field('attendees_staff', $meet->ID);
	
	foreach ($staff_attendees as $staff_attendee) {
		if ($staff_attendee[attendee_staff][ID] == $user_id && $staff_attendee[status] == 'accepted') {
			if (!in_array($meet->ID, $your_meeting_ids)) {
				array_push($your_meeting_ids, $meet->ID);	
			}
		}
	}
	
	if ($meet->post_author == $user_id && !in_array($meet->ID, $your_meeting_ids)) {	
	array_push($your_meeting_ids, $meet->ID);
	}		
}

if (!empty($your_meeting_ids)) {
$meetings_max_num_pages = ceil( count($your_meeting_ids)/10);

	if (isset($_GET['pg'])) {
	$slice_from = 10 * ($_GET['pg'] - 1);
	$meeting_ids = array_slice($your_meeting_ids, $slice_from , 10);	
	} else {
	$meeting_ids = array_slice($your_meeting_ids, 0 , 10);	
	}

$meetings_args['post__in' ] = $meeting_ids;
} else {
$meetings_args['author'] = $user_id;
}

$meetings_query = new WP_Query( $meetings_args );
//echo '<pre>';print_r($meetings_args);echo '</pre>';

/* NEWS QUERY */
$your_news_ids = array();

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

$news = get_posts($news_args);

foreach ($news as $article) {
	
	if (!in_array($article->ID, $your_news_ids)) {	
	array_push($your_news_ids, $article->ID);
	}		
}

if (!empty($your_news_ids)) {
$news_max_num_pages = ceil( count($your_news_ids)/10);

	if (isset($_GET['yn_pg'])) {
	$slice_from = 10 * ($_GET['yn_pg'] - 1);
	$news_ids = array_slice($your_news_ids, $slice_from , 10);	
	} else {
	$news_ids = array_slice($your_news_ids, 0 , 10);	
	}

$news_args['post__in' ] = $news_ids;
}

$news_query = new WP_Query( $news_args );

/* EVENTS QUERY */
$your_events_ids = array();

$events_args = array(
'post_type' => 'post',
'posts_per_page' => -1,
'order'	=> 'DESC',
'orderby' => 'date',
'author'=> $user_id,
'category_name'	=> 'events'
);

if (!isset($_GET['events_sortby'])) {
$events_args['post_status'] = array('pending', 'publish', 'draft');
}

if (isset($_GET['events_sortby']) && $_GET['events_sortby'] == 'publish') {
$events_args['post_status'] = 'publish';
}

if (isset($_GET['events_sortby']) && $_GET['events_sortby'] == 'pending') {
$events_args['post_status'] = 'pending';
}

if (isset($_GET['events_sortby']) && $_GET['events_sortby'] == 'draft') {
$events_args['post_status'] = 'draft';
}

$events = get_posts($events_args);

foreach ($events as $event) {
	
	if (!in_array($event->ID, $your_events_ids)) {	
	array_push($your_events_ids, $event->ID);
	}		
}

//echo '<pre>';print_r($your_events_ids);echo '</pre>';

if (!empty($your_events_ids)) {
$events_max_num_pages = ceil( count($your_events_ids)/10);

	if (isset($_GET['ev_pg'])) {
	$slice_from = 10 * ($_GET['ev_pg'] - 1);
	$event_ids = array_slice($your_events_ids, $slice_from , 10);	
	} else {
	$event_ids = array_slice($your_events_ids, 0 , 10);	
	}

$events_args['post__in' ] = $event_ids;
}

$events_query = new WP_Query( $events_args );

/* ANNOUNCEMENTS QUERY */
$your_announce_ids = array();

$announce_args = array(
'post_type' => 'post',
'posts_per_page' => -1,
'order'	=> 'DESC',
'orderby' => 'date',
'author'=> $user_id,
'category_name'	=> 'announcements'
);

if (!isset($_GET['an_sortby'])) {
$announce_args['post_status'] = array('pending', 'publish', 'draft');
}

if (isset($_GET['an_sortby']) && $_GET['an_sortby'] == 'publish') {
$announce_args['post_status'] = 'publish';
}

if (isset($_GET['an_sortby']) && $_GET['an_sortby'] == 'pending') {
$announce_args['post_status'] = 'pending';
}

if (isset($_GET['an_sortby']) && $_GET['an_sortby'] == 'draft') {
$announce_args['post_status'] = 'draft';
}

$announcments = get_posts($announce_args);

foreach ($announcments as $an) {
	
	if (!in_array($an->ID, $your_announce_ids)) {	
	array_push($your_announce_ids, $an->ID);
	}		
}

//echo '<pre>';print_r($your_announce_ids);echo '</pre>';

if (!empty($your_announce_ids)) {
$announce_max_num_pages = ceil( count($your_announce_ids)/10);

	if (isset($_GET['an_pg'])) {
	$slice_from = 10 * ($_GET['an_pg'] - 1);
	$announce_ids = array_slice($your_announce_ids, $slice_from , 10);	
	} else {
	$announce_ids = array_slice($your_announce_ids, 0 , 10);	
	}

$announce_args['post__in' ] = $announce_ids;
}

$announce_query = new WP_Query( $announce_args );



 ?>