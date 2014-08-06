<?php get_header(); ?>

<?php
$news_page = get_page( get_option('page_for_posts') );
$icon = get_field('icon', $news_page->ID);
$feat_img = get_field('feat_img', $news_page->ID);
$color = get_field('col', $news_page->ID);

?>

<article class="page">
<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php echo $news_page->post_title; ?></h1>

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>		
		<article>
			<h1><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time>
			<?php the_excerpt(); ?>
		</article>
<?php endwhile; ?>
		
		<div class="pagination-links">
		
		<?php wp_pagenavi(); ?>		
		
		</div>	
		
<?php else: ?>
<h2>No posts to display</h2>
<?php endif; ?>

</div>

<?php get_footer(); ?>
