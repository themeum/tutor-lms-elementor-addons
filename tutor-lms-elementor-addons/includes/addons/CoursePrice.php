<?php
/**
 * Course Price Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CoursePrice extends BaseAddon {

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Price', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_price_content',
            [
                'label' => __('General Settings', 'tutor-lms-elementor-addons'),
            ]
        );
        
        $this->add_responsive_control(
            'course_price_align',
            $this->etlms_alignment() //alignment
        );

        $this->end_controls_section();
	}

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .etlms-course-price';
        $normal_text = $selector.' > .amount, '. $selector.' > .price';
        $strikethrough_text = $selector.' del .amount';

        $this->start_controls_section(
            'course_price_style_section',
            [
                'label' => __('Text', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Start Tabs */
        $this->start_controls_tabs('course_price_style_tabs');

            /* Normal Tab */
            $this->start_controls_tab(
                'course_price_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'normal_text_color',
                [
                    'label'     => __('Color', 'tutor-lms-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $normal_text => 'color: {{VALUE}};',
                    ],
                    'default'   => '#161616'
                ]
            );
    
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'normal_text_typography',
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $normal_text,
                )
            );

            $this->end_controls_tab();

            /* Strikethrough Tab */
            $this->start_controls_tab(
                'course_price_strikethrough_style_tab',
                [
                    'label' => __( 'Strike', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'strikethrough_text_color',
                [
                    'label'     => __('Color', 'tutor-lms-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $strikethrough_text => 'color: {{VALUE}};',
                    ],
                    'default'   => '#7A7A7A'
                ]
            );
    
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'strikethrough_text_typography',
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $strikethrough_text,
                )
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        /* End Tabs */

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        if (tutils()->is_enrolled()) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Since you are already enrolled, the price will not appear', 'tutor-lms-elementor-addons');
            }
            return;
        }
        $course = etlms_get_course();
        if ($course) {
            echo '<div class="etlms-course-price">';
            tutor_course_price();
            echo '</div>';
        }
    }
}
