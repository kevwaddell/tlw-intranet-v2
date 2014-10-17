<?php
/*
Template Name: Calendar page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	

<?php 
$icon = get_field('icon');
$color = get_field('col');
$parent = get_page($post->post_parent);
$meetings_pg = get_page_by_title("Meetings");
$ical_page = get_page_by_title("Cal feed");
$rooms = get_terms('tlw_rooms_tax');
$ical_page_split_url = explode('http://', get_permalink($ical_page->ID));
$extra_content = get_field('extra_content');
//echo '<pre>';print_r($ical_page_split_url);echo '</pre>';
?>	
		<article <?php post_class(); ?>>
			<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:""; ?>">
			<?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?>
			<?php echo $parent->post_title; ?> <?php the_title(); ?>
			</h1>
			
			<?php if ($extra_content) { ?>
			<?php echo $extra_content; ?>
			<div class="rule"></div>
			<?php } ?>
			
			<div class="alerts alerts-off">
				<div class="alerts-wrap">
				<!-- NOTIFICATION ALERTS -->
				<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/add-meeting-request.php'); ?>
				<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/add-meeting-action.php'); ?>
				<?php include (STYLESHEETPATH . '/_/inc/meeting-rooms/notifications/add-meeting-approval.php'); ?>
				<!-- NOTIFICATION ALERTS -->
				</div>
			</div>
			
			<div class="action-btns<?php echo (!empty($color)) ? " col-".$color:""; ?>">
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-xs-6">
						<a href="<?php echo get_permalink($meetings_pg->ID); ?>" class="btn btn-default btn-block"><i class="fa fa-clock-o fa-lg"></i>Meetings</a>
					</div>
					<div class="col-xs-6">
						<?php if (is_user_logged_in()) { 
						$user_ID = get_current_user_id();		
						?>
						<a href="<?php the_permalink(); ?>?request=room_booking&userid=<?php echo $user_ID ; ?>" class="btn btn-default btn-block btn-action" data-toggle="modal"><i class="fa fa-check fa-lg"></i>Book a meeting room</a>
						<?php } else { ?>
						<a href="#log-in-alert" class="btn btn-default btn-block" data-toggle="modal"><i class="fa fa-check fa-lg"></i>Book a meeting room</a>
						<?php } ?>							
				</div>
				</div>		
				<a href="webcal://<?php echo $ical_page_split_url[1]; ?>" class="btn btn-default btn-block"><i class="fa fa-calendar fa-lg"></i>Download calendar</a>
			</div>
			
			<div class="rule"></div>

			<section class="calendar-section<?php echo (!empty($color)) ? " col-".$color:""; ?>">
				<?php the_content(); ?>
			</section>
			
		</article>
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
