<?php
/**
 * Course Instructors
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseInstructors extends BaseAddon {

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Instructors', 'tutor-lms-elementor-addons');
    }
    
    protected function register_content_controls(){

        $this->start_controls_section(
            'course_instructors_content_settings',
            [
                'label' => __('Author Info','tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
			'section_title_text',
			[
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'About the instructors', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows' => 3,
			]
        );

        $this->add_control(
            'course_instructor_profile',
            [
                'label' => __('Profile Picture','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'separator'=> 'after',
                'label_on' => __( 'Show', 'tutor-lms-elementor-addons' ),
                'label_off' => __( 'Hide', 'tutor-lms-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes'              
            ]
        );        

        $this->add_control(
            'course_instructor_name',
            [
                'label' => __('Display Name','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'tutor-lms-elementor-addons' ),
                'label_off' => __( 'Hide', 'tutor-lms-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes'                
            ]
        );
        
        $this->add_control(
            'course_instructor_designation',
            [
                'label' => __('Designation','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'tutor-lms-elementor-addons' ),
                'label_off' => __( 'Hide', 'tutor-lms-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes'                
            ]
        );


        //link        
        $this->add_control(
            'course_instructor_link',
            [
                'label'   => __('Link', 'tutor-lms-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'description' => __('Link for the Author Name and Image','tutor-lms-elementor-addons'),
                'options' => [
                    'none' => 'None', 
                    'new_window' => 'New Window', 
                    'same_window' => 'Same Window',
                ],

                'default' => 'new_window',
            ]
        );

        $this->add_responsive_control(
            'course_author_layout',
            $this->etlms_layout('up') // default layout up 
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $title_selector = ".etlms-course-instructor-title .tutor-segment-title";

        /* Title Section */
        $this->start_controls_section(
            'course_instructors_title_section',
            [
                'label' => __('Section Title', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_instructors_title_color',
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
                'name'      => 'course_instructors_title_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->add_responsive_control(
            'etlms_instructor_heading_gap',
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
                    $title_selector => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
                'default' => [
					'size' => 25,
                ]
            ]
        );
        $this->end_controls_section();

        /* Instructor Section */
        $instructor_wrap = ".etlms-single-instructor-wrap";
        $img_selector = $instructor_wrap." .instructor-avatar a";
        $name_selector = $instructor_wrap." .instructor-name h3 a";
        $designation_selector = $instructor_wrap." .instructor-name p";
        $biography_selector = $instructor_wrap." .instructor-bio";

        $this->start_controls_section(
            'course_instructor_section',
            [
                'label' => __('Instructor', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label' => __( 'Image Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $img_selector.' span, '.$img_selector.' img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}}/2 - 3px)',
                ],
                'default' => [
					'size' => 48,
				]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'course_instructor_background',
                'label' => __( 'Background Type', 'tutor-lms-elementor-addons' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => $img_selector.' span',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'course_instructor_img_border',
                'selector' => $img_selector.' span, '.$img_selector.' img'
            ]
        );

        $this->add_control(
            'course_instructors_avatar_border_radius',
            [
                'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-course-instructor-avatar img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .etlms-course-instructor-avatar span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'selectors' => [
                    $img_selector.' span, '.$img_selector.' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => '%',
                    'isLinked' => true
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'course_instructor_name_color',
            [
                'label'     => __('Name Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$name_selector => 'color: {{VALUE}}',
                ],
                'default'   => '#161616'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructor_name_typo',
                'label'     => __('Name Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $name_selector,
            ]
        );
        $this->add_control(
            'course_instructor_designation_color',
            [
                'label'     => __('Designation Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$designation_selector => 'color: {{VALUE}}',
                ],
                'default'   => '#7A7A7A'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructor_designation_typo',
                'label'     => __('Designation Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $designation_selector,
            ]
        );

        $this->add_control(
            'course_instructor_bio_color',
            [
                'label'     => __('Biography Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$biography_selector => 'color: {{VALUE}}',
                ],
                'default'   => '#525252'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructor_bio_typo',
                'label'     => __('Biography Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $biography_selector,
            ]
        );

        $this->end_controls_section();

        /* Instructor Rating Section */
        $ins_info_selector = $instructor_wrap." .single-instructor-bottom";
        $ins_rating_star_selector = $instructor_wrap." .single-instructor-bottom  .tutor-star-rating-group";

        /* Bottom Info Section */
        $this->start_controls_section(
            'course_instructor_bottom_info_section',
            array(
                'label' => __('Bottom Info', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_instructor_rating_color',
            [
                'label'     => __('Rating Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $ins_rating_star_selector => 'color: {{VALUE}};',
                ],
                'default'   => '#ED9700'
            ]
        );
        $this->add_control(
            'course_instructor_rating_size',
            [
                'label' => __( 'Rating Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 64,
                    ],
                ],
                'selectors' => [
                    $ins_rating_star_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 18
                ]
            ]
        );  

        $this->add_control(
            'course_instructor_label_color',
            [
                'label'     => __('Label Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $ins_info_selector.' .rating-digits,'. $ins_info_selector.' .courses,'. $ins_info_selector.' .students' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_instructor_label_typography',
                'label'     => __('Label Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $ins_info_selector.' .rating-digits,'. $ins_info_selector.' .courses,'. $ins_info_selector.' .students',
                'scheme'    => Typography::TYPOGRAPHY_1,
            )
        );
        $this->add_control(
            'course_instructor_value_color',
            [
                'label'     => __('Value Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $ins_info_selector.' .rating-total-meta,'. $ins_info_selector.' .tutor-text-mute' => 'color: {{VALUE}} !important;',
                ],
                'default'   => '#525252'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_instructor_value_typography',
                'label'     => __('Value Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $ins_info_selector.' .ratings .rating-total-meta,'. $ins_info_selector.' .tutor-text-mute'
            )
        );
        $this->add_control(
            'course_instructor_bottom_info_icon_size',
            [
                'label' => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 64,
                    ],
                ],
                'selectors' => [
                    $ins_info_selector.' .courses i, '.$ins_info_selector.' .students i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 18
                ]
            ]
        );  
        $this->end_controls_section();

        //spacing section
        $this->start_controls_section(
            'course_instructors_space_section',
            [
                'label' => __('Spacing','tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'course_instructors_padding',
            [
                'label' => __('Instructor Padding', 'tutor-lms-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $instructor_wrap.' .single-instructor-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'course_instructors_bottom_padding',
            [
                'label' => __('Bottom Info Padding', 'tutor-lms-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $ins_info_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 15,
                    'right' => 20,
                    'bottom' => 15,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_instructor_bottom_space',
            [
                'label' => __( 'Space Between', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $instructor_wrap.':not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 20
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        global $wp_query;
        if (empty($wp_query->query_vars['course_subpage'])) {
            $course = etlms_get_course();
            if($course){
                ob_start();
                $settings = $this->get_settings_for_display();
                include etlms_get_template('course/instructors');
                $output = apply_filters( 'tutor_course/single/instructors_html', ob_get_clean() );
                echo $output;
            }
        }
    }
}
