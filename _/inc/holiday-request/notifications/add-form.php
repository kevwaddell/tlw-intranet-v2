<form action="<?php the_permalink(); ?>" method="post" class="holiday-form" id="add_holiday_form">

	<input type="hidden" name="userid" id="userid" value="<?php echo $_GET['userid']; ?>">
	
	<small class="help-block">* Required</small>
	
	<div class="form-group">
	<label for="start_date"><span class="required">*</span>Start date</label>
	<input type="date" id="holiday_start_date" name="holiday_start_date" class="form-control date-picker" placeholder="Choose a date" value="<?php echo (isset($_POST['holiday_start_date'])) ? $_POST['holiday_start_date']:""; ?>">
	</div>
	
	<div class="form-group">
	<label for="num_days"><span class="required">*</span>Number of days</label>
	<input type="number" id="num_days" name="num_days" class="form-control" placeholder="0.0" step="0.5" value="<?php echo (isset($_POST['num_days'])) ? $_POST['num_days']:""; ?>">
	<p class="help-block">e.g 1 or 1.5 for half days.</p>
	</div>
			
	<div class="action-btns">
		<div class="row">
			<div class="col-xs-6">
				<input type="submit" value="Send request" class="btn btn-info btn-block">
			</div>
			<div class="col-xs-6">
			<a href="<?php the_permalink(); ?>" class="btn btn-info btn-block cancel-btn" title="Cancel">Cancel</a>
			</div>
		</div>
	</div>
		
</form>