<?php
/*
Template Name: Users list page
*/
?>

<?php get_header(); ?>

<?php 
$excluded_users = array(1, 60);
$emp_otm_user = get_field('employee_otm', 'options');

$all_users 	= get_users();

foreach ($all_users as $u) {
//print_r($u->caps);echo '<br>';
	if (empty($u->roles)) {
	//print_r($u->ID);echo '<br>';
	array_push($excluded_users, $u->ID);
	}
}

$number 	= 15;
$paged 		= (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset 	= ($paged - 1) * $number;

$users_args = array(
'exclude'	=> $excluded_users
);
$users 	= get_users($users_args);

$query_args = array(
'offset'	=> $offset,
'number'	=> $number,
'exclude'	=> $excluded_users,
'meta_key'	=> 'last_name',
'orderby'	=> 'meta_value'
);

$query 		= new WP_User_Query($query_args);
$total_users = count($users);
$total_query = count($query->total_users);
$total_pages = intval($total_users / $number) + 1;
$user_counter = 0;
//echo '<pre>';print_r($users);echo '</pre>';
$icon = get_field('icon');
$color = get_field('col');
?>

<article <?php post_class('page'); ?>>

<h1 class="block-header<?php echo (!empty($color)) ? " col-".$color:"col-gray"; ?>"><?php if (!empty($icon)) {  echo '<i class="fa '.$icon.' fa-lg"></i>'; }?><?php echo the_title(); ?></h1>

<?php if ($total_users > 0) { ?>

<div class="user-list">

	<div class="user-list-inner">
	
		<?php if ($total_users > $number) { ?>
		<div class="pagination-links user-pag user-pag-top">
		<?php echo paginate_links(array(  
		              'base' => get_pagenum_link(1) . '%_%',  
		              'format' => '?paged=%#%',  
		              'current' => $paged,  
		              'total' => $total_pages,  
		              'prev_text' => 'Previous',  
		              'next_text' => 'Next'  
		            )); 
		            
		 ?>
		</div>	
		<?php } ?>
	
		<div class="row">
		
		<?php foreach ($query->results as $user) { 
		$user_counter++;	
		//echo '<pre>';print_r($query);echo '</pre>';
		?>
		
		<div class="col-xs-5ths">
		
			<a href="<?php echo get_author_posts_url($user->ID);?>" id="user-link-<?php echo $user_counter; ?>" title="View Profile" class="user-link<?php echo ($user_counter >= 16 && $user_counter <= $number) ? ' last-link':'';?>">
				<?php if ($user->ID == $emp_otm_user['ID']) { ?>
				<span class="eotm-tag"></span>
				<?php } ?>

		        <span class="user-avatar"><?php echo get_avatar( $user->ID, 150 ); ?></span>  
		        <span class="user-name"> <?php echo get_the_author_meta('first_name', $user->ID);?><br><?php echo get_the_author_meta('last_name', $user->ID);?></span>  
		        
		    </a>  
	    
		</div>
	    
		<?php } ?>
		
		</div>
		
		<?php if ($total_users > $number) { ?>

		<div class="pagination-links user-pag user-pag-bot">
		<?php echo paginate_links(array(  
		              'base' => get_pagenum_link(1) . '%_%',  
		              'format' => '?paged=%#%',  
		              'current' => $paged,  
		              'total' => $total_pages,  
		              'prev_text' => 'Previous',  
		              'next_text' => 'Next'  
		            )); 
		            
		 ?>
		</div>	
		
		<?php } ?>

	</div>
	
</div>

<?php } else { ?>
<p>No users at the moment.</p>
<?php } ?>

</article>


<?php get_footer(); ?>
