<?php
$today_start = strtotime("Today 08:00");
$today_end = strtotime("Today 18:00");
$args = array( 'hide_empty' => 0 );
$rooms = get_terms('tlw_rooms_tax', $args);
$meetings_pg = get_page_by_title('Meetings');
$calendar_pg = get_page_by_title('Calendar');
//echo '<pre>';print_r($rooms);echo '</pre>';
 ?>

<div class="panel-feeds">

	<ul class="nav nav-tabs">
		<?php foreach ($rooms as $room) { ?>
		
		<?php if ($room == reset($rooms)) { ?>
		<li class="active">
		<?php } else { ?>
		<li>
		<?php } ?>
		
		<a href="#panel-<?php echo $room->slug; ?>" data-toggle="tab"><?php echo $room->name; ?></a></li>
		<?php } ?>
	</ul>
	
	<!-- Tab panes -->
	<div class="tab-content">
	
	<?php foreach ($rooms as $room) { 
	$meeting_args = array(
	'post_type' => 'tlw_meeting',
	'posts_per_page' => -1,
	'order'	=> 'ASC',
	'meta_key'	=> 'start_time',
	'orderby' => 'meta_value_num',
	'rooms'	=> $room->slug,
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'start_time',
			'value' => $today_start,
			'compare' => '>'
		),
		array(
			'key' => 'end_time',
			'value' => $today_end,
			'compare' => '<'
		)
	)	
	);
	
	$meetings = get_posts($meeting_args);	
	//echo '<pre>';print_r($meetings);echo '</pre>';	
	?>
	<?php if ($room == reset($rooms)) { ?>
	<div class="tab-pane active" id="panel-<?php echo $room->slug; ?>">
	<?php } else { ?>
	<div class="tab-pane" id="panel-<?php echo $room->slug; ?>">
	<?php } ?>
		
		<?php if (!empty($meetings)) { ?>
		
		<div class="panel-feed">
			<div class="panel-feed-wrap">
			
			<ul class="list-unstyled">
			
				<?php foreach ($meetings as $meeting) { 
				$description = get_field('meeting_description', $meeting->ID);
				$start_time = get_field('start_time', $meeting->ID);
				$end_time = get_field('end_time', $meeting->ID);
				$booked_by = get_user_by('id', $meeting->post_author);
				?>
				<li>
					<p class="time"><span>Time:</span> <?php echo date('g:ia', $start_time);?> - <?php echo date('g:ia', $end_time);?></p>	
					<p class="title"><span>Meeting:</span> <?php echo $description; ?></p>
					<p class="name"><span>Booked by:</span> <?php echo $booked_by->data->display_name; ?></p>
				</li>
				<?php } 
				$meetings = array();	
				?>
				
			</ul>
			
			</div>
		</div>
		
		<?php } else { ?>
		<div class="well">
		<?php echo $room->name; ?> is available today.
		</div>
		<?php } ?>
		
	</div>
	
	<?php } ?>
				
	</div>

</div>

<div class="panel-btns">
	<a href="<?php echo get_permalink($meetings_pg->ID); ?>" class="btn btn-default btn-block"><i class="fa fa-check fa-lg"></i>Book a room</a>
	<a href="<?php echo get_permalink($calendar_pg->ID); ?>" class="btn btn-default btn-block"><i class="fa fa-calendar fa-lg"></i>View calendar</a>
</div>
