<?php
/**
 * Course Description
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseDescription extends BaseAddon {

    public function get_title() {
        return __('Course Description', 'tutor-elementor-addons');
    }

    protected function register_content_controls(){

        $this->start_controls_section(
            'course_description_content_section',
            [
                'label' => 'General Settings',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
			'section_title_text',
			[
				'label' => __( 'Title', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Description', 'tutor-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-elementor-addons' ),
				'rows' => 3,
			]
        );
        
        $this->end_controls_section();
    }
    
    protected function register_style_controls() {
        $paragraph_selector = '{{WRAPPER}} .etlms-course-description';
        $heading_selector = $paragraph_selector.' .tutor-segment-title';

        /* Heading Section */
        $this->start_controls_section(
            'course_description_heading_section',
            [
                'label' => __('Heading', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_description_heading_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$heading_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_description_heading_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $heading_selector,
            ]
        );
        $this->add_responsive_control(
            'etlms_heading_gap',
            [
                'label' => __( 'Gap', 'tutor-elementor-addons' ),
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
					'size' => 15,
                ]
            ]
        );
        $this->end_controls_section();

        /* Paragraph  Section */
        $this->start_controls_section(
            'course_description_paragraph_section',
            [
                'label' => __('Paragraph', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_description_paragraph_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$paragraph_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_description_paragraph_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $paragraph_selector,
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable_option = (bool) get_tutor_option('disable_course_description');
		if ($disable_option) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course description from tutor settings', 'tutor-elementor-addons');
            }
			return;
		}
        $course = etlms_get_course();
        if ($course) {
            ob_start();
            $settings = $this->get_settings_for_display();
            include_once etlms_get_template('course/description');
            echo ob_get_clean();
        }
    }
}
