<?php
/**
 * Course Author Addon
 *
 * @since 1.0.0
 *
 * @package ELTMSBundleTitle
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class BundleCourses extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Bundle Courses', 'tutor-lms-elementor-addons' );
	}


	protected function register_content_controls() {
		$this->start_controls_section(
			'bundle_title_content',
			array(
				'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'bundle_title_html_tag',
			array(
				'label'   => __( 'Select Tag', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h5' => 'h5',
					'h6' => 'h6',
				),
				'default' => 'h2',
			)
		);

		$this->add_responsive_control(
			'bundle_title_align',
			$this->title_alignment_with_selectors(
				array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
				'left'
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .tutor-course-details-title';
		// Style
		$this->start_controls_section(
			'bundle_style_section',
			array(
				'label' => __( 'Color & Typography', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bundle_title_color',
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
				'name'     => 'bundle_title_typography',
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
		$title     = __( 'Bundle Courses', 'tutor-lms-elementor-addons' );
		$course    = etlms_get_bundle();
		$course_id = get_the_ID();
		if ( $course ) {
			$title = get_the_title();
		}
		$settings = $this->get_settings_for_display();
		if ( $course ) { ?>

				<div class="tutor-mt-32">
					<?php require_once \TutorPro\CourseBundle\Utils::template_path( 'single/bundle-courses.php' ); ?>
				</div>
			<?php
		}
	}
}
