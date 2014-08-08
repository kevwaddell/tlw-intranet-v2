<aside class="user-actions actions-closed">
			
	<div class="user-btns"<?php if (!is_front_page()) { echo ' style="top: 80px;"';} ?>>
		
		<?php if (!is_front_page()) { ?>
		
		<a href="<?php echo get_option('home'); ?>/" class="user-btn"><span>Dashboard</span><i class="fa fa-home fa-lg"></i></a>
		
		<?php } ?>
		
		<?php if (is_user_logged_in()) { 
		global $current_user;
		$favs = unserialize( get_user_meta($current_user->ID, 'user_favourites', true) );	
		?>
		
		<a href="<?php echo wp_logout_url(); ?>" class="user-btn"><span>Logout</span><i class="fa fa-unlock-alt fa-lg"></i></a>
		
		<button id="user-links" class="user-btn"><span>User links</span><i class="fa fa-user fa-lg"></i></button>
		
		<?php if (count($favs) > 0) { ?>	
		<button id="favourites" class="user-btn"><span>favorites</span><i class="fa fa-star fa-lg"></i></button>
		<?php }  ?>
		
		<?php } else { ?>
		
		<a href="#log-in-alert" id="login" class="user-btn" data-toggle="modal"><span>Login</span><i class="fa fa-lock fa-lg"></i></a>
			
		<?php } ?>
		
		<button id="search" class="user-btn"><span>Search</span><i class="fa fa-search fa-lg"></i></button>
	</div>
				
	<?php if (is_user_logged_in()) { ?>

	<div id="user-links-box" class="user-actions-wrap">
	
		<div class="user-title">

			<?php 
			$profile_page = get_page_by_title('Your Profile');
			$avatar = get_avatar( $current_user->ID, 40 );
			//echo '<pre>';print_r($current_user);echo '</pre>';
			 ?>
		
			<span class="user-avatar"><?php echo $avatar; ?></span><?php echo $current_user->display_name; ?>
		
		</div>
	 
		<ul class="list-unstyled">
			<li><i class="fa fa-eye fa-lg"></i> <a href="<?php echo get_author_posts_url( $current_user->ID, $current_user->user_nicename); ?>">Your profile</a></li>
			<li><i class="fa fa-lock fa-lg"></i><?php wp_loginout( get_permalink($post->ID), true); ?></li>
			<?php if (current_user_can('administrator') || current_user_can('editor')) { ?>
			<li><i class="fa fa-cog fa-lg"></i> <a href="<?php echo admin_url(); ?>" target="_blank">Admin</a></li>
			<?php } ?>
		</ul>
	</div>
	
	<?php if (count($favs) > 0) { ?>
	<div id="favourites-box" class="user-actions-wrap">
		<h3>Your favourites</h3>
		
		<?php include (STYLESHEETPATH . '/_/inc/global/favourites-list.php'); ?>
		
		<div class="action-btns col-gray" style="margin-top: 10px;">
			<a href="<?php echo get_author_posts_url( $current_user->ID, $current_user->user_nicename); ?>" title="Edit Favourites" class="btn btn-default btn-block"><i class="fa fa-pencil fa-lg"></i>Edit Favourites</a>
		</div>
		
	</div>
	<?php }  ?>
	
	<?php } ?>
	
	<div id="search-box" class="user-actions-wrap">
		<h3>Search</h3>
		<?php get_template_part( 'hidden-searchform' ); ?>
	</div>


</aside>
