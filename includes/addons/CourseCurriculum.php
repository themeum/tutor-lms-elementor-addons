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

    protected function register_content_controls(){

        $topic_icon_selector = ".elementor-widget-container .etlms-course-title  h4  i";
        $lesson_icon_selector = ".elementor-widget-container .etlms-course-lesson  h5 i";
        $assignment_icon_selector = ".elementor-widget-container .etlms-course-assignment  h5 i";
        $quiz_icon_selector = ".elementor-widget-container .etlms-course-quiz  h5 i";

        $this->start_controls_section(
            'course_curriculum_content_topic_section',
            [
                'label' => __('Topic Icon','tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'course_topic_active_icon',
            [
                'label' => __('Topic Active Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                'default' =>['fa fa-minus'],
                'label_block' => true,
            ]
        );         

        $this->add_control(
            'course_topic_inactive_icon',
            [
                'label' => __('Topic Inactive Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                'default' =>['fa fa-plus'],
                'label_block' => true,
            ]
        );       

        $this->add_responsive_control(
            'course_curriculum_topic_icon_align',
            $this->etlms_icon_align($prefix_class='etlms-topic-icon-align-')
        );

        $this->add_control(
            'course_curriculum_topic_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $topic_icon_selector => 'color: {{VALUE}}',
                ],
            ]
        );        

        $this->add_control(
            'course_curriculum_topic_icon_hover_color',
            [
                'label'     => __('Hover', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $topic_icon_selector.":hover"=> 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_curriculum_topic_icon_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
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
            ]
        );
        $this->end_controls_section();

        //lesson settings
        $this->start_controls_section(
            'course_curriculum_content_lesson_section',
            [
                'label' => __('Lesson Icon','tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

//lesson icon

        $this->add_control(
            'course_lesson_icon',
            [
                'label' => __('Choose Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
            ]
        );       
//lesson icon end

        $this->add_responsive_control(
            'course_curriculum_lesson_icon_align',
            $this->etlms_icon_align($prefix_class='etlms-lesson-icon-align-')
        );

        $this->add_control(
            'course_curriculum_lesson_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $lesson_icon_selector => 'color: {{VALUE}}',
                ],
            ]
        );        

        $this->add_control(
            'course_curriculum_lesson_icon_hover_color',
            [
                'label'     => __('Hover', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $lesson_icon_selector.':hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_curriculum_lesson_icon_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
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
        $this->end_controls_section();

        //lessong settings end

        //assignment settings start
        $this->start_controls_section(
            'course_curriculum_content_assignment_section',
            [
                'label' => __('Assignment Icon','tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'course_assignment_icon',
            [
                'label' => __('Choose Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                
                'label_block' => true,
            ]
        );       

        $this->add_responsive_control(
            'course_curriculum_assignment_icon_align',
            $this->etlms_icon_align($prefix_class='etlms-assignment-icon-align-')
        );

        $this->add_control(
            'course_curriculum_assignment_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $assignment_icon_selector => 'color: {{VALUE}}',
                ],
            ]
        );        

        $this->add_control(
            'course_curriculum_assignment_icon_hover_color',
            [
                'label'     => __('Hover', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $assignment_icon_selector.':hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_curriculum_assignment_icon_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $assignment_icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();        
        //assignment settings end

        //quiz settings start
        $this->start_controls_section(
            'course_curriculum_content_quiz_section',
            [
                'label' => __('Quiz Icon','tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'course_quiz_icon',
            [
                'label' => __('Choose Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                
                'label_block' => true,
            ]
        );       

        $this->add_responsive_control(
            'course_curriculum_quiz_icon_align',
            $this->etlms_icon_align($prefix_class='etlms-quiz-icon-align-')
        );

        $this->add_control(
            'course_curriculum_quiz_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $quiz_icon_selector => 'color: {{VALUE}}',
                ],
            ]
        );        

        $this->add_control(
            'course_curriculum_quiz_icon_hover_color',
            [
                'label'     => __('Hover', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $quiz_icon_selector.':hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'course_curriculum_quiz_icon_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $quiz_icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();         
        //quiz settings end

    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-topics-wrap';
        $topic_header = $selector.' .tutor-course-topics-header';
        $course_topic = $selector.' .tutor-course-topic';
        $course_topic_background = $selector.' .etlms-course-title';
        /* Header Title Section */
        $this->start_controls_section(
            'course_topics_header_title_section',
            [
                'label' => __('Header Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_topics_header_title_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
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
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $topic_header.' .tutor-segment-title',
            ]
        );


        $this->end_controls_section();


        /* Header Info Section */
        $this->start_controls_section(
            'course_topics_header_info_section',
            [
                'label' => __('Header Info', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_topics_header_info_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$topic_header.' .tutor-course-topics-header-right' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_topics_header_info_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $topic_header.' .tutor-course-topics-header-right',
            ]
        );

        $this->add_control(
            'course_topics_header_space',
            [
                'label' => __( 'Space Between', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    $topic_header => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        
        $this->end_controls_section();

        /* Course Topics Section */
        $this->start_controls_section(
            'course_topics_title_section',
            [
                'label' => __('Topic Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_topics_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $course_topic.' .etlms-course-title h4',
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
                    $course_topic.' .etlms-course-title h4' => 'text-indent: {{SIZE}}{{UNIT}};',
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
                    'course_topic_normal_color',
                    [
                        'label'     => __('Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic.' .etlms-course-title h4' => 'color: {{VALUE}}',
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
                    $course_topic_background => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};
                    '
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
                    'course_topic_hover_color',
                    [
                        'label'     => __('Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $course_topic.' .etlms-course-title h4:hover' => 'color: {{VALUE}}',
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
                    $course_topic_background.':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};
                    '
                ],
            ]
        );
            $this->end_controls_tabs();

        $this->end_controls_section();

        /* Course Lesson Section */
        $lesson_background_selector = $selector." .tutor-course-lessons";
        $lession_title_selector = $course_topic. ' .tutor-course-lesson h5, .tutor-course-lesson h5 a';
        $this->start_controls_section(
            'course_lesson_title_section',
            [
                'label' => __('Lesson Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_lesson_title_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$lession_title_selector => 'color: {{VALUE}}',
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
                    'course_lesson_normal_color',
                    [
                        'label'     => __('Color', 'tutor-elementor-addons'),
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
                    'course_lesson_hover_color',
                    [
                        'label'     => __('Color', 'tutor-elementor-addons'),
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
                    '.etlms-course-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'course_curriculum_lesson_space',
            [
                'label' => __( 'Spacing Between Lessons', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '.tutor-course-lesson' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'course_curriculum_topic_space',
            [
                'label' => __( 'Spacing After Topic', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $course_topic_background => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
