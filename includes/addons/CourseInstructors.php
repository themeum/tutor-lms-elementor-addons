<?php
/**
 * Course Instructors
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseInstructors extends BaseAddon {

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Instructors', 'tutor-elementor-addons');
    }
    
    protected function register_content_controls(){

        $this->start_controls_section(
            'course_instructors_content_settings',
            [
                'label' => __('Author Info','tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'course_instructor_profile',
            [
                'label' => __('Profile Picture','tutor-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'separator'=> 'after',
                'label_on' => __( 'Show', 'tutor-elementor-addons' ),
                'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes'              
            ]
        );        

        $this->add_control(
            'course_instructor_name',
            [
                'label' => __('Display Name','tutor-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'tutor-elementor-addons' ),
                'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes'                
            ]
        );


        //link        
        $this->add_control(
            'course_instructor_link',
            [
                'label'   => __('Link', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'description' => __('Link for the Author Name and Image','tutor-elementor-addons'),
                'options' => [
                    'none' => 'None', 
                    'new_window' => 'New Window', 
                    'same_window' => 'Same Window',
                ],

                'default' => 'none',
                'separator' => 'after'
            ]
        );


        $this->add_control(
            'course_instructor_layout',
            $this->etlms_non_responsive_layout()
        );        

        $this->add_control(
            'course_instructor_alignment',
            $this->etlms_non_responsive_alignment()
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-instructors';
        $title_selector = ".etlms-course-instructor-title >h4";

        /* Title Section */
        $this->start_controls_section(
            'course_instructors_title_section',
            [
                'label' => __('Section Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_instructors_title_color',
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
                'name'      => 'course_instructors_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->end_controls_section();

        /* Instructor Section */
        $img_selector = ".etlms-course-instructor-avatar img";
        $no_img_selector = ".etlms-course-instructor-avatar .tutor-text-avatar";
        $name_selector = ".etlms-instructor-name";
        $designation_selector = ".etlms-instructor-jobtitle";

        $this->start_controls_section(
            'course_instructor_section',
            [
                'label' => __('Instructor', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label' => __( 'Image Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $img_selector => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',                    
                    $no_img_selector => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                   
                ],
            ]
        );

        $this->add_control(
            'course_instructor_name_color',
            [
                'label'     => __('Name Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$name_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructor_name_typo',
                'label'     => __('Name Typography', 'tutor-elementor-addons'),
                'selector'  => $name_selector,
            ]
        );
        $this->add_control(
            'course_instructor_designation_color',
            [
                'label'     => __('Designation Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$designation_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_instructor_designation_typo',
                'label'     => __('Designation Typography', 'tutor-elementor-addons'),
                'selector'  => $designation_selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'course_instructor_background',
                'label' => __( 'Background Type', 'tutor-elementor-addons' ),
                //'types' => [ 'classic', 'gradient', 'video' ],
                'types' => [ 'classic', 'gradient'],
                'selector' => $no_img_selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'course_instructor_img_border', 
                
                'selector' =>'.etlms-course-instructor-avatar > img ,.etlms-course-instructor-avatar > span',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_instructors_avatar_border_radius',
            [
                'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .etlms-course-instructor-avatar img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .etlms-course-instructor-avatar span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* Instructor Rating Section */
        $ins_selector = ".etlms-single-instructor-bottom .tutor-instructor-left";
        $bottom_info_selector = ".etlms-course-instructors-wrap .etlms-single-instructor-bottom";
        $ins_info_selector = ".etlms-single-instructor-bottom";
        $ins_rating_star_selector = ".etlms-single-instructor-bottom  .tutor-star-rating-group";


        /* Bottom Info Section */
        $this->start_controls_section(
            'course_instructor_bottom_info_section',
            array(
                'label' => __('Bottom Info', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'course_instructor_rating_color',
            [
                'label'     => __('Rating Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $ins_rating_star_selector => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'course_instructor_rating_size',
            [
                'label' => __( 'Rating Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $ins_rating_star_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  

        $this->add_control(
            'course_instructor_label_color',
            [
                'label'     => __('Label Color', 'tutor-elementor-addons'),
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
                'label'     => __('Label Typography', 'tutor-elementor-addons'),
                'selector'  => $ins_info_selector.' .rating-digits,'. $ins_info_selector.' .courses,'. $ins_info_selector.' .students'
            )
        );
        $this->add_control(
            'course_instructor_value_color',
            [
                'label'     => __('Value Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $ins_info_selector.' .rating-total-meta,'. $ins_info_selector.' .tutor-text-mute' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'course_instructor_value_typography',
                'label'     => __('Value Typography', 'tutor-elementor-addons'),
                'selector'  => $ins_info_selector.' .rating-total-meta,'. $ins_info_selector.' .tutor-text-mute'
            )
        );
        $this->end_controls_section();

        //spacing section
        $this->start_controls_section(
            'course_instructors_space_section',
            [
                'label' => __('Spacing','tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'course_instructors_padding',
            [
                'label' => __('Instructor Padding', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '.etlms-course-instructors-wrap .tutor-instructor-left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'course_instructors_bottom_padding',
            [
                'label' => __('Bottom Info Padding', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '.etlms-single-instructor-bottom'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_instructor_bottom_space',
            [
                'label' => __( 'Space Between', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '.etlms-single-instructor-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
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
                include_once etlms_get_template('course/instructors');
                $output = apply_filters( 'tutor_course/single/instructors_html', ob_get_clean() );
                echo $output;
            }
        }
    }
}
