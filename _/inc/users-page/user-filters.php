<div class="user-filters">
			
	<div class="row">
		<div class="col-xs-10">
			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<form action="<?php echo get_permalink($staff_members_pg->ID);?>" method="post">
							<select class="form-control selectpicker" name="by-department" id="by-department" onchange="this.form.submit()">			<option value="0">All Departments</option>
								<!-- <option value="0">By Department</option> -->
								<?php foreach ($departments as $department) { ?>
								<option value="<?php echo $department->ID; ?>"<?php echo (isset($_POST['by-department']) && $_POST['by-department'] == $department->ID) ? ' selected="selected"':'' ; ?>><?php echo $department->post_title; ?></option>
								<?php } ?>
							</select>
						</form>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="form-group">
					<form action="<?php echo get_permalink($staff_members_pg->ID);?>" method="post">
						<select class="form-control selectpicker" name="by-name" data-live-search="true" id="by-name" onchange="this.form.submit()">
							<option value="0">All Staff</option>
							<?php foreach ($select_users as $user) { ?>
							<option value="<?php echo $user->ID; ?>"<?php echo (isset($_POST['by-name']) && $_POST['by-name'] == $user->ID) ? ' selected="selected"':'' ; ?>><?php echo $user->data->display_name; ?></option>
							<?php } ?>
						</select>
					</form>
					</div>
				</div>
				
				<div class="col-xs-4">
					<div class="form-group">
					<form action="<?php echo get_permalink($staff_members_pg->ID);?>" method="post">
						<select class="form-control selectpicker" name="by-job-title" id="by-job-title" onchange="this.form.submit()">
							<option value="0">All Job titles</option>
							<?php foreach ($job_titles as $job_title) { ?>
							<option value="<?php echo $job_title; ?>"<?php echo (isset($_POST['by-job-title']) && $_POST['by-job-title'] == $job_title) ? ' selected="selected"':'' ; ?>><?php echo $job_title; ?></option>
							<?php } ?>
						</select>
					</form>
					</div>
				</div>
			</div>
		
		
		</div>
		
		<div class="col-xs-2">
			<div class="filter-actions">
				<a href="<?php echo get_permalink($staff_members_pg->ID);?>?list_style=grid" class="btn<?php echo ( !isset($_GET['list_style']) || $_GET['list_style'] == 'grid') ? " active":""; ?>" title="Grid"><i class="fa fa-th fa-lg"></i></a>
				<a href="<?php echo get_permalink($staff_members_pg->ID);?>?list_style=list" class="btn<?php echo ($_GET['list_style'] == 'list') ? " active":""; ?>" title="List"><i class="fa fa-list fa-lg"></i></a>
			</div>
		</div>
	</div>
</div>


