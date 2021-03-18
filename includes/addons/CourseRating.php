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

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Rating', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_title_content',
            [
                'label' => __('General Settings', 'tutor-lms-elementor-addons'),
            ]
        );
        $this->add_responsive_control(
            'course_rating_align',
            $this->etlms_alignment() //alignment
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
                'label' => __('Rating Stars', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_rating_star_color',
            [
                'label'     => __('Star Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $rating_group => 'color: {{VALUE}};',
                ],
                'default'   => '#ED9700'
            ]
        );

        $this->add_responsive_control(
            'course_rating_star_size',
            [
                'label' => __( 'Star Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    $rating_group.' i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
					'size' => 16,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_rating_typography',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $rating_count,
            )
        );

        $this->add_control(
            'course_rating_text_color',
            [
                'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $rating_count => 'color: {{VALUE}};',
                ],
                'default'   => '#525252'
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => __( 'Gap', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    $rating_group.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
					'size' => 5,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable = (bool) get_tutor_option('disable_course_review');
        if ($disable) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course review from tutor settings', 'tutor-lms-elementor-addons');
            }
            return;
        }

        $course = etlms_get_course();
        if ($course) {
            ob_start();
            include etlms_get_template('course/rating');
            echo ob_get_clean();
        }
    }
}
