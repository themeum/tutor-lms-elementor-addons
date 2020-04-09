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

    public function get_title() {
        return __('Course Price', 'tutor-lms-elementor-addons');
    }

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .course-price';
        // Style
        $this->start_controls_section(
            'course_style_section',
            array(
                'label' => __('Style', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_price_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
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
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $selector,
            )
        );

        $this->add_responsive_control(
            'course_price_margin',
            [
                'label' => __('Margin', 'tutor-lms-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'course_price_align',
            [
                'label'        => __('Alignment', 'tutor-lms-elementor-addons'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'tutor-lms-elementor-addons'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'tutor-lms-elementor-addons'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'tutor-lms-elementor-addons'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-align-%s',
                'default'      => 'left',
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo '<div class="course-price">' . __('Free', 'tutor-lms-elementor-addons') . '</div>';
        } else {
            echo '<div class="course-price">';
                tutor_course_price();
            echo '</div>';
        }
    }
}
