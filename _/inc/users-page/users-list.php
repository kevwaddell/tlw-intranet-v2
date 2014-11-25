<table class="user-list-table">
	
	<tbody>
		<?php foreach ($query->results as $user) { 
		$department_ids = get_the_author_meta( "department", $user->ID );
		$dep_ids_counter = 0;

		
		$job_title = get_the_author_meta( "job_title", $user->ID );
		$ext = get_the_author_meta( "extension", $user->ID );
		$user_counter++;
		//echo '<pre>';print_r($user);echo '</pre>';
		?>
		<tr class="entry-tr">
			<td colspan="6">
				<table class="table table-bordered">
					<tbody>
						<tr>
							
							<td class="avatar" rowspan="3">
								 <span class="user-avatar"><?php echo get_avatar( $user->ID, 150 ); ?></span>  
							</td>
							
							<td class="name">
								<?php echo get_the_author_meta('display_name', $user->ID);?>
								<?php echo ($ext) ? '<span class="pull-right"><i class="fa fa-phone-square"></i> '.$ext.'</span>':''; ?>
							</td>
							
							<td class="email">
								<a href="mailto:<?php echo get_the_author_meta('user_email', $user->ID);?>" title="Email "><?php echo get_the_author_meta('user_email', $user->ID);?></a>	
							</td>	
						</tr>
						<tr>
							<td class="department">
								
								<?php if (!empty($department_ids) ) { ?>
									
									<?php foreach ($department_ids as $dep_id) { 
									$dep_ids_counter++;	
									$dep = get_post($dep_id);
									?>
									
									<?php echo $dep->post_title; ?>
									
									<?php } ?>
		
								<?php } ?>
							
							</td>
							<td class="job-title">
								<?php if ($job_title) { ?>
								<?php echo $job_title;?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							
							<td class="ext-no">
								<?php if ($ext) { ?>
								Ext: <?php echo $ext;?>
								<?php } ?>
							</td>
							
							<td class="ext-no">
							
							</td>
			
						</tr>
							
					</tbody>
				</table>
			 </td>
		</tr>
		<?php } ?>
		
	</tbody>
	
</table>
