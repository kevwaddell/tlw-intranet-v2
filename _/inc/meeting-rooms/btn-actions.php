<div class="action-btns<?php echo (!empty($color)) ? " col-".$color:""; ?>">
	<div class="row" style="margin-bottom: 10px;">
		<div class="col-xs-6">
			<?php if (is_user_logged_in()) { 
				
			?>
			<a href="<?php echo get_permalink($meetings->ID); ?>?request=room_booking&userid=<?php echo $current_user_ID ; ?>" class="btn btn-default btn-block btn-action no-arrow" data-toggle="modal"><i class="fa fa-check fa-lg"></i>Book a meeting room</a>
			<?php } else { ?>
			<a href="#log-in-alert" class="btn btn-default btn-block no-arrow" data-toggle="modal"><i class="fa fa-check fa-lg"></i>Book a meeting room</a>
			<?php } ?>
		</div>
		<div class="col-xs-6">
			<a href="<?php echo get_permalink($calendar->ID); ?>" class="btn btn-default btn-block"><i class="fa fa-calendar fa-lg"></i>View calendar</a>
		</div>
	</div>
</div>
