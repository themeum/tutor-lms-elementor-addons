<?php
/**
 * Course Duration Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseDuration extends BaseAddon {

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-";

    public function get_title() {
        return __('Course Duration', 'tutor-elementor-addons');
    }

    //content section
    protected function register_content_controls(){
        //layout 
        $this->start_controls_section(
           'course_duration_content_settings',
            [
                'label' => __( 'General Settings', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_responsive_control(
            'course_duration_layout',
            //layout options
            $this->etlms_layout()
        ); 
        $this->add_responsive_control(
            'course_duration_alignment',
        //alignment    
            $this->etlms_alignment()
        );

        $duration_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';


        $this->add_responsive_control(
            'course_category_gap',
            [
                'label' => __( 'Gap', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                       
                    ]

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 13,
                ],
                'selectors' => [
                    '.elementor-layout-left .etmls-single-course-meta-duration a:not(:last-child)' => $duration_spacing,                    
                    '.elementor-layout-up .etmls-single-course-meta-duration a:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--tabletleft .etmls-single-course-meta-duration a:not(:last-child)' => $duration_spacing,                    
                    '.elementor-layout--tabletup .etmls-single-course-meta-duration a:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--mobileleft .etmls-single-course-meta-duration a:not(:last-child)' => $duration_spacing,                    
                    '.elementor-layout--mobileup .etmls-single-course-meta-duration a:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );        
        $this->end_controls_section();
    } 

    protected function register_style_controls() {
        $selector = '.etmls-single-course-meta-duration a';
        $this->start_controls_section(
            'course_duration_section',
            [
                'label' => __('Style', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_duration_color',
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
                'name'      => 'course_duration_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector,
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable_course_duration = get_tutor_option('disable_course_duration');
        if (!$disable_course_duration) {
            $course = etlms_get_course();
            $course_duration = '';
            if ($course) {
                $course_duration = get_tutor_course_duration_context();
            }
            if(!empty($course_duration)) {
                $markup = '<div class="etmls-single-course-meta-duration">';
                $markup .= __('Course Duration','tutor-elementor-addons');
                $markup .= '<strong>'.$course_duration.'</strong>';
                $markup .= '</div>';
                echo $markup;
            }
        }
    }
}
