<?php get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	

<?php 
$icon = get_field('icon', $meetings->ID);
$color = get_field('col', $meetings->ID);
?>	
		<article <?php post_class(); ?>>
			<h2 class="block-header<?php echo (!empty($color)) ? " col-".$color:""; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php the_title(); ?></h2>
			
			<?php the_content(); ?>
		</article>
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
