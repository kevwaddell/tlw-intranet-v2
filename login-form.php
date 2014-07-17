<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		<div class="form-group">
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username' ); ?></label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input form-control" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
		</div>
		<div class="form-group">
			<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password' ); ?></label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input form-control" value="" size="20" />
		</div>

		<?php do_action( 'login_form' ); ?>

		<div class="form-inline">
			<label for="rememberme<?php $template->the_instance(); ?>">
			<input name="rememberme" type="checkbox" class="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
			<span><?php esc_attr_e( 'Remember Me' ); ?></span>
			</label>
		</div>
		<div class="form-group submit">
			<input type="submit" name="wp-submit" class="btn btn-default btn-block" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="login" />
		</div>
	</form>
	<?php $template->the_action_links( array( 'login' => false ) ); ?>
</div>
