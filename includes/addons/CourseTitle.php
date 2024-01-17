<?php
/**
 * Course Title Addon
 *
 * @since 1.0.0
 *
 * @package ELTMSCourseTitle
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CourseTitle
 */
class CourseTitle extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	/**
	 * Prefix class layout
	 *
	 * @var string
	 */
	private static $prefix_class_layout = 'elementor-layout-';

	/**
	 * Prefix class alignment
	 *
	 * @var string
	 */
	private static $prefix_class_alignment = 'elementor-align-';

	/**
	 * Get title label
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Course Title', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Register content controls
	 *
	 * @return void
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'course_title_content',
			array(
				'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'course_title_html_tag',
			array(
				'label'   => esc_html__( 'Select Tag', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1' => esc_html( 'h1' ),
					'h2' => esc_html( 'h2' ),
					'h3' => esc_html( 'h3' ),
					'h4' => esc_html( 'h4' ),
					'h5' => esc_html( 'h5' ),
					'h6' => esc_html( 'h6' ),
				),
				'default' => 'h2',
			)
		);

		$this->add_responsive_control(
			'course_title_align',
			$this->title_alignment_with_selectors(
				array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
				'left'
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register style controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .tutor-course-details-title';

		$this->start_controls_section(
			'course_style_section',
			array(
				'label' => __( 'Color & Typography', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_title_typography',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $selector,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render content
	 *
	 * @return void
	 */
	protected function render() {
		$title  = __( 'Course Title', 'tutor-lms-elementor-addons' );
		$course = etlms_get_course();
		if ( $course ) {
			$title = get_the_title();
		}

		$settings  = $this->get_settings_for_display();
		$saved_tag = $settings['course_title_html_tag'];

		$tag_name = 'h2';
		$options  = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
		if ( in_array( $saved_tag, $options, true ) ) {
			$tag_name = $saved_tag;
		}

		echo sprintf(
			'<%1$s class="tutor-course-details-title tutor-fs-4 tutor-fw-bold tutor-color-black tutor-mt-12 tutor-mb-0"> 
					<span>' . esc_html( $title ) . '</span>
			</%1$s>',
			esc_attr( $tag_name )
		);

	}
}
