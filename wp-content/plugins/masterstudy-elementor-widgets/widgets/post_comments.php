<?php

use Elementor\Controls_Manager;

class Elementor_STM_Post_Comments extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_post_comments';
    }

    public function get_title()
    {
        return esc_html__('STM Post Comments', 'masterstudy-elementor-widgets');
    }

    public function get_icon()
    {
        return 'eicon-comments';
    }

    public function get_categories()
    {
        return ['theme-elements'];
    }

    public function add_dimensions($selector = '')
    {
    }

    protected function _register_controls()
    {

        $this->add_dimensions('.masterstudy_elementor_post_comments_');

        $this->end_controls_section();

    }

    protected function render()
    {
        if (function_exists('masterstudy_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' masterstudy_elementor_post_comments_';

            masterstudy_show_template('post_comments', $settings);

        }
    }

    protected function _content_template()
    {

    }

}
