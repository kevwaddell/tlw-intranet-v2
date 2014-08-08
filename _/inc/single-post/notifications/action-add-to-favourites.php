<?php if ( isset($_GET['action']) && $_GET['action'] == 'add_to_favs') {  
	
	global $current_user;
	global $post;
	
	$favs = unserialize(get_user_meta($current_user->ID, 'user_favourites', true));
	$fav_info = array('post_id' => $post->ID, 'post_type'	=> $post->post_type);
	$errors = array();
	
	if (!is_array($favs)) {
	$user_meta_update = add_user_meta( $current_user->ID, 'user_favourites', serialize(array($fav_info)), true );
	} else {
	$all_favs = $favs;
	
		if ( in_array_r($post->ID, $all_favs) ) {
		$errors[] = "This item is already in your favourites.";	
		} else {
		array_push($all_favs, $fav_info);
		$user_meta_update = update_user_meta( $current_user->ID, 'user_favourites', serialize($all_favs) );
		}
	
	//echo '<pre>';print_r($errors);echo '</pre>';	
	}
	
	//echo '<pre>';print_r($favs);echo '</pre>';
	
?>

<?php if (count($errors) > 0) { ?>

<div class="alert alert-danger">
	
	<?php foreach ($errors as $error) { ?>
	<strong><?php echo $error; ?></strong><br>
	<?php } ?>
	<br>
	
<div class="action-btns">
	<a href="<?php the_permalink(); ?>" class="btn btn-danger btn-block">Continue</a>
</div>

</div>

<?php } else { ?>

<div class="alert alert-success">
	
<strong><?php echo $post->post_title; ?></strong> has been added to your favourites.<br><br>
	
<div class="action-btns">
	<a href="<?php the_permalink(); ?>" class="btn btn-success btn-block">Continue</a>
</div>

</div>

<?php } ?>

<?php } ?>