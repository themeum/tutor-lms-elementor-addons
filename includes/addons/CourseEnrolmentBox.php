<?php
/**
 * Course EnrolmentBox
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseEnrolmentBox extends BaseAddon {

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_title() {
        return __('Course Enrolment Box', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
        // Slider Button stle
        $this->start_controls_section(
            'course_edit_mode_section',
            [
                'label' => __('Edit Mode', 'tutor-elementor-addons'),
            ]
        );
        $this->add_control(
            'course_enrolment_edit_mode',
            [
                'label'   => __('Select Mode', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'enrolment_box' => 'Enrolment Box', 
                    'enrolled_box' => 'Enrolled Box',
                ],
                'enrolment_box' => 'Enrolment Box',
            ]
        );
        $this->end_controls_section();
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-rating .tutor-star-rating-group';

        //Style
        $this->start_controls_section(
            'course_style_section',
            array(
                'label' => __('Rating Stars', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_rating_color',
            [
                'label'     => __('Star Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_rating_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector,
            )
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $settings = $this->get_settings_for_display();
        $edit_mode = $settings['course_enrolment_edit_mode'];
        $editor_mode = \Elementor\Plugin::instance()->editor->is_edit_mode();
        if ( ($editor_mode && $edit_mode == 'enrolled_box') || (is_user_logged_in() && tutils()->is_enrolled()) ) {
            include_once etlms_get_template('course/enrolled-box');
        } else {
            include_once etlms_get_template('course/enrolment-box');
        }
    }
}
