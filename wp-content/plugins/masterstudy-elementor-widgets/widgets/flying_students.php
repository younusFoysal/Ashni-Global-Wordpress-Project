<?php

use Elementor\Controls_Manager;

class Elementor_STM_Flying_Students extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_flying_students';
    }

    public function get_title()
    {
        return esc_html__('STM Flying Students', 'masterstudy-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-user-graduate';
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


        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'elementor-stm-widgets'),
            ]
        );

        $this->add_control(
            'horizontal_align',
            [
                'label' => __('Vertical Align', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right',
                ],
                'default' => 'center',
            ]
        );

        $this->end_controls_section();

        $this->add_dimensions('.masterstudy_elementor_flying_students');

    }

    protected function render()
    {
        if (function_exists('masterstudy_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' masterstudy_elementor_flying_students';

            masterstudy_show_template('flying_students', $settings);

        }
    }

    protected function _content_template()
    {

    }

}
