<div class="wrap">
    <h2><img src="<?php echo WP_PLUGIN_URL; ?>/iw-profile/img/icon1.png" alt="SB Login Settings"><?php _e('Profile page setting'); ?></h2>
    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
        echo '<div id="message" class="updated"><p>' . __('Settings saved.') . '</p></div>' . PHP_EOL;
    } ?>

    <div style="width: 68%; float: left;">
        <form method="post" action="options.php">
            <?php
            settings_fields('iwl-settings-group');

            $iwl_option_lost = get_option('iwl_option_lost');

            $iwl_option_xtra = get_option('iwl_option_xtra');
            $iwl_option_xtra_c = get_option('iwl_option_xtra_c');
            $iwl_option_xtra_link = get_option('iwl_option_xtra_link');

            $iwl_option_info = get_option('iwl_option_info');
            $iwl_option_woo = get_option('iwl_option_woo');
            $iwl_option_settings = get_option('iwl_option_settings');
            $email_name_c = get_option('email_name_c');
            $email_email_c = get_option('email_email_c');
            $email_name = get_option('email_name');
            $email_email = get_option('email_email');
            $iwl_cap_log = get_option('iwl_cap_log');
            $iwl_cap_reg = get_option('iwl_cap_reg');
            ?>
            <div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
                <h3 class="hndle" style="padding:5px; color:#007193;">Show/Add Links</h3>
                <div class="inside">
                    <div>
                        <table class="form-table">
                            <tr valign="top">
                                <p><b>If you want to show Captcha form please install <a
                                            href="http://wordpress.org/plugins/captcha/" target="_blank">Captcha
                                            Plugin</a>. Than it will automatically show Captcha form.</b></p>

                            </tr>

                            <tr valign="top">
                                <th scope="row"><?php _e('Show Lost your password:'); ?></th>
                                <td><input type="checkbox" name="iwl_option_lost"
                                           value="Enabled" <?php if (get_option('iwl_option_lost') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>


                            <tr valign="top">
                                <th scope="row"><?php _e('Show Info Tab:'); ?></th>
                                <td><input type="checkbox" name="iwl_option_info"
                                           value="Enabled" <?php if (get_option('iwl_option_info') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>
                            <?php
                            global $isWooActive;
                            if ($isWooActive): ?>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Show Woocommerce Tab like orders and track theme:'); ?></th>
                                    <td><input type="checkbox" name="iwl_option_woo"
                                               value="Enabled" <?php if (get_option('iwl_option_woo') == Enabled) echo('checked="checked"'); ?>/>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr valign="top">
                                <th scope="row"><?php _e('Show Settings Tab:'); ?></th>
                                <td><input type="checkbox" name="iwl_option_settings"
                                           value="Enabled" <?php if (get_option('iwl_option_settings') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Show Captcha In Login:'); ?></th>
                                <td><input type="checkbox" name="iwl_cap_log"
                                           value="Enabled" <?php if (get_option('iwl_cap_log') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Show Show Captcha In Registration:'); ?></th>
                                <td><input type="checkbox" name="iwl_cap_reg"
                                           value="Enabled" <?php if (get_option('iwl_cap_reg') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Add Extra Link:'); ?></th>
                                <td><input type="checkbox" name="iwl_option_xtra_c"
                                           value="Enabled" <?php if (get_option('iwl_option_xtra_c') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row"><?php _e('Add Extra Link:'); ?></th>
                                <td><input type="text" name="iwl_option_xtra"
                                           value="<?php $iwl_option_xtra = get_option('iwl_option_xtra');
                                           if (!empty($iwl_option_xtra)) {
                                               echo $iwl_option_xtra;
                                           } else {
                                               echo "";
                                           } ?>" placeholder="<?php _e('Text for Link:'); ?>"><input type="text"
                                                                                    name="iwl_option_xtra_link"
                                                                                    value="<?php $iwl_option_xtra_link = get_option('iwl_option_xtra_link');
                                                                                    if (!empty($iwl_option_xtra_link)) {
                                                                                        echo $iwl_option_xtra_link;
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>"
                                                                                    placeholder="<?php _e('Link address for button:'); ?>">
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 5px;color:#007193;font-size:16px;border-bottom: 1px solid #EEEEEE;">
                                    Email Customization
                                </th>
                            </tr>


                            <tr valign="top">
                                <th scope="row"><?php _e('Customize Email From Name:'); ?></th>
                                <td><input type="checkbox" name="email_name_c"
                                           value="Enabled" <?php if (get_option('email_name_c') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row"><?php _e('Email From Name:'); ?></th>
                                <td><input type="text" name="email_name"
                                           value="<?php $email_name = get_option('email_name');
                                           if (!empty($email_name)) {
                                               echo $email_name;
                                           } else {
                                               echo "";
                                           } ?>"></td>
                            </tr>

                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Customize From Email Address:'); ?></th>
                                <td><input type="checkbox" name="email_email_c"
                                           value="Enabled" <?php if (get_option('email_email_c') == Enabled) echo('checked="checked"'); ?>/>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Email Address From:'); ?></th>
                                <td><input type="text" name="email_email"
                                           value="<?php $email_email = get_option('email_email');
                                           if (!empty($email_email)) {
                                               echo $email_email;
                                           } else {
                                               echo "";
                                           } ?>"></td>
                            </tr>

                        </table>


                        <?php submit_button(); ?>
                    </div>

                </div>
            </div>
        </form>
    </div>
<?php echo iwl_sidebar(); ?>