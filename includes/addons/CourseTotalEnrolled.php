<?php
/**
 * Course Total Enrolled
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseTotalEnrolled extends BaseAddon {

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-";    

    public function get_title() {
        return __('Course Total Enrolled', 'tutor-elementor-addons');
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
			'course_total_enroll_label',
			[
				'label' => __( 'Label', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Enrolled:', 'tutor-elementor-addons' ),
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
                    '.elementor-layout-up .etlms-course-total-enroll strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout-left .etlms-course-total-enroll strong' => 'margin-left: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--tabletup .etlms-course-total-enroll strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--tabletleft .etlms-course-total-enroll strong' => 'margin-lef: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--mobileup .etlms-course-total-enroll strong' => 'margin-top: {{SIZE}}{{UNIT}};',                    
                    '.elementor-layout--mobileleft .etlms-course-total-enroll strong' => 'margin-left: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .etlms-course-total-enroll';

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
        $disable_option = (bool) get_tutor_option('disable_course_total_enrolled');
		if ($disable_option) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course total enrolled from tutor settings', 'tutor-elementor-addons');
            }
			return;
        }

        $course = etlms_get_course();
        $settings = $this->get_settings_for_display();
        if ($course) {
            $total_enroll = (int) tutils()->count_enrolled_users_by_course();
            $markup = '<div class="etlms-lead-info etlms-course-total-enroll">';
            $markup .= ($settings['course_total_enroll_label']) ? '<label>'.$settings['course_total_enroll_label'].'</label>' : '';
            $markup .= '<strong>'. $total_enroll .'</strong>';
            $markup .= '</div>';
            echo $markup;
        }
    }
}
