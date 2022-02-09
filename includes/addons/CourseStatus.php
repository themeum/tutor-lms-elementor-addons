<?php
/**
 * Course Status
 *
 * @since 1.0.0
 *
 * @package ETLMSCourseStatus
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register content and style tab controls
 */
class CourseStatus extends BaseAddon {

	/**
	 * Addon title what will visible on the elementor editor
	 * panel.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Course Status', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Register content controls
	 *
	 * @return void
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'course_status_content_section',
			array(
				'label' => 'Course Progress',
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'course_progress_title_text',
			array(
				'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Course Progress', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows'        => 3,
			)
		);

		$this->add_control(
			'course_status_display_percent',
			array(
				'label'     => __( 'Display Percentage', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'block' => __( 'Show', 'tutor-lms-elementor-addons' ),
					'none'  => __( 'Hide', 'tutor-lms-elementor-addons' ),
				),
				'default'   => 'block',
				'selectors' => array(
					'{{WRAPPER}} .progress-percentage' => 'display: {{VALUE}};',
				),
			)
		);

		// $this->add_control(
		// 'course_status_percent_position',
		// array(
		// 'label'     => __( 'Position', 'tutor-lms-elementor-addons' ),
		// 'type'      => Controls_Manager::SELECT,
		// 'options'   => array(
		// 'inside'  => __( 'Inside', 'tutor-lms-elementor-addons' ),
		// 'outside' => __( 'Outside', 'tutor-lms-elementor-addons' ),
		// 'ontop'   => __( 'On top', 'tutor-lms-elementor-addons' ),
		// ),
		// 'condition' => array(
		// 'course_status_display_percent' => 'show',
		// ),
		// 'default'   => 'inside',
		// )
		// );

		$this->end_controls_section();
	}

	/**
	 * Register styles controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		$progress_wrapper = '{{WRAPPER}} .tutor-course-progress-wrapper';
		/* Section Title */
		$this->start_controls_section(
			'course_status_title_section',
			array(
				'label' => __( 'Course Progress Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_status_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .tutor-text-medium-h6" => 'color: {{VALUE}};',
				),
				'default'   => '#212327',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_status_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$progress_wrapper .tutor-text-medium-h6",
			)
		);
		$this->add_responsive_control(
			'etlms_heading_gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => -50,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => '16',
				),
				'selectors'  => array(
					"$progress_wrapper .list-item-progress" => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/* Section Bar */
		$this->start_controls_section(
			'course_status_bar_section',
			array(
				'label' => __( 'Progress Bar', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_status_bar_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .list-item-progress .progress-bar .progress-value" => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_status_bar_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .list-item-progress .progress-bar" => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_status_progress_bar_height',
			array(
				'label'      => __( 'Height', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 6,
						'max'  => 64,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 4,
					'unit' => 'px',
				),
				'selectors'  => array(
					"$progress_wrapper .list-item-progress .progress-bar" => 'height: {{SIZE}}{{UNIT}};',
					"$progress_wrapper .list-item-progress .progress-bar .progress-value" => 'height: 100%;',
				),
			)
		);

		$this->add_control(
			'course_status_progress_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 2,
					'unit' => 'px',
				),
				'selectors'  => array(
					"$progress_wrapper .list-item-progress .progress-bar" => 'border-radius: {{SIZE}}{{UNIT}};',
					"$progress_wrapper .list-item-progress .progress-bar .progress-value"   => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_status_progress_text',
			array(
				'label' => __( 'Progress Text', 'tutor-lms-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_status_progress_text_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .progress-percentage, $progress_wrapper .progress-steps" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_status_progress_text_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$progress_wrapper .progress-percentage, $progress_wrapper .progress-steps",
			)
		);

		$this->end_controls_section();
		// course progress controls end.
	}

	/**
	 * Render content
	 *
	 * @param array $instance | addons instance.
	 *
	 * @return void
	 */
	protected function render( $instance = array() ) {
		$disable_option = ! (bool) get_tutor_option( 'enable_course_progress_bar' );
		if ( $disable_option ) {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				echo __( 'Please enable course status from tutor settings', 'tutor-lms-elementor-addons' );
			}
			return;
		}

		$settings = $this->get_settings_for_display();
		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || ( is_user_logged_in() && tutils()->is_enrolled() ) ) {
			ob_start();
			include etlms_get_template( 'course/status' );
			$output = apply_filters( 'tutor_course/single/completing-progress-bar', ob_get_clean() );
			// PHPCS - the variable $output holds safe data.
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
