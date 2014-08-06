<?php
/*
Template Name: Add article page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	

<?php 
$icon = get_field('icon');
$color = get_field('col');

$return_url = get_home_url();

if ( isset($_GET['httpref']) ) {
$return_url = urldecode($_GET['httpref']);
}
?>	

	<div class="alerts<?php echo (isset($_POST['userid']) || isset($_GET['postid'])) ? '':' alerts-off'; ?>">
		<div class="alerts-wrap">
			
		<?php include (STYLESHEETPATH . '/_/inc/add-post/notifications/add-post-action.php'); ?>	
		<?php include (STYLESHEETPATH . '/_/inc/add-post/notifications/confirm-post-action.php'); ?>	
		
		</div>
	</div>

	<article <?php post_class(); ?>>
		<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:""; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php the_title(); ?></h1>
		
		
		<div id="info-alert" class="alert alert-info hidden">
		<button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		
		<?php the_content(); ?>
		</div>
		
		<div class="editor-form-wrap">
			<div class="row">
				<div class="col-xs-11">
					<?php include (STYLESHEETPATH . '/_/inc/add-post/add-post-form.php'); ?>
				</div>
				<div class="col-xs-1">
					<?php include (STYLESHEETPATH . '/_/inc/add-post/btn-actions.php'); ?>
				</div>
			</div>
		</div>
		
	</article>
	
	<div id="help-video" class="modal fade">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title">Help Video</h4>
	      </div>
	      <div class="modal-body">
	     	 <video width="100%" height="auto" controls>
			 	 <source src="http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4" type="video/mp4">
			 	 <source src="http://clips.vorwaerts-gmbh.de/big_buck_bunny.ogv" type="video/ogg">
			 	 Your browser does not support the video tag.
			 </video>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->

					
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
