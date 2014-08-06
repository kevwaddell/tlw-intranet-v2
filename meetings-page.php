<?php
/*
Template Name: Meetings page
*/
?>

<?php get_header(); ?>

<?php 
$current_user_ID = get_current_user_id();
$meetings = get_page_by_title('Meetings');
$calendar = get_page_by_title('Calendar');
$meetings_page_content_raw = $meetings->post_content;
$meetings_page_content = apply_filters('the_content', $meetings_page_content_raw );
$icon = get_field('icon', $meetings->ID);
$color = get_field('col', $meetings->ID);
$today = date('Ymd');
$today_start = strtotime("Today 08:00");
$today_end = strtotime("Today 18:00");
$ics_options = get_option('ICSAdminOptions');
$ics_files = unserialize($ics_options[ics_files]);
$rooms = get_terms('tlw_rooms_tax');
$rb_admin = get_field('rb_admin', 'options');
/*
echo '<pre>';
print_r($today_start."<br>");
print_r(date("D jS F Y H:i", $today_start)."<br><br>");
echo '</pre>';
*/
//echo '<pre>';print_r($current_user_ID);echo '</pre>';
?>


<article <?php post_class('page'); ?>>
	
	<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	
	
	<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:""; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php echo $meetings->post_title; ?></h1>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/banner-imgs.php'); ?>

	<?php if (!empty($meetings_page_content)) { ?>
	<?php echo $meetings_page_content ; ?>
	<?php } ?>
	
	<?php endwhile; ?>
	<?php endif; ?>

	<div class="rule"></div>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/btn-actions.php'); ?>								
						
	<div class="rule"></div>

	<div class="alerts alerts-off">
		<div class="alerts-wrap">
	<!-- NOTIFICATION ALERTS -->
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/add-meeting-request.php'); ?>
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/add-meeting-action.php'); ?>
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/add-meeting-approval.php'); ?>
					
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/booking-request-action.php'); ?>
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/approve-meeting-request.php'); ?>
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/approve-meeting-action.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/reject-meeting-request.php'); ?>
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/reject-meeting-action.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/cancel-meeting-request.php'); ?>
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/cancel-meeting-action.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/notify-attendees-cancel-action.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/delete-meeting-request.php'); ?>
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/delete-meeting-action.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/edit-meeting-action.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/update-meeting-action.php'); ?>
		<!-- NOTIFICATION ALERTS -->
		</div>
	</div>
	
	<section class="page-section">
		<div class="lists-wrap">
			
			<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/data-list-query.php'); ?>
			
			<!-- MEETINGS SECTION -->
			<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/meeting-list.php'); ?>
			<!-- MEETINGS SECTION END -->
			
			</div>
	</section>


</article>

<?php get_footer(); ?>
