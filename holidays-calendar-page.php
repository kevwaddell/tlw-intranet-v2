<?php
/*
Template Name: Holidays Calendar page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	

<?php 
$icon = get_field('icon');
$color = get_field('col');
$parent = get_page($post->post_parent);
$request_pg = get_page_by_title("Holiday Request");
$ical_page = get_page_by_title("Holidays Cal Feed");
$rooms = get_terms('tlw_rooms_tax');
$form = get_field('form', $post->post_parent);
$ical_page_split_url = explode('http://', get_permalink($ical_page->ID));
$extra_content = get_field('extra_content');
//echo '<pre>';print_r($ical_page_split_url);echo '</pre>';
?>	
		<article <?php post_class(); ?>>
			<h2 class="block-header<?php echo (!empty($color)) ? " col-".$color:""; ?>">
			<?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?>
			<?php the_title(); ?>
			</h2>
			
			<?php if ($extra_content) { ?>
			<?php echo $extra_content; ?>
			<div class="rule"></div>
			<?php } ?>
			
			<div class="action-btns<?php echo (!empty($color)) ? " col-".$color:""; ?>">	
				<a href="<?php echo get_permalink($request_pg->ID); ?>" class="btn btn-default btn-block no-arrow"><i class="fa fa-angle-double-left fa-lg"></i><?php echo $request_pg->post_title; ?></a>
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
