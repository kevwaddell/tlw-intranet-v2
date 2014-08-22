<div id="carousel-office-news" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php for ($on = 0; $on < count($office_news); $on++) { ?>
	<li data-target="#carousel-office-news" data-slide-to="<?php echo $on; ?>"<?php echo ($on == 0) ? ' class="active"':''; ?>></li>
  	<?php } ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
  
  <?php 
  global $post;
  foreach ($office_news as $post) : 
  setup_postdata($post);  
  	if (has_post_thumbnail()) {
	$post_thumbnail_id = get_post_thumbnail_id();
	$img_src = wp_get_attachment_image_src($post_thumbnail_id, 'img-3-col-crop');		
  	} else {
  	$img_src = wp_get_attachment_image_src($office_news_feat_img['id'], 'img-3-col-crop'); 	
  	}
  	$img_url =  $img_src[0];
  	
  	//echo '<pre>';print_r($img_url);echo '</pre>';
  ?>
  
  	<?php if ($post == reset($office_news)) { ?>
  	<div class="item active">
  	<?php } else { ?>
  	<div class="item">
  	<?php } ?>
  		
    	<div class="row">
    		<div class="col-xs-3">
		    	<div class="img" style="background-image: url(<?php echo $img_url; ?>);"></div>
    		</div>
	    	<div class="col-xs-9">
	    		<div class="txt">
					<h3><?php the_title(); ?></h3>
					<time class="post-date"><span>Published on:</span> <?php echo get_the_date(); ?></time>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="post-link">View Article</a>
	    		</div>
	    	</div>
    	</div>
    </div>  	
  	
 <?php 
 endforeach; 
 wp_reset_postdata(); 
 ?>

  </div>

</div>

<div class="panel-btns">
	
	<?php if (is_user_logged_in()) { ?>
	
	<div class="row">
		
		<div class="col-xs-6">
			<a href="<?php echo get_category_link( $on_cat_id ); ?>" class="btn btn-default btn-block"><i class="fa fa-eye fa-lg"></i>All Office News</a>
		</div>
		
		<div class="col-xs-6">
			<a href="<?php echo get_permalink($add_article_pg->ID); ?>?httpref=<?php echo $home_url; ?>" class="btn btn-default btn-block"><i class="fa fa-plus-circle fa-lg"></i>Submit an Article</a>
		</div>
		
	</div>
	
	<?php } else { ?>
	<a href="<?php echo get_category_link( $on_cat_id ); ?>" class="btn btn-default btn-block">All Office News</a>
	<?php } ?>
	
</div>