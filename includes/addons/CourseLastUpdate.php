<?php
/**
 * Course Last Update
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseLastUpdate extends BaseAddon {

    public function get_title() {
        return __('Course Last Updated', 'tutor-lms-elementor-addons');
    }

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-meta-last-update';
        $this->start_controls_section(
            'course_last_update_section',
            [
                'label' => __('Style', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_last_update_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_last_update_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $selector,
            ]
        );
        $this->add_responsive_control(
            'course_last_update_align',
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
        if (get_post_type() == tutor()->course_post_type) {
            $last_update = esc_html(get_the_modified_date());
        } else {
            $course = etlms_get_course();
			if ($course->have_posts()) {
				while ($course->have_posts()) {
					$course->the_post();
					$last_update = esc_html(get_the_modified_date());
				}
				wp_reset_postdata();
            }
        }
        $disable_update_date = get_tutor_option('disable_course_update_date');
        if (!$disable_update_date) {
            $markup = '<div class="tutor-single-course-meta-last-update">';
            $markup .= $last_update;
            $markup .= '</div>';
            echo $markup;
        }
    }
}
