<?php
/**
 * Course Ratting Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseRating extends BaseAddon {

    public function get_title() {
        return __('Course Rating', 'tutor-lms-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-rating .tutor-star-rating-group';

        //Style
        $this->start_controls_section(
            'course_style_section',
            array(
                'label' => __('Rating Stars', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_rating_color',
            [
                'label'     => __('Star Color', 'tutor-lms-elementor-addons'),
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
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $selector,
            )
        );

        $this->add_responsive_control(
            'course_rating_align',
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
        $settings = $this->get_settings_for_display();

        ob_start();
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            $query = etlms_get_course($settings);
			if ($query->have_posts()){
				while ($query->have_posts()){
					$query->the_post();
					include_once etlms_get_template('course/rating');
				}
				wp_reset_postdata();
            }
        } else {
            include_once etlms_get_template('course/rating');
        }
        echo ob_get_clean();
    }
}
