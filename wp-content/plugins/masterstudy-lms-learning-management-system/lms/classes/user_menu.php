<?php

new STM_LMS_User_Menu;

class STM_LMS_User_Menu
{
    public function __construct()
    {
        add_action('wp_footer', array($this, 'float_menu'));
    }

    function float_menu()
    {
        STM_LMS_Templates::show_lms_template('account/float_menu/float_menu');
    }

    static function float_menu_enabled()
    {

        $float_menu = STM_LMS_Options::get_option('float_menu', false);
        $float_menu_guest = STM_LMS_Options::get_option('float_menu_guest', true);

        if (!is_user_logged_in() && $float_menu) return $float_menu_guest;

        return $float_menu;
    }

}