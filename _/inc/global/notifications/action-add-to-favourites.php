<?php if ( $_GET['action'] == 'add_to_favs') {  
	
	$page_url = explode("?", $_SERVER['REQUEST_URI']);
	
	$favs = unserialize(get_user_meta($current_user->ID, 'user_favourites', true));
	$fav_info = array('post_id' => $_GET['postid'], 'post_type'	=> $_GET['type']);
	$errors = array();
	
	//echo '<pre>';print_r($favs);echo '</pre>';
	
	if (!empty($favs)) {

		if ( in_array_r($_GET['postid'],  $favs) ) {
		$errors[] = "This item is already in your favourites.";	
		} else {
		array_push($favs, $fav_info);
		update_user_meta( $current_user->ID, 'user_favourites', serialize($favs) );
		}
	} else {
	update_user_meta( $current_user->ID, 'user_favourites', serialize(array($fav_info)));
	}
?>

<?php if (empty($errors)) { ?>

<div class="alert alert-success text-center">
<h4><i class="fa fa-check-circle fa-lg"></i> Success</h4>
	
<strong><?php echo $post->post_title; ?></strong><br>has been added to your favourites.<br><br>
	
	<div class="action-btns">
		<a href="<?php echo $page_url[0]; ?>" class="btn btn-success btn-block">Continue</a>
	</div>

</div>

<?php } else { ?>

<div class="alert alert-danger text-center">
	
	<h4><i class="fa fa-warning fa-lg"></i> Errors</h4>
	
	<?php foreach ($errors as $error) { ?>
	<strong><?php echo $error; ?></strong><br>
	<?php } ?>
	<br>
	
	<div class="action-btns">
		<a href="<?php echo $page_url[0]; ?>" class="btn btn-danger btn-block">Continue</a>
	</div>

</div>

<?php } ?>

<?php } ?>