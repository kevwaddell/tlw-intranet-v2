<?php get_header(); ?>

<?php include (STYLESHEETPATH . '/_/inc/user/user-vars.php') ?>

<?php include (STYLESHEETPATH . '/_/inc/user/user-data-query.php'); ?>

<article class="user-profile page">
<h1 class="block-header col-red"><i class="fa fa-user fa-lg"></i><?php echo ($current_user->ID == $user_id) ?  "Your":"Staff";?> Profile</h1>

<!-- USER PROFILE INFO -->
<?php include (STYLESHEETPATH . '/_/inc/user/user-profile-info.php'); ?>
<!-- USER PROFILE INFO END -->

<!-- MEETINGS DATA LIST -->

<?php if ($current_user->ID == $user_id || current_user_can("administrator") ) { ?>
<section class="page-section">
	<div class="lists-wrap">
		
	<?php include (STYLESHEETPATH . '/_/inc/user/user-meetings.php'); ?>	
	
	<?php include (STYLESHEETPATH . '/_/inc/user/user-holidays.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/user/user-news.php'); ?>	
	
	<?php include (STYLESHEETPATH . '/_/inc/user/user-events.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/user/user-announcements.php'); ?>
		
	</div>
</section>
<?php } ?>

</article>

<?php get_footer(); ?>
