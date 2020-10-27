<?php
/**
 * Course Tags
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseTags extends BaseAddon {

    public function get_title() {
        return __('Course Tags', 'tutor-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-tag-wrap';
        $title_selector = $selector.' .course-benefits-title h4';
        $tag_selector = $selector.' .tutor-course-tags a';

        /* Title Section */
        $this->start_controls_section(
            'course_tags_title_section',
            [
                'label' => __('Section Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_tags_title_color',
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
                'name'      => 'course_tags_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->end_controls_section();

        /* Tag Section */
        $this->start_controls_section(
            'add_to_cart_button_style',
            [
                'label' => __( 'Tags', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        /* Start Tabs */
        $this->start_controls_tabs('course_tags_style_tabs');

            /* Normal Tab */
            $this->start_controls_tab(
                'course_tags_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_tags_normal_color',
                    [
                        'label'     => __( 'Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $tag_selector => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'course_tags_normal_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $tag_selector,
                    )
                );

                $this->add_control(
                    'course_tags_normal_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $tag_selector => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'course_tags_normal_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $tag_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'course_tags_normal_margin',
                    [
                        'label' => __( 'Margin', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $tag_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_tags_normal_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $tag_selector,
                    ]
                );

                $this->add_control(
                    'course_tags_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $tag_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'course_tags_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $tag_selector,
                    ]
                );

            $this->end_controls_tab();

            /* Hover Tab */
            $tag_selector_hover = $tag_selector.':hover';
            $this->start_controls_tab(
                'course_tags_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_tags_hover_color',
                    [
                        'label'     => __( 'Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $tag_selector_hover => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'course_tags_hover_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $tag_selector_hover,
                    )
                );

                $this->add_control(
                    'course_tags_hover_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $tag_selector_hover => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'course_tags_hover_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $tag_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'course_tags_hover_margin',
                    [
                        'label' => __( 'Margin', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $tag_selector_hover => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_tags_hover_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $tag_selector_hover,
                    ]
                );

                $this->add_control(
                    'course_tags_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $tag_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'course_tags_hover_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $tag_selector_hover,
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        /* End Tabs */

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $course = etlms_get_course();
        if ($course) {
            echo '<div class="tutor-single-course-tag-wrap">';
            tutor_course_tags_html();
            echo '</div>';
        }
    }
}
