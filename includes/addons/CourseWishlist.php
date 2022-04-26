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
use TutorLMS\Elementor\AddonsTrait;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Manage content and style controls
 */
class CourseWishlist extends BaseAddon {

	/**
	 * Layout prefix class
	 *
	 * @var $prefix_class_layout
	 */
	private static $prefix_class_layout = 'elementor-layout-';

	/**
	 * Layout prefix class
	 *
	 * @var $prefix_class_layout
	 */
	private static $prefix_class_alignment = 'elementor-align-';
	/**
	 * Trait for getting common controls
	 */
	use AddonsTrait;

	/**
	 * Addon Title
	 *
	 * @return string | title text
	 */
	public function get_title() {
		return __( 'Course Wishlist', 'tutor-lms-elementor-addons' );
	}

	/**
	 * General settings controls for content tab
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'course_wishlist_content_tab',
			array(
				'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
			)
		);
			$this->add_control(
				'course_wishlist_icon_show',
				array(
					'label'        => __( 'Show Icon', 'tutor-lms-elementor-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
					'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

			$this->add_control(
				'course_wishlist_text_show',
				array(
					'label'        => __( 'Show Text', 'tutor-lms-elementor-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'separator'    => 'after',
					'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
					'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);
			$this->add_control(
				'course_wishlist_text',
				array(
					'label'       => esc_html__( 'Text', 'plugin-name' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__( 'Wishlist', 'tutor-lms-elementor-addons' ),
					'placeholder' => esc_html__( 'Type your text here', 'tutor-lms-elementor-addons' ),
					'condition'   => array(
						'course_wishlist_text_show' => 'yes',
					),
				)
			);

			$this->add_responsive_control(
				'course_wishlist_align',
				array(
					'label'        => __( 'Alignment', 'tutor-lms-elementor-addons' ),
					'type'         => \Elementor\Controls_Manager::CHOOSE,
					'options'      => array(
						'flex-start' => array(
							'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center'     => array(
							'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
							'icon'  => 'eicon-text-align-center',
						),
						'flex-end' => array(
							'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'prefix_class' => self::$prefix_class_alignment . '%s',
					'default'      => 'flex-start',
					'selectors'    => array(
						'{{WRAPPER}} .etlms-course-bookmark a' => 'display: flex; justify-content: {{VALUE}};',
					),
				)
			);

			$this->add_responsive_control(
				'course_wishlist_space_between',
				array(
					'label'      => __( 'Space Between', 'tutor-lms-elementor-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'min' => 0,
							'max' => 100,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .etlms-course-bookmark a' => 'column-gap: {{SIZE}}{{UNIT}};',
					)
				)
			);

		$this->end_controls_section();
	}

	/**
	 * Style controls for style tab
	 */
	protected function register_style_controls() {
		$wishlist_wrapper = '{{WRAPPER}} .etlms-course-bookmark';
		// Style.
		$this->start_controls_section(
			'course_wishlist_style_section',
			array(
				'label' => __( 'General Styles', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_wishlist_icon_color',
			array(
				'label'     => __( 'Icon color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$wishlist_wrapper a i" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_wishlist_icon_size',
			array(
				'label'      => __( 'Icon size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					"$wishlist_wrapper a i" => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'course_wishlist_text_color',
			array(
				'label'     => __( 'Text color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$wishlist_wrapper a:not(i)" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_wishlist_text_typography',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$wishlist_wrapper a:not(i)",
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
		$settings  		= $this->get_settings_for_display();
		$is_editor 		= \Elementor\Plugin::instance()->editor->is_edit_mode();
		$is_wishlisted 	= tutor_utils()->is_wishlisted( get_the_ID(), get_current_user_id() );
		?>
			<div class="etlms-course-bookmark">
				<a href="javascript:;" class="<?php echo esc_attr( ! $is_editor ? 'tutor-course-wishlist-btn ' : '' ); ?>tutor-btn tutor-btn-ghost tutor-course-wishlist-btn tutor-mr-16" data-course-id="<?php echo get_the_ID(); ?>">
					<?php if ( 'yes' === $settings['course_wishlist_icon_show'] ) : ?>
						<i class="tutor-icon-bookmark-<?php echo esc_attr( $is_wishlisted ? 'bold' : 'line' ); ?> tutor-mr-8" area-hidden="true"></i>
					<?php endif; ?>

					<?php if ( 'yes' === $settings['course_wishlist_text_show'] ) : ?>
						<?php echo esc_html( $settings['course_wishlist_text'] ); ?>
					<?php endif; ?>
				</a>
			</div>
		<?php
	}
}
