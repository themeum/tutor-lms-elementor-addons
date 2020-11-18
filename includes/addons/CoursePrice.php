<?php
/**
 * Course Price Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CoursePrice extends BaseAddon {

    use ETLMS_Trait;

    private static $prefix_class_layout = "etlms-author-layout-";

    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Price', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_price_content',
            [
                'label' => __('General Settings', 'tutor-elementor-addons'),
            ]
        );
        
        $this->add_responsive_control(
            'course_price_align',
            $this->etlms_alignment() //alignment
        );

        $this->end_controls_section();
	}

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .course-price';
        // Style
        $this->start_controls_section(
            'course_style_section',
            array(
                'label' => __('Style', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_price_color',
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
                'name'      => 'course_price_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector,
            )
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $course = etlms_get_course();
        if ($course) {
            echo '<div class="course-price">';
            tutor_course_price();
            echo '</div>';
        }
    }
}
