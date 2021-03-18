<?php
/**
 * Course Status
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseStatus extends BaseAddon {

    public function get_title() {
        return __('Course Status', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls(){

        $this->start_controls_section(
            'course_status_content_section',
            [
                'label' => 'General Settings',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
			'section_title_text',
			[
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Course Status', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows' => 3,
			]
        );

        $this->add_control(
            'course_status_display_percent',
            [
                'label' => __('Display Percentage','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'show' => __('Show','tutor-lms-elementor-addons'),
                    'hide' => __('Hide','tutor-lms-elementor-addons'),
                ],
                'default'=> 'show'
            ]
        );

        $this->add_control(
            'course_status_percent_position',
            [
                'label' => __('Position','tutor-lms-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'inside' => __('Inside','tutor-lms-elementor-addons'),
                    'outside' => __('Outside','tutor-lms-elementor-addons'),
                    'ontop' => __('On top','tutor-lms-elementor-addons'),
                ],
                'condition'=>[
                    'course_status_display_percent'=> 'show'
                ],
                'default'=> 'inside'
            ]
        );

        $this->end_controls_section();
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .etlms-course-status';
        $title_selector = $selector.' .tutor-segment-title';
        $progress_bar_wrap = $selector.' .etlms-progress-bar-wrap';
        $progress_bar_background = $selector.' .etlms-progress-bar';
        $progress_bar_filled = $selector.' .etlms-progress-filled';
        $progress_percent = $selector.' .etlms-progress-percent h4';

        /* Section Title */
        $this->start_controls_section(
            'course_status_title_section',
            [
                'label' => __('Section Title', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'course_status_title_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $title_selector => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_status_title_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->add_responsive_control(
            'etlms_heading_gap',
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
                    $title_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '.etlms-progress-ontop .etlms-progress-percent' => 'top: calc(-{{SIZE}}{{UNIT}} - 20px);',
                ],
                'default' => [
					'size' => 15,
                ]
            ]
        );
        $this->end_controls_section();

        /* Section Bar */
        $this->start_controls_section(
            'course_status_bar_section',
            [
                'label' => __('Progress Bar', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_status_bar_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$progress_bar_filled => 'background-color: {{VALUE}}',
				],
            ]
        );

        $this->add_control(
            'course_status_bar_background_color',
            [
                'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$progress_bar_background => 'background-color: {{VALUE}}',
				],
            ]
        );

        $this->add_control(
            'course_status_progress_bar_height',
            [
                'label'     => __('Height', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'size_units' =>['px'],
                'range' =>[
                    'px'=> [
                        'min' => 6,
                        'max' => 64,
                        'step' => 1
                    ]
                ],
                'default'=> [
                    'size' => 25,
                    'unit' => 'px'
                ],
                'selectors' => [
					$progress_bar_wrap => 'height: {{SIZE}}{{UNIT}}'
				]
            ]
        );        

        $this->add_control(
            'course_status_progress_radius',
            [
                'label'     => __('Border Radius', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'size_units' =>['px','%'],
                'range' =>[
                    'px'=> [
                        'min' =>0,
                        'max' => 100,
                        'step' => 1
                    ],                    
                    '%'=> [
                        'min' =>0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'default'=> [
                    'size' => 25,
                    'unit' => 'px'
                ],
                'selectors' => [
                    $progress_bar_background => 'border-radius: {{SIZE}}{{UNIT}}',
                    $progress_bar_filled => 'border-top-left-radius:  {{SIZE}}{{UNIT}}; border-bottom-left-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_control(
            'course_status_progress_text',
            [
                'label' => __( 'Progress Text', 'tutor-lms-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'course_status_progress_text_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$progress_percent => 'color: {{VALUE}}'
				]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_status_progress_text_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $progress_percent
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable_option = (bool) get_tutor_option('disable_course_progress_bar');
		if ($disable_option) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course status from tutor settings', 'tutor-lms-elementor-addons');
            }
			return;
        }

        $settings = $this->get_settings_for_display();
        if (\Elementor\Plugin::instance()->editor->is_edit_mode() || (is_user_logged_in() && tutils()->is_enrolled())) {
            ob_start();
            include etlms_get_template('course/status');
            $output = apply_filters( 'tutor_course/single/completing-progress-bar', ob_get_clean() );
            echo $output;
        }
    }
}
