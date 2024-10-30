<?php
$error = array();
/* If profile was saved, update profile. */
if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'update-user') {

    /* Update user information. */

    if (!empty($_POST['email'])) {
        if (!is_email(esc_attr($_POST['email'])))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif (email_exists(esc_attr($_POST['email'])) != $current_user->id)
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else {
            wp_update_user(array('ID' => $current_user->ID, 'user_email' => esc_attr($_POST['email'])));
            if ($isWooActive) {
                wp_update_user(array('ID' => $current_user->ID, 'billing_email' => esc_attr($_POST['email'])));
            }
        }
    }
    if (!empty($_POST['first_name']))
        update_user_meta($current_user->ID, 'first_name', esc_attr($_POST['first_name']));
    if (!empty($_POST['last_name']))
        update_user_meta($current_user->ID, 'last_name', esc_attr($_POST['last_name']));

    if ($isWooActive) {
        if (!empty($_POST['first_name']))
            update_user_meta($current_user->ID, 'billing_first_name', esc_attr($_POST['first_name']));
        if (!empty($_POST['last_name']))
            update_user_meta($current_user->ID, 'billing_last_name', esc_attr($_POST['last_name']));
        if (!empty($_POST['billing_phone']))
            update_user_meta($current_user->ID, 'billing_phone', esc_attr($_POST['billing_phone']));
        if (!empty($_POST['billing_city']))
            update_user_meta($current_user->ID, 'billing_city', esc_attr($_POST['billing_city']));
        if (!empty($_POST['billing_address_1']))
            update_user_meta($current_user->ID, 'billing_address_1', esc_attr($_POST['billing_address_1']));
        if (!empty($_POST['billing_postcode']))
            update_user_meta($current_user->ID, 'billing_postcode', esc_attr($_POST['billing_postcode']));
    }
    if (!empty($_POST['mobileNumber']))
        update_user_meta($current_user->ID, 'mobileNumber', esc_attr($_POST['mobileNumber']));
    if (!empty($_POST['DateofBirth']))
        update_user_meta($current_user->ID, 'DateofBirth', esc_attr($_POST['DateofBirth']));
    if (!empty($_POST['monthofBirth']))
        update_user_meta($current_user->ID, 'monthofBirth', esc_attr($_POST['monthofBirth']));
    if (!empty($_POST['yearofBirth']))
        update_user_meta($current_user->ID, 'yearofBirth', esc_attr($_POST['yearofBirth']));
    if ($_FILES && wp_verify_nonce($_POST['my_image_upload_nonce'], 'iwCustomAvatar')) {
        $admin_path = str_replace(get_bloginfo('url') . '/', ABSPATH, get_admin_url());
        $admin_path = apply_filters('my_plugin_get_admin_path', $admin_path);
        $iw_admin_url = $admin_path;
        require_once($iw_admin_url . 'includes/image.php');
        require_once($iw_admin_url . 'includes/file.php');
        require_once($iw_admin_url . 'includes/media.php');
        $iw_new_upload = media_handle_upload('iwCustomAvatar', 0);


        update_user_meta($current_user->ID, 'iwCustomAvatar', esc_attr(wp_get_attachment_url($iw_new_upload)));

    }


}
?>
 