
<form action="<?php echo iw_login_current_url(); ?>" method="post" class="iw_form" autocomplete="off" id="iw_register_form" style="display:none"><div class="iw_form_inner">
		<div class="tab-content-iw">
	<?php
		global $iw_reg_errors;
		if (isset($iw_reg_errors) && sizeof($iw_reg_errors)>0 && $iw_reg_errors->get_error_code()) :
			echo '<ul class="errors">';
			foreach ($iw_reg_errors->errors as $error) {
				echo '<li>'.$error[0].'</li>';
				break;
			}
			echo '</ul>';
		endif; 
	?>
	
	<p><label for="iw_reg_username"><?php _e('Username','iw-profile'); ?>:</label> <input type="text" class="text" name="username" id="iw_reg_username" placeholder="<?php _e('Username', 'iw-profile'); ?>" /></p>
	<p><label for="iw_reg_email"><?php _e('Email','iw-profile'); ?>:</label> <input type="text" class="text" name="email" id="iw_reg_email" placeholder="<?php _e('you@yourdomain.com', 'iw-profile'); ?>" /></p>
	<p class="column"><label for="iw_reg_password"><?php _e('Password','iw-profile'); ?>:</label> <input type="password" class="text" name="password" id="iw_reg_password" placeholder="<?php _e('Password','iw-profile'); ?>" /></p>
	<p class="column column-alt"><label for="iw_reg_password_2" class="hidden"><?php _e('Re-enter','iw-profile'); ?>:</label> <input type="password" class="text" name="password2" id="iw_reg_password_2" placeholder="<?php _e('Re-enter Password','iw-profile'); ?>" /></p>
<?php if (get_option('iwl_cap_reg')) : ?><p><?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?></p><?php endif; ?>
	<p><input type="submit" class="button" value="<?php _e('Register','iw-profile'); ?>" /><input name="iw_register" type="hidden" value="true"  /></p>

</div>
	</div>
</form>
