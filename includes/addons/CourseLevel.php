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
    
    protected function register_content_controls() {
        $selector = '{{WRAPPER}} .etlms-course-level';
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

        // layout
        $this->add_responsive_control(
			'course_level_layout',
			array(
				'label'        => __( 'Layout', 'tutor-lms-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'row'    => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'column' => array(
						'title' => __( 'Up', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-v-align-top',
					),
				),
				'default'      => 'row',
                'prefix_class' => 'etlms-layout-',
				'toggle'       => false,
				'selectors'    => array(
					'{{WRAPPER}} .etlms-course-level' => 'flex-direction: {{VALUE}};',
				),
			)
		);

        //alignment
        $this->add_responsive_control(
			'course_level_alignment',
			array(
				'label'     => __( 'Alignment', 'tutor-lms-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'flex-start',
				'selectors' => array(
					'{{WRAPPER}}.etlms-layout-row .etlms-course-level' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}}.etlms-layout-column .etlms-course-level' => 'align-items: {{VALUE}};',
				),
			)
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
                'selectors' => [
                    $selector => 'gap: {{SIZE}}{{UNIT}};'
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
                        $selector.' .tutor-meta-key' => 'color: {{VALUE}}',
                    ],
                    'default'   => '#757c8e'
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'course_level_label_typo',
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $selector.' .tutor-meta-key',
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
                        $selector.' .tutor-meta-value' => 'color: {{VALUE}}',
                    ],
                    'default'   => '#212327'
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'course_level_value_typo',
                    'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                    'selector'  => $selector.' .tutor-meta-value',
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
            $markup = '<div class="etlms-course-level tutor-meta">';
            $markup .= ($settings['course_level_label']) ? '<span class="tutor-meta-key">'.$settings['course_level_label'].'</span>' : '';
            $markup .= '<span class="tutor-meta-value">'. $level .'</span>';
            $markup .= '</div>';
            echo $markup;
        }
    }

}
