<?php get_header(); ?>

<?php 
if (isset($_GET['type'])) {

	switch ($_GET['type']) {
		case "all": $search_args = array('s'=>$s, 'posts_per_page' => -1 );
		break;
		case "office-news":
		case "company-news":
		case "events":
		case "announcements": 
		$search_args = array('s'=>$s, 'post_type' => 'post' ,'posts_per_page' => -1, 'category_name' =>  $_GET['type']);
		break;
		case "meetings":
		$search_args = array('s'=>$s, 'post_type' => 'tlw_meeting' ,'posts_per_page' => -1);
		break;
	}
	
} else {
$search_args = array('s'=>$s, 'posts_per_page' => -1 );
}

$allsearch = new WP_Query($search_args); 
wp_reset_query();
$search_count = $allsearch->post_count;
$search_query = get_search_query(); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$search_args['paged'] = $paged;
$search_args['posts_per_page'] = 10;
$wp_query = new WP_Query( $search_args );
//echo '<pre>';print_r($wp_query);echo '</pre>';
?>

<?php
$icon = 'fa-search';
$color = 'red';
?>

<article class="page">
<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?>Search Results</h1>

	<h2 class="text-center">Search Results</h2>
	<p class="intro text-center">You Searched for: "<?php the_search_query(); ?>"<br> Results: <?php echo $search_count; ?></p>
	
	<div class="search-form-wrap">
	<?php get_search_form(); ?>
	</div>
	
	<div class="rule"></div>
	
	<section class="search-list">

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

	<div class="well well-lg">
		<h3 class="text-center">Sorry</h3>
		<p class="text-center">There are no search results for "<?php echo $search_query; ?>". Please try again.</p>
	</div>
	
	<?php endif; ?>
	
	</section>

</div>

<?php get_footer(); ?>
