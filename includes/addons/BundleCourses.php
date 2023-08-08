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

	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .elm-bundle-courses .tutor-fs-5.tutor-fw-bold.tutor-color-black.tutor-mb-12';
		$courses_title_selector = '{{WRAPPER}} .tutor-bundle-course-title';
		$courses_author_selector = '{{WRAPPER}} .tutor-bundle-course-list-desc p a';
		// Style.
		$this->start_controls_section(
			'bundle_course_style_section',
			array(
				'label' => __( 'Title Color & Typography', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bundle_courses_title_color',
			array(
				'label'     => __( 'Title Color', 'tutor-lms-elementor-addons' ),
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
				'name'     => 'bundle_courses_title_typography',
				'label'    => __( 'Title Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $selector,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'bundle_courselist_style_section',
			array(
				'label' => __( 'Courses List', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bundle_courseslist_title_color',
			array(
				'label'     => __( 'Title Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$courses_title_selector => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bundle_courseslist_title_typography',
				'label'    => __( 'Title Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $courses_title_selector,
			)
		);
		$this->add_control(
			'bundle_coursesauthor_title_color',
			array(
				'label'     => __( 'Author Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$courses_author_selector => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bundle_coursesauthor_title_typography',
				'label'    => __( 'Author Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $courses_author_selector,
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

				<div class="tutor-mt-32 elm-bundle-courses">
					<?php require_once \TutorPro\CourseBundle\Utils::template_path( 'single/bundle-courses.php' ); ?>
				</div>
			<?php
		}
	}
}
