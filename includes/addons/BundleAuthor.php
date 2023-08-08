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

class BundleAuthor extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Bundle Author', 'tutor-lms-elementor-addons' );
	}


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
				'default'     => __( 'Instructors', 'tutor-lms-elementor-addons' ),
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
		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$selector = '{{WRAPPER}} h2.tutor-fs-5.tutor-fw-bold.tutor-color-black.tutor-mb-12';
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
		$this->start_controls_section(
			'bundle_author_bg_style_section',
			array(
				'label' => __( 'Background', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'bundle_author_bg_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tutor-card' => 'background-color: {{VALUE}};',
				),
				'default'   => '#fcfcfd',
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
		$title     = __( 'Bundle Author', 'tutor-lms-elementor-addons' );
		$course    = etlms_get_bundle();
		$course_id = get_the_ID();
		if ( $course ) {
			$title = get_the_title();
		}
		$settings = $this->get_settings_for_display();
		if ( $course ) { ?>
		   <div class="tutor-bundle-author-list tutor-card tutor-card-md tutor-sidebar-card tutor-mt-24 tutor-py-24 tutor-px-32">
						<?php
						include etlms_get_template( 'course/bundle-authors' );
						?>
			</div>
			<?php
		}
	}
}
