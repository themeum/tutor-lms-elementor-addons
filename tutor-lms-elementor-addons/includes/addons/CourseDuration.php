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

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-";    

    public function get_title() {
        return __('Course Duration', 'tutor-lms-elementor-addons');
    }
    
    protected function register_content_controls(){
        //layout 
        $this->start_controls_section(
           'course_duration_layout_settings',
            [
                'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'course_duration_label',
			[
				'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Course Duration:', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your label here', 'tutor-lms-elementor-addons' ),
			]
		);

        $this->add_responsive_control(
            'course_duration_layout',
            //layout options
            $this->etlms_layout()
        ); 

        //alignment    
        $this->add_responsive_control(
            'course_duration_alignment',
            //alignment options
            $this->etlms_alignment()
        );

        $this->add_responsive_control(
            'course_duration_gap',
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
                    '.elementor-layout-up .etlms-course-duration strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout-left .etlms-course-duration strong' => 'margin-left: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--tabletup .etlms-course-duration strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--tabletleft .etlms-course-duration strong' => 'margin-lef: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--mobileup .etlms-course-duration strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--mobileleft .etlms-course-duration strong' => 'margin-left: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .etlms-course-duration';

        $this->start_controls_section(
            'course_duration_style_section',
            [
                'label' => __('Text', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Start Tabs */
        $this->start_controls_tabs('course_duration_tabs');

            /* Label Tab */
            $this->start_controls_tab(
                'course_duration_label_tab',
                [
                    'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_duration_label_color',
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
                    'name'      => 'course_duration_label_typo',
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $selector.' label',
                ]
            );

            $this->end_controls_tab();

            /* Value Tab */
            $this->start_controls_tab(
                'course_duration_value_tab',
                [
                    'label' => __( 'Value', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_duration_value_color',
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
                    'name'      => 'course_duration_value_typo',
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
        $disable_option = (bool) get_tutor_option('disable_course_duration');
		if ($disable_option) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course duration from tutor settings', 'tutor-lms-elementor-addons');
            }
			return;
        }
        
        $course = etlms_get_course();
        $settings = $this->get_settings_for_display();
        if ($course) {
            $course_duration = get_tutor_course_duration_context();
            $course_duration = (!empty($course_duration)) ? $course_duration : 0;
            $markup = '<div class="etlms-lead-info etlms-course-duration">';
            $markup .= ($settings['course_duration_label']) ? '<label>'.$settings['course_duration_label'].'</label>' : '';
            $markup .= '<strong>'. $course_duration .'</strong>';
            $markup .= '</div>';
            echo $markup;
        }
    }
}
