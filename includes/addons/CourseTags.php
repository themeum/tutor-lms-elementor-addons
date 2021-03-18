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
        return __('Course Tags', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls(){

        $this->start_controls_section(
            'course_tags_content_section',
            [
                'label' => 'General Settings',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
			'section_title_text',
			[
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Tags', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows' => 3,
			]
        );
        
        $this->end_controls_section();
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .etlms-course-tag';
        $title_selector = $selector.' .course-benefits-title h4';
        $tag_selector = $selector.' .tutor-course-tags a';

        /* Title Section */
        $this->start_controls_section(
            'course_tags_title_section',
            [
                'label' => __('Section Title', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_tags_title_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
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
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->add_responsive_control(
            'etlms_heading_gap',
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
                    $title_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
					'size' => 15,
                ]
            ]
        );
        $this->end_controls_section();

        /* Tag Section */
        $this->start_controls_section(
            'add_to_cart_button_style',
            [
                'label' => __( 'Tags', 'tutor-lms-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        /* Start Tabs */
        $this->start_controls_tabs('course_tags_style_tabs');

            /* Normal Tab */
            $this->start_controls_tab(
                'course_tags_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_tags_normal_color',
                    [
                        'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $tag_selector => 'color: {{VALUE}};',
                        ],
                        'default'   => '#525252'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'course_tags_normal_typography',
                        'label'     => __( 'Typography', 'tutor-lms-elementor-addons' ),
                        'selector'  => $tag_selector,
                    )
                );

                $this->add_control(
                    'course_tags_normal_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $tag_selector => 'background-color: {{VALUE}}',
                        ],
                        'default'   => '#F7F9FA'
                    ]
                );

                $this->add_control(
                    'course_tags_normal_padding',
                    [
                        'label' => __( 'Padding', 'tutor-lms-elementor-addons' ),
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
                        'label' => __( 'Margin', 'tutor-lms-elementor-addons' ),
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
                        'label' => __( 'Border', 'tutor-lms-elementor-addons' ),
                        'selector' => $tag_selector,
                    ]
                );

                $this->add_control(
                    'course_tags_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $tag_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'default' => [
                            'top' => 50,
                            'right' => 50,
                            'bottom' => 50,
                            'left' => 50,
                            'unit' => 'px',
                            'isLinked' => true
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'course_tags_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
                        'selector' => $tag_selector,
                    ]
                );

            $this->end_controls_tab();

            /* Hover Tab */
            $tag_selector_hover = $tag_selector.':hover';
            $this->start_controls_tab(
                'course_tags_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_tags_hover_color',
                    [
                        'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
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
                        'label'     => __( 'Typography', 'tutor-lms-elementor-addons' ),
                        'selector'  => $tag_selector_hover,
                    )
                );

                $this->add_control(
                    'course_tags_hover_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $tag_selector_hover => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'course_tags_hover_padding',
                    [
                        'label' => __( 'Padding', 'tutor-lms-elementor-addons' ),
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
                        'label' => __( 'Margin', 'tutor-lms-elementor-addons' ),
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
                        'label' => __( 'Border', 'tutor-lms-elementor-addons' ),
                        'selector' => $tag_selector_hover,
                    ]
                );

                $this->add_control(
                    'course_tags_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
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
                        'label' => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
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
            ob_start();
            $settings = $this->get_settings_for_display();
            include etlms_get_template('course/tags');
            $output = apply_filters( 'tutor_course/single/tags_html', ob_get_clean() );
            echo $output;
        }
    }
}
