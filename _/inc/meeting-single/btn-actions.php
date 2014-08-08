<?php if ($post->post_author == $current_user_ID || current_user_can("administrator") ) { ?>
<div class="action-btns col-purple">
	<a href="<?php the_permalink(); ?>?request=add_attendee" id="add_attendee" class="btn btn-default btn-block" data-toggle="modal"><i class="fa fa-plus fa-lg"></i>Add Attendee</a>
</div>

<?php 
if ($start_time > $now) { ?>

<div class="rule"></div>
<div class="action-btns<?php echo (!empty($color)) ? " col-".$color:""; ?>">
	<div class="row">
		<div class="col-xs-6">
			<a href="<?php the_permalink(); ?>?request=edit" class="btn btn-default btn-block edit-meeting"><i class="fa fa-pencil fa-lg"></i>Edit</a>	
		</div>	
		<div class="col-xs-6">
			<a href="<?php the_permalink(); ?>?request=cancel" class="btn btn-default btn-block cancel-meeting btn-action"><i class="fa fa-times fa-lg"></i>Cancel</a>
		</div>
	</div>	
</div>
<?php } ?>

<?php } ?>