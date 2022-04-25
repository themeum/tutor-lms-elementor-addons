<?php
/**
 * Course Total Enrolled
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CourseTotalEnrolled extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Course Total Enrolled', 'tutor-lms-elementor-addons' );
	}

	protected function register_content_controls() {
		// layout
		$this->start_controls_section(
			'course_level_layout_settings',
			array(
				'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,

			)
		);

		$this->add_control(
			'course_total_enroll_label',
			array(
				'label'       => __( 'Label', 'tutor-lms-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enrolled:', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your label here', 'tutor-lms-elementor-addons' ),
			)
		);

		// layout
		$this->add_responsive_control(
			'course_enrolled_layout',
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
					'{{WRAPPER}} .etlms-course-enrolled-count-meta' => 'flex-direction: {{VALUE}};',
				),
			)
		);

        //alignment
        $this->add_responsive_control(
			'course_enrolled_alignment',
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
					'{{WRAPPER}}.etlms-layout-row .etlms-course-enrolled-count-meta' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}}.etlms-layout-column .etlms-course-enrolled-count-meta' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
            'course_enrolled_gap',
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
                    '{{WRAPPER}} .etlms-course-enrolled-count-meta' => 'gap: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .etlms-course-enrolled-count-meta';

		$this->start_controls_section(
			'course_total_enrolled_style_section',
			array(
				'label' => __( 'Text', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		/* Start Tabs */
		$this->start_controls_tabs( 'course_total_enrolled_tabs' );

			/* Label Tab */
			$this->start_controls_tab(
				'course_total_enrolled_label_tab',
				array(
					'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
				)
			);

			$this->add_control(
				'course_total_enrolled_label_color',
				array(
					'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .etlms-course-enrolled-count-meta .tutor-meta-key' => 'color: {{VALUE}}',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'course_total_enrolled_label_typo',
					'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
					'selector' => '{{WRAPPER}} .etlms-course-enrolled-count-meta .tutor-meta-key',
				)
			);

			$this->end_controls_tab();

			/* Value Tab */
			$this->start_controls_tab(
				'course_total_enrolled_value_tab',
				array(
					'label' => __( 'Value', 'tutor-lms-elementor-addons' ),
				)
			);

			$this->add_control(
				'course_total_enrolled_value_color',
				array(
					'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .etlms-course-enrolled-count-meta .tutor-meta-value' => 'color: {{VALUE}}',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'course_total_enrolled_value_typo',
					'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
					'selector' => '{{WRAPPER}} .etlms-course-enrolled-count-meta .tutor-meta-value',
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		/* End Tabs */

		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		$disable_option = (bool) get_tutor_option( 'disable_course_total_enrolled' );
		if ( $disable_option ) {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				echo __( 'Please enable course total enrolled from tutor settings', 'tutor-lms-elementor-addons' );
			}
			return;
		}

		$course   = etlms_get_course();
		$settings = $this->get_settings_for_display();
		if ( $course ) {
			$total_enroll = (int) tutils()->count_enrolled_users_by_course();
			$markup       = '<div class="tutor-meta etlms-course-enrolled-count-meta">';
			$markup      .= ( $settings['course_total_enroll_label'] ) ? '<span class="tutor-meta-key">' . $settings['course_total_enroll_label'] . '</span>' : '';
			$markup      .= '<span class="tutor-meta-value">' . $total_enroll . '</span>';
			$markup      .= '</div>';
			echo $markup;
		}
	}
}
