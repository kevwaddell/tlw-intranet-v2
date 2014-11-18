<?php if ( $_GET['request'] == 'add_to_favs') {  
$page_url = explode("?", $_SERVER['REQUEST_URI']);

$postid = $_GET['postid'];
$type = $_GET['type'];
?>

<div class="alert alert-success text-center">
	
Do you want to add<br><strong><?php echo $post->post_title; ?></strong><br>to your favourites.<br><br>
	
<div class="action-btns">
		
	<div class="row">
		<div class="col-xs-6">
				<a href="?action=add_to_favs&postid=<?php echo $postid;?>&type=<?php echo $type;?>" class="btn btn-success btn-block"><i class="fa fa-check fa-lg"></i> Yes</a>
			</div>
			<div class="col-xs-6">
				<a href="<?php echo $page_url[0]; ?>" class="btn btn-danger btn-block"><i class="fa fa-times fa-lg"></i> No</a>
			</div>
		</div>
	</div>

</div>

<?php } ?>