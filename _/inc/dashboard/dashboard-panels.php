<div class="row">
		
	<div class="col-xs-12">
			
		<div class="dash-panel col-aqua panel-open">
			<h2 class="panel-head"><i class="fa fa-rss fa-lg"></i>Latest News and Events from TLW</h2>
			<button class="close-panel-btn"><i class="fa fa-times fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
			
			<div class="panel-content">
			<?php include (STYLESHEETPATH . '/_/inc/dashboard/news-panel/latest-news-panel.php'); ?>
			</div>
		</div>
	
	</div>
	
	<div class="col-xs-6">
				
		<div class="dash-panel col-red panel-closed">
			<h2 class="panel-head"><i class="fa fa-bullhorn fa-lg"></i>Announcements</h2>
			<button class="close-panel-btn"><i class="fa fa-times fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
			
			<div class="panel-content">
			<?php include (STYLESHEETPATH . '/_/inc/dashboard/announcments-panel.php'); ?>
			</div>
		</div>
	
		<div class="dash-panel col-pink panel-closed">
			<h2 class="panel-head"><i class="fa fa-location-arrow fa-lg"></i>Out of office</h2>
			<button class="close-panel-btn"><i class="fa fa-times fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
			
			<div class="panel-content">
			<?php include (STYLESHEETPATH . '/_/inc/dashboard/out-of-office.php'); ?>
			</div>
		</div>
		
		<div class="dash-panel col-blue panel-closed">
			<h2 class="panel-head"><i class="fa fa-briefcase fa-lg"></i>Jobs Board</h2>
			<button class="close-panel-btn"><i class="fa fa-times fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
			
			<div class="panel-content">
			
			</div>
		</div>
		
	</div>
	
	<div class="col-xs-6">
	
		<div class="dash-panel col-purple panel-closed">
			<h2 class="panel-head"><i class="fa fa-clock-o fa-lg"></i>Meeting rooms</h2>
			<button class="close-panel-btn"><i class="fa fa-times fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
			
			<div class="panel-content">
			<?php include (STYLESHEETPATH . '/_/inc/dashboard/meeting-rooms-panel.php'); ?>
			</div>
		</div>
		
		<div class="dash-panel col-green panel-closed">
			<h2 class="panel-head"><i class="fa fa-trophy fa-lg"></i>Employee of the month</h2>
			<button class="close-panel-btn"><i class="fa fa-times fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
			
			<div class="panel-content">
			<?php include (STYLESHEETPATH . '/_/inc/dashboard/employee-of-month-panel.php'); ?>
			</div>
		</div>
		
		<div class="dash-panel col-orange panel-closed">
			<h2 class="panel-head"><i class="fa fa-bar-chart-o fa-lg"></i>Question of the day</h2>
			<button class="close-panel-btn"><i class="fa fa-times fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
			
			<div class="panel-content">
			<?php gravity_form(3, false, false, false, '', true, 1); ; ?>
			</div>
		</div>
	
	</div>
		
</div>