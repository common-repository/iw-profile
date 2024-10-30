
<?php
global $before_title, $after_title, $current_user,$isWooActive,$iw_login_vars;
require_once($iw_login_vars['plugin_path'].'/include/form.php');
$current_user = wp_get_current_user();
?>
<div class="iw_logged_in" id="iw_user">
    <?php iw_login_load_template('logged-in/user.php'); ?>
</div>
<?php if($isWooActive){ ?>
<div class="iw_logged_in" id="iw_orders">
    <?php iw_login_load_template('logged-in/orders.php'); ?>
</div>
<div class="iw_logged_in" id="iw_order-tracking">
    <?php iw_login_load_template('logged-in/order-tracking.php'); ?>
</div>
<?php } ?>
<div class="iw_logged_in" id="iw_info">
    <?php iw_login_load_template('logged-in/info.php'); ?>
</div>
<div class="iw_logged_in" id="iw_settings">
    <?php iw_login_load_template('logged-in/settings.php'); ?>
</div>