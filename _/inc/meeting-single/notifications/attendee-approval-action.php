<?php if ( isset($_GET['request']) && $_GET['request'] == "user_approval") { ?>

	<?php if (is_user_logged_in()) { ?>
		
		<div class="alert alert-success">
		Please complete your attendee request using the buttons below.<br><br>
		
		<div class="action-btns">
			<div class="row">
				<div class="col-xs-6">
					<a href="<?php the_permalink(); ?>?action=accept&user_key=<?php echo $_GET['user_key']; ?>&user=<?php echo $_GET['user']; ?>" class="btn btn-success btn-block accept btn-action"><i class="fa fa-check fa-lg"></i>Accept invite</a>
				</div>
				
				<div class="col-xs-6">
					<a href="<?php the_permalink(); ?>?action=reject&user_key=<?php echo $_GET['user_key']; ?>&user=<?php echo $_GET['user']; ?>" class="btn btn-danger btn-block reject btn-action"><i class="fa fa-times fa-lg"></i>Reject invite</a>
				</div>
			</div>
		</div>
		
		</div>
	
	<?php } else { ?>
	
		<div class="alert alert-danger">
		<strong>Please login to complete your request <a href="#log-in-alert" data-toggle="modal" class="btn btn-default btn-danger">Login</a></strong>
		</div>

	<?php } ?>
	
	<div class="rule"></div>

<?php }  ?>

