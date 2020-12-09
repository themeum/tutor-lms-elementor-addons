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

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Curriculum', 'tutor-elementor-addons');
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
                'label' => __('General Settings','tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'course_topic_collapse_icon',
            [
                'label' => __('Collapse Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                'default' =>'fa fa-plus',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'course_topic_expand_icon',
            [
                'label' => __('Expand Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                'default' =>'fa fa-minus',
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
        $course_topic = $selector.' .tutor-course-topic';
        $course_topic_background = $selector.' .etlms-course-curriculum-title';
        $topic_icon_selector = "{{WRAPPER}} .etlms-course-curriculum-title h4 i";

        /* Header Title Section */
        $this->start_controls_section(
            'course_topics_header_section',
            [
                'label' => __('Header', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_topics_header_title_color',
            [
                'label'     => __('Title Color', 'tutor-elementor-addons'),
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
                'label'     => __('Title Typography', 'tutor-elementor-addons'),
                'selector'  => $topic_header.' .tutor-segment-title',
            ]
        );

        $this->add_control(
            'course_topics_header_info_color',
            [
                'label'     => __('Info Color', 'tutor-elementor-addons'),
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
                'label'     => __('Info Typography', 'tutor-elementor-addons'),
                'selector'  => $topic_header.' .tutor-course-topics-header-right',
            ]
        );

        $this->end_controls_section();

        /* Course Topics Section */
        $this->start_controls_section(
            'course_topics_title_section',
            [
                'label' => __('Topic', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_curriculum_topic_icon_size',
            [
                'label' => __( 'Icon Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $topic_icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 16
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_topics_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $course_topic.' .etlms-course-curriculum-title h4',
            ]
        );

        //text indent
        $this->add_control(
            'course_topics_title_indent',
            [
                'label' => __( 'Text Indent', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $course_topic.' .etlms-course-curriculum-title h4 i' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //title normal/hover tabs
        //* Start Tabs */
        $this->start_controls_tabs('course_topic_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_topic_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_curriculum_topic_icon_normal_color',
                    [
                        'label'     => __('Icon Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $topic_icon_selector => 'color: {{VALUE}}',
                        ],
                    ]
                );
                
                $this->add_control(
                    'course_topic_normal_color',
                    [
                        'label'     => __('Text Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic.' .etlms-course-curriculum-title h4' => 'color: {{VALUE}}',
                        ],
                    ]
                );                

                $this->add_control(
                    'course_topic_normal_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_background => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_topic_normal_border_type',
                        'selector' => $course_topic_background,
                        'separator' => 'before',
                    ]
                );


                $this->add_control(
                    'course_topic_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $course_topic_background => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

            /* Hovered Icon */
            $this->start_controls_tab(
                'course_categories_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_curriculum_topic_icon_hover_color',
                    [
                        'label'     => __('Icon Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $topic_icon_selector.':hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                
                $this->add_control(
                    'course_topic_hover_color',
                    [
                        'label'     => __('Text Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic.' .etlms-course-curriculum-title h4:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );                

                $this->add_control(
                    'course_topic_hover_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic_background.':hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_topic_hover_border_type', 
                        
                        'selector' => $course_topic_background.':hover',
                        'separator' => 'before',
                    ]
                );


                $this->add_control(
                    'course_topic_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $course_topic_background.":hover" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        /* Course Lesson Section */
        $lesson_background_selector = $selector." .tutor-course-lessons";
        $lesson_icon_selector = "{{WRAPPER}} .tutor-course-lesson .lesson-preview-title i";
        $lession_title_selector = $course_topic. ' .tutor-course-lesson h5, .tutor-course-lesson h5 a';

        $this->start_controls_section(
            'course_lesson_section',
            [
                'label' => __('Lesson', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'course_curriculum_lesson_icon_size',
            [
                'label' => __( 'Icon Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $lesson_icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_lesson_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $lession_title_selector,
            ]
        );

        //title normal/hover tabs
        //* Start Tabs */
        $this->start_controls_tabs('course_lesson_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_lesson_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );

                $this->add_control(
                    'course_curriculum_lesson_icon_normal_color',
                    [
                        'label'     => __('Icon Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_icon_selector => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_text_color',
                    [
                        'label'     => __('Text Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lession_title_selector => 'color: {{VALUE}}',
                        ],
                    ]
                );
                

                $this->add_control(
                    'course_lesson_normal_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_background_selector => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_lesson_normal_border_type', 
                        
                        'selector' => $lesson_background_selector,
                        'separator' => 'before',
                    ]
                );

                $this->add_control(
                    'course_lesson_normal_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $lesson_background_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};
                            '
                        ],
                    ]
                );

            $this->end_controls_tab();

            /* Hovered lesson */
            $this->start_controls_tab(
                'course_lesson_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );

                $this->add_control(
                    'course_curriculum_lesson_icon_hover_color',
                    [
                        'label'     => __('Icon Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_icon_selector => 'color: {{VALUE}}',
                        ],
                    ]
                );
                
                $this->add_control(
                    'course_lesson_hover_color',
                    [
                        'label'     => __('Text Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lession_title_selector.':hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );                

                $this->add_control(
                    'course_lesson_hover_background_color',
                    [
                        'label'     => __('Background Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $lesson_background_selector.':hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_lesson_hover_border_type', 
                        
                        'selector' => $lesson_background_selector.':hover',
                        'separator' => 'before',
                    ]
                );

                $this->add_control(
                    'course_lesson_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $lesson_background_selector.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};
                            '
                        ],
                    ]
                );

        $this->end_controls_tabs();

        $this->end_controls_section();

        /* Spacing */
        $this->start_controls_section(
            'topic_lesson_spacing_section',
            [
                'label' => __('Spacing', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'topic_title_padding',
            [
                'label' => __( 'Topic Title Padding', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '.etlms-course-curriculum-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'lesson_title_padding',
            [
                'label' => __( 'Lesson Title Padding', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '.tutor-course-lesson' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'course_curriculum_topic_space',
            [
                'label' => __( 'Space Between Topic', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $course_topic_background.':not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        ob_start();
        $course = etlms_get_course();
        $settings = $this->get_settings_for_display();
        if ($course) {
            include_once etlms_get_template('course/course-topics');
            echo ob_get_clean();
        }
    }
}
