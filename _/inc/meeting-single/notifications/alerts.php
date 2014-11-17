<?php if (isset($_GET['request']) || isset($_GET['action']) || $_SERVER['REQUEST_METHOD'] === 'POST' ) { ?>
<div class="actions-wrap">

	<div class="alerts-wrap">
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/add-attendee-request.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/add-attendee-action.php'); ?>
		
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/remove-attendee-action.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/notify-attendee-action.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/user-accept-email.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/user-reject-email.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/user-remove-email.php'); ?>
		
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/cancel-meeting-request.php'); ?>
		
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/request-add-to-favourites.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/request-remove-favourite.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/action-add-to-favourites.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/meeting-single/notifications/action-remove-favourite.php'); ?>
	</div>

</div>
<?php } ?>
