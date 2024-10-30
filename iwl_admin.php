<?php

add_action('admin_menu', 'register_iwl_menu_page');
add_action('admin_init', 'register_iwl_settings');
define('iwl_DOMAIN', 'iw-profile');

function register_iwl_menu_page()
{

    add_menu_page('IW profile', 'IW profile', 'add_users', __FILE__, 'iwl_plugin_menu', plugins_url('iw-profile/img/icon.png'));

    add_submenu_page(__FILE__, __('How to Use | IW profile', iwl_DOMAIN), __('How to Use', iwl_DOMAIN), 'add_users', __FILE__, 'iwl_plugin_menu');

    add_submenu_page(__FILE__, 'Settings | IW profile', 'Settings', 'manage_options', 'iwl_settings', 'iwl_settings_page');

    add_submenu_page(__FILE__, 'Server Information | IW profile', 'Server Information', 'add_users', 'iwl_server_info', 'iwl_server_info_menu');
}

function register_iwl_settings()
{
    global $isWooActive;

    register_setting('iwl-settings-group', 'iwl_option_lost');

    register_setting('iwl-settings-group', 'iwl_option_xtra_c');
    register_setting('iwl-settings-group', 'iwl_option_xtra');
    register_setting('iwl-settings-group', 'iwl_option_xtra_link');
    if ($isWooActive) {
        register_setting('iwl-settings-group', 'iwl_option_woo');
    }
    register_setting('iwl-settings-group', 'iwl_option_info');
    register_setting('iwl-settings-group', 'iwl_option_settings');
    register_setting('iwl-settings-group', 'email_email');
    register_setting('iwl-settings-group', 'email_name');
    register_setting('iwl-settings-group', 'email_email_c');
    register_setting('iwl-settings-group', 'email_name_c');
    register_setting('iwl-settings-group', 'iwl_cap_log');
    register_setting('iwl-settings-group', 'iwl_cap_reg');
}

include "admin/sidebar.php";

function iwl_plugin_menu()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include "admin/usage.php";
}


function iwl_settings_page()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include "admin/settings.php";
}

function iwl_server_info_menu()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include "admin/server_info.php";
}

?>