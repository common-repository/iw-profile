<?php
global $isWooActive;
$the_link= $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<div class="tab-content-iw">
    <form method="post" id="adduser" action="<?php echo esc_url($the_link); ?>" enctype="multipart/form-data">
        <p class="form-username">
            <label for="iwCustomAvatar"><?php _e('Your Profile Image:', 'iw-profile'); ?></label>
            <input class="text-input" name="iwCustomAvatar" type="file"
                   id="iwCustomAvatar"/>
        </p><!-- .form-username -->
        <p class="form-username">
            <label for="first_name"><?php _e('Name', 'iw-profile'); ?></label>
            <input class="text-input" name="first_name" type="text"
                   id="first_name"
                   value="<?php the_author_meta('first_name', $current_user->ID); ?>"/>
        </p><!-- .form-username -->

        <p class="form-username">
            <label for="last_name"><?php _e('Last Name', 'iw-profile'); ?></label>
            <input class="text-input" name="last_name" type="text"
                   id="last_name"
                   value="<?php the_author_meta('last_name', $current_user->ID); ?>"/>
        </p><!-- .form-username -->

        <p class="form-username">
            <label for="email"><?php _e('Email', 'iw-profile'); ?></label>
            <input class="text-input" name="email" type="text" id="email"
                   value="<?php the_author_meta('user_email', $current_user->ID); ?>"/>
        </p>
        <?php if ($isWooActive) { ?>
            <p class="form-username">
                <label for="billing_phone"><?php _e('Tel Number', 'iw-profile'); ?></label>
                <input class="text-input" name="billing_phone" type="text" id="billing_phone"
                       value="<?php the_author_meta('billing_phone', $current_user->ID); ?>"/>
            </p>
        <?php } ?>
        <p class="form-username">
            <label for="mobileNumber"><?php _e('Mobile Number', 'iw-profile'); ?></label>
            <input class="text-input" name="mobileNumber" type="text" id="mobileNumber"
                   value="<?php the_author_meta('mobileNumber', $current_user->ID); ?>"/>
        </p>

        <p class="form-user-select">
            <label for="DateofBirth"><?php _e('Date of Birth', 'iw-profile'); ?></label>

            <select name="DateofBirth" id="DateofBirth">
                <?php for ($i = 1; $i <= 31; $i++) { ?>
                    <option value="<?php echo $i; ?>"
                        <?php
                        $get = get_the_author_meta('DateofBirth', $current_user->ID);
                        if ($i == (int)$get) {
                            ?> selected
                        <?php } ?>
                    >
                        <?php echo $i; ?></option>
                    <?php
                } ?>
            </select>
            <select name="monthofBirth" id="monthofBirth">
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                    <option value="<?php echo $i; ?>"
                        <?php
                        $get = get_the_author_meta('monthofBirth', $current_user->ID);
                        if ($i == (int)$get) {
                            ?> selected
                        <?php } ?>
                    >
                        <?php echo $i; ?></option>
                    <?php
                } ?>
            </select>
            <select name="yearofBirth" id="yearofBirth">
                <?php for ($i = 1300; $i <= 1394; $i++) { ?>
                    <option value="<?php echo $i; ?>"
                        <?php
                        $get = get_the_author_meta('yearofBirth', $current_user->ID);
                        if ($i == (int)$get) {
                            ?> selected
                        <?php } ?>
                    >
                        <?php echo $i; ?></option>
                    <?php
                } ?>
            </select>
        </p>

        <?php if ($isWooActive) { ?>
            <p class="form-username">
                <label for="billing_city"><?php _e('city', 'iw-profile'); ?></label>
                <input class="text-input" name="billing_city" type="text" id="billing_city"
                       value="<?php the_author_meta('billing_city', $current_user->ID); ?>"/>
            </p>

            <p class="form-textarea">
                <label for="billing_address_1"><?php _e('address', 'iw-profile') ?></label>
                                    <textarea name="billing_address_1" id="billing_address_1" rows="3"
                                              cols="50"><?php the_author_meta('billing_address_1', $current_user->ID); ?></textarea>
            </p><!-- .form-textarea -->
            <p class="form-username">
                <label for="billing_postcode"><?php _e('Postal Code', 'iw-profile'); ?></label>
                <input class="text-input" name="billing_postcode" type="text" id="billing_postcode"
                       value="<?php the_author_meta('billing_postcode', $current_user->ID); ?>"/>
            </p>
        <?php } ?>
        <p class="form-submit">
            <?php echo $referer; ?>
            <input name="updateuser" type="submit" id="updateuser" class="submit button"
                   value="<?php _e('submit', 'iw-profile'); ?>"/>
            <?php wp_nonce_field('update-user'); ?>
            <?php wp_nonce_field('iwCustomAvatar', 'my_image_upload_nonce'); ?>
            <input name="action" type="hidden" id="action" value="update-user"/>
        </p><!-- .form-submit -->
    </form><!-- #adduser -->
</div>
