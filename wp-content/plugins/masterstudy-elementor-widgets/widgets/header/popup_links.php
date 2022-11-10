<?php

use Elementor\Controls_Manager;

class Elementor_STM_LMS_Popup_Links extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_lms_popup_links';
    }

    public function get_title()
    {
        return esc_html__('STM LMS Popup Links', 'masterstudy-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-link';
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
            'link_1_title',
            [
                'label' => __( 'Link 1 title', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Become an Instructor', 'masterstudy-elementor-widgets' ),
                'placeholder' => __( 'Type your title here', 'masterstudy-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'link_1_icon',
            [
                'label' => __( 'Link 1 icon', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => array(
                    'value' => 'lnr lnr-bullhorn'
                ),
            ]
        );

        $this->add_control(
            'link_2_title',
            [
                'label' => __( 'Link 2 title', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'For Enterprise', 'masterstudy-elementor-widgets' ),
                'placeholder' => __( 'Type your title here', 'masterstudy-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'link_2_icon',
            [
                'label' => __( 'Link 2 icon', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => array(
                    'value' => 'stmlms-case'
                ),
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Color', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stm_lms_bi_link i, {{WRAPPER}} .stm_lms_bi_link span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => __( 'Hover Color', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .stm_lms_bi_link:hover i, {{WRAPPER}} .stm_lms_bi_link:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.masterstudy_elementor_popup_links');

    }

    protected function render()
    {

        if (function_exists('masterstudy_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' masterstudy_elementor_popup_links';

            masterstudy_show_template('header/popup_links', $settings);

        }
    }

    protected function _content_template()
    {

    }

}
