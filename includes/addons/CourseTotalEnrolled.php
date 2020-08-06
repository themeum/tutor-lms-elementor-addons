<?php
/**
 * Course Total Enrolled
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseTotalEnrolled extends BaseAddon {

    public function get_title() {
        return __('Course Total Enrolled', 'tutor-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-meta-total-enroll';
        $this->start_controls_section(
            'course_total_enrolled_section',
            [
                'label' => __('Style', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_total_enrolled_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_total_enrolled_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector,
            ]
        );
        $this->add_responsive_control(
            'course_total_enrol_align',
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

    protected function render($instance = []) {
        if (get_post_type() == tutor()->course_post_type) {
            $total_enrolled = (int) tutor_utils()->count_enrolled_users_by_course();
        } else {
            $course = etlms_get_course();
			if ($course->have_posts()) {
				while ($course->have_posts()) {
					$course->the_post();
					$total_enrolled = (int) tutor_utils()->count_enrolled_users_by_course();
				}
				wp_reset_postdata();
            }
        }
        $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
        if (!$disable_total_enrolled) {
            $markup = '<div class="tutor-single-course-meta-total-enroll">';
            $markup .= $total_enrolled;
            $markup .= '</div>';
            echo $markup;
        }
    }
}
