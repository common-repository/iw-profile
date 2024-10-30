
    <form action="<?php echo iw_login_current_url(); ?>/?iwprofile" method="post" class="iw_form" id="iw_login_form">
        <div class="tab-content-iw">
    <div class="iw_form_inner">

        <?php
        global $iw_login_errors;
        if (isset($iw_login_errors) && sizeof($iw_login_errors) > 0 && $iw_login_errors->get_error_code()) :
            echo '<ul class="errors">';
            foreach ($iw_login_errors->errors as $error) {
                echo '<li>' . $error[0] . '</li>';
                break;
            }
            echo '</ul>';
        endif;
        ?>

        <p class="column"><input type="text" class="text" name="log" id="iw_username"
                  placeholder="<?php _e('Username', 'iw-profile'); ?>"/></p>
        <p class="column column-alt"><input type="password" class="text" name="pwd" id="iw_password"
                  placeholder="<?php _e('Password', 'iw-profile'); ?>"/></p>
        <?php if (get_option('iwl_cap_log')) : ?>
            <p>
                <?php
                if (function_exists('cptch_display_captcha_custom')) {
                    echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />";
                    echo cptch_display_captcha_custom();
                } ?>
            </p>
        <?php endif; ?>
        <p><?php if (get_option('iwl_option_lost') == Enabled) {
                echo '<a class="forgotten" href="#iw_lost_password_form">' . __('Lost Password?', 'iw-profile') . '</a>';
            } else {
                echo '';
            } ?>
            <input type="submit" class="button" value="<?php _e('Login', 'iw-profile'); ?>"/>
            <input name="iw_login" type="hidden" value="true"/>
            <input name="rememberme" type="hidden" id="rememberme" value="forever"/>
            <input name="redirect_to" type="hidden" id="redirect_to" value="<?php echo iw_login_current_url(); ?>"/>
        </p>
    </div>
        </div>
</form>

