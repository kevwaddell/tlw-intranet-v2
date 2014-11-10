<?php 
$args = array( 'hide_empty' => 0 );
$rooms = get_terms('tlw_rooms_tax', $args);
//echo '<pre>';print_r($rooms);echo '</pre>';
 ?>

<div class="banner-imgs">
	<div class="row">
		<?php foreach ($rooms as $room) { ?>
		<div class="col-xs-4">
			<figure class="img">
				<img src="http://www.abbeyoffices.com/_images/assets/locations/image-gallery-full/Meeting-room_8.jpg" width="100%">
				<figcaption><?php echo $room->name; ?></figcaption>
			</figure>
			
		</div>
		<?php } ?>
			
	</div>
</div>