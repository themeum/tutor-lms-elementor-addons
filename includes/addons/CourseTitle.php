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

    public function get_title() {
        return __('Course Title', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_title_content',
            [
                'label' => __('General Settings', 'tutor-elementor-addons'),
            ]
        );
        $this->add_control(
            'course_title_html_tag',
            [
                'label'   => __('Select Tag', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'h1', 
                    'h2' => 'h2', 
                    'h3' => 'h3', 
                    'h5' => 'h5', 
                    'h6' => 'h6'
                ],
                'default' => 'h1',
            ]
        );

        $this->add_responsive_control(
            'course_title_align',
            [
                'label'        => __('Alignment', 'tutor-elementor-addons'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'tutor-elementor-addons'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'tutor-elementor-addons'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'tutor-elementor-addons'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-align-%s',
                'default'      => 'left',
            ]
        );

        $this->end_controls_section();
	}
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .course-title';
        // Style
        $this->start_controls_section(
            'course_style_section',
            array(
                'label' => __('Color & Typography', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_title_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_title_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector,
            )
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $title = __('Course Title', 'tutor-elementor-addons');
        $course = etlms_get_course();
        if ($course) {
            $title = get_the_title();
        }
        $settings = $this->get_settings_for_display();
        echo sprintf('<%1$s class="course-title">' . $title . '</%1$s>', $settings['course_title_html_tag']);
    }
}
