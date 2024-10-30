<?php global $current_user,$before_title,$after_title; ?>
<div class="tab-content-iw">
    <div class="mainpro">
        <?php echo get_avatar($current_user->ID); ?>
        <div class="after-avatar">

            <?php echo $before_title; ?><?php _e('Welcome', 'iw-profile'); ?>
            <strong>
                <?php if (!empty($current_user->user_firstname))
                    echo $current_user->user_firstname;
                else echo $current_user->display_name;
                ?>
            </strong><?php echo $after_title; ?>

            <?php
            global $userdata;
            get_currentuserinfo();
            echo '<br>';
            echo _e('You logged in on ', 'iw-profile');
            echo '<strong>';
            iw_get_last_login($userdata->ID);
            echo '</strong>';
            ?>


            <ul class="links">


                <?php if (get_option('iwl_option_xtra_c')) : ?>
                    <li><a href="<?php $iwl_option_xtra_link = get_option('iwl_option_xtra_link');
                    if (!empty($iwl_option_xtra_link)) {
                        echo $iwl_option_xtra_link;
                    } else {
                        echo "";
                    } ?>"><?php $iwl_option_xtra = get_option('iwl_option_xtra');
                        if (!empty($iwl_option_xtra)) {
                            echo $iwl_option_xtra;
                        } else {
                            echo "";
                        } ?></a></li><?php endif; ?>

                <li>
                    <a href="<?php echo wp_logout_url(iw_login_current_url()); ?>"><?php _e('Log out', 'iw-profile'); ?></a>
                </li>
            </ul>
        </div>
    </div>

</div>
