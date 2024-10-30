<?php
 if (is_user_logged_in()) : 
	
	global $current_user,$isWooActive;
	$current_user = wp_get_current_user();
	?>
<div class="accnt-hdr">
        <h2>
			<span class="accnt-icn"></span>
				<?php
				_e('My Account', 'iw-profile');
				?>
		</h2>
	<ul class="iw_tabs">
		<li class="active"><a href="#iw_user"><?php echo $current_user->user_login; ?></a></li>
		<?php if (get_option('iwl_option_woo') && $isWooActive) : ?><li><a href="#iw_orders"><?php _e('Orders', 'iw-profile'); ?></a></li><?php endif; ?>
		<?php if (get_option('iwl_option_woo') && $isWooActive) : ?><li><a href="#iw_order-tracking"><?php _e('Order Tracking', 'iw-profile'); ?></a></li><?php endif; ?>
		<?php if (get_option('iwl_option_info')) : ?><li><a href="#iw_info"><?php _e('Info', 'iw-profile'); ?></a></li><?php endif; ?>
		<?php if (get_option('iwl_option_settings')) : ?><li><a href="#iw_settings"><?php _e('Settings', 'iw-profile'); ?></a></li><?php endif; ?>
	</ul>
	</div>
	
<?php else : ?>
	 <div class="accnt-hdr">
	 <h2>
		 <span class="accnt-icn"></span>
		 <?php
		 _e('My Account');
		 ?>
	 </h2>
	<ul class="iw_tabs">
		<li class="active"><a href="#iw_login_form"><?php _e('Login', 'iw-profile'); ?></a></li>
		<?php if (get_option('users_can_register')) : ?><li><a href="#iw_register_form"><?php _e('Register', 'iw-profile'); ?></a></li><?php endif; ?>
	</ul>
	 </div>

<?php endif; ?>