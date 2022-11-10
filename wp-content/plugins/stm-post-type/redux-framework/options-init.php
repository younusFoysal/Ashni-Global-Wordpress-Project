<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 *
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 *
 */

stm_load_theme_options();

function stm_load_theme_options()
{

    if (!class_exists('Redux')) {
        return;
    }

    $opt_name = "stm_option";

    $default_colors = stm_default_colors();
    $layout = stm_get_layout();

    $args = array(
        'opt_name' => 'stm_option',
        'display_name' => 'MasterStudy',
        'page_title' => __('Theme Options', 'stm-post-type'),
        'menu_title' => __('Theme Options', 'stm-post-type'),
        'update_notice' => false,
        'admin_bar' => true,
        'dev_mode' => false,
        'menu_icon' => 'dashicons-hammer',
        'menu_type' => 'menu',
        'allow_sub_menu' => true,
        'page_parent_post_type' => '',
        'default_mark' => '',
        'hints' => array(
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => true,
        'output_tag' => true,
        'compiler' => true,
        'page_permissions' => 'manage_options',
        'save_defaults' => true,
        'database' => 'options',
        'transient_time' => '3600',
        'show_import_export' => true,
        'network_sites' => true
    );

    Redux::setArgs($opt_name, $args);

    /*
     * ---> END ARGUMENTS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection($opt_name, array(
        'title' => __('General', 'stm-post-type'),
        'desc' => '',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'logo',
                'url' => false,
                'type' => 'media',
                'title' => __('Site Logo', 'stm-post-type'),
                'default' => array('url' => get_template_directory_uri() . '/assets/img/tmp/logo-colored.png'),
                'subtitle' => __('Upload your logo file here.', 'stm-post-type'),
            ),
            array(
                'id' => 'logo_transparent',
                'url' => false,
                'type' => 'media',
                'title' => __('White-text Logo', 'stm-post-type'),
                'default' => array('url' => get_template_directory_uri() . '/assets/img/tmp/logo_transparent.png'),
                'subtitle' => __('For our transparent header options, we need your logo to be in white to stand out.', 'stm-post-type'),
            ),
            array(
                'id' => 'logo_text_font',
                'type' => 'typography',
                'title' => __('Site Title Typography', 'stm-post-type'),
                'compiler' => true,
                'google' => true,
                'font-backup' => false,
                'font-weight' => false,
                'all_styles' => true,
                'font-style' => false,
                'subsets' => true,
                'font-size' => true,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'color' => true,
                'preview' => true,
                'output' => array('.logo-unit .logo'),
                'units' => 'px',
                'subtitle' => __('Select custom font for your logo (choose these parametrs if you want to display Blogname instead of logo image).', 'stm-post-type'),
                'default' => array(
                    'color' => "#fff",
                    'font-family' => 'Montserrat',
                    'font-size' => '23px',
                )
            ),
            array(
                'id' => 'logo_width',
                'type' => 'text',
                'title' => __('Logo Width (px)', 'stm-post-type'),
                'default' => '253'
            ),
            array(
                'id' => 'menu_top_margin',
                'type' => 'text',
                'title' => __('Menu margin top (px)', 'stm-post-type'),
                'default' => '5'
            ),
            array(
                'id' => 'main_paddings',
                'type' => 'spacing',
                'compiler' => true,
                'title' => __('Main Content Paddings', 'stm-post-type'),
                'default' => '',
            ),
            array(
                'id' => 'preloader',
                'type' => 'switch',
                'title' => __('Enable preloader.', 'stm-post-type'),
                'default' => false
            ),
            array(
                'id' => 'favicon',
                'url' => false,
                'type' => 'media',
                'title' => __('Site Favicon', 'stm-post-type'),
                'default' => '',
                'subtitle' => __('Upload a 16px x 16px .png or .gif image here', 'stm-post-type'),
            ),
            array(
                'id' => 'left_bar',
                'type' => 'switch',
                'title' => __('Enable left fixed sidebar.', 'stm-post-type'),
                'default' => false
            ),
            array(
                'id' => 'enable_shop',
                'type' => 'switch',
                'title' => __('Enable shop.', 'stm-post-type'),
                'subtitle' => __('Enable eCommerce store for selling various products (separately from courses).', 'stm-post-type'),
                'default' => false
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Header', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-file',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'header_style',
                'type' => 'button_set',
                'title' => __('Header Style Options', 'stm-post-type'),
                'subtitle' => __('Select your header style option', 'stm-post-type'),
                'options' => array(
                    'header_default' => __('Offline Courses', 'stm-post-type'),
                    'header_2' => __('Online Courses', 'stm-post-type'),
                    'header_3' => __('Academy', 'stm-post-type'),
                    'header_4' => __('Logo Centered', 'stm-post-type'),
                    'header_5' => __('Distance Learning', 'stm-post-type'),
                    'header_6' => __('Simple', 'stm-post-type'),
                ),
                'default' => 'header_default'
            ),
            array(
                'id' => 'sticky_header',
                'type' => 'switch',
                'title' => __('Enable fixed header on scroll.', 'stm-post-type'),
                'default' => false
            ),
            array(
                'id' => 'header_desktop_bg',
                'type' => 'color',
                'title' => __('Header Desktop Background Color', 'stm-post-type'),
                'default' => ''
            ),
            array(
                'id' => 'header_mobile_bg',
                'type' => 'color',
                'title' => __('Header Mobile Background Color', 'stm-post-type'),
                'default' => ''
            ),
            array(
                'id' => 'header_main_color',
                'type' => 'typography',
                'title' => __('Header Color', 'stm-post-type'),
                'default' => '',
                'compiler' => false,
                'google' => false,
                'font-backup' => false,
                'font-weight' => false,
                'all_styles' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => false,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'font-family' => false,
                'color' => true,
                'text-align' => false,
                'preview' => false,
                'output' => array('#header .header_default, #header .header_default .stm_header_links a, #header .header_default .header_main_menu_wrapper a, #header .header_default .header_top_bar a, #header .header_default .right_buttons a > i, #header .header_default .header_top_bar'),
            ),
            array(
                'id' => 'header_links_color_hover',
                'type' => 'typography',
                'title' => __('Header Links Color on Hover', 'stm-post-type'),
                'default' => '',
                'compiler' => false,
                'google' => false,
                'font-backup' => false,
                'font-weight' => false,
                'all_styles' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => false,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'font-family' => false,
                'color' => true,
                'text-align' => false,
                'preview' => false,
                'output' => array(
                    '#header .header_default .stm_header_links a:hover, #header .header_default .header_main_menu_wrapper a:hover, #header .header_default .header_top_bar a:hover,
                    .header_5 .header_main_menu_wrapper .header-menu > li.current-menu-item > a, .header_5 .header_main_menu_wrapper .header-menu > li:hover > a'
                ),
            ),

            /*Default Header Settings*/
            array(
                'id' => 'default_show_wishlist',
                'type' => 'switch',
                'title' => __('Show LMS Wishlist', 'stm-post-type'),
                'default' => true
            ),
            array(
                'id' => 'default_show_search',
                'type' => 'switch',
                'title' => __('Show Search Icon', 'stm-post-type'),
                'required' => array('header_style', '=', array('header_default', 'header_6'),),
                'default' => true
            ),
            array(
                'id' => 'default_show_socials',
                'type' => 'switch',
                'title' => __('Show Socials', 'stm-post-type'),
                'required' => array('header_style', '=', array('header_default', 'header_5'),),
                'default' => true
            ),

            /*Header 2 SETTINGS*/
            array(
                'id' => 'online_show_wpml',
                'type' => 'switch',
                'title' => __('Show WPML Switcher', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_2',),
                'default' => true
            ),
            array(
                'id' => 'online_show_socials',
                'type' => 'switch',
                'title' => __('Show Socials', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_2',),
                'default' => true
            ),
            array(
                'id' => 'online_show_search',
                'type' => 'switch',
                'title' => __('Show Search', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_2',),
                'default' => true
            ),
            array(
                'id' => 'online_show_links',
                'type' => 'switch',
                'title' => __('Show Popup links', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_2',),
                'default' => true
            ),
			array(
				'id' => 'course_categories_limit',
				'type' => 'text',
				'title' => __('Course Search Categories Limit', 'stm-post-type'),
				'default' => '10'
			),
            /*Header 3 SETTINGS*/
            array(
                'id' => 'header_course_categories',
                'type' => 'select',
                'multi' => true,
                'data' => 'terms',
                'sortable' => true,
                'args' => array(
                    'taxonomies' => array('stm_lms_course_taxonomy'),
                ),
                'title' => __('Course Categories', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_3'),
                'default' => ''
            ),
            array(
                'id' => 'header_course_categories_online',
                'type' => 'select',
                'multi' => true,
                'data' => 'terms',
                'sortable' => true,
                'args' => array(
                    'taxonomies' => array('stm_lms_course_taxonomy'),
                ),
                'title' => __('Course Categories', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_2'),
                'default' => ''
            ),
            /*Header 4 SETTINGS*/
            array(
                'id' => 'header_4_show_socials',
                'type' => 'switch',
                'title' => __('Show Socials', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_4',),
                'default' => true
            ),
            array(
                'id' => 'header_4_phone',
                'type' => 'text',
                'title' => __('Phone number', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_4',),
            ),
            /*Header 5 SETTINGS*/
            array(
                'id' => 'header_5_app_url',
                'type' => 'text',
                'title' => __('App URL', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_5',),
                'default' => ''
            ),
            /*Header 6 SETTINGS*/
            array(
                'id' => 'show_login_buttons',
                'type' => 'switch',
                'title' => __('Show Login Button', 'stm-post-type'),
                'required' => array('header_style', '=', 'header_6',),
                'default' => true
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Top Bar', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el el-website',
        'submenu' => true,
        'fields' => array(
            array(
                'title' => __('Enable Top Bar', 'stm-post-type'),
                'id' => 'top_bar',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'id' => 'top_bar_login',
                'type' => 'switch',
                'title' => __('Show login url', 'stm-post-type'),
                'required' => array('top_bar', '=', true,),
                'default' => true
            ),
            array(
                'id' => 'top_bar_social',
                'type' => 'switch',
                'title' => __('Enable Top Bar Social Media icons', 'stm-post-type'),
                'default' => true
            ),
            array(
                'id' => 'top_bar_wpml',
                'type' => 'switch',
                'title' => __('Enable Top Bar WPML switcher(if WPML Plugin installed)', 'stm-post-type'),
                'default' => true
            ),
            array(
                'id' => 'top_bar_color',
                'type' => 'color',
                'title' => __('Top Bar Background Color', 'stm-post-type'),
                'default' => '#333333'
            ),
            array(
                'id' => 'font_top_bar',
                'type' => 'typography',
                'title' => __('Top Bar', 'stm-post-type'),
                'compiler' => true,
                'google' => true,
                'font-backup' => false,
                'font-weight' => true,
                'all_styles' => true,
                'font-style' => true,
                'subsets' => true,
                'font-size' => true,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'color' => true,
                'preview' => true,
                'output' => array('.header_top_bar, .header_top_bar a, .header_2_top_bar .header_2_top_bar__inner ul.header-menu li a'),
                'units' => 'px',
                'subtitle' => __('Select custom font for your top bar text.', 'stm-post-type'),
                'default' => array(
                    'color' => "#aaaaaa",
                    'font-family' => 'Montserrat',
                    'font-size' => '12px',
                )
            ),
            array(
                'id' => 'top_bar_text_color_hover',
                'type' => 'typography',
                'title' => __('Top Bar Links Color on Hover', 'stm-post-type'),
                'default' => '',
                'compiler' => false,
                'google' => false,
                'font-backup' => false,
                'font-weight' => false,
                'all_styles' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => false,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'font-family' => false,
                'color' => true,
                'text-align' => false,
                'preview' => false,
                'output' => array('#header .header_top_bar a:hover'),
            ),
            array(
                'id' => 'top_bar_use_social',
                'type' => 'sortable',
                'mode' => 'checkbox',
                'title' => __('Select Social Media Icons to display', 'stm-post-type'),
                'subtitle' => __('The urls for your social media icons will be taken from Social Media settings tab.', 'stm-post-type'),
                'required' => array(
                    array('top_bar_social', '=', true,)
                ),
                'options' => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'instagram' => 'Instagram',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'git' => 'Git',
                    'linkedin' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'yahoo' => 'Yahoo',
                    'delicious' => 'Delicious',
                    'dropbox' => 'Dropbox',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'Soundcloud',
                    'google' => 'Google',
                    'google-plus' => 'Google +',
                    'skype' => 'Skype',
                    'youtube' => 'Youtube',
                    'youtube-play' => 'Youtube Play',
                    'tumblr' => 'Tumblr',
                    'whatsapp' => 'Whatsapp',
                    'telegram' => 'Telegram',
                ),
                'default' => array(
                    'facebook' => '0',
                    'twitter' => '0',
                    'instagram' => '0',
                    'behance' => '0',
                    'dribbble' => '0',
                    'flickr' => '0',
                    'git' => '0',
                    'linkedin' => '0',
                    'pinterest' => '0',
                    'yahoo' => '0',
                    'delicious' => '0',
                    'dropbox' => '0',
                    'reddit' => '0',
                    'soundcloud' => '0',
                    'google' => '0',
                    'google-plus' => '0',
                    'skype' => '0',
                    'youtube' => '0',
                    'youtube-play' => '0',
                    'tumblr' => '0',
                    'whatsapp' => '0',
                    'telegram' => '0',
                ),
            ),
            array(
                'id' => 'top_bar_address',
                'type' => 'text',
                'title' => __('Address', 'stm-post-type'),
                'required' => array('top_bar', '=', true,),
                'default' => __('1010 Moon ave, New York, NY US', 'stm-post-type'),
            ),
            array(
                'id' => 'top_bar_address_mobile',
                'type' => 'switch',
                'title' => __('Show address on mobile', 'stm-post-type'),
                'required' => array('top_bar', '=', true,),
            ),
            array(
                'id' => 'top_bar_working_hours',
                'type' => 'text',
                'title' => __('Working Hours', 'stm-post-type'),
                'default' => __('Mon - Sat 8.00 - 18.00', 'stm-post-type'),
            ),
            array(
                'id' => 'top_bar_working_hours_mobile',
                'type' => 'switch',
                'title' => __('Show Working hours on mobile', 'stm-post-type'),
                'required' => array('top_bar', '=', true,),
            ),
            array(
                'id' => 'top_bar_phone',
                'type' => 'text',
                'title' => __('Phone number', 'stm-post-type'),
                'default' => __('+1 212-226-3126', 'stm-post-type'),
            ),
            array(
                'id' => 'top_bar_phone_mobile',
                'type' => 'switch',
                'title' => __('Show Phone on mobile', 'stm-post-type'),
                'required' => array('top_bar', '=', true,),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Styling', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-tint',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'color_skin',
                'type' => 'button_set',
                'title' => __('Color Skin', 'stm-post-type'),
                'options' => array(
                    '' => __('Default', 'stm-post-type'),
                    'skin_custom_color' => __('Custom color', 'stm-post-type'),
                ),
                'default' => ''
            ),
            array(
                'id' => 'primary_color',
                'type' => 'color',
                'compiler' => true,
                'title' => __('Primary Color', 'stm-post-type'),
                'default' => $default_colors[$layout]['primary_color'],
                'required' => array('color_skin', '=', 'skin_custom_color'),
                'output' => array(
                    'background-color' => '
body.skin_custom_color .stm_archive_product_inner_grid_content .stm-courses li.product.course-col-list .product-image .onsale, 
body.skin_custom_color .related.products .stm-courses li.product.course-col-list .product-image .onsale,
body.skin_custom_color .stm_archive_product_inner_grid_content .stm-courses li.product .product__inner .woocommerce-LoopProduct-link .onsale, 
body.skin_custom_color .related.products .stm-courses li.product .product__inner .woocommerce-LoopProduct-link .onsale,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .sticky_post,
body.skin_custom_color .overflowed_content .wpb_column .icon_box,
body.skin_custom_color .stm_countdown_bg,
body.skin_custom_color #searchform-mobile .search-wrapper .search-submit,
body.skin_custom_color .header-menu-mobile .header-menu > li .arrow.active,
body.skin_custom_color .header-menu-mobile .header-menu > li.opened > a,
body.skin_custom_color mark,
body.skin_custom_color .woocommerce .cart-totals_wrap .shipping-calculator-button:hover,
body.skin_custom_color .detailed_rating .detail_rating_unit tr td.bar .full_bar .bar_filler,
body.skin_custom_color .product_status.new,
body.skin_custom_color .stm_woo_helpbar .woocommerce-product-search input[type="submit"],
body.skin_custom_color .stm_archive_product_inner_unit .stm_archive_product_inner_unit_centered .stm_featured_product_price .price.price_free,
body.skin_custom_color .sidebar-area .widget:after,
body.skin_custom_color .sidebar-area .socials_widget_wrapper .widget_socials li .back a,
body.skin_custom_color .socials_widget_wrapper .widget_socials li .back a,
body.skin_custom_color .widget_categories ul li a:hover:after,
body.skin_custom_color .event_date_info_table .event_btn .btn-default,
body.skin_custom_color .course_table tr td.stm_badge .badge_unit.quiz,
body.skin_custom_color .page-links span:hover,
body.skin_custom_color .page-links span:after,
body.skin_custom_color .page-links > span:after,
body.skin_custom_color .page-links > span,
body.skin_custom_color .stm_post_unit:after,
body.skin_custom_color .blog_layout_grid .post_list_content_unit:after,
body.skin_custom_color ul.page-numbers > li a.page-numbers:after,
body.skin_custom_color ul.page-numbers > li span.page-numbers:after,
body.skin_custom_color ul.page-numbers > li a.page-numbers:hover,
body.skin_custom_color ul.page-numbers > li span.page-numbers:hover,
body.skin_custom_color ul.page-numbers > li a.page-numbers.current:after,
body.skin_custom_color ul.page-numbers > li span.page-numbers.current:after,
body.skin_custom_color ul.page-numbers > li a.page-numbers.current,
body.skin_custom_color ul.page-numbers > li span.page-numbers.current,
body.skin_custom_color .triangled_colored_separator,
body.skin_custom_color .magic_line,
body.skin_custom_color .navbar-toggle .icon-bar,
body.skin_custom_color .navbar-toggle:hover .icon-bar,
body.skin_custom_color #searchform .search-submit,
body.skin_custom_color .header_main_menu_wrapper .header-menu > li > ul.sub-menu:before,
body.skin_custom_color .search-toggler:after,
body.skin_custom_color .modal .popup_title,
body.skin_custom_color .sticky_post,
body.skin_custom_color .btn-carousel-control:after,
.primary_bg_color,
.mbc,
.stm_lms_courses_carousel_wrapper .owl-dots .owl-dot.active,
.stm_lms_courses_carousel__term.active,
body.course_hub .header_default.header_2,
.triangled_colored_separator:before,
.triangled_colored_separator:after,
body.skin_custom_color.udemy .btn-default,
.single_instructor .stm_lms_courses .stm_lms_load_more_courses, 
.single_instructor .stm_lms_courses .stm_lms_load_more_courses:hover,
.stm_lms_course_sticky_panel .stm_lms_course_sticky_panel__button .btn,
.stm_lms_course_sticky_panel .stm_lms_course_sticky_panel__button .btn:hover,
body.skin_custom_color.language_center .btn-default,
.header-login-button.sign-up a,
#header .header_6 .stm_lms_log_in,
body.cooking .stm_lms_courses_carousel__buttons .stm_lms_courses_carousel__button:hover,
body.cooking .stm_theme_wpb_video_wrapper .stm_video_preview:after,
body.cooking .btn.btn-default, 
body.cooking .button, 
body.cooking .form-submit .submit, 
body.cooking .post-password-form input[type=submit],
body.cooking .btn.btn-default:hover, 
body.cooking .button:hover, 
body.cooking .form-submit .submit:hover, 
body.cooking .post-password-form input[type=submit]:hover,
body.cooking div.multiseparator:after,
body.cooking .view_type_switcher a.view_grid.active_grid, 
body.cooking .view_type_switcher a.view_list.active_list, 
body.cooking .view_type_switcher a:hover,
body.cooking.woocommerce .sidebar-area .widget .widget_title:after,
body.cooking.woocommerce .sidebar-area .widget.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle,
body.cooking.woocommerce .sidebar-area .widget.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range,
body.cooking .stm_lms_courses_list_view .stm_lms_courses__grid .stm_lms_courses__single--image>a:after,
body.cooking .testimonials_main_wrapper.simple_carousel_wrapper .btn-carousel-control:hover,
body.cooking .testimonials_main_wrapper.simple_carousel_wrapper .btn-carousel-control:focus,
body.cooking .short_separator,
body.cooking .widget_tag_cloud .tagcloud a:hover,
body.cooking .blog_layout_grid .sticky .post_list_meta_unit,
body.cooking .stm_lms_instructor_courses__single--featured .feature_it,

.stm_archive_product_inner_grid_content .stm-courses li.product .product__inner .button:hover,

body.tech .stm_lms_courses_carousel__buttons .stm_lms_courses_carousel__button:hover,
body.tech .stm_theme_wpb_video_wrapper .stm_video_preview:after,
body.tech .btn.btn-default, 
body.tech .button, 
body.tech .form-submit .submit, 
body.tech .post-password-form input[type=submit],
body.tech .btn.btn-default:hover, 
body.tech .button:hover, 
body.tech .form-submit .submit:hover, 
body.tech .post-password-form input[type=submit]:hover,
body.tech div.multiseparator:after,
body.tech .view_type_switcher a.view_grid.active_grid, 
body.tech .view_type_switcher a.view_list.active_list, 
body.tech .view_type_switcher a:hover,
body.tech.woocommerce .sidebar-area .widget .widget_title:after,
body.tech.woocommerce .sidebar-area .widget.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle,
body.tech.woocommerce .sidebar-area .widget.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range,
body.tech .stm_lms_courses_list_view .stm_lms_courses__grid .stm_lms_courses__single--image>a:after,
body.tech .testimonials_main_wrapper.simple_carousel_wrapper .btn-carousel-control:hover,
body.tech .testimonials_main_wrapper.simple_carousel_wrapper .btn-carousel-control:focus,
body.tech .short_separator,
body.tech .stm_lms_wishlist_button .lnr:after,
body.tech .widget_tag_cloud .tagcloud a:hover,
body.tech .blog_layout_grid .sticky .post_list_meta_unit,
body.tech .stm_lms_instructor_courses__single--featured .feature_it,
body.tech .select2-container--default .select2-results__option--highlighted[aria-selected], 
body.tech .select2-container--default .select2-results__option--highlighted[data-selected]
',
                    'border-left-color' => '.icon_box.stm_icon_box_hover_none',
                    'border-color' => '
body.skin_custom_color ul.page-numbers > li a.page-numbers:hover,
body.skin_custom_color ul.page-numbers > li a.page-numbers.current,
body.skin_custom_color ul.page-numbers > li span.page-numbers.current,
body.skin_custom_color .custom-border textarea:active, 
body.skin_custom_color .custom-border input[type=text]:active,
body.skin_custom_color .custom-border input[type=email]:active, 
body.skin_custom_color .custom-border input[type=number]:active, 
body.skin_custom_color .custom-border input[type=password]:active, 
body.skin_custom_color .custom-border input[type=tel]:active,
body.skin_custom_color .custom-border .form-control:active,
body.skin_custom_color .custom-border textarea:focus, 
body.skin_custom_color .custom-border input[type=text]:focus, 
body.skin_custom_color .custom-border input[type=email]:focus, 
body.skin_custom_color .custom-border input[type=number]:focus, 
body.skin_custom_color .custom-border input[type=password]:focus, 
body.skin_custom_color .custom-border input[type=tel]:focus,
body.skin_custom_color .custom-border .form-control:focus,
body.skin_custom_color .icon-btn:hover .icon_in_btn,
body.skin_custom_color .icon-btn:hover,
body.skin_custom_color .average_rating_unit,
body.skin_custom_color blockquote,
body.skin_custom_color .tp-caption .icon-btn:hover .icon_in_btn,
body.skin_custom_color .tp-caption .icon-btn:hover,
body.skin_custom_color .stm_theme_wpb_video_wrapper .stm_video_preview:after,
body.skin_custom_color .btn-carousel-control,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit,
body.skin_custom_color .search-toggler:hover,
body.skin_custom_color .search-toggler,
.stm_lms_courses_carousel_wrapper .owl-dots .owl-dot.active,
.triangled_colored_separator .triangle:before,
body.cooking .stm_lms_courses_carousel__buttons .stm_lms_courses_carousel__button,
body.cooking .btn.btn-default, 
body.cooking .button, 
body.cooking .form-submit .submit, 
body.cooking .post-password-form input[type=submit],
body.cooking.woocommerce .sidebar-area .widget.widget_product_categories ul li a:after,
body.cooking .select2-container--default .select2-selection--single .select2-selection__arrow b:after,
body.cooking.woocommerce .sidebar-area .widget .widget_title:after,
body.cooking .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit,
body.cooking .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .post_list_comment_num,
body.cooking .widget_tag_cloud .tagcloud a:hover,

body.tech .stm_lms_courses_carousel__buttons .stm_lms_courses_carousel__button,
body.tech .btn.btn-default, 
body.tech .button, 
body.tech .form-submit .submit, 
body.tech .post-password-form input[type=submit],
body.tech.woocommerce .sidebar-area .widget.widget_product_categories ul li a:after,
body.tech .select2-container--default .select2-selection--single .select2-selection__arrow b:after,
body.tech.woocommerce .sidebar-area .widget .widget_title:after,
body.tech .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit,
body.tech .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .post_list_comment_num,
body.tech .widget_tag_cloud .tagcloud a:hover,
body.tech .stm_lms_points_history__head .left a,
body.tech .simple_carousel_wrapper_style_6 .navs #carousel-custom-dots li.active:before
',
                    'color' => '
body.skin_custom_color .icon_box .icon i,
body.skin_custom_color .icon-btn:hover .icon_in_btn,
body.skin_custom_color .icon-btn:hover .link-title,
body.skin_custom_color .stats_counter .h1,
body.skin_custom_color .event_date_info .event_date_info_unit .event_labels,
body.skin_custom_color .event-col .event_archive_item .event_location i,
body.skin_custom_color .event-col .event_archive_item .event_start i,
body.skin_custom_color .gallery_terms_list li.active a,
body.skin_custom_color .tp-caption .icon-btn:hover .icon_in_btn,
body.skin_custom_color .teacher_single_product_page>a:hover .title,
body.skin_custom_color .sidebar-area .widget ul li a:hover:after,
body.skin_custom_color div.pp_woocommerce .pp_gallery ul li a:hover,
body.skin_custom_color div.pp_woocommerce .pp_gallery ul li.selected a,
body.skin_custom_color .single_product_after_title .meta-unit i,
body.skin_custom_color .single_product_after_title .meta-unit .value a:hover,
body.skin_custom_color .woocommerce-breadcrumb a:hover,
body.skin_custom_color #footer_copyright .copyright_text a:hover,
body.skin_custom_color .widget_stm_recent_posts .widget_media .cats_w a:hover,
body.skin_custom_color .widget_pages ul.style_2 li a:hover,
body.skin_custom_color .sidebar-area .widget_categories ul li a:hover,
body.skin_custom_color .sidebar-area .widget ul li a:hover,
body.skin_custom_color .widget_categories ul li a:hover,
body.skin_custom_color .stm_product_list_widget li a:hover .title,
body.skin_custom_color .widget_contacts ul li .text a:hover,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:focus .h6,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:focus .h6,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:focus,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:focus,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:active .h6,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:active .h6,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:active,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:active,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:hover .h6,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:hover .h6,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:hover,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:hover,
body.skin_custom_color .widget_pages ul.style_1 li a:focus .h6,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:focus .h6,
body.skin_custom_color .widget_pages ul.style_1 li a:focus,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:focus,
body.skin_custom_color .widget_pages ul.style_1 li a:active .h6,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:active .h6,
body.skin_custom_color .widget_pages ul.style_1 li a:active,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:active,
body.skin_custom_color .widget_pages ul.style_1 li a:hover .h6,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:hover .h6,
body.skin_custom_color .widget_pages ul.style_1 li a:hover,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:hover,
body.skin_custom_color .see_more a:after,
body.skin_custom_color .see_more a,
body.skin_custom_color .transparent_header_off .header_main_menu_wrapper ul > li > ul.sub-menu > li a:hover,
body.skin_custom_color .stm_breadcrumbs_unit .navxtBreads > span a:hover,
body.skin_custom_color .btn-carousel-control,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .date-m,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .date-d,
body.skin_custom_color .stats_counter h1,
body.skin_custom_color .yellow,
body.skin_custom_color ol li a:hover,
body.skin_custom_color ul li a:hover,
body.skin_custom_color .search-toggler,
.primary_color,
.mtc_h:hover,
body.classic_lms .header_top_bar .header_top_bar_socs ul li a:hover,
body.classic_lms .header_top_bar a:hover,
#footer .widget_stm_lms_popular_courses ul li a:hover .meta .h5.title,
body.classic_lms .stm_lms_wishlist_button a:hover i,
.classic_lms .post_list_main_section_wrapper .post_list_item_title:hover,
.stm_lms_courses__single.style_2 .stm_lms_courses__single--title h5:hover,
body.cooking .stm_lms_courses_carousel__buttons .stm_lms_courses_carousel__button,
body.cooking #footer .widget_contacts ul li .icon,
body.cooking #footer .stm_product_list_widget.widget_woo_stm_style_2 li a:hover .meta .title,
body.cooking .courses_filters__switcher i:not(.active),
body.cooking .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .date-d,
body.cooking .blog_layout_grid .post_list_meta_unit .date-m,
body.cooking .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .post_list_comment_num,
body.cooking .stm_post_info .stm_post_details .post_meta li i,
body.cooking .comment-form .logged-in-as a,
body.cooking .post_list_content_unit .post_list_item_title:hover,
body.cooking .post_list_content_unit .post_list_item_title:focus,
body.cooking .widget_search .search-form>label:after,
body.cooking .blog_layout_grid .post_list_cats a,
body.cooking .blog_layout_grid .post_list_item_tags a,
body.cooking .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .date-d,
body.cooking .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .date-m-plugin,
body.cooking .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .post_list_comment_num,
body.cooking #stm_lms_faq .panel.panel-default .panel-heading .panel-title a:hover,
body.cooking .stm_post_info .stm_post_details .comments_num .post_comments:hover,
body.cooking .stm_lms_courses_list_view .stm_lms_courses__grid .stm_lms_courses__single--info_title a:hover h4,
body.cooking .comments-area .commentmetadata i,
body.cooking .stm_lms_gradebook__filter .by_views_sorter.by-views,
body.cooking .stm_post_info .stm_post_details .comments_num .post_comments i,

body.tech .stm_lms_courses_carousel__buttons .stm_lms_courses_carousel__button,
body.tech #footer .widget_contacts ul li .icon,
body.tech #footer .stm_product_list_widget.widget_woo_stm_style_2 li a:hover .meta .title,
body.tech .courses_filters__switcher i:not(.active),
body.tech .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .date-d,
body.tech .blog_layout_grid .post_list_meta_unit .date-m,
body.tech .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .post_list_comment_num,
body.tech .stm_post_info .stm_post_details .post_meta li i,
body.tech .comment-form .logged-in-as a,
body.tech .post_list_content_unit .post_list_item_title:hover,
body.tech .post_list_content_unit .post_list_item_title:focus,
body.tech .widget_search .search-form>label:after,
body.tech .blog_layout_grid .post_list_cats a,
body.tech .blog_layout_grid .post_list_item_tags a,
body.tech .footer_wrapper .widget_contacts ul li .text a,
body.tech .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .date-d,
body.tech .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .date-m-plugin,
body.tech .blog_layout_grid .plugin_style .post_list_inner_content_unit .post_list_meta_unit .post_list_comment_num,
body.tech #stm_lms_faq .panel.panel-default .panel-heading .panel-title a:hover,
body.tech .stm_post_info .stm_post_details .comments_num .post_comments:hover,
body.tech .stm_lms_courses_list_view .stm_lms_courses__grid .stm_lms_courses__single--info_title a:hover h4,
body.tech .comments-area .commentmetadata i,
body.tech .stm_lms_gradebook__filter .by_views_sorter.by-views,
body.tech .stm_post_info .stm_post_details .comments_num .post_comments i,
body.tech .stm_lms_courses_carousel__top .h4:hover,
body.tech.skin_custom_color #footer a:hover,
body.tech .socials_widget_wrapper__text a,
.testimonials_main_title_6 i
',
                    'border-bottom-color' => '
body.skin_custom_color .triangled_colored_separator .triangle,
body.skin_custom_color .magic_line:after,
body.cooking .stm_lms_gradebook__filter .by_views_sorter.by-views,
body.tech .stm_lms_gradebook__filter .by_views_sorter.by-views
',
                )
            ),
            array(
                'id' => 'secondary_color',
                'type' => 'color',
                'compiler' => true,
                'title' => __('Secondary Color', 'stm-post-type'),
                'default' => $default_colors[$layout]['secondary_color'],
                'required' => array('color_skin', '=', 'skin_custom_color'),
                'output' => array(
                    'border-left-color' => 'body.rtl-demo .stm_testimonials_wrapper_style_2 .stm_lms_testimonials_single__content:after',
                    'background-color' => '
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .sticky_post,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .sticky_post,
body.skin_custom_color .product_status.special,
body.skin_custom_color .view_type_switcher a:hover,
body.skin_custom_color .view_type_switcher a.view_list.active_list,
body.skin_custom_color .view_type_switcher a.view_grid.active_grid,
body.skin_custom_color .stm_archive_product_inner_unit .stm_archive_product_inner_unit_centered .stm_featured_product_price .price,
body.skin_custom_color .sidebar-area .widget_text .btn,
body.skin_custom_color .stm_product_list_widget.widget_woo_stm_style_2 li a .meta .stm_featured_product_price .price,
body.skin_custom_color .widget_tag_cloud .tagcloud a:hover,
body.skin_custom_color .sidebar-area .widget ul li a:after,
body.skin_custom_color .sidebar-area .socials_widget_wrapper .widget_socials li a,
body.skin_custom_color .socials_widget_wrapper .widget_socials li a,
body.skin_custom_color .gallery_single_view .gallery_img a:after,
body.skin_custom_color .course_table tr td.stm_badge .badge_unit,
body.skin_custom_color .widget_mailchimp .stm_mailchimp_unit .button,
body.skin_custom_color .textwidget .btn:active,
body.skin_custom_color .textwidget .btn:focus,
body.skin_custom_color .form-submit .submit:active,
body.skin_custom_color .form-submit .submit:focus,
body.skin_custom_color .button:focus,
body.skin_custom_color .button:active,
body.skin_custom_color .btn-default:active,
body.skin_custom_color .btn-default:focus,
body.skin_custom_color .button:hover,
body.skin_custom_color .textwidget .btn:hover,
body.skin_custom_color .form-submit .submit,
body.skin_custom_color .button,
body.skin_custom_color .btn-default,
.btn.btn-default:hover, .button:hover, .textwidget .btn:hover,
body.skin_custom_color .short_separator,
body.skin_custom_color div.multiseparator:after,
body.skin_custom_color .widget_pages ul.style_2 li a:hover:after,
body.skin_custom_color.single-product .product .woocommerce-tabs .wc-tabs li.active a:before,
body.skin_custom_color.woocommerce .sidebar-area .widget .widget_title:after,
body.skin_custom_color.woocommerce .sidebar-area .widget.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle,
body.skin_custom_color.woocommerce .sidebar-area .widget.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range,
.sbc,
.sbc_h:hover,
.wpb-js-composer .vc_general.vc_tta.vc_tta-tabs.vc_tta-style-classic li.vc_tta-tab:not(.vc_active)>a,
.wpb-js-composer .vc_general.vc_tta.vc_tta-tabs.vc_tta-style-classic li.vc_tta-tab:not(.vc_active)>a:hover,
#header.transparent_header .header_2 .stm_lms_account_dropdown .dropdown button,
.stm_lms_courses_categories.style_3 .stm_lms_courses_category>a:hover,
.stm_lms_udemy_course .nav.nav-tabs>li a,
body.classic_lms .classic_style .nav.nav-tabs>li.active a,
.header_bottom:after,
.sbc:hover,
body.rtl-demo .stm_testimonials_wrapper_style_2 .stm_lms_testimonials_single__content
',
                    'border-color' => '
body.skin_custom_color.woocommerce .sidebar-area .widget.widget_layered_nav ul li a:after, 
body.skin_custom_color.woocommerce .sidebar-area .widget.widget_product_categories ul li a:after,
body.skin_custom_color .wpb_tabs .form-control:focus,
body.skin_custom_color .wpb_tabs .form-control:active,
body.skin_custom_color .woocommerce .cart-totals_wrap .shipping-calculator-button,
body.skin_custom_color .sidebar-area .widget_text .btn,
body.skin_custom_color .widget_tag_cloud .tagcloud a:hover,
body.skin_custom_color .icon_box.dark a:hover,
body.skin_custom_color .simple-carousel-bullets a.selected,
body.skin_custom_color .stm_sign_up_form .form-control:active,
body.skin_custom_color .stm_sign_up_form .form-control:focus,
body.skin_custom_color .form-submit .submit,
body.skin_custom_color .button,
body.skin_custom_color .btn-default,
.sbrc,
.sbrc_h:hover,
.vc_general.vc_tta.vc_tta-tabs,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_list .post_list_meta_unit,

body.tech .stm_lms_points_history__head .left a:hover,
#header.transparent_header .header_2 .stm_lms_account_dropdown .dropdown button
',
                    'color' => '
.header_2_top_bar__inner .top_bar_right_part .header_top_bar_socs ul li a:hover,
.secondary_color,
body.skin_custom_color.single-product .product .woocommerce-tabs .wc-tabs li.active a,
body.skin_custom_color.single-product .product .woocommerce-tabs .wc-tabs li a:hover,
body.skin_custom_color .widget_pages ul.style_2 li a:hover .h6,
body.skin_custom_color .icon_box .icon_text>h3>span,
body.skin_custom_color .stm_woo_archive_view_type_list .stm_featured_product_stock i,
body.skin_custom_color .stm_woo_archive_view_type_list .expert_unit_link:hover .expert,
body.skin_custom_color .stm_archive_product_inner_unit .stm_archive_product_inner_unit_centered .stm_featured_product_body a .title:hover,
body.skin_custom_color .stm_product_list_widget.widget_woo_stm_style_2 li a:hover .title,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .date-m,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .date-d,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .date-m,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .date-d,
body.skin_custom_color .widget_stm_recent_posts .widget_media a:hover .h6,
body.skin_custom_color .widget_product_search .woocommerce-product-search:after,
body.skin_custom_color .widget_search .search-form > label:after,
body.skin_custom_color .sidebar-area .widget ul li a,
body.skin_custom_color .sidebar-area .widget_categories ul li a,
body.skin_custom_color .widget_contacts ul li .text a,
body.skin_custom_color .event-col .event_archive_item > a:hover .title,
body.skin_custom_color .stm_contact_row a:hover,
body.skin_custom_color .comments-area .commentmetadata i,
body.skin_custom_color .stm_post_info .stm_post_details .comments_num .post_comments:hover,
body.skin_custom_color .stm_post_info .stm_post_details .comments_num .post_comments i,
body.skin_custom_color .stm_post_info .stm_post_details .post_meta li a:hover span,
body.skin_custom_color .stm_post_info .stm_post_details .post_meta li i,
body.skin_custom_color .blog_layout_list .post_list_item_tags .post_list_divider,
body.skin_custom_color .blog_layout_list .post_list_item_tags a,
body.skin_custom_color .blog_layout_list .post_list_cats .post_list_divider,
body.skin_custom_color .blog_layout_list .post_list_cats a,
body.skin_custom_color .blog_layout_list .post_list_item_title a:hover,
body.skin_custom_color .blog_layout_grid .post_list_item_tags .post_list_divider,
body.skin_custom_color .blog_layout_grid .post_list_item_tags a,
body.skin_custom_color .blog_layout_grid .post_list_cats .post_list_divider,
body.skin_custom_color .blog_layout_grid .post_list_cats a,
body.skin_custom_color .blog_layout_grid .post_list_item_title:focus,
body.skin_custom_color .blog_layout_grid .post_list_item_title:active,
body.skin_custom_color .blog_layout_grid .post_list_item_title:hover,
body.skin_custom_color .stm_featured_products_unit .stm_featured_product_single_unit .stm_featured_product_single_unit_centered .stm_featured_product_body a .title:hover,
body.skin_custom_color .icon_box.dark a:hover,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_tags .post_list_divider,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_tags a,
body.skin_custom_color .post_list_main_section_wrapper .post_list_cats .post_list_divider,
body.skin_custom_color .post_list_main_section_wrapper .post_list_cats a,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_title:active,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_title:focus,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_title:hover,
body.skin_custom_color a:hover,
.secondary_color,
#header.transparent_header .header_2 .header_top .stm_lms_categories .heading_font, 
#header.transparent_header .header_2 .header_top .stm_lms_categories i,
.classic_lms .post_list_main_section_wrapper .post_list_cats a,
.classic_lms .post_list_main_section_wrapper .post_list_item_tags a,
body.skin_custom_color .single_product_after_title .meta-unit.teacher:hover .value,
.stm_lms_course_sticky_panel__teacher:before,
.stm_lms_courses__single__inner .stm_lms_courses__single--info_title a:hover h4
',
                )
            ),
            array(
                'id' => 'link_color',
                'type' => 'color',
                'compiler' => true,
                'title' => __('Link Color', 'stm-post-type'),
                'default' => $default_colors[$layout]['link_color'],
                'required' => array('color_skin', '=', 'skin_custom_color'),
                'output' => array(
                    'color' => 'a'
                )
            ),
            array(
                'id' => 'button_radius',
                'type' => 'text',
                'compiler' => true,
                'title' => __('Button Border Radius (px)', 'stm-post-type'),
                'default' => '0',
            ),
            array(
                'id' => 'button_dimensions',
                'type' => 'spacing',
                'compiler' => true,
                'title' => __('Button Paddings', 'stm-post-type'),
                'default' => '',
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Post Type Settings', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-website',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'blog_layout',
                'type' => 'button_set',
                'options' => array(
                    'grid' => __('Grid view', 'stm-post-type'),
                    'list' => __('List view', 'stm-post-type')
                ),
                'default' => 'grid',
                'title' => __('Blog Layout', 'stm-post-type')
            ),
            array(
                'id' => 'blog_sidebar',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('sidebar'), 'posts_per_page' => -1),
                'title' => __('Blog Sidebar', 'stm-post-type'),
                'default' => '655'
            ),
            array(
                'id' => 'blog_sidebar_position',
                'type' => 'button_set',
                'title' => __('Blog Sidebar - Position', 'stm-post-type'),
                'options' => array(
                    'left' => __('Left', 'stm-post-type'),
                    'none' => __('No Sidebar', 'stm-post-type'),
                    'right' => __('Right', 'stm-post-type')
                ),
                'default' => 'right'
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Teachers', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-user',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'teachers_sidebar',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('sidebar'), 'posts_per_page' => -1),
                'title' => __('Teachers Sidebar', 'stm-post-type'),
            ),
            array(
                'id' => 'teachers_sidebar_position',
                'type' => 'button_set',
                'title' => __('Teachers Sidebar - Position', 'stm-post-type'),
                'options' => array(
                    'left' => __('Left', 'stm-post-type'),
                    'none' => __('No Sidebar', 'stm-post-type'),
                    'right' => __('Right', 'stm-post-type')
                ),
                'default' => 'none'
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Events', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-calendar',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'events_sidebar',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('sidebar'), 'posts_per_page' => -1),
                'title' => __('Events Sidebar', 'stm-post-type'),
            ),
            array(
                'id' => 'events_sidebar_position',
                'type' => 'button_set',
                'title' => __('Events Sidebar - Position', 'stm-post-type'),
                'options' => array(
                    'left' => __('Left', 'stm-post-type'),
                    'none' => __('No Sidebar', 'stm-post-type'),
                    'right' => __('Right', 'stm-post-type')
                ),
                'default' => 'none'
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Gallery', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-picture',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'gallery_sidebar',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('sidebar'), 'posts_per_page' => -1),
                'title' => __('Gallery Sidebar', 'stm-post-type'),
            ),
            array(
                'id' => 'gallery_sidebar_position',
                'type' => 'button_set',
                'title' => __('Gallery Sidebar - Position', 'stm-post-type'),
                'options' => array(
                    'left' => __('Left', 'stm-post-type'),
                    'none' => __('No Sidebar', 'stm-post-type'),
                    'right' => __('Right', 'stm-post-type')
                ),
                'default' => 'none'
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Shop', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el el-shopping-cart',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'shop_layout',
                'type' => 'button_set',
                'options' => array(
                    'grid' => __('Grid view', 'stm-post-type'),
                    'list' => __('List view', 'stm-post-type')
                ),
                'default' => 'grid',
                'title' => __('Shop Layout', 'stm-post-type')
            ),
            array(
                'id' => 'shop_sidebar',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('sidebar'), 'posts_per_page' => -1),
                'title' => __('Sidebar', 'stm-post-type'),
                'default' => '740'
            ),
            array(
                'id' => 'shop_sidebar_position',
                'type' => 'button_set',
                'title' => __('Sidebar - Position', 'stm-post-type'),
                'options' => array(
                    'left' => __('Left', 'stm-post-type'),
                    'right' => __('Right', 'stm-post-type')
                ),
                'default' => 'right'
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Events', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el el-calendar',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'paypal_email',
                'type' => 'text',
                'title' => __('Paypal Email', 'stm-post-type'),
            ),
            array(
                'id' => 'currency',
                'type' => 'text',
                'title' => __('Currency', 'stm-post-type'),
                'default' => __('USD', 'stm-post-type'),
                'description' => __('Ex. USD', 'stm-post-type'),
            ),
            array(
                'id' => 'event_currency_symbol',
                'type' => 'text',
                'title' => __('Currency symbol', 'stm-post-type'),
                'default' => '$',
            ),
            array(
                'id' => 'event_currency_symbol_position',
                'type' => 'select',
                'title' => __('Currency symbol position', 'stm-post-type'),
                'options' => array(
                    'left' => __('Left', 'stm-post-type'),
                    'right' => __('Right', 'stm-post-type'),
                ),
                'default' => 'left',
            ),
            array(
                'id' => 'paypal_mode',
                'type' => 'select',
                'title' => __('Paypal Mode', 'stm-post-type'),
                'options' => array(
                    'sand' => 'SandBox',
                    'live' => 'Live',
                ),
                'default' => 'sand',
            ),
            array(
                'id' => 'admin_subject',
                'type' => 'text',
                'title' => __('Admin Subject', 'stm-post-type'),
                'default' => __('New Participant for [event]', 'stm-post-type'),
            ),
            array(
                'id' => 'admin_message',
                'type' => 'textarea',
                'title' => __('Admin Message', 'stm-post-type'),
                'default' => __('A new member wants to join your [event]<br>Participant Info:<br>Name: [name]<br>Email: [email]<br>Phone: [phone]<br>Message: [message]', 'stm-post-type'),
                'description' => __('Shortcodes Available - [name], [email], [phone], [message].', 'stm-post-type')
            ),
            array(
                'id' => 'user_subject',
                'type' => 'text',
                'title' => __('User Subject', 'stm-post-type'),
                'default' => __('Confirmation of your pariticipation in the [event]', 'stm-post-type'),
            ),
            array(
                'id' => 'user_message',
                'type' => 'textarea',
                'title' => __('User Message', 'stm-post-type'),
                'default' => __('Dear [name].<br/> This email is sent to you to confirm your participation in the event.<br/>We will contact you soon with further details.<br>With any question, feel free to phone +999999999999 or write to <a href="mailto:timur@stylemix.net">timur@stylemix.net</a>.<br>Regards,<br>MasterStudy Team.', 'stm-post-type'),
                'description' => __('Shortcodes Available - [name], [email], [phone], [message].', 'stm-post-type')
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Typography', 'stm-post-type'),
        'icon' => 'el-icon-font',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'font_body',
                'type' => 'typography',
                'title' => __('Body', 'stm-post-type'),
                'compiler' => true,
                'google' => true,
                'font-backup' => false,
                'font-weight' => false,
                'all_styles' => true,
                'font-style' => false,
                'subsets' => true,
                'font-size' => true,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'color' => true,
                'preview' => true,
                'output' => array(
                    'body, 
                    .normal_font,
                    .h6.normal_font,
                    body.rtl.rtl-demo .stm_testimonials_wrapper_style_2 .stm_lms_testimonials_single__excerpt p, 
                    .stm_product_list_widget.widget_woo_stm_style_2 li a .meta .title'
                ),
                'units' => 'px',
                'subtitle' => __('Select custom font for your main body text.', 'stm-post-type'),
                'default' => array(
                    'color' => "#555555",
                    'font-family' => 'Open Sans',
                    'font-size' => '14px',
                )
            ),
            array(
                'id' => 'font_btn',
                'type' => 'typography',
                'title' => __('Button', 'stm-post-type'),
                'compiler' => true,
                'google' => true,
                'font-backup' => false,
                'font-weight' => false,
                'all_styles' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => false,
                'preview' => true,
                'output' => array('.btn, .header-login-button.sign-up a'),
                'units' => 'px',
                'subtitle' => __('Select custom font for your button.', 'stm-post-type'),
                'default' => array(
                    'font-family' => 'Montserrat',
                    'font-size' => '14px',
                )
            ),
            array(
                'id' => 'menu_heading',
                'type' => 'typography',
                'title' => __('Menu', 'stm-post-type'),
                'compiler' => true,
                'google' => true,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => true,
                'font-style' => false,
                'subsets' => true,
                'font-size' => false,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'color' => true,
                'preview' => true,
                'output' => array('.header-menu'),
                'units' => 'px',
                'subtitle' => __('Select custom font for menu', 'stm-post-type'),
                'default' => array(
                    'color' => "#fff",
                    'font-family' => 'Montserrat',
                    'font-weight' => '900',
                )
            ),
            array(
                'id' => 'font_heading',
                'type' => 'typography',
                'title' => __('Heading', 'stm-post-type'),
                'compiler' => true,
                'google' => true,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => false,
                'font-style' => false,
                'subsets' => true,
                'font-size' => false,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'color' => true,
                'preview' => true,
                'output' => array('h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6,.nav-tabs>li>a,.member-name,.section-title,.user-name,.heading_font,.item-title,.acomment-meta,[type="reset"],.bp-subnavs,.activity-header,table,.widget_categories ul li a,.sidebar-area .widget ul li a,.select2-selection__rendered,blockquote,.select2-chosen,.vc_tta-tabs.vc_tta-tabs-position-top .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a,.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, body.distance-learning .btn, body.distance-learning .vc_btn3'),
                'units' => 'px',
                'subtitle' => __('Select custom font for headings', 'stm-post-type'),
                'default' => array(
                    'color' => "#333333",
                    'font-family' => 'Montserrat',
                )
            ),
            array(
                'id' => 'h1_params',
                'type' => 'typography',
                'title' => __('H1', 'stm-post-type'),
                'compiler' => true,
                'google' => false,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => true,
                'font-family' => false,
                'text-align' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => false,
                'preview' => true,
                'output' => array('h1,.h1'),
                'units' => 'px',
                'default' => array(
                    'font-size' => '50px',
                    'font-weight' => '700'
                )
            ),
            array(
                'id' => 'h1_dimensions',
                'type' => 'spacing',
                'compiler' => true,
                'mode' => 'margin',
                'title' => __('H1 Margins', 'stm-post-type'),
                'default' => '',
            ),
            array(
                'id' => 'h2_params',
                'type' => 'typography',
                'title' => __('H2', 'stm-post-type'),
                'compiler' => true,
                'google' => false,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => true,
                'font-family' => false,
                'text-align' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => false,
                'preview' => true,
                'output' => array('h2,.h2'),
                'units' => 'px',
                'default' => array(
                    'font-size' => '32px',
                    'font-weight' => '700'
                )
            ),
            array(
                'id' => 'h2_dimensions',
                'type' => 'spacing',
                'compiler' => true,
                'mode' => 'margin',
                'title' => __('H2 Margins', 'stm-post-type'),
                'default' => '',
            ),
            array(
                'id' => 'h3_params',
                'type' => 'typography',
                'title' => __('H3', 'stm-post-type'),
                'compiler' => true,
                'google' => false,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => true,
                'font-family' => false,
                'text-align' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => false,
                'preview' => true,
                'output' => array('h3,.h3'),
                'units' => 'px',
                'default' => array(
                    'font-size' => '18px',
                    'font-weight' => '700'
                )
            ),
            array(
                'id' => 'h3_dimensions',
                'type' => 'spacing',
                'compiler' => true,
                'mode' => 'margin',
                'title' => __('H3 Margins', 'stm-post-type'),
                'default' => '',
            ),
            array(
                'id' => 'h4_params',
                'type' => 'typography',
                'title' => __('H4', 'stm-post-type'),
                'compiler' => true,
                'google' => false,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => true,
                'font-family' => false,
                'text-align' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => false,
                'preview' => true,
                'output' => array('h4,.h4,blockquote'),
                'units' => 'px',
                'default' => array(
                    'font-size' => '16px',
                    'font-weight' => '400'
                )
            ),
            array(
                'id' => 'h4_dimensions',
                'type' => 'spacing',
                'compiler' => true,
                'mode' => 'margin',
                'title' => __('H4 Margins', 'stm-post-type'),
                'default' => '',
            ),
            array(
                'id' => 'h5_params',
                'type' => 'typography',
                'title' => __('H5', 'stm-post-type'),
                'compiler' => true,
                'google' => false,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => true,
                'font-family' => false,
                'text-align' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => false,
                'preview' => true,
                'output' => array('h5,.h5,.select2-selection__rendered'),
                'units' => 'px',
                'default' => array(
                    'font-size' => '14px',
                    'font-weight' => '700'
                )
            ),
            array(
                'id' => 'h5_dimensions',
                'type' => 'spacing',
                'compiler' => true,
                'mode' => 'margin',
                'title' => __('H5 Margins', 'stm-post-type'),
                'default' => '',
            ),
            array(
                'id' => 'h6_params',
                'type' => 'typography',
                'title' => __('H6', 'stm-post-type'),
                'compiler' => true,
                'google' => false,
                'font-backup' => false,
                'all_styles' => true,
                'font-weight' => true,
                'font-family' => false,
                'text-align' => false,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => false,
                'preview' => true,
                'output' => array('h6,.h6,.widget_pages ul li a, .widget_nav_menu ul li a, .footer_menu li a,.widget_categories ul li a,.sidebar-area .widget ul li a'),
                'units' => 'px',
                'default' => array(
                    'font-size' => '12px',
                    'font-weight' => '400'
                )
            ),
            array(
                'id' => 'h6_dimensions',
                'type' => 'spacing',
                'compiler' => true,
                'mode' => 'margin',
                'title' => __('H6 Margins', 'stm-post-type'),
                'default' => '',
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Footer', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-photo',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'footer_top',
                'type' => 'switch',
                'title' => __('Enable footer widgets area.', 'stm-post-type'),
                'default' => true,
            ),
            array(
                'id' => 'footer_parallax_option',
                'type' => 'switch',
                'title' => __('Enable Parallax style for Footer.', 'stm-post-type'),
                'output' => array('position' => '#footer'),
                'default' => true,
            ),
            array(
                'id' => 'footer_top_color',
                'type' => 'color',
                'title' => __('Footer Background Color', 'stm-post-type'),
                'output' => array('background-color' => '#footer_top'),
                'default' => '#414b4f',
            ),
            array(
                'id' => 'footer_first_columns',
                'type' => 'button_set',
                'title' => __('Footer Columns', 'stm-post-type'),
                'desc' => __('Select the number of columns to display in the footer.', 'stm-post-type'),
                'type' => 'button_set',
                'default' => '4',
                'required' => array('footer_top', '=', true,),
                'options' => array(
                    '1' => __('1 Column', 'stm-post-type'),
                    '2' => __('2 Columns', 'stm-post-type'),
                    '3' => __('3 Columns', 'stm-post-type'),
                    '4' => __('4 Columns', 'stm-post-type'),
                ),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Footer Bottom', 'stm-post-type'),
        'desc' => '',
        'icon' => 'el-icon-photo',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'footer_bottom',
                'type' => 'switch',
                'title' => __('Enable footer bottom widgets area.', 'stm-post-type'),
                'default' => false,
            ),
            array(
                'id' => 'footer_bottom_color',
                'type' => 'color',
                'title' => __('Footer Bottom Background Color', 'stm-post-type'),
                'output' => array('background-color' => '#footer_bottom'),
                'default' => '#414b4f',
            ),

            array(
                'id' => 'footer_bottom_title',
                'type' => 'typography',
                'title' => __('Footer bottom Title typography', 'stm-post-type'),
                'compiler' => true,
                'google' => false,
                'font-backup' => false,
                'font-weight' => true,
                'font-family' => false,
                'text-align' => false,
                'all_styles' => true,
                'font-style' => false,
                'subsets' => false,
                'font-size' => true,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'color' => true,
                'preview' => true,
                'output' => array('#footer_bottom .widget_title h3'),
                'units' => 'px',
            ),
            array(
                'id' => 'footer_bottom_title_uppercase',
                'type' => 'switch',
                'title' => __('Footer bottom uppercase title.', 'stm-post-type'),
                'default' => true,
            ),
            array(
                'id' => 'footer_bottom_text_color',
                'type' => 'color',
                'title' => __('Footer Bottom Text Color', 'stm-post-type'),
                'output' => array(
                    'color' => '#footer_bottom, .widget_contacts ul li .text, 
				.footer_widgets_wrapper .widget ul li a,
				.widget_nav_menu ul.style_1 li a .h6, 
				.widget_pages ul.style_2 li a .h6,
				#footer .stm_product_list_widget.widget_woo_stm_style_2 li a .meta .title,
				.widget_pages ul.style_1 li a .h6',
                    'background-color' => '.widget_pages ul.style_2 li a:after'
                ),
                'default' => '#fff',
            ),
            array(
                'id' => 'footer_bottom_columns',
                'type' => 'button_set',
                'title' => __('Footer Bottom Columns', 'stm-post-type'),
                'desc' => __('Select the number of columns to display in the footer bottom.', 'stm-post-type'),
                'default' => '4',
                'required' => array('footer_bottom', '=', true,),
                'options' => array(
                    '1' => __('1 Column', 'stm-post-type'),
                    '2' => __('2 Columns', 'stm-post-type'),
                    '3' => __('3 Columns', 'stm-post-type'),
                    '4' => __('4 Columns', 'stm-post-type'),
                ),
            ),
            array(
                'id' => 'footer_bottom_socials',
                'type' => 'button_set',
                'title' => __('Footer Bottom Socials', 'stm-post-type'),
                'desc' => __('Select column number to insert socials.', 'stm-post-type'),
                'default' => 'none',
                'required' => array('footer_bottom', '=', true,),
                'options' => array(
                    'none' => __('None', 'stm-post-type'),
                    '1' => __('1 Column', 'stm-post-type'),
                    '2' => __('2 Column', 'stm-post-type'),
                    '3' => __('3 Column', 'stm-post-type'),
                    '4' => __('4 Column', 'stm-post-type'),
                ),
            ),
        )
    ));

    $copyright_fields = apply_filters('masterstudy_copyright_fields', array(
            array(
                'id' => 'footer_copyright',
                'type' => 'switch',
                'title' => __('Enable footer copyright section.', 'stm-post-type'),
                'default' => true,
            ),
            array(
                'id' => 'footer_copyright_bg_color',
                'type' => 'color',
                'title' => __('Footer Copyright Background Color', 'stm-post-type'),
                'output' => array('background-color' => '#footer_copyright'),
                'default' => '#5e676b',
                'required' => array(
                    array('footer_copyright', '=', true,),
                ),
            ),
            array(
                'id' => 'footer_copyright_text_color',
                'type' => 'color',
                'title' => __('Footer Copyright Text Color', 'stm-post-type'),
                'output' => array('color' => '#footer_copyright .copyright_text, #footer_copyright .copyright_text a'),
                'default' => '#fff',
                'required' => array(
                    array('footer_copyright', '=', true,),
                ),
            ),
            array(
                'id' => 'footer_copyright_border_color',
                'type' => 'color',
                'title' => __('Footer Copyright Border Color', 'stm-post-type'),
                'output' => array('border-color' => '#footer_copyright'),
                'default' => '#5e676b',
                'required' => array(
                    array('footer_copyright', '=', true,),
                ),
            ),
            array(
                'id' => 'footer_logo_enabled',
                'type' => 'switch',
                'required' => array(
                    array('footer_copyright', '=', true,),
                ),
                'title' => __('Enable footer logo.', 'stm-post-type'),
                'default' => true,
            ),
            array(
                'id' => 'footer_logo',
                'url' => false,
                'type' => 'media',
                'title' => __('Footer Logo', 'stm-post-type'),
                'required' => array(
                    array('footer_copyright', '=', true,),
                    array('footer_logo_enabled', '=', true,),
                ),
                'default' => array('url' => get_template_directory_uri() . '/assets/img/tmp/footer-logo2x.png'),
                'subtitle' => __('Upload your logo file here. Size - 50*56 (Retina 2x). Note, bigger images will be cropped to default size', 'stm-post-type'),
            ),
            array(
                'id' => 'footer_copyright_text',
                'type' => 'textarea',
                'title' => __('Footer Copyright', 'stm-post-type'),
                'subtitle' => __('Enter the copyright text.', 'stm-post-type'),
                'required' => array(
                    array('footer_copyright', '=', true,),
                ),
                'default' => __('Copyright &copy; 2015 MasterStudy Theme by <a target="_blank" href="http://www.stylemixthemes.com/">Stylemix Themes</a>', 'stm-post-type'),
            ),
            array(
                'id' => 'copyright_use_social',
                'type' => 'sortable',
                'mode' => 'checkbox',
                'title' => __('Select Social Media Icons to display in copyright section', 'stm-post-type'),
                'subtitle' => __('The urls for your social media icons will be taken from Social Media settings tab.', 'stm-post-type'),
                'options' => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'instagram' => 'Instagram',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'git' => 'Git',
                    'linkedin' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'yahoo' => 'Yahoo',
                    'delicious' => 'Delicious',
                    'dropbox' => 'Dropbox',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'Soundcloud',
                    'google' => 'Google',
                    'google-plus' => 'Google +',
                    'skype' => 'Skype',
                    'youtube' => 'Youtube',
                    'youtube-play' => 'Youtube Play',
                    'tumblr' => 'Tumblr',
                    'whatsapp' => 'Whatsapp',
                    'telegram' => 'Telegram',
                ),
                'default' => array(
                    'facebook' => '0',
                    'twitter' => '0',
                    'instagram' => '0',
                    'behance' => '0',
                    'dribbble' => '0',
                    'flickr' => '0',
                    'git' => '0',
                    'linkedin' => '0',
                    'pinterest' => '0',
                    'yahoo' => '0',
                    'delicious' => '0',
                    'dropbox' => '0',
                    'reddit' => '0',
                    'soundcloud' => '0',
                    'google' => '0',
                    'google-plus' => '0',
                    'skype' => '0',
                    'youtube' => '0',
                    'youtube-play' => '0',
                    'tumblr' => '0',
                    'whatsapp' => '0',
                ),
            ),
        )
    );

    Redux::setSection($opt_name, array(
        'title' => __('Copyright', 'stm-post-type'),
        'desc' => __('Copyright block at the bottom of footer', 'stm-post-type'),
        'id' => 'footer_copyright',
        'subsection' => true,
        'fields' => $copyright_fields
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Social Media', 'stm-post-type'),
        'icon' => 'el-icon-address-book',
        'desc' => __('Enter social media urls here and then you can enable them for footer or header. Please add full URLs including "http://".', 'stm-post-type'),
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'facebook',
                'type' => 'text',
                'title' => __('Facebook', 'stm-post-type'),
                'subtitle' => '',
                'default' => 'https://www.facebook.com/',
                'desc' => __('Enter your Facebook URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'twitter',
                'type' => 'text',
                'title' => __('Twitter', 'stm-post-type'),
                'subtitle' => '',
                'default' => 'https://www.twitter.com/',
                'desc' => __('Enter your Twitter URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'instagram',
                'type' => 'text',
                'title' => __('Instagram', 'stm-post-type'),
                'subtitle' => '',
                'default' => 'https://www.instagram.com/',
                'desc' => __('Enter your Instagram URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'behance',
                'type' => 'text',
                'title' => __('Behance', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Behance URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'dribbble',
                'type' => 'text',
                'title' => __('Dribbble', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Dribbble URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'flickr',
                'type' => 'text',
                'title' => __('Flickr', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Flickr URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'git',
                'type' => 'text',
                'title' => __('Git', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Git URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'linkedin',
                'type' => 'text',
                'title' => __('Linkedin', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Linkedin URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'pinterest',
                'type' => 'text',
                'title' => __('Pinterest', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Pinterest URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'yahoo',
                'type' => 'text',
                'title' => __('Yahoo', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Yahoo URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'delicious',
                'type' => 'text',
                'title' => __('Delicious', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Delicious URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'dropbox',
                'type' => 'text',
                'title' => __('Dropbox', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Dropbox URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'reddit',
                'type' => 'text',
                'title' => __('Reddit', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Reddit URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'soundcloud',
                'type' => 'text',
                'title' => __('Soundcloud', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Soundcloud URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'google',
                'type' => 'text',
                'title' => __('Google', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Google URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'google-plus',
                'type' => 'text',
                'title' => __('Google +', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Google + URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'skype',
                'type' => 'text',
                'title' => __('Skype', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Skype URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'youtube',
                'type' => 'text',
                'title' => __('Youtube', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Youtube URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'youtube-play',
                'type' => 'text',
                'title' => __('Youtube Play', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Youtube Play(only icon differ) URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'tumblr',
                'type' => 'text',
                'title' => __('Tumblr', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Tumblr URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'whatsapp',
                'type' => 'text',
                'title' => __('Whatsapp', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Whatsapp URL.', 'stm-post-type'),
            ),
            array(
                'id' => 'telegram',
                'type' => 'text',
                'title' => __('Telegram', 'stm-post-type'),
                'subtitle' => '',
                'desc' => __('Enter your Telegram URL.', 'stm-post-type'),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Social Widget', 'stm-post-type'),
        'desc' => __('Choose socials for widget, and their order', 'stm-post-type'),
        'id' => 'social_widget_opt',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'stm_social_widget_sort',
                'type' => 'sortable',
                'mode' => 'checkbox',
                'title' => __('Select Social Widget Icons to display', 'stm-post-type'),
                'subtitle' => __('The urls for your social media icons will be taken from Social Media settings tab.', 'stm-post-type'),
                'options' => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'instagram' => 'Instagram',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'git' => 'Git',
                    'linkedin' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'yahoo' => 'Yahoo',
                    'delicious' => 'Delicious',
                    'dropbox' => 'Dropbox',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'Soundcloud',
                    'google' => 'Google',
                    'google-plus' => 'Google +',
                    'skype' => 'Skype',
                    'youtube' => 'Youtube',
                    'youtube-play' => 'Youtube Play',
                    'tumblr' => 'Tumblr',
                    'whatsapp' => 'Whatsapp',
                    'telegram' => 'Telegram',
                ),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('MailChimp', 'stm-post-type'),
        'icon' => 'el-icon-paper-clip',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'mailchimp_api_key',
                'type' => 'text',
                'title' => __('Mailchimp API key', 'stm-post-type'),
                'subtitle' => __('Paste your MailChimp API key', 'stm-post-type'),
                'default' => ""
            ),
            array(
                'id' => 'mailchimp_list_id',
                'type' => 'text',
                'title' => __('Mailchimp list id', 'stm-post-type'),
                'subtitle' => __('Paste your MailChimp List id', 'stm-post-type'),
                'default' => ""
            )
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => __('Custom CSS', 'stm-post-type'),
        'icon' => 'el-icon-css',
        'submenu' => true,
        'fields' => array(
            array(
                'id' => 'site_css',
                'type' => 'ace_editor',
                'title' => __('CSS Code', 'stm-post-type'),
                'subtitle' => __('Paste your custom CSS code here.', 'stm-post-type'),
                'mode' => 'css',
                'default' => ""
            )
        )
    ));
}

/*
 * <--- END SECTIONS
 */

if (!function_exists('stm_option')) {
    function stm_option($id, $fallback = false, $key = false)
    {
        global $stm_option;
        if ($fallback == false) {
            $fallback = '';
        }
        $output = (isset($stm_option[$id]) && $stm_option[$id] !== '') ? $stm_option[$id] : $fallback;
        if (!empty($stm_option[$id]) && $key) {
            $output = $stm_option[$id][$key];
        }

        return $output;
    }
}

// Remove redux demo
function removeDemoModeLink()
{
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
    }
}

add_action('init', 'removeDemoModeLink');