<?php 
/*
Template Name: Single iCal template
*/
?>
<?php
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="meeting_ical.ics"'); 
$eol = "\r\n";
$meetingid = $_GET['meetingid'];
$meeting = get_post($meetingid);
?>
BEGIN:VCALENDAR<?php echo $eol; ?>
VERSION:2.0<?php echo $eol; ?>
PRODID:-//<?php bloginfo('name'); ?>//NONSGML v1.0//EN<?php echo $eol; ?>
CALSCALE:GREGORIAN<?php echo $eol; ?>
<?php
$booked_by = get_user_by('id', $meeting->post_author);
$date = get_post_meta($meeting->ID, 'meeting_date', true);
$start= get_post_meta($meeting->ID, 'start_time', true);
$end = get_post_meta($meeting->ID, 'end_time', true);
$description = get_post_meta($meeting->ID, 'meeting_description', true);
$room = wp_get_post_terms( $meeting->ID, 'tlw_rooms_tax');
function dateToCal($timestamp) {
  return date('Ymd\THi00', $timestamp);
}
function escapeString($string) {
  return preg_replace('/([\,;])/','\\\$1', $string);
}
?>
BEGIN:VTIMEZONE<?php echo $eol; ?>
TZID:Europe/London<?php echo $eol; ?>
TZURL:http://tzurl.org/zoneinfo-outlook/Europe/London<?php echo $eol; ?>
X-LIC-LOCATION:Europe/London<?php echo $eol; ?>
BEGIN:DAYLIGHT<?php echo $eol; ?>
TZOFFSETFROM:+0000<?php echo $eol; ?>
TZOFFSETTO:+0100<?php echo $eol; ?>
TZNAME:BST<?php echo $eol; ?>
DTSTART:<?php echo dateToCal(strtotime("now")); ?><?php echo $eol; ?>
RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU<?php echo $eol; ?>
END:DAYLIGHT<?php echo $eol; ?>
BEGIN:STANDARD<?php echo $eol; ?>
TZOFFSETFROM:+0100<?php echo $eol; ?>
TZOFFSETTO:+0000<?php echo $eol; ?>
TZNAME:GMT<?php echo $eol; ?>
DTSTART:<?php echo dateToCal(strtotime("now +1hour")); ?><?php echo $eol; ?>
RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU<?php echo $eol; ?>
END:STANDARD<?php echo $eol; ?>
END:VTIMEZONE<?php echo $eol; ?>
BEGIN:VEVENT<?php echo $eol; ?>
UID: <?php echo uniqid(); ?><?php echo $eol; ?>
DTSTART;TZID="Europe/London":<?php echo dateToCal($start); ?><?php echo $eol; ?>
DTEND;TZID="Europe/London":<?php echo dateToCal($end); ?><?php echo $eol; ?>
SUMMARY:<?php echo escapeString($description); ?><?php echo $eol; ?>
DESCRIPTION:<?php echo escapeString("Booked by ".$booked_by->data->display_name); ?><?php echo $eol; ?>
LOCATION:<?php echo escapeString($room[0]->name);  ?><?php echo $eol; ?>
CLASS:PRIVATE<?php echo $eol; ?>
END:VEVENT<?php echo $eol; ?>
END:VCALENDAR<?php echo $eol; ?>