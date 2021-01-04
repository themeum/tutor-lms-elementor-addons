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

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-";    

    public function get_title() {
        return __('Course Total Enrolled', 'tutor-lms-elementor-addons');
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
			'course_total_enroll_label',
			[
				'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Enrolled:', 'tutor-lms-elementor-addons' ),
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

        $this->start_controls_section(
            'course_total_enrolled_style_section',
            [
                'label' => __('Text', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Start Tabs */
        $this->start_controls_tabs('course_total_enrolled_tabs');

            /* Label Tab */
            $this->start_controls_tab(
                'course_total_enrolled_label_tab',
                [
                    'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_total_enrolled_label_color',
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
                    'name'      => 'course_total_enrolled_label_typo',
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $selector.' label',
                ]
            );

            $this->end_controls_tab();

            /* Value Tab */
            $this->start_controls_tab(
                'course_total_enrolled_value_tab',
                [
                    'label' => __( 'Value', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_total_enrolled_value_color',
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
                    'name'      => 'course_total_enrolled_value_typo',
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
        $disable_option = (bool) get_tutor_option('disable_course_total_enrolled');
		if ($disable_option) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course total enrolled from tutor settings', 'tutor-lms-elementor-addons');
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
