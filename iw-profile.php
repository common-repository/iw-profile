<?php
/*
Plugin Name: iw Profile
Plugin URI: http://IDEHWEB.com
Description: iw profile widget that allows a user to login, register, reset their password, see recent activity,time , post , Woocommerce order and track theme, information for users and comment count ALL without leaving their current location! It also allow to change wordpress email form name and address.
Version: 1.4
Author: Hamid Reza Alinia
Author URI: http://IDEHWEB.com
*/

/*
Copyright (C) 2016  Hamid Reza Alinia

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANT ABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

global $iw_login_vars, $wpdb, $isWooActive;

$iw_login_vars['plugin_path'] = WP_PLUGIN_DIR . '/iw-profile';
$iw_login_vars['plugin_url'] = WP_PLUGIN_URL . '/iw-profile';
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    $isWooActive = true;
} else
    $isWooActive = false;
load_plugin_textdomain('iw-profile', $iw_login_vars['plugin_url'] . '/langs/', 'iw-profile/langs/');

###[ Detect Ajax ]###############################################[ IDEHWEB.COM ]####

if (!function_exists('iw_is_ajax')) {
    function iw_is_ajax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') return true;
        return false;
    }
}

###[ Get Current URL ]###########################################[ IDEHWEB.COM ]####

function iw_login_current_url()
{
    $pageURL = 'http://';
    $pageURL .= $_SERVER['HTTP_HOST'];
    $pageURL .= $_SERVER['REQUEST_URI'];
    if (force_ssl_login() || force_ssl_admin()) $pageURL = str_replace('http://', 'https://', $pageURL);
    return $pageURL;
}

###[ Update user data upon logging in ]###########################################[ IDEHWEB.COM ]####

function iw_your_last_login($login)
{
    global $user_ID;
    $user = get_userdatabylogin($login);
    update_usermeta($user->ID, 'last_login', current_time('mysql'));
}

add_action('wp_login', 'iw_your_last_login');
function iw_get_last_login($user_id)
{
    $last_login = get_user_meta($user_id, 'last_login', true);
    $date_format = get_option('date_format') . ' ' . get_option('time_format');
    $the_last_login = mysql2date($date_format, $last_login, false);
    echo $the_last_login;
}

function iw_update_user_meta($user_id)
{
    update_user_meta($user_id, 'iw_login_time', current_time('timestamp'));
    update_user_meta($user_id, 'iw_num_comments', wp_count_comments()->approved);
    update_user_meta($user_id, 'iw_num_posts', wp_count_posts('post')->publish);
}

###[ Update user data upon viewing post ]###########################################[ IDEHWEB.COM ]####

function iw_update_user_view_meta()
{
    if (is_user_logged_in() && is_single()) :

        global $post;
        $user_id = get_current_user_id();
        $posts = get_user_meta($user_id, 'iw_viewed_posts', true);
        if (!is_array($posts)) $posts = array();
        if (sizeof($posts) > 4) array_shift($posts);
        if (!in_array($post->ID, $posts)) $posts[] = $post->ID;
        update_user_meta($user_id, 'iw_viewed_posts', $posts);

    endif;
}

add_action('wp_head', 'iw_update_user_view_meta');

###[ Init ]######################################################[ IDEHWEB.COM ]####

function iw_login_init_script()
{
    global $iw_login_vars;
    if (!is_admin()) :
        wp_register_script('ajax_login_js', $iw_login_vars['plugin_url'] . '/js/login.js', 'jquery', '1.0', true);
        wp_register_script('blockui', $iw_login_vars['plugin_url'] . '/js/blockui.js', 'jquery', '1.0', true);
        wp_enqueue_script('jquery');
        wp_enqueue_script('ajax_login_js');
        wp_enqueue_script('blockui');
    endif;
}

add_action('init', 'iw_login_init_script');

function iw_login_init_style()
{
    global $iw_login_vars;
    $logincss = $iw_login_vars['plugin_url'] . '/css/login.css';
    if (file_exists(TEMPLATEPATH . '/iw-profile/login.css')) $logincss = get_bloginfo('template_url') . '/iw-profile/login.css';
    if (is_ssl()) $logincss = str_replace('http://', 'https://', $logincss);
    wp_register_style('login_css', $logincss);
    wp_enqueue_style('login_css');
}

add_action('wp_print_styles', 'iw_login_init_style');


class iw_profile extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

            'iw_profile',


            __('IW Profile Widget', 'iw_profile'),


            array('description' => __('this is widget for IW Profile', 'iw_profile'),)
        );
    }


    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];


        iw_login_widget($args);
        echo $args['after_widget'];
    }


    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('iw profile', 'iw_profile');
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php
    }


    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}


function wpb_load_widget()
{
    register_widget('iw_profile');
}

add_action('widgets_init', 'wpb_load_widget');

###[ Load Templates ]###############################################[ IDEHWEB.COM ]####

function iw_login_load_template($name)
{
    global $iw_login_vars;
    if (file_exists(TEMPLATEPATH . '/iw-profile/' . $name)) include(TEMPLATEPATH . '/iw-profile/' . $name); else include($iw_login_vars['plugin_path'] . '/template/' . $name);
}

###[ Shortcode ]###############################################[ IDEHWEB.COM ]####

add_shortcode('iwprofile', 'iw_login_widget');

###[ Widget ]###################################################[ IDEHWEB.COM ]####

function iw_login_widget($args)
{
    global $before_title, $after_title;

    // extract($args);

    echo $before_widget;

    if (is_user_logged_in()) :
        iw_login_load_template('before-template.php');
        iw_login_load_template('tabs.php');
        iw_login_load_template('logged-in.php');
        iw_login_load_template('after-template.php');
    else :
        iw_login_load_template('before-template.php');
        iw_login_load_template('tabs.php');
        iw_login_load_template('login-form.php');
        if (get_option('users_can_register'))
            iw_login_load_template('register-form.php');
        iw_login_load_template('lost-password-form.php');
        iw_login_load_template('after-template.php');

    endif;
    echo $after_widget;
}

###[ Option Page ]###############################################[ IDEHWEB.COM ]####

if (is_admin())
    include 'iwl_admin.php';

###[ Email ]###############################################[ IDEHWEB.COM ]####

if (!class_exists('wp_mail_from')) {
    class wp_mail_from
    {

        function wp_mail_from()
        {
            if (get_option('email_email_c')) {
                add_filter('wp_mail_from', array(&$this, 'sb_mail_from'));
            }
            if (get_option('email_name_c')) {
                add_filter('wp_mail_from_name', array(&$this, 'sb_mail_from_name'));
            }
        }

        function sb_mail_from($old)
        {
            $email = get_option('email_email');
            $email = is_email($email);
            return $email;
        }

        function sb_mail_from_name($old)
        {
            $name = get_option('email_name');
            $name = esc_attr($name);
            return $name;
        }

    }

    $wp_mail_from = new wp_mail_from();
}

###[ Proces Login/Register ]###################################################[ IDEHWEB.COM ]####

function iw_login_process()
{

    global $iw_login_errors, $iw_reg_errors, $iw_lost_pass_errors;

    if (isset($_POST['iw_login']) && $_POST['iw_login']) :
        $iw_login_errors = iw_handle_login();
    elseif (get_option('users_can_register') && isset($_POST['iw_register']) && $_POST['iw_register']) :
        $iw_reg_errors = iw_handle_register();
    elseif (isset($_POST['iw_lostpass']) && $_POST['iw_lostpass']) :
        $iw_lost_pass_errors = iw_handle_lost_password();
    endif;

}

add_action('init', 'iw_login_process');

function iw_handle_login()
{

    if (isset($_REQUEST['redirect_to'])) $redirect_to = $_REQUEST['redirect_to'];
    else $redirect_to = admin_url();

    if (is_ssl() && force_ssl_login() && !force_ssl_admin() && (0 !== strpos($redirect_to, 'https')) && (0 === strpos($redirect_to, 'http'))) $secure_cookie = false;
    else $secure_cookie = '';

    $user = wp_signon('', $secure_cookie);

    // Check the username
    if (!$_POST['log']) :
        $user = new WP_Error();
        $user->add('empty_username', __('<strong>ERROR</strong>: Please enter a username.', 'iw-profile'));
    elseif (!$_POST['pwd']) :
        $user = new WP_Error();
        $user->add('empty_username', __('<strong>ERROR</strong>: Please enter your password.', 'iw-profile'));
    endif;

    $redirect_to = apply_filters('login_redirect', $redirect_to, isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '', $user);

    $redirect_to = apply_filters('iw_login_redirect', $redirect_to);

    if (!is_wp_error($user)) iw_update_user_meta($user->ID);

    if (iw_is_ajax()) :
        if (!is_wp_error($user)) :
            echo 'SUCCESS';
        else :
            foreach ($user->errors as $error) {
                echo $error[0];
                break;
            }
        endif;
        exit;
    else :
        if (!is_wp_error($user)) :
            wp_redirect($redirect_to);
            exit;
        endif;
    endif;
    return $user;
}

function iw_handle_register()
{

    $posted = array();
    $errors = new WP_Error();
    $user_pass = wp_generate_password();

    require_once(ABSPATH . WPINC . '/registration.php');

    // Get (and clean) data
    $fields = array(
        'username',
        'email',
        'password',
        'password2'
    );
    foreach ($fields as $field) {
        if (isset($_POST[$field])) $posted[$field] = stripslashes(trim($_POST[$field])); else $posted[$field] = '';
    }

    $user_login = sanitize_user($posted['username']);
    $user_email = apply_filters('user_registration_email', $posted['email']);

    // Check the username
    if ($posted['username'] == '')
        $errors->add('empty_username', __('<strong>ERROR</strong>: Please enter a username.', 'iw-profile'));
    elseif (!validate_username($posted['username']))
        $errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.', 'iw-profile'));
    elseif (username_exists($posted['username']))
        $errors->add('username_exists', __('<strong>ERROR</strong>: This username is already registered, please choose another one.', 'iw-profile'));

    // Check the e-mail address
    if ($posted['email'] == '')
        $errors->add('empty_email', __('<strong>ERROR</strong>: Please type your e-mail address.', 'iw-profile'));
    elseif (!is_email($posted['email']))
        $errors->add('invalid_email', __('<strong>ERROR</strong>: The email address isn&#8217;t correct.', 'iw-profile'));
    elseif (email_exists($posted['email']))
        $errors->add('email_exists', __('<strong>ERROR</strong>: This email is already registered, please choose another one.', 'iw-profile'));

    // Check Passwords match
    if ($posted['password'] == '')
        $errors->add('empty_password', __('<strong>ERROR</strong>: Please enter a password.', 'iw-profile'));
    elseif ($posted['password'] !== $posted['password2'])
        $errors->add('wrong_password', __('<strong>ERROR</strong>: Passwords do not match.', 'iw-profile'));
    else
        $user_pass = $posted['password'];

    do_action('register_post', $posted['username'], $posted['email'], $errors);
    $errors = apply_filters('registration_errors', $errors, $posted['username'], $posted['email']);

    if (!$errors->get_error_code()) :
        $user_id = wp_create_user($posted['username'], $user_pass, $posted['email']);
        if (!$user_id) :
            $errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact with the site admin !', 'iw-profile'), get_option('admin_email')));
        else :
            $secure_cookie = is_ssl() ? true : false;
            wp_set_auth_cookie($user_id, true, $secure_cookie);
            wp_new_user_notification($user_id, $user_pass);
            iw_update_user_meta($user_id);
        endif;
    endif;

    if (iw_is_ajax()) :
        if (!$errors->get_error_code()) :
            echo 'SUCCESS';
        else :
            foreach ($errors->errors as $error) {
                echo $error[0];
                break;
            }
        endif;
        exit;
    else :
        if (!is_wp_error($user)) :
            wp_redirect(iw_login_current_url());
            exit;
        endif;
    endif;
    return $errors;
}

function iw_handle_lost_password()
{

    global $wpdb, $current_site;

    $errors = new WP_Error();

    if (empty($_POST['username_or_email'])) $errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.', 'iw-profile'));

    if (strpos($_POST['username_or_email'], '@')) {
        $user_data = get_user_by_email(trim($_POST['username_or_email']));
        if (empty($user_data)) $errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.', 'iw-profile'));
    } else {
        $login = trim($_POST['username_or_email']);
        $user_data = get_userdatabylogin($login);
    }

    do_action('lostpassword_post');

    if (!$user_data) $errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or e-mail.', 'iw-profile'));

    if (iw_is_ajax()) :
        if ($errors->get_error_code()) :
            foreach ($errors->errors as $error) {
                echo $error[0];
                break;
            }
            exit;
        endif;
    else :
        if ($errors->get_error_code()) return $errors;
    endif;

    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;

    do_action('retrieve_password', $user_login);

    $allow = apply_filters('allow_password_reset', true, $user_data->ID);

    if (!$allow) $errors->add('no_password_reset', __('Password reset is not allowed for this user', 'iw-profile'));
    else if (is_wp_error($allow)) $errors = $allow;

    if (iw_is_ajax()) :
        if ($errors->get_error_code()) :
            foreach ($errors->errors as $error) {
                echo $error[0];
                break;
            }
            exit;
        endif;
    else :
        if ($errors->get_error_code()) return $errors;
    endif;

    $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
    if (empty($key)) {
        // Generate something random for a key...
        $key = wp_generate_password(20, false);
        do_action('retrieve_password_key', $user_login, $key);
        // Now insert the new md5 key into the db
        $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
    }
    $message = __('Someone has asked to reset the password for the following site and username.', 'iw-profile') . "\r\n\r\n";
    $message .= network_site_url() . "\r\n\r\n";
    $message .= sprintf(__('Username: %s', 'iw-profile'), $user_login) . "\r\n\r\n";
    $message .= __('To reset your password visit the following address, otherwise just ignore this email and nothing will happen.', 'iw-profile') . "\r\n\r\n";
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

    if (is_multisite()) $blogname = $GLOBALS['current_site']->site_name;
    else $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf(__('[%s] Password Reset', 'iw-profile'), $blogname);

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    wp_mail($user_email, $title, $message);

    if (iw_is_ajax()) :
        echo 'SUCCESS:' . __('Check your e-mail for the confirmation link.', 'iw-profile');
        exit;
    endif;

    return true;
}

###[ Proces adding fields if not exist ]###################################################[ IDEHWEB.COM ]####

add_action('show_user_profile', 'iw_show_extra_profile_fields');
add_action('edit_user_profile', 'iw_show_extra_profile_fields');

function iw_show_extra_profile_fields($user)
{ ?>

    <h3>Extra profile information</h3>

    <table class="form-table">

        <tr>
            <th><label for="mobileNumber"><?php _e('Mobile Number', 'profile'); ?>/label></th>

            <td>
                <input type="text" name="mobileNumber" id="mobileNumber"
                       value="<?php echo esc_attr(get_the_author_meta('mobileNumber', $user->ID)); ?>"
                       class="regular-text"/><br/>

            </td>
        </tr>
        <tr>
            <th><label for="DateofBirth"><?php _e('Date of Birth', 'profile'); ?></label></th>

            <td>
                <input type="text" name="DateofBirth" id="DateofBirth"
                       value="<?php echo esc_attr(get_the_author_meta('DateofBirth', $user->ID)); ?>"
                       class="regular-text"/><br/>

            </td>
        </tr>
        <tr>
            <th><label for="monthofBirth"><?php _e('Month of Birth', 'profile'); ?></label></th>

            <td>
                <input type="text" name="monthofBirth" id="monthofBirth"
                       value="<?php echo esc_attr(get_the_author_meta('monthofBirth', $user->ID)); ?>"
                       class="regular-text"/><br/>

            </td>
        </tr>
        <tr>
            <th><label for="yearofBirth"><?php _e('year of Birth', 'profile'); ?></label></th>

            <td>
                <input type="text" name="yearofBirth" id="yearofBirth"
                       value="<?php echo esc_attr(get_the_author_meta('yearofBirth', $user->ID)); ?>"
                       class="regular-text"/><br/>

            </td>
        </tr>

        <tr>
            <th><label for="iwCustomAvatar"><?php _e('Custom Avatar URL', 'profile'); ?></label></th>
            <td>
                <input type="text" name="iwCustomAvatar" id="iwCustomAvatar"
                       value="<?php echo esc_attr(get_the_author_meta('iwCustomAvatar', $user->ID)); ?>"/><br/>

            </td>
        </tr>


    </table>
<?php }

add_action('personal_options_update', 'iw_save_extra_profile_fields');
add_action('edit_user_profile_update', 'iw_save_extra_profile_fields');

function iw_save_extra_profile_fields($user_id)
{

    if (!current_user_can('edit_user', $user_id))
        return false;

    update_usermeta(absint($user_id), 'mobileNumber', wp_kses_post($_POST['mobileNumber']));
    update_usermeta(absint($user_id), 'DateofBirth', wp_kses_post($_POST['DateofBirth']));
    update_usermeta(absint($user_id), 'monthofBirth', wp_kses_post($_POST['monthofBirth']));
    update_usermeta(absint($user_id), 'yearofBirth', wp_kses_post($_POST['yearofBirth']));
    update_usermeta(absint($user_id), 'iwCustomAvatar', wp_kses_post($_POST['iwCustomAvatar']));

}


function iw_gravatar_filter($avatar, $id_or_email, $size, $default, $alt)
{

    // If provided an email and it doesn't exist as WP user, return avatar since there can't be a custom avatar
    $email = is_object($id_or_email) ? $id_or_email->comment_author_email : $id_or_email;
    if (is_email($email) && !email_exists($email))
        return $avatar;

    $custom_avatar = get_the_author_meta('iwCustomAvatar');
    if ($custom_avatar)
        $return = '<img src="' . $custom_avatar . '" width="' . $size . '" height="' . $size . '" alt="' . $alt . '" />';
    elseif ($avatar)
        $return = $avatar;
    else
        $return = '<img src="' . $default . '" width="' . $size . '" height="' . $size . '" alt="' . $alt . '" />';
    return $return;
}

add_filter('get_avatar', 'iw_gravatar_filter', 10, 5);
