<div class="post-actions<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>">
		
	<a href="javascript:window.print()" title="Add to Favourites" class="btn"><span>Print</span><i class="fa fa-print fa-lg"></i></a>
	
	<?php if (is_user_logged_in()) { 
		if ($cat[0]->slug == 'office-news' || $cat[0]->slug == 'company-news') {
		$add_post_pg = get_page_by_title("Add Article");	
		}
		
		if ($cat[0]->slug == 'events') {
		$add_post_pg = get_page_by_title("Add Event");	
		}
		
		if ($cat[0]->slug == 'announcements') {
		$add_post_pg = get_page_by_title("Add Announcement");	
		}
		
	?>
	
	<a href="<?php esc_url( the_permalink() ); ?>?action=addto_favs" class="btn btn-action" title="Add to Favourites"><span>Add to Favourites</span><i class="fa fa-star fa-lg"></i></a>

	<a href="<?php echo get_permalink($add_post_pg->ID); ?>?httpref=<?php urlencode(the_permalink()); ?>" title="Add Post" class="btn"><span><?php echo $add_post_pg->post_title; ?></span><i class="fa fa-plus-circle fa-lg"></i></a>
	<?php } ?>
	
	<?php if ($current_user->ID == $post->post_author || current_user_can("administrator") || current_user_can("editor") ) { ?>
	<a href="<?php the_permalink(); ?>?request=edit_post&userid=<?php echo $current_user->ID; ?>" title="Edit Post" class="btn"><span>Edit Post</span><i class="fa fa-pencil fa-lg"></i></a>
	
	<?php } ?>
	
</div>