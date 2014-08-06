<?php
/*
Template Name: Holiday request page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	

<?php 
$calendar = get_page_by_title("Holidays Calendar");
$current_user_ID = get_current_user_id();
$icon = get_field('icon', $meetings->ID);
$color = get_field('col', $meetings->ID);
$rb_admin = get_field('rb_admin', 'options');
?>	
		<article <?php post_class(); ?>>
			<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php the_title(); ?></h1>
			
			<?php include (STYLESHEETPATH . '/_/inc/holiday-request/banner-imgs.php'); ?>
			
			<?php the_content(); ?>
			
			<div class="rule"></div>
			
			<div class="action-btns<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>">
				<?php if (is_user_logged_in()) { ?>
				
				<a href="<?php the_permalink(); ?>?request=holiday&userid=<?php echo $current_user_ID ; ?>" class="btn btn-default btn-block btn-action"><i class="fa fa-check fa-lg"></i>Make a holiday request</a>
				<?php } else { ?>
				<a href="#log-in-alert" class="btn btn-default btn-block" data-toggle="modal"><i class="fa fa-check fa-lg"></i>Make a holiday request</a>
				<?php } ?>
				
				<?php if (current_user_can("administrator") || $current_user_ID == $rb_admin['ID']) { ?>
				<a href="<?php echo get_permalink($calendar->ID); ?>" class="btn btn-default btn-block"><i class="fa fa-calendar fa-lg"></i>View Holidays calendar</a>
				<?php } ?>
			</div>
			
			<div class="rule"></div>
			
			<div class="alerts alerts-off">
				<div class="alerts-wrap">
				<!-- NOTIFICATION ALERTS -->
				<?php include (STYLESHEETPATH . '/_/inc/holiday-request/notifications/add-holiday-request.php'); ?>
				<?php include (STYLESHEETPATH . '/_/inc/holiday-request/notifications/add-holiday-action.php'); ?>
				<?php include (STYLESHEETPATH . '/_/inc/holiday-request/notifications/add-holiday-approval.php'); ?>
				<!-- NOTIFICATION ALERTS -->
				</div>
			</div>
			
			<section class="page-section">
				<div class="lists-wrap">
					
					<?php include (STYLESHEETPATH . '/_/inc/holiday-request/data-list-query.php'); ?>
					
					<!-- OUT OF OFFICE SECTION -->
					<?php include (STYLESHEETPATH . '/_/inc/holiday-request/out-of-office-list.php'); ?>
					<!-- OUT OF OFFICE SECTION END -->
					
				</div>
			</section>


		</article>
		
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
