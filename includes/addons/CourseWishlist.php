<?php
/**
 * Course Wishlist Addon
 *
 * @since v2.0.0
 *
 * @package ETLMSCourseWishlist
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Manage content and style controls
 */
class CourseWishlist extends BaseAddon {

	/**
	 * Addon Title
	 *
	 * @return string | title text
	 */
	public function get_title() {
		return __( 'Course Wishlist', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Icon for the addons that will be visible on elementor panel
	 *
	 * @return string | icon name
	 */
	public function get_icon() {
		return 'eicon-heart-o';
	}

	/**
	 * General settings controls for content tab
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
	 * Style controls for style tab
	 */
	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .course-title';
		// Style.
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
	 * Render Wishlist template
	 *
	 * @since v2.0.0
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			<a href="#" class="action-btn tutor-text-regular-body tutor-color-text-primary tutor-course-wishlist-btn" data-course-id="<?php echo get_the_ID(); ?>">
				<i class="tutor-icon-fav-line-filled"></i> <?php esc_html_e( 'Wishlist', 'tutor-lms-elementor-addons' ); ?>
			</a>
		<?php
	}
}
