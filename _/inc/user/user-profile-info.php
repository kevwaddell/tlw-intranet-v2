<div class="user-details">

	<div class="row">
		
		<div class="col-xs-2">
		
			<div class="user-avatar">  
			 <?php echo get_avatar( $user_id, 200 ); ?>      
			</div> 
			
		</div>
		
		<div class="col-xs-10">
			
			<?php if ($current_user->ID == $user_id && !is_super_admin()) { 
			$edit_profile_pg = get_page_by_title("Edit Profile");	
			?>
			<?php if ($current_user->ID != $rb_admin['ID']) { ?>
			<div class="action-btns col-red">
				<a href="<?php echo get_permalink($edit_profile_pg->ID); ?>" title="Edit profile" class="btn btn-default btn-block"><i class="fa fa-pencil fa-lg"></i>Edit your profile</a>
			</div>
			<div class="rule"></div>
			<?php } ?>
			
			<?php } ?>
			
			<div class="row">	
				
				<div class="col-xs-5">
					<div class="info-label">Name:</div> 
				</div>
				<div class="col-xs-7">
					<div class="text"><?php echo $user_display_name; ?></div>
				</div>
				
			</div>
			
			<?php if (current_user_can("administrator") || $current_user->ID == $user_id || $current_user->ID == $rb_admin['ID']) { ?>
			
			<div class="row">	
				<div class="col-xs-5">
					<div class="info-label">Username:</div> 
				</div>
				<div class="col-xs-7">
					<div class="text"><?php echo $user_name; ?></div>
				</div>
			</div>
			
			<?php if (!empty($user_start_date_raw)) { ?>
			<div class="row">
				<div class="col-xs-5">
					<div class="info-label">Start date:</div> 
				</div>
				<div class="col-xs-7">
					<div class="text"><?php echo $user_start_date; ?></div>
				</div>
			</div>
			<?php } ?>
			
			<?php if (!empty($user_holidays)) { ?>
			<div class="row">
				<div class="col-xs-5">
					<div class="info-label">Number of holidays:</div> 
				</div>
				<div class="col-xs-7">
					<div class="text"><?php echo $user_holidays; ?></div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-5">
					<div class="info-label">Holidays <?php echo date("Y", time()); ?>:</div> 
				</div>
				<div class="col-xs-7">
					<div class="text">
					Used <span class="badge"><?php echo $holidays_used; ?></span> | 
					booked <span class="badge"><?php echo $holidays_booked; ?></span> |
					left <span class="badge"><?php echo $holidays_left; ?></span>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<?php } ?>
			
			<div class="row">	
				
				<div class="col-xs-5">
					<div class="info-label">Email:</div> 
				</div>
				<div class="col-xs-7">
					<div class="text"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></div>
				</div>
				
			</div>
			
			<?php if (!empty($user_job_title)) { ?>
			<div class="row">	
				
				<div class="col-xs-5">
					<div class="info-label">Job title:</div> 
				</div>
				<div class="col-xs-7">
					<div class="text"><?php echo $user_job_title; ?></div>
				</div>
				
			</div>
			<?php } ?>
			
			<?php if (!empty($user_department)) { 
			$dep_counter = 0;	
			?>
			<div class="row">	
				
				<div class="col-xs-5">
					<div class="info-label">
					<?php if (count($user_department) > 1) { ?>
					Departments:
					<?php } else { ?>
					Department:
					<?php } ?>
					</div> 
				</div>
				<div class="col-xs-7">
					<div class="text">
						<?php foreach($user_department as $dep) {
						$dep_page = get_page($dep);	
						$dep_counter++;
						?>
						
						<?php if ($dep_counter > 1) { echo " | ";} ?>
						<a href="<?php echo get_permalink($dep); ?>" title="View <?php echo $dep_page->post_title; ?> department"><?php echo $dep_page->post_title; ?></a>
						<?php } ?>
					</div>
				</div>
				
			</div>
			<?php } ?>
			
			<?php if ($job_description) { ?>
			
			<div class="job-info">
			<h4>Job Description</h4>
			<div class="txt"><?php echo $job_description; ?></div>
			</div>
			<?php } ?>
			
		</div>
		
	</div>
	
		<?php if ($current_user->ID == $user_id && !is_super_admin()) { 
			$holiday_request_pg = get_page_by_title("Holiday Requests");
			$meetings_page = get_page_by_title("Meetings");
			?>
			
			<?php if ($current_user->ID != 60) { ?>
			<div class="rule"></div>
			<div class="action-btns col-red">
				<a href="?request=add_holiday&userid=<?php echo $current_user->ID; ?>" title="Make a holiday request" class="btn btn-default btn-block no-arrow btn-action"><i class="fa fa-plane fa-lg"></i>Make a holiday request</a>
				<a href="<?php echo get_permalink($meetings_page->ID); ?>" title="Edit profile" class="btn btn-default btn-block no-arrow"><i class="fa fa-clock-o fa-lg"></i>Book a meeting room</a>
			</div>
			<?php } ?>
			
			<?php } ?>
			
			<div class="rule"></div>	

</div>