<?php 
/*
Template Name: iCal template
*/
?>
<?php
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename="meetings_ical_feed.ics"'); 
$eol = "\r\n";
?>
BEGIN:VCALENDAR<?php echo $eol; ?>
VERSION:2.0<?php echo $eol; ?>
PRODID:-//<?php bloginfo('name'); ?>//NONSGML v1.0//EN<?php echo $eol; ?>
CALSCALE:GREGORIAN<?php echo $eol; ?>
METHOD:PUBLISH<?php echo $eol; ?>
X-WR-TIMEZONE:Europe/London<?php echo $eol; ?>
X-WR-CALNAME:<?php echo bloginfo('name')." - Meetings Calendar"; ?><?php echo $eol; ?>
<?php
$cal_args = array(
'post_type' => 'tlw_meeting',
'posts_per_page' => -1,
'post_status' => "publish",
'order'	=> 'ASC',
'meta_key'	=> 'start_time',
'orderby' => 'meta_value_num'
);
$cal_posts = query_posts($cal_args);
/*
$default_tz = date_default_timezone_get();
date_default_timezone_set(get_option('timezone_string')); 
*/
//echo '<pre>';print_r(get_option('timezone_string'));echo '</pre>';

foreach($cal_posts as $post) :
setup_postdata($post); 
$booked_by = get_user_by('id', $post->post_author);
$date = get_post_meta($post->ID, 'meeting_date', true);
$start= get_post_meta($post->ID, 'start_time', true);
$end = get_post_meta($post->ID, 'end_time', true);
$description = get_post_meta($post->ID, 'meeting_description', true);
$room = wp_get_post_terms( $post->ID, 'tlw_rooms_tax');

//echo '<pre>';print_r (get_option('timezone_string') );echo '</pre>';
//echo '<pre>';print_r (date('Ymd\THi00', $end) );echo '</pre>';
?>
BEGIN:VEVENT<?php echo $eol; ?>
BEGIN:VTIMEZONE<?php echo $eol; ?>
TZID:Europe/London<?php echo $eol; ?>
BEGIN:DAYLIGHT<?php echo $eol; ?>
TZOFFSETFROM:+0000<?php echo $eol; ?>
RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU<?php echo $eol; ?>
DTSTART:<?php echo date('Ymd\THi00', $start); ?><?php echo $eol; ?>
TZNAME:GMT+01:00<?php echo $eol; ?>
TZOFFSETTO:+0100<?php echo $eol; ?>
END:DAYLIGHT<?php echo $eol; ?>
BEGIN:STANDARD<?php echo $eol; ?>
TZOFFSETFROM:+0100<?php echo $eol; ?>
RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU<?php echo $eol; ?>
DTSTART:<?php echo date('Ymd\THi00', $start); ?><?php echo $eol; ?>
TZNAME:GMT<?php echo $eol; ?>
TZOFFSETTO:+0000<?php echo $eol; ?>
END:STANDARD<?php echo $eol; ?>
END:VTIMEZONE<?php echo $eol; ?>
SUMMARY:<?php echo $description; ?><?php echo $eol; ?>
LOCATION:<?php echo $room[0]->name;  ?><?php echo $eol; ?>
DESCRIPTION: Booked by <?php echo $booked_by->data->display_name; ?><?php echo $eol; ?>
DTSTART:<?php echo date('Ymd\THi00', $start); ?><?php echo $eol; ?>
DTEND:<?php echo date('Ymd\THi00', $end); ?><?php echo $eol; ?>
UID: <?php echo $post->ID; ?><?php echo $eol; ?>
CLASS:PRIVATE<?php echo $eol; ?>
CREATED:<?php echo date('Ymd\THi00', $start); ?><?php echo $eol; ?>
END:VEVENT<?php echo $eol; ?>
<?php endforeach; ?>
END:VCALENDAR<?php echo $eol; ?>