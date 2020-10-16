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
        return __('Course Rating', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_title_content',
            [
                'label' => __('General Settings', 'tutor-elementor-addons'),
            ]
        );
        $this->add_responsive_control(
            'course_rating_align',
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
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-rating';
        $rating_group = $selector.' .tutor-star-rating-group';
        $rating_count = $selector.' .tutor-single-rating-count';

        //Style
        $this->start_controls_section(
            'course_style_section',
            array(
                'label' => __('Rating Stars', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_rating_star_color',
            [
                'label'     => __('Star Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $rating_group => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_rating_star_size',
            [
                'label' => __( 'Star Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    $rating_group.' i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_rating_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $rating_count,
            )
        );

        $this->add_control(
            'course_rating_text_color',
            [
                'label'     => __('Text Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $rating_count => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => __( 'Gap', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 4,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    $rating_group.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        ob_start();
        $course = etlms_get_course();
        if ($course) {
            include_once etlms_get_template('course/rating');
        }
        echo ob_get_clean();
    }
}
