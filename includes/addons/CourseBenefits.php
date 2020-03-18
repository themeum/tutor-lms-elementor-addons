<?php
/**
 * Course Benefits
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseBenefits extends BaseAddon
{
    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_title()
    {
        return __('Course Benefits', 'tutor-elementor-addons');
    }
    
    protected function register_style_controls()
    {
        $selector = "{{WRAPPER}} .tutor-course-benefits-wrap";
        $title_selector = $selector.' .course-benefits-title h4';
        $content_selector = $selector." .tutor-course-benefits-items";
        $icon_selector = $content_selector.' li:before';

        /* Title Section */
        $this->start_controls_section(
            'course_benefits_title_section',
            [
                'label' => __('Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_benefits_title_color',
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
                'name'      => 'course_benefits_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->end_controls_section();

        /* Icon  Section */
        $this->start_controls_section(
            'course_benefits_icon_section',
            [
                'label' => __('Icon', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_benefits_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$icon_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_benefits_icon_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $icon_selector,
            ]
        );
        $this->end_controls_section();

        /* Content  Section */
        $this->start_controls_section(
            'course_benefits_content_section',
            [
                'label' => __('Content', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_benefits_content_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$content_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_benefits_content_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $content_selector,
            ]
        );
        $this->end_controls_section();


        /* Spacing  Section */
        $this->start_controls_section(
            'course_benefits_spacing_section',
            [
                'label' => __('Spacing', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_benefits_padding',
            [
                'label' => __('Padding', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $content_selector.' li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'course_benefits_margin',
            [
                'label' => __('Margin', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $content_selector.' li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = [])
    {
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            $markup = '<div class="tutor-single-course-segment tutor-course-benefits-wrap">
                <div class="course-benefits-title">
                    <h4 class="tutor-segment-title">What Will I Learn?</h4>
                </div>
                <div class="tutor-course-benefits-content">
                    <ul class="tutor-course-benefits-items tutor-custom-list-style">
                        <li>How to use an email list to make money</li>
                        <li>How to remarket back to profitable leads</li>
                        <li>How to find profitable Affiliate Marketing products</li>
                    </ul>
                </div>
            </div>';
            echo $markup;
        } else {
            $disable_benefits = get_tutor_option('disable_course_benefits');
            if ( !$disable_benefits ) {
                tutor_course_benefits_html();
            }
        }
    }
}
