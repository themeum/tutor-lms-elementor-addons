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
            $markup .= '<div class="course-content-title"><h4 class="tutor-segment-title">'.__('Description', 'tutor').'</h4></div>';
            $markup .= '<div class="tutor-course-content-content"><p>This is a sample course description for edit view</p></div>';
            $markup .= "</div>";
            echo $markup;
        } else {
            $disable_description = get_tutor_option('disable_course_description');
            if ( !$disable_description ) {
                wp_reset_postdata();
                tutor_course_content();
            }
        }
    }
}
