<div class="page-section section-closed" style="margin-top: 10px;">
	
	<h3 class="section-header"><i class="fa fa-rss fa-lg"></i>Your News Articles</h3>
	<button class="close-section-btn"><i class="fa fa-minus-circle fa-lg"></i><i class="fa fa-chevron-circle-down fa-lg"></i></button>
	
	<div id="news-section-inner" class="section-inner">
	
		<div id="news-section-wrap" class="section-wrap">
		
			<div class="data-list-key">
			
				<div class="filters col-red">
					<span><a href="<?php echo get_author_posts_url($user_id);?>" <?php echo (!isset($_GET['post_sortby'])) ? " class=\"active\"":""; ?>>All</a></span>
					<span><a href="<?php echo get_author_posts_url($user_id);?>?post_sortby=publish"<?php echo (isset($_GET['post_sortby']) && $_GET['post_sortby'] == "publish") ? " class=\"active\"":""; ?>>Published</a></span>
					<span><a href="<?php echo get_author_posts_url($user_id);?>?post_sortby=pending"<?php echo (isset($_GET['post_sortby']) && $_GET['post_sortby'] == "pending") ? " class=\"active\"":""; ?>>Pending</a></span>
					<span><a href="<?php echo get_author_posts_url($user_id);?>?post_sortby=draft"<?php echo (isset($_GET['post_sortby']) && $_GET['post_sortby'] == "draft") ? " class=\"active\"":""; ?>>Draft</a></span>
				</div>
			
			</div>

	
			<div class="data-list-key">
			
				<div class="actions-key">
					<span class="actions"><i class="fa fa-cogs"></i> Actions</span>
					<span class="status"><i class="fa fa-info-circle"></i> Status</span>
				</div>
				
				<div class="status-key">
				<span class="published">Published</span>
				<span class="pending">Pending</span>
				<span class="draft">Draft</span>	
				</div>
		
			</div>
			<?php if ( $news_query->have_posts() ): 
			$news_count == 0;	
			?>
			<div class="data-list">
				<div class="data-list-wrap">
				
					<table class="data-list-table">
						<thead class="data-list-header">
							<tr>
								<th class="settings"><i class="fa fa-cogs fa-lg"></i></th>
								<th class="marker"><i class="fa fa-info-circle fa-lg"></i></th>
								<th class="description">Article title</th>
								<th class="time">Date added</th>
							</tr>
						</thead>
					
						<tbody>
					<?php while ( $news_query->have_posts() ) : $news_query->the_post(); 
					$news_count++;	
					$date_raw = strtotime(get_the_date());
					$date_raw = date('Ymd' , $date_raw);
					?>	
						<tr id="entry-tr-<?php echo $news_count; ?>" class="entry-tr">
							<td colspan="4">
								 <table class="table table-bordered">
										<tbody>
									<tr class="info-tr">	
										<td class="settings">
											<a href="#" id="view-btn-<?php echo get_the_ID(); ?>"class="btn btn-default settings"><i class="fa fa-cogs"></i></a>
										</td>
										<td class="marker <?php echo $post->post_status;?>">
											<i class="fa fa-square"></i>
										</td>
										<td class="description">
											<?php the_title(); ?>
										</td>
										<td class="time">
											<?php echo get_the_date();?>
										</td>
									</tr>
									<tr class="actions-tr actions-tr-closed" id="actions-tr-<?php echo get_the_ID(); ?>">
										<td colspan="4">
										
											<?php if ($current_user->ID == $user_id && $post->post_status != 'publish') { ?>
											<a href="#" class="btn btn-default edit"><i class="fa fa-pencil"></i> Edit article</a>
											<?php } ?>
											
											<?php if ($post->post_status != 'pending' && $post->post_status != 'draft') { ?>
											<a href="<?php the_permalink();?>" class="btn btn-default view"><i class="fa fa-eye"></i> View article</a>
											<?php } ?>
										
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
					<?php endwhile; ?>
						</tbody>
					</table>
					
					<?php if (count($your_news_ids) > 10) { 
						
						if (isset($_GET['post_sortby'])) {
						$url_format = '&post_sortby='.$_GET['post_sortby'];	
						}
						
					?>
	
					<div class="pagination-links pagination-actions">
					
					<?php if ( isset($_GET['yn_pg']) && $_GET['yn_pg'] > 1 ) { ?>
					
					<a class="prev page-numbers" href="?yn_pg=<?php echo ($_GET['yn_pg'] - 1); ?><?php echo $url_format; ?>">&laquo; Previous</a>
					
					<?php } ?>
					
					<?php for ($np = 1; $np <= $news_max_num_pages; $np++) { ?>
						
						<?php if ( !isset($_GET['yn_pg']) ) { ?>
							
							<?php if ( $np == 1) { ?>
							
							<span class="page-numbers current"><?php echo $np; ?></span>
							
							<?php } ?>
							
							<?php if ( $np != 1) { ?>
							
							<a class="page-numbers" href="?yn_pg=<?php echo $np; ?><?php echo $url_format; ?>"><?php echo $np; ?></a>
								
							<?php } ?>
							
						<?php } else { ?>
							
							<?php if ( $np == $_GET['yn_pg'] ) { ?>
							<span class="page-numbers current"><?php echo $np; ?></span>
							<?php } else { ?>
							<a class="page-numbers" href="?yn_pg=<?php echo $np; ?><?php echo $url_format; ?>"><?php echo $np; ?></a>
							<?php } ?>
							
						<?php } ?>
							
					<?php } ?>
					
					<?php if ( !isset($_GET['yn_pg']) || $_GET['yn_pg'] < $news_max_num_pages ) { ?>
					
					<a class="next page-numbers" href="?yn_pg=<?php echo (isset($_GET['yn_pg'])) ? ($_GET['yn_pg'] + 1): "2"; ?><?php echo $url_format; ?>">Next &raquo;</a>
					
					<?php } ?>
					
					</div>	
				
					<?php } ?>
				
				</div>
			</div>
			
		 <?php else: ?>
		 
		 <div class="well text-center">
		
		<?php 
			switch ( $_GET['post_sortby'] ) { 
			case "publish": $message = "You have no news articles awaiting approval.";
			break;
			case "pending": $message = "You have no published news articles at the moment.";
			break;
			case "draft": $message = "You have no draft news articles at the moment.";
			break;
			default: $message = "You have no news articles at the moment.";
			}  
		 ?>
		 
		 <?php echo $message; ?>
		 
		</div>
			
		 <?php endif;
		 wp_reset_postdata();
		  ?>
	
		</div><!-- Section inner wrap -->

	</div><!-- Section inner -->
	
</div>
