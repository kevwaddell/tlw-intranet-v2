<?php get_header(); ?>

<?php 
$current_user_ID = get_current_user_id();
$meetings = get_page_by_title('Meetings');
$meeting_rooms_pg = get_page($meetings->post_parent);
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

	<h2 class="block-header<?php echo (!empty($color)) ? " col-".$color:""; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php echo $meetings->post_title; ?></h2>
	
	<div class="action-btns<?php echo (!empty($color)) ? " col-".$color:""; ?>">
		<a href="<?php echo get_permalink($meeting_rooms_pg->ID); ?>" class="btn btn-default btn-block no-arrow"><i class="fa fa-angle-double-left fa-lg"></i><?php echo $meeting_rooms_pg->post_title; ?></a>
	</div>
	
	<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/banner-imgs.php'); ?>

	<?php if (!empty($meetings_page_content)) { ?>
	<?php echo $meetings_page_content ; ?>
	<?php } ?>

	<div class="rule"></div>
									
	<div class="action-btns<?php echo (!empty($color)) ? " col-".$color:""; ?>">
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-xs-6">
				<?php if (is_user_logged_in()) { 
					
				?>
				<a href="<?php echo get_permalink($meetings->ID); ?>?request=room_booking&userid=<?php echo $current_user_ID ; ?>" class="btn btn-default btn-block btn-action" data-toggle="modal"><i class="fa fa-check fa-lg"></i>Book a meeting room</a>
				<?php } else { ?>
				<a href="#log-in-alert" class="btn btn-default btn-block" data-toggle="modal"><i class="fa fa-check fa-lg"></i>Book a meeting room</a>
				<?php } ?>
			</div>
			<div class="col-xs-6">
				<a href="<?php echo get_permalink($calendar->ID); ?>" class="btn btn-default btn-block"><i class="fa fa-calendar fa-lg"></i>View calendar</a>
			</div>
		</div>
	</div>
					
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
