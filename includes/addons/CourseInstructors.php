<?php
/**
 * Course Instructors
 *
 * @since 1.0.0
 *
 * @package CourseInstructors
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register content & styles controls
 */
class CourseInstructors extends BaseAddon {

	/**
	 * Traits for reusing codes
	 *
	 * Get layout & alignments controls
	 */
	use \TutorLMS\Elementor\AddonsTrait;

	/**
	 * Prefix layout class
	 *
	 * @var string
	 */
	private static $prefix_class_layout = 'elementor-layout-';

	/**
	 * Prefix alignment class
	 *
	 * @var string
	 */
	private static $prefix_class_alignment = 'elementor-align-';

	/**
	 * Title of this addon, that will be visible on the elementor editor panel
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Course Instructors', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Register controls for content tab
	 *
	 * @return void
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'instructor_section',
			array(
				'label' => __( 'About the Instructor', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'about_the_instructors_title',
			array(
				'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'A course by', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows'        => 3,
			)
		);

		$this->add_control(
			'course_instructor_profile',
			array(
				'label'        => __( 'Profile Picture', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'separator'    => 'after',
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_instructor_name',
			array(
				'label'        => __( 'Display Name', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_instructor_designation',
			array(
				'label'        => __( 'Designation', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		// link.
		$this->add_control(
			'course_instructor_link',
			array(
				'label'       => __( 'Link', 'tutor-lms-elementor-addons' ),
				'type'        => Controls_Manager::SELECT,
				'description' => __( 'Link for the Author Name and Image', 'tutor-lms-elementor-addons' ),
				'options'     => array(
					'_blank' => 'New Window',
					''       => 'Same Window',
				),

				'default'     => '_blank',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Style tab controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .etlms-course-instructors';

		/* Title Section */
		$this->start_controls_section(
			'course_instructors_title_section',
			array(
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_instructors_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$selector h3" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructors_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$selector h3",
			)
		);

		$this->add_responsive_control(
			'etlms_instructor_heading_gap',
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
				'selectors'  => array(
					"$selector h3" => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'course_instructor_section',
			array(
				'label' => __( 'Instructor Section', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_instructor_image_size',
			array(
				'label'      => __( 'Image Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$selector . ' .tutor-avatar' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'course_instructors_avatar_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$selector . ' .tutor-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'course_instructor_name_color',
			array(
				'label'     => __( 'Name Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector . ' .tutor-instructor-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_name_typo',
				'label'    => __( 'Name Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $selector . ' .tutor-instructor-name',
			)
		);

		$this->add_control(
			'course_instructor_designation_color',
			array(
				'label'     => __( 'Designation Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector . ' .tutor-instructor-designation' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_designation_typo',
				'label'    => __( 'Designation Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $selector . ' .tutor-instructor-designation',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render content for outputting
	 *
	 * @param array $instance | instance of this addon.
	 *
	 * @return void
	 */
	protected function render( $instance = array() ) {
		$course     = etlms_get_course();
		$is_enabled = tutor_utils()->get_option( 'display_course_instructors' );
		$is_editor  = \Elementor\Plugin::instance()->editor->is_edit_mode();
		if ( ! $is_enabled && $is_editor ) {
			return esc_html_e( 'Please enable Instructor Info from Tutor settings ', 'tutor-lms-elementor-addons' );
		}
		if ( $course ) {
			ob_start();
			$settings = $this->get_settings_for_display();
			include etlms_get_template( 'course/instructors' );
			$output = apply_filters( 'tutor_course/single/instructors_html', ob_get_clean() );
			// PHPCS - the variable $output holds safe data.
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
