<?php
/**
 * Course Level Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseLevel extends BaseAddon {

    public function get_title() {
        return __('Course Level', 'tutor-elementor-addons');
    }
    
    protected function register_content_controls(){
        //layout 
        $this->start_controls_section(
           'course_level_layout_settings',
            [
                'label' => __( 'General Settings', 'tutor-elementor-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_responsive_control(
            'course_level_layout',
            [
                'label' => __( 'Layout', 'tutor-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'tutor-elementor-addons' ),
                        'icon' => 'fa fa-long-arrow-left',
                    ],
                    'up' => [
                        'title' => __( 'Center', 'tutor-elementor-addons' ),
                        'icon' => 'fa fa-long-arrow-up',
                    ]

                ],
                'prefix_class' => 'etlms-course-level-%s',
                'default' => 'left',
                'toggle' => false
            ]
        ); 

        //alignment    
        $this->add_responsive_control(
            'course_level_alignment',
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

        $this->add_responsive_control(
            'course_level_gap',
            [
                'label' => __( 'Gap', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                       
                    ]

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '.etlms-course-level-up .etlms-course-level-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',                    
                    '.etlms-course-level-left .etlms-course-level-content' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-meta ul li.tutor-course-level';

        //Section Label
        $this->start_controls_section(
            'course_level_label_section',
            [
                'label' => __('Label', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_level_label_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$selector.' strong' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_level_label_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector.' strong',
            ]
        );
        $this->end_controls_section();

        //Section Value
        $this->start_controls_section(
            'course_level_value_section',
            [
                'label' => __('Value', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_level_value_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_level_value_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector,
            ]
        );
        $this->end_controls_section();


        //Section Alignment
        // $this->start_controls_section(
        //     'course_level_alignment_section',
        //     [
        //         'label' => __('Alignment', 'tutor-elementor-addons'),
        //         'tab' => Controls_Manager::TAB_STYLE,
        //     ]
        // );
        // $this->add_responsive_control(
        //     'course_level_align',
        //     [
        //         'label'        => __('Alignment', 'tutor-elementor-addons'),
        //         'type'         => Controls_Manager::CHOOSE,
        //         'options'      => [
        //             'left'   => [
        //                 'title' => __('Left', 'tutor-elementor-addons'),
        //                 'icon'  => 'fa fa-align-left',
        //             ],
        //             'center' => [
        //                 'title' => __('Center', 'tutor-elementor-addons'),
        //                 'icon'  => 'fa fa-align-center',
        //             ],
        //             'right'  => [
        //                 'title' => __('Right', 'tutor-elementor-addons'),
        //                 'icon'  => 'fa fa-align-right',
        //             ],
        //         ],
        //         'prefix_class' => 'elementor-align-%s',
        //         'default'      => 'left',
        //     ]
        // );
        // $this->end_controls_section();
    }

    protected function render($instance = []) {
        ob_start();
        $course = etlms_get_course();
        if ($course) {
            include_once etlms_get_template('course/level');
        }
        echo ob_get_clean();
    }

}
