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
use Elementor\Core\Schemes\Typography;
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
				'label'       => __( 'About the Instructors Title', 'tutor-lms-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'About the instructors', 'tutor-lms-elementor-addons' ),
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

		$this->add_control(
			'course_instructor_bio',
			array(
				'label'        => __( 'Bio', 'tutor-lms-elementor-addons' ),
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
					'none'        => 'None',
					'new_window'  => 'New Window',
					'same_window' => 'Same Window',
				),

				'default'     => 'new_window',
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
				'label' => __( 'Course Instructor Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_instructors_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$selector .etlms-course-instructor-title" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructors_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$selector .etlms-course-instructor-title",
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
					"$selector .etlms-course-instructor-title" => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				)
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
				)
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
					$selector . ' .etlms-instructor-name', $selector . ' .etlms-instructor-name a' => 'color: {{VALUE}}',
				)
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_name_typo',
				'label'    => __( 'Name Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $selector . ' .etlms-instructor-name',
			)
		);

		$this->add_control(
			'course_instructor_designation_color',
			array(
				'label'     => __( 'Designation Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector . ' .etlms-instructor-designation' => 'color: {{VALUE}}',
				)
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_designation_typo',
				'label'    => __( 'Designation Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $selector . ' .etlms-instructor-designation',
			)
		);

		$this->add_control(
			'course_instructor_bio_color',
			array(
				'label'     => __( 'Biography Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector . ' .etlms-instructor-bio' => 'color: {{VALUE}} !important;',
				)
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_bio_typo',
				'label'    => __( 'Biography Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $selector . ' .etlms-instructor-bio',
			)
		);

		$this->end_controls_section();

		/* Bottom Info Section */
		$this->start_controls_section(
			'course_instructor_bottom_info_section',
			array(
				'label' => __( 'Instructor Bottom Info', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_instructor_rating_color',
			array(
				'label'     => __( 'Rating Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector . ' .tutor-ratings-stars' => 'color: {{VALUE}};'
				)
			)
		);

		$this->add_control(
			'course_instructor_rating_size',
			array(
				'label'      => __( 'Rating Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 64,
					),
				),
				'selectors'  => array(
					$selector . ' .tutor-ratings-stars' => 'font-size: {{SIZE}}{{UNIT}};'
				)
			)
		);

		$this->add_control(
			'course_instructor_label_color',
			array(
				'label'     => __( 'Label Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector . ' .tutor-ratings-average' => 'color: {{VALUE}};',
					$selector . ' .tutor-meta-value' => 'color: {{VALUE}};'
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_label_typography',
				'label'    => __( 'Label Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$selector .tutor-ratings-average, $selector .tutor-meta-value",
				'scheme'   => Typography::TYPOGRAPHY_1,
			)
		);

		$this->add_control(
			'course_instructor_value_color',
			array(
				'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector . ' .tutor-ratings-count' => 'color: {{VALUE}} !important;',
					$selector . ' .tutor-meta-key' => 'color: {{VALUE}} !important;'
				)
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_value_typography',
				'label'    => __( 'Value Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$selector .tutor-ratings-average, $selector .tutor-meta-value",
			)
		);

		$this->add_control(
			'course_instructor_bottom_info_icon_size',
			array(
				'label'      => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 64,
					),
				),
				'selectors'  => array(
					$selector . ' .etlms-meta-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				)
			)
		);

		$this->end_controls_section();

		// spacing section.
		$this->start_controls_section(
			'course_instructors_space_section',
			array(
				'label' => __( 'Instructor Spacing', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_instructors_padding',
			array(
				'label'      => __( 'Instructor Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					$selector . ' .tutor-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'separator'  => 'before',
			)
		);

		$this->add_control(
			'course_instructors_bottom_padding',
			array(
				'label'      => __( 'Bottom Info Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"$selector .tutor-card-footer" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
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
		global $wp_query;
		if ( empty( $wp_query->query_vars['course_subpage'] ) ) {
			$course = etlms_get_course();
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
}
