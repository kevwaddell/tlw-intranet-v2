<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'profile' ); ?>
	<?php $template->the_errors(); ?>
	<div class="row">	
				
	<div class="col-xs-5">
			<div class="info-label">Name:</div> 
		</div>
		<div class="col-xs-7">
			<div class="text"><?php echo esc_attr( $profileuser->first_name ); ?> <?php echo esc_attr( $profileuser->last_name ); ?></div>
		</div>
	
	</div>
	
	<div class="row">	
		<div class="col-xs-5">
			<div class="info-label">Username:</div> 
		</div>
		<div class="col-xs-7">
			<div class="text"><?php echo esc_attr( $profileuser->user_login ); ?></div>
		</div>
	</div>

	<form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" style="margin-top: 20px;" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php _e( 'New Password' ); ?></h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<p class="help-block"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.' ); ?></p>
					<div class="input-group input-group-lg">
					 <span class="input-group-addon"><i class="fa fa-shield"></i></span>
					 <input class="form-control" type="password" name="pass1" id="pass1" size="16" value="" placeholder="Enter new password" autocomplete="off">
					</div>
				</div>
				
				<div class="form-group">
					<p class="help-block"><?php _e( 'Type your new password again.' ); ?></p>
					<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-shield"></i></span>
					 <input class="form-control" type="password" name="pass2" id="pass2" size="16" placeholder="Must match above" value="" autocomplete="off">
					</div>
				</div>
				
				<div id="pass-strength-result"><?php _e( 'Strength indicator', 'theme-my-login' ); ?></div>
				<p class="help-block"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).' ); ?></p>
				
			</div>
		</div>
		
		<input type="hidden" name="action" value="profile" />
		<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
		<div class="action-btns col-red">
			<div class="row">
			<div class="col-xs-6">
				<input type="submit" class="btn btn-block" value="<?php esc_attr_e( 'Update Profile' ); ?>" name="submit" />
			</div>
			<div class="col-xs-6">
				<a href="<?php echo get_author_posts_url( $current_user->ID, $current_user->user_nicename); ?>" class="btn btn-block no-arrow" title="Cancel">Cancel</a>
			</div>
		</div>
		
	</form>
</div>
