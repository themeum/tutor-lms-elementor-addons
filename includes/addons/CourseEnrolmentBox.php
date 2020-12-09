<?php
/**
 * Course EnrolmentBox
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseEnrolmentBox extends BaseAddon {

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Enrolment Box', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
        // Slider Button stle
        $this->start_controls_section(
            'course_edit_mode_section',
            [
                'label' => __('Preview Mode', 'tutor-elementor-addons'),
            ]
        );
        $this->add_control(
            'course_enrolment_edit_mode',
            [
                'label'   => __('Select Mode', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'enrolment_box' => 'Enrolment Box', 
                    'enrolled_box' => 'Enrolled Box',
                ],
                'enrolment_box' => 'Enrolment Box',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'course_enroll_button_section',
            [
                'label' => __('Button', 'tutor-elementor-addons'),
            ]
        );

        $this->add_responsive_control(
            'course_enroll_buttons_align',
            $this->etlms_alignment() //alignment
        );

        $this->add_control(
            'course_enroll_buttons_size',
            [
                'label'   => __('Size', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'small' => __('Small', 'tutor-elementor-addons'), 
                    'medium' => __('Medium', 'tutor-elementor-addons'), 
                    'large' => __('Large', 'tutor-elementor-addons'),
                ],
                'prefix_class' => 'course-enroll-buttons-size-',
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'course_enroll_buttons_width',
            [
                'label'   => __('Width', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'auto' => __('Auto', 'tutor-elementor-addons'), 
                    'fill' => __('Fill', 'tutor-elementor-addons'), 
                    'fixed' => __('Fixed', 'tutor-elementor-addons'),
                ],
                'prefix_class' => 'course-enroll-buttons-width-',
                'default' => 'fill',
            ]
        );

        $this->add_responsive_control(
            'course_enroll_buttons_fixed_width',
            [
                'label' => __( 'Fixed Width', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 400,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 160,
				],
                'condition' => [
                    'course_enroll_buttons_width' => 'fixed'
                ],
                'selectors' => [
                    '{{WRAPPER}} button, {{WRAPPER}} .tutor-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-enrollment-box';
        /* Add to Cart Section */
        $add_to_cart_btn_selector1 = $selector.' .tutor-course-purchase-box button';
        $add_to_cart_btn_selector2 = $selector.' .tutor-course-purchase-box edd-add-to-cart';
        $add_to_cart_btn_selector = $add_to_cart_btn_selector1.', '.$add_to_cart_btn_selector2;
        $this->start_controls_section(
            'add_to_cart_btn',
            [
                'label' => __( 'Add to Cart Button', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['course_enrolment_edit_mode' => 'enrolment_box'],
            ]
        );
        /* Start Tabs */
        $this->start_controls_tabs('add_to_cart_btn_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'add_to_cart_btn_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'add_to_cart_btn_normal_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $add_to_cart_btn_selector => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'add_to_cart_btn_normal_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $add_to_cart_btn_selector => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'add_to_cart_btn_normal_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $add_to_cart_btn_selector,
                    )
                );
                $this->add_control(
                    'add_to_cart_btn_normal_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $add_to_cart_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'add_to_cart_btn_normal_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $add_to_cart_btn_selector,
                    ]
                );
                $this->add_control(
                    'add_to_cart_btn_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $add_to_cart_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'add_to_cart_btn_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $add_to_cart_btn_selector,
                    ]
                );
            $this->end_controls_tab();

            /* Hover Tab */
            $add_to_cart_btn_selector_hover = $add_to_cart_btn_selector.':hover';
            $this->start_controls_tab(
                'add_to_cart_btn_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'add_to_cart_btn_hover_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $add_to_cart_btn_selector_hover => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'add_to_cart_btn_hover_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $add_to_cart_btn_selector_hover => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'add_to_cart_btn_hover_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $add_to_cart_btn_selector_hover,
                    )
                );
                $this->add_control(
                    'add_to_cart_btn_hover_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $add_to_cart_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'add_to_cart_btn_hover_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $add_to_cart_btn_selector_hover,
                    ]
                );
                $this->add_control(
                    'add_to_cart_btn_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $add_to_cart_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'add_to_cart_btn_hover_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $add_to_cart_btn_selector_hover,
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        /* Enroll Button Section */
        $enroll_btn_selector = $selector.' .tutor-btn-enroll';
        $this->start_controls_section(
            'enroll_btn',
            [
                'label' => __( 'Enroll Button', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['course_enrolment_edit_mode' => 'enrolment_box'],
            ]
        );
        /* Start Tabs */
        $this->start_controls_tabs('enroll_btn_tabs');

            /* Normal Tab */
            $this->start_controls_tab(
                'enroll_btn_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'enroll_btn_normal_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $enroll_btn_selector => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'enroll_btn_normal_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $enroll_btn_selector => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'enroll_btn_normal_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $enroll_btn_selector,
                    )
                );
                $this->add_control(
                    'enroll_btn_normal_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $enroll_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'enroll_btn_normal_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $enroll_btn_selector,
                    ]
                );
                $this->add_control(
                    'enroll_btn_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $enroll_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'enroll_btn_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $enroll_btn_selector,
                    ]
                );
            $this->end_controls_tab();

            /* Hover Tab */
            $enroll_btn_selector_hover = $enroll_btn_selector.':hover';
            $this->start_controls_tab(
                'enroll_btn_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'enroll_btn_hover_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $enroll_btn_selector_hover => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'enroll_btn_hover_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $enroll_btn_selector_hover => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'enroll_btn_hover_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $enroll_btn_selector_hover,
                    )
                );
                $this->add_control(
                    'enroll_btn_hover_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $enroll_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'enroll_btn_hover_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $enroll_btn_selector_hover,
                    ]
                );
                $this->add_control(
                    'enroll_btn_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $enroll_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'enroll_btn_hover_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $enroll_btn_selector_hover,
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /* Continue Button Section */
        $start_btn_selector = $selector.' .tutor-lead-info-btn-group .tutor-success';
        $this->start_controls_section(
            'start_btn',
            [
                'label' => __( 'Start/Continue Button', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
            ]
        );
        /* Start Tabs */
        $this->start_controls_tabs('start_btn_tabs');

            /* Normal Tab */
            $this->start_controls_tab(
                'start_btn_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'start_btn_normal_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $start_btn_selector => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'start_btn_normal_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $start_btn_selector => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'start_btn_normal_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $start_btn_selector,
                    )
                );
                $this->add_control(
                    'start_btn_normal_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $start_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'start_btn_normal_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $start_btn_selector,
                    ]
                );
                $this->add_control(
                    'start_btn_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $start_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'start_btn_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $start_btn_selector,
                    ]
                );
            $this->end_controls_tab();

            /* Hover Tab */
            $start_btn_selector_hover = $start_btn_selector.':hover';
            $this->start_controls_tab(
                'start_btn_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'start_btn_hover_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $start_btn_selector_hover => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'start_btn_hover_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $start_btn_selector_hover => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'start_btn_hover_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $start_btn_selector_hover,
                    )
                );
                $this->add_control(
                    'start_btn_hover_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $start_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'start_btn_hover_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $start_btn_selector_hover,
                    ]
                );
                $this->add_control(
                    'start_btn_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $start_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'start_btn_hover_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $start_btn_selector_hover,
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /* Continue Button Section */
        $complete_btn_selector = $selector.' .tutor-lead-info-btn-group .course-complete-button';
        $this->start_controls_section(
            'complete_btn',
            [
                'label' => __( 'Complete Button', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
            ]
        );
        /* Start Tabs */
        $this->start_controls_tabs('complete_btn_tabs');

            /* Normal Tab */
            $this->start_controls_tab(
                'complete_btn_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'complete_btn_normal_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $complete_btn_selector => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'complete_btn_normal_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $complete_btn_selector => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'complete_btn_normal_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $complete_btn_selector,
                    )
                );
                $this->add_control(
                    'complete_btn_normal_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $complete_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'complete_btn_normal_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $complete_btn_selector,
                    ]
                );
                $this->add_control(
                    'complete_btn_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $complete_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'complete_btn_normal_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $complete_btn_selector,
                    ]
                );
            $this->end_controls_tab();

            /* Hover Tab */
            $complete_btn_selector_hover = $complete_btn_selector.':hover';
            $this->start_controls_tab(
                'complete_btn_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'complete_btn_hover_color',
                    [
                        'label'     => __( 'Text Color', 'tutor-elementor-addons' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $complete_btn_selector_hover => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'complete_btn_hover_background_color',
                    [
                        'label' => __( 'Background Color', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            $complete_btn_selector_hover => 'background-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    array(
                        'name'      => 'complete_btn_hover_typography',
                        'label'     => __( 'Typography', 'tutor-elementor-addons' ),
                        'selector'  => $complete_btn_selector_hover,
                    )
                );
                $this->add_control(
                    'complete_btn_hover_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $complete_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'complete_btn_hover_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'selector' => $complete_btn_selector_hover,
                    ]
                );
                $this->add_control(
                    'complete_btn_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            $complete_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'complete_btn_hover_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $complete_btn_selector_hover,
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /* Enrolled info */
        $enrolled_info_selector = $selector.' .tutor-course-enrolled-wrap p';
        $enrolled_info_icon_selector = $enrolled_info_selector.' i';
        $enrolled_info_date_selector = $enrolled_info_selector.' span';
        $this->start_controls_section(
            'enrolled_info_section',
            [
                'label' => __('Enrolled Info', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
            ]
        );
        $this->add_control(
            'enrolled_info_icon_color',
            [
                'label'     => __('Icon Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$enrolled_info_icon_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_responsive_control(
            'enrolled_info_icon_size',
            [
                'label' => __( 'Icon Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    $enrolled_info_icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 18
                ]
            ]
        );
        $this->add_control(
            'enrolled_info_label_color',
            [
                'label'     => __('Label Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$enrolled_info_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'enrolled_info_label_typo',
                'label'     => __('Label Typography', 'tutor-elementor-addons'),
                'selector'  => $enrolled_info_selector,
            ]
        );
        $this->add_control(
            'enrolled_info_date_color',
            [
                'label'     => __('Date Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$enrolled_info_date_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'enrolled_info_date_typo',
                'label'     => __('Date Typography', 'tutor-elementor-addons'),
                'selector'  => $enrolled_info_date_selector,
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $settings = $this->get_settings_for_display();
        $edit_mode = $settings['course_enrolment_edit_mode'];
        $editor_mode = \Elementor\Plugin::instance()->editor->is_edit_mode();
        $is_enrolled = tutils()->is_enrolled();
        $is_administrator = current_user_can('administrator');
        $is_instructor = tutor_utils()->is_instructor_of_this_course();
        $course_content_access = (bool) get_tutor_option('course_content_access_for_ia');
        if (($editor_mode && $edit_mode == 'enrolled_box') || $is_enrolled || ($course_content_access && ($is_administrator || $is_instructor))) {
            include_once etlms_get_template('course/enrolled-box');
        } else {
            include_once etlms_get_template('course/enrolment-box');
        }
    }
}
