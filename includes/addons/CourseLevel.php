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

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-";    

    public function get_title() {
        return __('Course Level', 'tutor-elementor-addons');
    }
    
    protected function register_content_controls(){
        //layout 
        $this->start_controls_section(
           'course_level_layout_settings',
            [
                'label' => __( 'General Settings', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_control(
			'course_level_label',
			[
				'label' => __( 'Label', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Course level:', 'tutor-elementor-addons' ),
				'placeholder' => __( 'Type your label here', 'tutor-elementor-addons' ),
			]
		);

        $this->add_responsive_control(
            'course_level_layout',
            //layout options
            $this->etlms_layout()
        ); 

        //alignment    
        $this->add_responsive_control(
            'course_level_alignment',
            //alignment options
            $this->etlms_alignment()
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
                        'max' => 300,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '.elementor-layout-up .etlms-course-level strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout-left .etlms-course-level strong' => 'margin-left: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--tabletup .etlms-course-level strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--tabletleft .etlms-course-level strong' => 'margin-lef: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--mobileup .etlms-course-level strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--mobileleft .etlms-course-level strong' => 'margin-left: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .etlms-course-level';

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
                    $selector.' label' => 'color: {{VALUE}}',
                ],
                'default'   => '#57586E'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_level_label_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector.' label',
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
                    $selector.' strong' => 'color: {{VALUE}}',
                ],
                'default'   => '#57586E'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_level_value_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector.' strong',
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $settings = $this->get_settings_for_display();
        $disable_course_level = get_tutor_option('disable_course_level');
        if (!$disable_course_level) {
            $course = etlms_get_course();
            if ($course) {
                $level = (get_tutor_course_level()) ? get_tutor_course_level() : __('All Levels', 'tutor-elementor-addons');
                $markup = '<div class="etlms-lead-info etlms-course-level">';
                $markup .= ($settings['course_level_label']) ? '<label>'.$settings['course_level_label'].'</label>' : '';
                $markup .= '<strong>'. $level .'</strong>';
                $markup .= '</div>';
                echo $markup;
            }
        }
    }

}
