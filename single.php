<?php include (STYLESHEETPATH . '/_/inc/single-post/notifications/post-update.php'); ?>

<?php get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	

<?php 
global $current_user;
get_currentuserinfo();
$icon = 'fa-rss';
$color = 'col-aqua';
$cat = get_the_category();
$cat_id = $cat[0]->term_id;
$tags = implode( ", ", wp_get_post_terms($post->ID, 'post_tag', array("fields" => "names") ) ) ; 
$icon = get_field('icon', 'category_'.$cat_id);
$color = get_field('color', 'category_'.$cat_id);

/*
if ($cat[0]->slug == 'events') {
$icon = 'fa-calendar';	
}

if ($cat[0]->slug == 'announcements') {
$icon = 'fa-bullhorn';	
}
*/
?>	
		<article <?php post_class('page'); ?>>

		<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>"><i class="fa <?php echo $icon; ?> fa-lg"></i><?php echo $cat[0]->name; ?> </h1>
		
			<div class="row">
				<div class="col-xs-3">
				
				<?php get_sidebar('single'); ?>
				
				</div>
				
				<div class="col-xs-8">
					
					<div class="content-outer">
						<div class="content-inner">
						
							<?php if (isset($_GET['userid']) && $_GET['request'] == "edit_post") { 
								$user_id = get_user_by('id', $_GET['userid']);
							?>
							
							<?php include (STYLESHEETPATH . '/_/inc/single-post/notifications/edit-post-form.php'); ?>
							
							<?php } else {  ?>
							
							<header class="page-header<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>">
								<h2><?php the_title(); ?></h2>
							</header>
							
							<?php if ($cat[0]->slug == 'events') { ?>	
							
							<?php include (STYLESHEETPATH . '/_/inc/single-post/details-box.php'); ?>
							
							<?php } ?>

							
							<div class="hentry-txt<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>">
								<?php the_content(); ?>
							</div>
							
							<?php } ?>
							
						</div>
					</div>
					
				</div>
				
				<div class="col-xs-1">
					
					<?php include (STYLESHEETPATH . '/_/inc/single-post/btn-actions.php'); ?>
					
				</div>
			
			</div>
			
			<div class="next-prev-posts<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>">
			<?php 
			$next_post = get_adjacent_post( true, '', false);
			$prev_post = get_adjacent_post( true, '', true);
			//echo '<pre>';print_r($prev_post);echo '</pre>';
			?>
				<div class="row">
					<div class="col-xs-6">
						<?php if (!empty($prev_post)) { ?>
						<a href="<?php echo get_permalink($prev_post->ID); ?>" title="View previous post" class="prev-post">
							<i class="fa fa-angle-double-left fa-lg"></i><?php echo $prev_post->post_title; ?>
						</a>
						<?php } ?>
					</div>
					<div class="col-xs-6">
						<?php if (!empty($next_post)) { ?>
						<a href="<?php echo get_permalink($next_post->ID); ?>" title="View next post" class="next-post">
							<?php echo $next_post->post_title; ?><i class="fa fa-angle-double-right fa-lg"></i>
						</a>
						<?php } ?>
					</div>
				</div>
			
			</div>
			
		</article>
		
		<div class="alerts alerts-off">
			<div class="alerts-wrap">
			
			</div>
		</div>
		
		
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
