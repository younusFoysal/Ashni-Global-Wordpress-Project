<?php

use Elementor\Controls_Manager;

class Elementor_STM_Icon_Button extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_icon_button';
    }

    public function get_title()
    {
        return esc_html__('STM Icon Button', 'masterstudy-elementor-widgets');
    }

    public function get_icon()
    {
        return 'eicon-button';
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
            'button_text',
            [
                'label' => __('Button Text', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
			'link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'elementor' ),
				'default' => [
					'url' => '#',
				],
			]
		);

        $this->add_control(
            'link_tooltip',
            [
                'label' => __('Link tooltip (title)', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'btn_align',
            [
                'label' => __('Button alignment', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'center' => esc_html__('Center', 'masterstudy-elementor-widgets'),
                    'left' => esc_html__('Left', 'masterstudy-elementor-widgets'),
                    'right' => esc_html__('Right', 'masterstudy-elementor-widgets'),
                ],
                'default' => 'left',
            ]
        );

        $this->add_control(
            'btn_size',
            [
                'label' => __('Button Size', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'btn-sm' => esc_html__('Small', 'masterstudy-elementor-widgets'),
                    'btn-normal-size' => esc_html__('Normal', 'masterstudy-elementor-widgets'),
                ],
                'default' => 'btn-sm',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Button Text Color', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => __('Button Text Color Hover', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Button Background Color', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __('Button Background Color Hover', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __('Button Border Color', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => __('Button Border Color Hover', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                ],
            ]
        );


        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '10' => esc_html__('10px', 'masterstudy-elementor-widgets'),
                    '11' => esc_html__('11px', 'masterstudy-elementor-widgets'),
                    '12' => esc_html__('12px', 'masterstudy-elementor-widgets'),
                    '13' => esc_html__('13px', 'masterstudy-elementor-widgets'),
                    '14' => esc_html__('14px', 'masterstudy-elementor-widgets'),
                    '15' => esc_html__('15px', 'masterstudy-elementor-widgets'),
                    '16' => esc_html__('16px', 'masterstudy-elementor-widgets'),
                    '17' => esc_html__('17px', 'masterstudy-elementor-widgets'),
                    '18' => esc_html__('18px', 'masterstudy-elementor-widgets'),
                    '19' => esc_html__('19px', 'masterstudy-elementor-widgets'),
                    '20' => esc_html__('20px', 'masterstudy-elementor-widgets'),
                ],
                'default' => '16',
            ]
        );


        $this->end_controls_section();

        $this->add_dimensions('.masterstudy_elementor_icon_button_');

    }

    protected function render()
    {
        if (function_exists('masterstudy_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' masterstudy_elementor_icon_button_';

            $settings['icon'] = (isset($settings['icon']['value']) && !empty($settings['icon']['value'])) ? ' '.$settings['icon']['value'] : '';

            $settings['link']['title'] = (isset($settings['button_text'])) ? $settings['button_text'] : __('Button','masterstudy-elementor-widgets');

            masterstudy_show_template('icon_button', $settings);

        }
    }

    protected function _content_template()
    {

    }

}
