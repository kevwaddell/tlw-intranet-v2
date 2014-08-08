<div class="post-actions<?php echo (!empty($color)) ? " col-".$color:" col-gray"; ?>">
		
	<a href="javascript:window.print()" title="Print page" class="btn"><span>Print</span><i class="fa fa-print fa-lg"></i></a>
	
	<?php if (is_user_logged_in()) { ?>
	
	<a href="<?php esc_url( the_permalink() ); ?>?action=add_to_favs" class="btn btn-action" title="Add to Favourites"><span>Add to Favourites</span><i class="fa fa-star fa-lg"></i></a>

	<?php } ?>
	
</div>