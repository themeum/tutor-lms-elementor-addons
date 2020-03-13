<?php
/**
 * Course Ratting Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseRating extends BaseAddon
{
    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_title()
    {
        return __('Rating', 'tutor-elementor-addons');
    }

    protected function register_content_controls()
    {
    }
    
    protected function register_style_controls()
    {
        $selector = ".tutor-single-course-rating .tutor-star-rating-group";

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
                    '{{WRAPPER}} '.$selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_rating_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => '{{WRAPPER}} '.$selector,
            )
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {
        ob_start();
        include_once etlms_get_template('course/rating');
        echo ob_get_clean();
    }
}
