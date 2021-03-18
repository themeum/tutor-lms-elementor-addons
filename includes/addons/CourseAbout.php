<?php
/**
 * Course About
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseAbout extends BaseAddon {

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course About', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls(){

        $this->start_controls_section(
            'course_about_content_section',
            [
                'label' => 'General Settings',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
			'section_title_text',
			[
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'About Course', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows' => 3,
			]
		);
                  
        $this->add_responsive_control(
            'course_about_align',
            $this->etlms_align_with_justify()
        );

        $this->end_controls_section();
    }
    
    protected function register_style_controls() {
        $paragraph_selector = '{{WRAPPER}} .tutor-course-excerpt';
        $heading_selector = '{{WRAPPER}} .tutor-segment-title';

        /* Heading Section */
        $this->start_controls_section(
            'course_about_heading_section',
            [
                'label' => __('Heading', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_about_heading_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$heading_selector => 'color: {{VALUE}}',
                ],
                'default'   => '#161616'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_about_heading_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $heading_selector,
            ]
        );

        $this->add_responsive_control(
            'etlms_heading_gap',
            [
                'label' => __( 'Gap', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    $heading_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
					'size' => 10,
				]
            ]
        );

        $this->end_controls_section();

        /* Paragraph  Section */
        $this->start_controls_section(
            'course_about_paragraph_section',
            [
                'label' => __('Paragraph', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_about_paragraph_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$paragraph_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_about_paragraph_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $paragraph_selector,
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable_about = (bool) get_tutor_option('disable_course_about');

        if ($disable_about) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course about from tutor settings', 'tutor-lms-elementor-addons');
            }
            return;
        }

        $course = etlms_get_course();
        if ($course) {
            ob_start();
            $settings = $this->get_settings_for_display();
            include etlms_get_template('course/about');
            echo ob_get_clean();
        }
    }
}
