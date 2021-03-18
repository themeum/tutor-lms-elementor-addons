<?php
/**
 * Course Curriculum
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseCurriculum extends BaseAddon {

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Curriculum', 'tutor-lms-elementor-addons');
    }

    public function get_style_depends()
    {
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim',
        ];
    }

    public function get_script_depends()
    {
        return [
            'etlms-course-topics'
        ];
    }  
      
    protected function register_content_controls(){

        $this->start_controls_section(
            'course_curriculum_content_topic_section',
            [
                'label' => __('General Settings','tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
			'section_title_text',
			[
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Topics for this course', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows' => 3,
			]
		);

        $this->add_control(
            'course_topic_collapse_icon',
            [
                'label' => __('Collapse Icon','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'fa fa-plus',
                    'fa fa-plus-circle',
                    'fa fa-plus-square-o',
                    'fa fa-plus-square',
                    'fa fa-angle-right',
                    'fa fa-angle-double-right',
                    'fa fa-chevron-right',
                    'fa fa-caret-right',
                    'fa fa-caret-square-o-right',
                    'fa fa-arrow-right',
                    'fa fa-arrow-circle-right',
                    'fa fa-arrow-circle-o-right',
                    'fa fa-angle-down',
                    'fa fa-angle-double-down',
                    'fa fa-chevron-down',
                    'fa fa-caret-down',
                    'fa fa-caret-square-o-down',
                    'fa fa-arrow-down',
                    'fa fa-arrow-circle-down',
                    'fa fa-arrow-circle-o-down'
                ],
                'default' =>'fa fa-chevron-down',
                'label_block' => true,

            ]
        );

        $this->add_control(
            'course_topic_expand_icon',
            [
                'label' => __('Expand Icon','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'fa fa-minus',
                    'fa fa-minus-circle',
                    'fa fa-minus-square-o',
                    'fa fa-minus-square',
                    'fa fa-angle-up',
                    'fa fa-angle-double-up',
                    'fa fa-chevron-up',
                    'fa fa-caret-up',
                    'fa fa-caret-square-o-up',
                    'fa fa-arrow-up',
                    'fa fa-arrow-circle-up',
                    'fa fa-arrow-circle-o-up',
                    'fa fa-angle-down',
                    'fa fa-angle-double-down',
                    'fa fa-chevron-down',
                    'fa fa-caret-down',
                    'fa fa-caret-square-o-down',
                    'fa fa-arrow-down',
                    'fa fa-arrow-circle-down',
                    'fa fa-arrow-circle-o-down'
                ],
                'default' =>'fa fa-chevron-up',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'course_curriculum_topic_icon_align',
            $this->etlms_icon_align($prefix_class='etlms-topic-icon-align-')
        );

        $this->end_controls_section();
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-topics-wrap';
        $topic_header = $selector.' .tutor-course-topics-header';
        $course_topic = $selector.' .etlms-course-topic';
        $course_topic_title_area = $course_topic.' .etlms-course-curriculum-title';
        $course_topic_active_title_area = $course_topic.'.etlms-topic-active .etlms-course-curriculum-title';

        /* Header Title Section */
        $this->start_controls_section(
            'course_topics_header_section',
            [
                'label' => __('Header', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_topics_header_title_color',
            [
                'label'     => __('Title Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$topic_header.' .tutor-segment-title' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_topics_header_title_typo',
                'label'     => __('Title Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $topic_header.' .tutor-segment-title',
            ]
        );

        $this->add_control(
            'course_topics_header_info_color',
            [
                'label'     => __('Info Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$topic_header.' .tutor-course-topics-header-right' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_topics_header_info_typo',
                'label'     => __('Info Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $topic_header.' .tutor-course-topics-header-right',
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
                    $topic_header.' .tutor-segment-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
					'size' => 20,
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        /* Course Topics Section */
        $this->start_controls_section(
            'course_topics_title_section',
            [
                'label' => __('Topic', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_curriculum_topic_icon_size',
            [
                'label' => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $course_topic_title_area.' h4 i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default'   => [
                    'size' => 18
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_topics_title_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $course_topic.' .etlms-course-curriculum-title h4',
            ]
        );

        //text indent
        $this->add_control(
            'course_topics_title_indent',
            [
                'label' => __( 'Text Indent', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    $course_topic.' .etlms-course-curriculum-title h4 i' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 5
                ]
            ]
        );

        //title normal/hover tabs
        //* Start Tabs */
        $this->start_controls_tabs('course_topic_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_topic_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_curriculum_topic_icon_normal_color',
                    [
                        'label'     => __('Icon Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_title_area.' h4 i' => 'color: {{VALUE}}',
                        ],
                        'default'   => '#175CFF'
                    ]
                );
                
                $this->add_control(
                    'course_topic_normal_color',
                    [
                        'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_title_area.' h4' => 'color: {{VALUE}}',
                        ],
                        'default'   => '#161616'
                    ]
                );

                $this->add_control(
                    'course_topic_normal_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_title_area => 'background-color: {{VALUE}}',
                        ],
                        'default'   => '#F7F9FA'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_topic_normal_border_type',
                        'selector' => $course_topic,
                        'separator' => 'before',
                    ]
                );

                $this->add_control(
                    'course_topic_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $course_topic => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'default' => [
                            'top' => 5,
                            'right' => 5,
                            'bottom' => 5,
                            'left' => 5,
                            'unit' => 'px',
                            'isLinked' => true
                        ],
                    ]
                );

            $this->end_controls_tab();

            /* Active Tab */
            $this->start_controls_tab(
                'course_topic_active_style_tab',
                [
                    'label' => __( 'Active', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_curriculum_topic_icon_active_color',
                    [
                        'label'     => __('Icon Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_active_title_area.' h4 i' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                
                $this->add_control(
                    'course_topic_active_color',
                    [
                        'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_active_title_area.' h4' => 'color: {{VALUE}}',
                        ],
                        'default'   => '#175CFF'
                    ]
                );

                $this->add_control(
                    'course_topic_active_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_active_title_area => 'background-color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_topic_active_border_type',
                        'selector' => $course_topic.'.etlms-topic-active',
                        'separator' => 'before',
                    ]
                );

                $this->add_control(
                    'course_topic_active_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $course_topic.'.etlms-topic-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );

            $this->end_controls_tab();

            /* Hovered Icon */
            $this->start_controls_tab(
                'course_categories_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_curriculum_topic_icon_hover_color',
                    [
                        'label'     => __('Icon Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_title_area.':hover h4 i' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                
                $this->add_control(
                    'course_topic_hover_color',
                    [
                        'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_title_area.':hover h4' => 'color: {{VALUE}}',
                        ],
                    ]
                );                

                $this->add_control(
                    'course_topic_hover_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_title_area.':hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_topic_hover_border_type', 
                        
                        'selector' => $course_topic.':hover',
                        'separator' => 'before',
                    ]
                );

                $this->add_control(
                    'course_topic_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $course_topic.":hover" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /* Course Lesson Section */
        $lesson_selector = $selector." .tutor-course-lessons .tutor-course-lesson";
        $lesson_title_selector = $lesson_selector." h5 .lesson-preview-title, ".$lesson_selector." h5 a";

        $this->start_controls_section(
            'course_lesson_section',
            [
                'label' => __('Lesson', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_curriculum_lesson_icon_size',
            [
                'label' => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $lesson_selector.' i' => 'font-size: {{SIZE}}{{UNIT}};',
                    $lesson_selector.' .zoom-icon img' => 'width: calc({{SIZE}}{{UNIT}} + 2px);',
                ],
                'default'   => [
                    'size' => 18
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_lesson_title_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $lesson_title_selector,
            ]
        );

        //title normal/hover tabs
        //* Start Tabs */
        $this->start_controls_tabs('course_lesson_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_lesson_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
                ]
            );

                $this->add_control(
                    'course_curriculum_lesson_icon_normal_color',
                    [
                        'label'     => __('Icon Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector.' i' => 'color: {{VALUE}}',
                        ],
                        'default'   => '#939AA3'
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_text_color',
                    [
                        'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_title_selector => 'color: {{VALUE}}',
                        ],
                        'default'   => '#161616'
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_info_text_color',
                    [
                        'label'     => __('Info Text Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector." .tutor-lesson-duration" => 'color: {{VALUE}}',
                        ],
                        'default'   => '#7A7A7A'
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector => 'background-color: {{VALUE}}',
                        ],
                        'default'   => '#F7F9FA',
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_border_width',
                    [
                        'label' => __( 'Border Width', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 10,
                            ],
                        ],
                        'selectors' => [
                            $lesson_selector => 'border-top-width: {{SIZE}}{{UNIT}};',
                        ],
                        'default' => [
                            'size' => 1
                        ]
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_border_color',
                    [
                        'label'     => __('Border Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector => 'border-color: {{VALUE}}',
                        ],
                        'default'   => '#E1EBF0'
                    ]
                );

            $this->end_controls_tab();

            /* Hovered lesson */
            $this->start_controls_tab(
                'course_lesson_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
                ]
            );

                $this->add_control(
                    'course_curriculum_lesson_icon_hover_color',
                    [
                        'label'     => __('Icon Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector.':hover i' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                
                $this->add_control(
                    'course_lesson_hover_color',
                    [
                        'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector.":hover h5 .lesson-preview-title, ".$lesson_selector.":hover h5 a" => 'color: {{VALUE}}',
                        ],
                    ]
                );   
                
                $this->add_control(
                    'course_lesson_normal_info_text_hover_color',
                    [
                        'label'     => __('Info Text Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_title_selector.':hover .tutor-lesson-duration' => 'color: {{VALUE}}',
                        ]
                    ]
                );

                $this->add_control(
                    'course_lesson_hover_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector.':hover' => 'background-color: {{VALUE}}',
                        ],
                        'separator' => 'after',
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_border_hover_width',
                    [
                        'label' => __( 'Border Width', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 10,
                            ],
                        ],
                        'selectors' => [
                            $lesson_selector.':hover' => 'border-top-width: {{SIZE}}{{UNIT}};',
                        ],
                        'default' => [
                            'size' => 1
                        ]
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_border_hover_color',
                    [
                        'label'     => __('Border Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_selector.':hover' => 'border-color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tabs();

        $this->end_controls_section();

        /* Spacing */
        $this->start_controls_section(
            'topic_lesson_spacing_section',
            [
                'label' => __('Spacing', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'topic_title_padding',
            [
                'label' => __( 'Topic Padding', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    $course_topic_title_area => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 15,
                    'right' => 20,
                    'bottom' => 15,
                    'left' => 20,
                    'unit' => 'px',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'lesson_title_padding',
            [
                'label' => __( 'Lesson Padding', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    $lesson_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 15,
                    'right' => 20,
                    'bottom' => 15,
                    'left' => 20,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'course_curriculum_topic_space',
            [
                'label' => __( 'Space Between Topic', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    $course_topic.':not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 20
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        ob_start();
        $course = etlms_get_course();
        if ($course) {
            $settings = $this->get_settings_for_display();
            include etlms_get_template('course/course-topics');
            echo ob_get_clean();
        }
    }
}
