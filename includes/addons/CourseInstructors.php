<?php
/**
 * Course Instructors
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseInstructors extends BaseAddon {

    public function get_title() {
        return __('Course Instructors', 'tutor-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-instructors';
        $title_selector = $selector.' .tutor-segment-title';

        /* Title Section */
        $this->start_controls_section(
            'course_instructors_title_section',
            [
                'label' => __('Section Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_instructors_title_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$title_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructors_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->end_controls_section();

        /* Instructor Section */
        $img_selector = $selector." .instructor-avatar span";
        $name_selector = $selector." .instructor-name a";
        $designation_selector = $selector." .instructor-name h4";
        $this->start_controls_section(
            'course_instructor_section',
            [
                'label' => __('Instructor', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_width',
            [
                'label' => __( 'Image Width', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $img_selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_height',
            [
                'label' => __( 'Image Height', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $img_selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'course_instructor_name_color',
            [
                'label'     => __('Name Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$name_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructor_name_typo',
                'label'     => __('Name Typography', 'tutor-elementor-addons'),
                'selector'  => $name_selector,
            ]
        );
        $this->add_control(
            'course_instructor_designation_color',
            [
                'label'     => __('Designation Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$designation_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructor_designation_typo',
                'label'     => __('Designation Typography', 'tutor-elementor-addons'),
                'selector'  => $designation_selector,
            ]
        );
        $this->end_controls_section();

        /* Instructor Rating Section */
        $info_selector = $selector." .single-instructor-bottom";
        $star_selector = $info_selector." .tutor-star-rating-group";
        $this->start_controls_section(
            'course_instructor_rating_section',
            array(
                'label' => __('Rating Stars', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'course_instructor_rating_color',
            [
                'label'     => __('Star Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $star_selector => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_instructor_rating_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $star_selector,
            )
        );
        $this->end_controls_section();

        /* Bottom Info Section */
        $this->start_controls_section(
            'course_instructor_bottom_info_section',
            array(
                'label' => __('Bottom Info', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'course_instructor_label_color',
            [
                'label'     => __('Label Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $info_selector.' .rating-digits,'. $info_selector.' .courses,'. $info_selector.' .students' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_instructor_label_typography',
                'label'     => __('Label Typography', 'tutor-elementor-addons'),
                'selector'  => $info_selector.' .rating-digits,'. $info_selector.' .courses,'. $info_selector.' .students'
            )
        );
        $this->add_control(
            'course_instructor_value_color',
            [
                'label'     => __('Value Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $info_selector.' .rating-total-meta,'. $info_selector.' .tutor-text-mute' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_instructor_value_typography',
                'label'     => __('Value Typography', 'tutor-elementor-addons'),
                'selector'  => $info_selector.' .rating-total-meta,'. $info_selector.' .tutor-text-mute'
            )
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            ob_start();
            include_once etlms_get_template('course/instructors');
            echo ob_get_clean();
        } else {
            echo '<div class="tutor-course-instructors">';
                tutor_course_instructors_html();
            echo '</div>';
        }
    }
}
