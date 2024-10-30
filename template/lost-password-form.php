<form action="<?php echo iw_login_current_url(); ?>" method="post" class="iw_form" autocomplete="off" id="iw_lost_password_form" style="display:none"><div class="iw_form_inner">
		<div class="tab-content-iw">
	<?php
		global $iw_lost_pass_errors;
		if (isset($iw_lost_pass_errors) && sizeof($iw_lost_pass_errors)>0 && $iw_lost_pass_errors->get_error_code()) :
			echo '<ul class="errors">';
			foreach ($iw_lost_pass_errors->errors as $error) {
				echo '<li>'.$error[0].'</li>';
				break;
			}
			echo '</ul>';
		endif; 
	?>
	
	<p><?php _e('Please enter your username or e-mail address. You will receive a new password via e-mail.', 'iw-profile'); ?></p>
	
	<p><label for="iw_lost_username"><?php _e('Username/Email','iw-profile'); ?>:</label> <input type="text" class="text" name="username_or_email" id="iw_lost_username" placeholder="<?php _e('you@yourdomain.com', 'iw-profile'); ?>" /></p>
<p><?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?></p>
	<p><input type="submit" class="button" value="<?php _e('Reset Password','iw-profile'); ?>" /><input name="iw_lostpass" type="hidden" value="true"  /></p>

</div>
	</div>
</form>