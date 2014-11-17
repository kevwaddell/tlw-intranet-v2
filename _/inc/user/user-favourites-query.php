<?php 
$favs = unserialize( get_user_meta($current_user->ID, 'user_favourites', true) );	
$original_favs = $favs;

foreach ($favs as $key => $fav) {
$item = get_post($fav['post_id']);
	if (!$item) {
		unset($favs[$key]);
	}

}
		
$diff_favs = array_diff($original_favs, $favs);
	
if (count($diff_favs) > 0) {
$user_meta_update = update_user_meta( $current_user->ID, 'user_favourites', serialize($favs) );	
$favs = unserialize( get_user_meta($current_user->ID, 'user_favourites', true) );
}

$fav_ids = array();

foreach ($favs as $fav) {
	
	if (!in_array($fav['post_id'], $fav_ids)) {
	array_push($fav_ids, $fav['post_id']);
	}	
}

echo '<pre>';
print_r($favs);
echo '<br>';
echo '<br>';
echo '<br>';
print_r($fav_ids);
echo '<br>';
echo '<br>';

if (!empty($fav_ids)) {
	
$fav_args = array(
'posts_per_page'	=> -1,
'order'	=> 'DESC',
'orderby' => 'date',
);
	
$user_favs = get_posts($fav_args);

if (!empty($fav_ids)) {
$favs_max_num_pages = ceil( count($fav_ids)/10);

	if (isset($_GET['fav_pg'])) {
	$slice_from = 10 * ($_GET['fav_pg'] - 1);
	$fav_ids = array_slice($fav_ids, $slice_from , 10);	
	} else {
	$fav_ids = array_slice($fav_ids, 0 , 10);	
	}

$fav_args['post__in' ] = $fav_ids;
}
$favs_query = new WP_Query( $fav_args );
print_r($favs_query);
echo '</pre>';
}

 ?>