<?php
/**
 * Course Share Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseSocialShare extends BaseAddon {

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-";    

    public function get_title() {
        return __('Course Social Share', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls(){

        $this->start_controls_section(
            'course_share_icon_content_section',
            [
                'label' => __('Social Icons', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'course_share_label_content',
            [
                'label' => __('Label', 'tutor-lms-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'tutor-lms-elementor-addons' ),
                'label_off' => __( 'Hide', 'tutor-lms-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'course_share_icon_shape',
            [
                'label' => __('Shape','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'rounded' => __( 'Rounded', 'tutor-lms-elementor-addons' ),
                    'square' => __( 'Square', 'tutor-lms-elementor-addons' ),
                    'circle' => __( 'circle', 'tutor-lms-elementor-addons' ),
                   
                ],  
                'default' => 'rounded',
                'prefix_class' => 'etlms-social-icon-'              
            ]
        );

        $this->add_responsive_control(
            'course_share_alignment',
            $this->etlms_alignment()
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $icon_selector = '{{WRAPPER}} .etlms-social-share-wrap >button >i';
        /* Label */
        $this->start_controls_section(
            'course_share_label_section',
            [
                'label' => __('Label', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_share_label_content_color',
            [
                'label' => __( 'Color', 'tutor-lms-elementor-addons' ),
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
                'label' => __( 'Typography', 'tutor-lms-elementor-addons' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .etlms-social-label',
            ]
        );        
        $this->end_controls_section();

        //icon settings
        $this->start_controls_section(
            'course_share_icon_section',
            [
                'label' => __('Icon', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_share_icon_color_settings',
            [
                'label' => __( 'Color', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Official Color', 'tutor-lms-elementor-addons' ),
                    'custom' => __( 'Custom', 'tutor-lms-elementor-addons' ),
                ],
            ]
        );

        $this->add_control(
            'course_share_icon_color',
            [
                'label' => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
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
                'label' => __( 'Shape Color', 'tutor-lms-elementor-addons' ),
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
                'label' => __( 'Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14
                ],
                'selectors' => [
                    $icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'course_share_icon_padding',
            [
                'label' => __( 'Padding', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    $icon_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                    'isLinked' => true
                ],
            ]
        );

        $icon_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';

        $this->add_responsive_control(
            'course_share_icon_spacing',
            [
                'label' => __( 'Spacing', 'tutor-lms-elementor-addons' ),
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
                'default' => [
                    'size' => 5
                ]
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

        $border_radius = [
            'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                $icon_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'default' => [
                'top' => 0,
                'right' => 0,
                'bottom' => 0,
                'left' => 0,
                'unit' => 'px',
                'isLinked' => true
            ]
        ];

        //for square shape
        $border_radius['condition'] = ['course_share_icon_shape' => ['square']];
        $this->add_control(
            'course_share_border_radius_square', $border_radius
        );

        //for rounded shape
        $border_radius['condition'] = ['course_share_icon_shape' => ['rounded']];
        $border_radius['default'] = ['top' => 5, 'right' => 5, 'bottom' => 5, 'left' => 5, 'unit' => 'px', 'isLinked' => true];
        $this->add_control(
            'course_share_border_radius_rounded', $border_radius
        );

        //for rounded shape
        $border_radius['condition'] = ['course_share_icon_shape' => ['circle']];
        $border_radius['default'] = ['top' => 50, 'right' => 50, 'bottom' => 50, 'left' => 50, 'unit' => '%', 'isLinked' => true];
        $this->add_control(
            'course_share_border_radius_circle', $border_radius
        );

        $this->end_controls_section();
        //hover section start
        $this->start_controls_section(
            'course_share_icon_hover_section',
            [
                'label' => __( 'Icon Hover', 'tutor-lms-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_icon_hover_color',
            [
                'label' => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
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
                'label' => __( 'Shape Color', 'tutor-lms-elementor-addons' ),
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
                'label' => __( 'Border Color', 'tutor-lms-elementor-addons' ),
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
                'label' => __( 'Hover Animation', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'condition' => [
                    'course_share_icon_shape' =>[
                        'square','rounded','circle'
                    ]
                ],
                'prefix_class' =>'etlms-animation-'
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable_course_share = (bool) get_tutor_option('disable_course_share');
        if ($disable_course_share) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course share from tutor settings', 'tutor-lms-elementor-addons');
            }
            return;
        }

        ob_start();
        $settings = $this->get_settings_for_display();
        include etlms_get_template('course/share');
        echo ob_get_clean();
    }
}
