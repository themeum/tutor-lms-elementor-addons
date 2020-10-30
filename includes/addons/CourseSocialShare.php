<?php
/**
 * Course Share Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseSocialShare extends BaseAddon {

    use ETLMS_Trait;

    private static $prefix_class_layout = "etlms-course-social-share-";

    private static $prefix_class_alignment = "elementor-align-";    

    public function get_title() {
        return __('Course Social Share', 'tutor-elementor-addons');
    }

    protected function register_content_controls(){

        $this->start_controls_section(
            'course_share_icon_content_section',
            [
                'label' => __('Social Icons', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'course_share_icon_shape',
            [
                'label' => __('Shape','tutor-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none'  => __( 'None', 'tutor-elementor-addons' ),
                    'rounded' => __( 'Rounded', 'tutor-elementor-addons' ),
                    'square' => __( 'Square', 'tutor-elementor-addons' ),
                    'circle' => __( 'circle', 'tutor-elementor-addons' ),
                   
                ],  
                'default' => 'rounded',
                'prefix_class' => 'etlms-social-icon-'              
            ]
        );

        $this->add_control(
            'course_share_alignment',
            $this->etlms_alignment()
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {


        /* Label */
        $this->start_controls_section(
            'course_share_label_section',
            [
                'label' => __('Label', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_share_label_content',
            [
                'label' => __('Label', 'tutor-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'tutor-elementor-addons' ),
                'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'course_share_label_content_color',
            [
                'label' => __( 'Color', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .etlms-social-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'tutor-elementor-addons' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .etlms-social-label',
            ]
        );        
        $this->end_controls_section();

        //icon settings
        $this->start_controls_section(
            'course_share_icon_section',
            [
                'label' => __('Icon', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        
        $this->add_control(
            'course_share_icon_color_settings',
            [
                'label' => __( 'Color', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Official Color', 'tutor-elementor-addons' ),
                    'custom' => __( 'Custom', 'tutor-elementor-addons' ),
                ],
            ]
        );

        $this->add_control(
            'course_share_icon_color',
            [
                'label' => __( 'Icon Color', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'course_share_icon_color_settings' => 'custom',
                ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-share-btn >i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'course_icon_shape_color',
            [
                'label' => __( 'Shape Color', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'course_share_icon_color_settings' => 'custom',
                ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-share-btn >i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_share_icon_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14
                ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-social-share-wrap >button >i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_share_icon_padding',
            [
                'label' => __( 'Padding', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .etlms-social' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'em',
                ],
                'tablet_default' => [
                    'unit' => 'em',
                ],
                'mobile_default' => [
                    'unit' => 'em',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
            ]
        );

        $icon_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';

        $this->add_responsive_control(
            'course_share_icon_spacing',
            [
                'label' => __( 'Spacing', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-social-share-wrap >button:not(:last-child)' => $icon_spacing,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border', // We know this mistake - TODO: 'icon_border' (for hover control condition also)
                'selector' => '{{WRAPPER}} .etlms-social-share-wrap > button >i',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_share_border_radius',
            [
                'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-social-share-wrap >button >i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //hover section start
        $this->start_controls_section(
            'course_share_icon_hover_section',
            [
                'label' => __( 'Icon Hover', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_icon_hover_color',
            [
                'label' => __( 'Icon Color', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'course_share_icon_color_settings' => 'custom',
                ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-share-btn >i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'course_icon_shape_hover_color',
            [
                'label' => __( 'Shape Color', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'course_share_icon_color_settings' => 'custom',
                    'course_share_icon_shape' => [
                        'rounded','square','circle'
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-share-btn >i:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color',
            [
                'label' => __( 'Border Color', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'image_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-share-btn >i:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'course_share_hover_animation',
            [
                'label' => __( 'Hover Animation', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::HOVER_ANIMATION,

                'condition' => [
                    'course_share_icon_shape' =>[
                        'square','rounded','circle'
                    ]
                ],
                
                'prefix_class' =>'etlms-share-btn elementor-animation-'
            ]
        );


        $this->end_controls_section();


    }

    protected function render($instance = []) {

        ob_start();
        $settings = $this->get_settings_for_display();
        include_once etlms_get_template('course/share');
        echo ob_get_clean();
    }
}
