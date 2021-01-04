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

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-";    

    public function get_title() {
        return __('Course Level', 'tutor-lms-elementor-addons');
    }
    
    protected function register_content_controls(){
        //layout 
        $this->start_controls_section(
           'course_level_layout_settings',
            [
                'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_control(
			'course_level_label',
			[
				'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Course level:', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your label here', 'tutor-lms-elementor-addons' ),
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
                'label' => __( 'Gap', 'tutor-lms-elementor-addons' ),
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

        $this->start_controls_section(
            'course_level_style_section',
            [
                'label' => __('Text', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Start Tabs */
        $this->start_controls_tabs('course_level_tabs');

            /* Label Tab */
            $this->start_controls_tab(
                'course_level_label_tab',
                [
                    'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_level_label_color',
                [
                    'label'     => __('Color', 'tutor-lms-elementor-addons'),
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
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $selector.' label',
                ]
            );

            $this->end_controls_tab();

            /* Value Tab */
            $this->start_controls_tab(
                'course_level_value_tab',
                [
                    'label' => __( 'Value', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_level_value_color',
                [
                    'label'     => __('Color', 'tutor-lms-elementor-addons'),
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
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $selector.' strong',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        /* End Tabs */

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable_option = (bool) get_tutor_option('disable_course_level');
		if ($disable_option) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course level from tutor settings', 'tutor-lms-elementor-addons');
            }
			return;
        }
        
        $course = etlms_get_course();
        $settings = $this->get_settings_for_display();
        if ($course) {
            $level = (get_tutor_course_level()) ? get_tutor_course_level() : __('All Levels', 'tutor-lms-elementor-addons');
            $markup = '<div class="etlms-lead-info etlms-course-level">';
            $markup .= ($settings['course_level_label']) ? '<label>'.$settings['course_level_label'].'</label>' : '';
            $markup .= '<strong>'. $level .'</strong>';
            $markup .= '</div>';
            echo $markup;
        }
    }

}
