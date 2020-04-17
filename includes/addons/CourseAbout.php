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

    public function get_title() {
        return __('Course About', 'tutor-lms-elementor-addons');
    }
    
    protected function register_style_controls() {
        $paragraph_selector = '{{WRAPPER}} .tutor-course-summery';
        $heading_selector = $paragraph_selector.' .tutor-segment-title';

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
        ob_start();
        if (get_post_type() == tutor()->course_post_type) {
            include_once etlms_get_template('course/about');
        } else {
            $course = etlms_get_course();
            if ($course->have_posts()) {
                while ($course->have_posts()) {
                    $course->the_post();
                    include_once etlms_get_template('course/about');
                }
                wp_reset_postdata();
            }
        }
        echo ob_get_clean();
    }
}
