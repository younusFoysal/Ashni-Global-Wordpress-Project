<?php

use Elementor\Controls_Manager;

class Elementor_STM_Course_Lessons extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stm_course_lessons';
    }

    public function get_title()
    {
        return esc_html__('STM Course Lessons', 'masterstudy-elementor-widgets');
    }

    public function get_icon()
    {
        return 'fa fa-leanpub';
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
            'title',
            [
                'label' => __('Section Title', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Section Title here', 'masterstudy-elementor-widgets'),
            ]
        );


        /*Lessons*/
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __('Lesson Title', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Type Lesson Title here', 'masterstudy-elementor-widgets'),
            ]
        );

        $repeater->add_control(
            'private_lesson',
            [
                'label' => __('Private', 'masterstudy-elementor-widgets'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __('Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                ],
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => __( 'Tab Text', 'masterstudy-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
            ]
        );

        $repeater->add_control(
            'badge',
            [
                'label' => __('Lesson badge', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'no_badge',
                'options' => array_flip(array(
					__( 'Choose Badge', 'masterstudy-elementor-widgets' )	=> 'no_badge',
					__( 'Test', 'masterstudy-elementor-widgets' )			=> 'test',
					__( 'Video', 'masterstudy-elementor-widgets' )		=> 'video',
					__( 'Exam', 'masterstudy-elementor-widgets' )			=> 'exam',
					__( 'Quiz', 'masterstudy-elementor-widgets' )			=> 'quiz',
					__( 'Lecture', 'masterstudy-elementor-widgets' )  	=> 'lecture',
					__( 'Seminar', 'masterstudy-elementor-widgets' )		=> 'seminar',
					__( 'Free', 'masterstudy-elementor-widgets' )			=> 'free',
					__( 'Practice', 'masterstudy-elementor-widgets' ) 	=> 'practice',
					__( 'Exercise', 'masterstudy-elementor-widgets' ) 	=> 'exercise',
					__( 'Activity', 'masterstudy-elementor-widgets' ) 	=> 'activity',
                ))
            ]
        );

        $repeater->add_control(
            'preview_video',
            [
                'label' => __('Preview video', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Type Preview video here', 'masterstudy-elementor-widgets'),
            ]
        );

        $repeater->add_control(
            'private_placeholder',
            [
                'label' => __('Content placeholder', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __('Type Private lesson content placeholder here', 'masterstudy-elementor-widgets'),
            ]
        );

        $repeater->add_control(
            'meta',
            [
                'label' => __('Lesson meta', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Type Lesson meta here', 'masterstudy-elementor-widgets'),
            ]
        );

        $repeater->add_control(
            'meta_icon',
            [
                'label' => __('Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                ],
            ]
        );

        $this->add_control(
            'lessons',
            [
                'label' => __('Repeater List', 'masterstudy-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );


        $this->end_controls_section();

        $this->add_dimensions('.masterstudy_elementor_course_lessons_');

    }

    protected function render()
    {
        if (function_exists('masterstudy_show_template')) {

            $settings = $this->get_settings_for_display();

            $settings['css_class'] = ' masterstudy_elementor_course_lessons ';

            masterstudy_show_template('course_lessons', $settings);

        }
    }

    protected function _content_template()
    {

    }

}
