<div class="panel-articles">

	<ul class="nav nav-tabs">
	  <li class="active"><a href="#company-news" data-toggle="tab">Company News</a></li>
	  <li><a href="#office-news" data-toggle="tab">Office News</a></li>
	  <li><a href="#events" data-toggle="tab">Events</a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active fade in" id="company-news">
		<?php include (STYLESHEETPATH . '/_/inc/dashboard/news-panel/company-news.php'); ?>
		</div>
		<div class="tab-pane fade" id="office-news">
		<?php include (STYLESHEETPATH . '/_/inc/dashboard/news-panel/office-news.php'); ?>
		</div>
		<div class="tab-pane fade" id="events">
		<?php include (STYLESHEETPATH . '/_/inc/dashboard/news-panel/events.php'); ?>
		</div>
	</div>
	
</div>