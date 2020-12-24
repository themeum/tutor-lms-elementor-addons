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

    use ETLMS_Trait;

    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Price', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_price_content',
            [
                'label' => __('General Settings', 'tutor-elementor-addons'),
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
        $regular_price = $selector.' > .amount, '. $selector.' > .price';
        $sale_price = $selector.' del .amount';

        //Section Regular
        $this->start_controls_section(
            'regular_price_label_section',
            [
                'label' => __('Regular Price', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'regular_price_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $regular_price => 'color: {{VALUE}};',
                ],
                'default'   => '#161616'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'regular_price_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $regular_price,
            )
        );

        $this->end_controls_section();

        //Section Regular
        $this->start_controls_section(
            'sale_price_label_section',
            [
                'label' => __('Sale Price', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sale_price_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $sale_price => 'color: {{VALUE}};',
                ],
                'default'   => '#7A7A7A'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'sale_price_typography',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $sale_price,
            )
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        if (tutils()->is_enrolled()) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Since you are already enrolled, the price will not appear', 'tutor-elementor-addons');
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
