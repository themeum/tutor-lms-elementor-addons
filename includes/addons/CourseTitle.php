<?php
/**
 * Course Title Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseTitle extends BaseAddon {

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Title', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_title_content',
            [
                'label' => __('General Settings', 'tutor-lms-elementor-addons'),
            ]
        );
        $this->add_control(
            'course_title_html_tag',
            [
                'label'   => __('Select Tag', 'tutor-lms-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'h1', 
                    'h2' => 'h2', 
                    'h3' => 'h3', 
                    'h5' => 'h5', 
                    'h6' => 'h6'
                ],
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'course_title_align',
            $this->etlms_alignment() //alignment
        );

        $this->end_controls_section();
	}
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .course-title';
        // Style
        $this->start_controls_section(
            'course_style_section',
            array(
                'label' => __('Color & Typography', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_title_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $selector => 'color: {{VALUE}};',
                ],
                'default'   => '#161616'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_title_typography',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $selector,
            )
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $title = __('Course Title', 'tutor-lms-elementor-addons');
        $course = etlms_get_course();
        if ($course) {
            $title = get_the_title();
        }
        $settings = $this->get_settings_for_display();
        echo sprintf('<%1$s class="course-title">' . $title . '</%1$s>', $settings['course_title_html_tag']);
    }
}
