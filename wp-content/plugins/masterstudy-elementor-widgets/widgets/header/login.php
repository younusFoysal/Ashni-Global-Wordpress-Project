<?php

use Elementor\Controls_Manager;

class Elementor_STM_LMS_Login extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_lms_login';
    }

    public function get_title()
    {
        return esc_html__('STM LMS Login', 'masterstudy-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-user-lock';
    }

    public function get_categories()
    {
        return ['theme-elements'];
    }

    public function add_dimensions($selector = '')
    {
        $this->start_controls_section(
            'section_dimensions',
            [
                'label' => __( 'Dimensions', 'elementor-stm-widgets' ),
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => __( 'Margin', 'masterstudy-elementor-widgets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} {$selector}" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'masterstudy-elementor-widgets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} {$selector}" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Log in', 'masterstudy-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Login icon', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => array(
                    'value' => 'stmlms-user'
                ),
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Color', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .masterstudy_elementor_stm_lms_login .stm_lms_log_in' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.masterstudy_elementor_stm_lms_login');

    }

    protected function render()
    {

        if (function_exists('masterstudy_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' masterstudy_elementor_stm_lms_login';

            masterstudy_show_template('header/login', $settings);

        }
    }

    protected function _content_template()
    {

    }

}
