<?php
$form_url = explode("?", $_SERVER['REQUEST_URI']);
//echo '<pre>';print_r(explode("?", $_SERVER['REQUEST_URI']));echo '</pre>';
 ?>

<form action="<?php echo get_option('home'); ?><?php echo $form_url[0]; ?>" method="post" class="holiday-form" id="add_holiday_form">

	<input type="hidden" name="userid" id="userid" value="<?php echo $_GET['userid']; ?>">
	
	<small class="help-block">* Required</small>
	
	<div class="form-group">
		<label for="start_date_day">All Day</label>
		<div class="form-group">
		<label class="radio-inline">
			<input type="radio" name="start_date_day" id="full-day-radio" value="Y" checked="checked"> Yes
		</label>
		<label class="radio-inline">
			<input type="radio" name="start_date_day" id="half-day-radio" value="N"> No
	  	</label>
		</div>
  	</div>

	<div class="form-group">
	<label for="start_date"><span class="required">*</span>Start date</label>
	<input type="text" id="holiday_start_date" name="holiday_start_date" class="form-control date-picker" placeholder="Choose a date" value="<?php echo (isset($_POST['holiday_start_date'])) ? $_POST['holiday_start_date']:""; ?>">
	</div>
	
	<div class="form-group">
		<label for="start_date">Start time</label>
        <input name="start_time" type="text" class="form-control timepicker" placeholder="h:mm PM" data-default-time="false">
	</div>
		
	<div class="form-group">
	<label for="num_days"><span class="required">*</span>Number of days</label>
	<input type="number" id="num_days" name="num_days" class="form-control" placeholder="0.0" step="0.5" value="<?php echo (isset($_POST['num_days'])) ? $_POST['num_days']:""; ?>">
	<p class="help-block">e.g 1 or 1.5 for half days.</p>
	</div>
			
	<div class="action-btns">
		<div class="row">
			<div class="col-xs-6">
				<input type="submit" value="Send request" name="add_holiday" class="btn btn-info btn-block">
			</div>
			<div class="col-xs-6">
			<a href="<?php echo get_option('home'); ?><?php echo $form_url[0]; ?>" class="btn btn-info btn-block cancel-btn" title="Cancel">Cancel</a>
			</div>
		</div>
	</div>
		
</form>