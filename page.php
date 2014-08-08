<?php get_header(); ?>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>	

<?php 
$icon = get_field('icon');
$color = get_field('col');
?>	
		<article <?php post_class(); ?>>
			<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:""; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php the_title(); ?></h1>
			
			<?php the_content(); ?>
			
			<div class="rule"></div>
			
		</article>
		
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
