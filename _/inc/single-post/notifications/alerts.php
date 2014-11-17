<?php if (isset($_GET['request']) || isset($_GET['action']) ) { ?>
<div class="actions-wrap">

	<div class="alerts-wrap">
		<?php include (STYLESHEETPATH . '/_/inc/single-post/notifications/request-add-to-favourites.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/single-post/notifications/action-add-to-favourites.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/single-post/notifications/request-remove-favourite.php'); ?>
		<?php include (STYLESHEETPATH . '/_/inc/single-post/notifications/action-remove-favourite.php'); ?>
	</div>
	
</div>
<?php } ?>
