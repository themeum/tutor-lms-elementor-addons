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
    
    protected function register_style_controls() {
        $paragraph_selector = '{{WRAPPER}} .tutor-course-content-wrap';
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
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            $markup = '<div class="tutor-course-content-wrap">';
            $markup .= '<div class="course-content-title"><h4 class="tutor-segment-title">'.__('Description', 'tutor-elementor-addons').'</h4></div>';
            $markup .= '<div class="tutor-course-content-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>';
            $markup .= "</div>";
            echo $markup;
        } else {
            $disable_description = get_tutor_option('disable_course_description');
            if (!$disable_description) {
                tutor_course_content();
            }
        }
    }
}
