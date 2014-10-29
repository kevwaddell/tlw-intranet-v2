<?php 
$form_url = explode("?", $_SERVER['REQUEST_URI']);
?>

<form action="<?php echo get_option('home'); ?><?php echo $form_url[0]; ?>" method="post" class="meeting-form" id="add_meeting_form">

	<input type="hidden" name="userid" id="userid" value="<?php echo $_GET['userid']; ?>">
	
	<small class="help-block">* Required</small>
	
	<div class="form-group">
		<label for="meeting_description"><span class="required">*</span>Meeting description</label>
		<input type="text" id="meeting_description" name="description" class="form-control" placeholder="Enter a meeting description" value="<?php echo (isset($_POST['description'])) ? $_POST['description']:""; ?>">
		<p class="help-block">e.g (Weekly team meeting).</p>
	</div>
	
	<div class="form-group">
		<label for="meeting_room"><span class="required">*</span>Room</label>
		<select class="form-control" id="meeting_room" name="meeting_room">
			<option value="0">Choose a room</option>
	<?php foreach ($rooms as $room) { ?>
			<option value="<?php echo $room->term_id; ?>"<?php echo (isset($_POST['meeting_room']) && $_POST['meeting_room'] == $room->term_id) ? " selected":""; ?>><?php echo $room->name; ?></option>
	<?php } ?>
	
		</select>
	</div>
	
	<div class="form-group">
	<label for="meeting_date"><span class="required">*</span>Date</label>
	<input type="text" id="meeting_date" name="meeting_date" class="form-control date-picker" placeholder="Choose a date" value="<?php echo (isset($_POST['meeting_date'])) ? $_POST['meeting_date']:""; ?>">
	</div>
		
	<div class="form-group form-inline">
		<label for="meeting_room">Start time</label>
		<select class="form-control" id="start_hrs" name="start_hrs">
			<?php for($h = 8 ; $h <= 16; $h++) { ?>
			<option value="<?php echo sprintf('%02d', $h); ?>"<?php echo (isset($_POST['start_hrs']) && $_POST['start_hrs'] == sprintf('%02d', $h)) ? " selected":""; ?>><?php echo sprintf('%02d', $h); ?></option>
			<?php } ?>
		</select>
		<span>:</span>
		<select class="form-control" id="start_mins" name="start_mins">
			<?php for($m = 0 ; $m <= 55; $m++) { ?>
				<?php if(($m % 5) == 0) { ?>
			<option value="<?php echo sprintf('%02d', $m); ?>"<?php echo (isset($_POST['start_mins']) && $_POST['start_mins'] == sprintf('%02d', $m)) ? " selected":""; ?>><?php echo sprintf('%02d', $m); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		&nbsp;&nbsp;
		<label>End time</label>
		<select class="form-control" id="end_hrs" name="end_hrs">
			<?php for($h = 9 ; $h <= 17; $h++) { ?>
			<option value="<?php echo sprintf('%02d', $h); ?>"<?php echo (isset($_POST['end_hrs']) && $_POST['end_hrs'] == sprintf('%02d', $h)) ? " selected":""; ?>><?php echo sprintf('%02d', $h); ?></option>
			<?php } ?>
		</select>
		<span>:</span>
		<select class="form-control" id="end_mins" name="end_mins">
			<?php for($m = 0 ; $m <= 55; $m++) { ?>
				<?php if(($m % 5) == 0) { ?>
			<option value="<?php echo sprintf('%02d', $m); ?>"<?php echo (isset($_POST['end_mins']) && $_POST['end_mins'] == sprintf('%02d', $m)) ? " selected":""; ?>><?php echo sprintf('%02d', $m); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
	</div>
	
	<div class="action-btns">
		<div class="row">
			<div class="col-xs-6">
				<?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
				<input type="submit" value="Send request" name="add_meeting" class="btn btn-info btn-block">
			</div>
			<div class="col-xs-6">
			<a href="<?php echo get_permalink($send_id); ?>" class="btn btn-info btn-block cancel-btn" title="Cancel">Cancel</a>
			</div>
		</div>
	</div>
		
</form>