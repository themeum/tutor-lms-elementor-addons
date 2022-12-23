<?php
/**
 * Course Price Addon
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CoursePrice extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Course Price', 'tutor-lms-elementor-addons' );
	}

	protected function register_content_controls() {
		$this->start_controls_section(
			'course_price_content',
			array(
				'label' => __( 'Course Price', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_responsive_control(
			'course_price_align',
			$this->title_alignment_with_selectors(
				array(
					'{{WRAPPER}} .tutor-course-sidebar-card-pricing' => 'display: block !important; text-align: {{VALUE}};',
				),
				'left'
			)
		);
		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$course_price_wrapper = '{{WRAPPER}} .tutor-course-sidebar-card-pricing';
		$this->start_controls_section(
			'course_price_style_section',
			array(
				'label' => __( 'Course Price', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		/* Start Tabs */
		$this->start_controls_tabs( 'course_price_style_tabs' );

			/* Normal Tab */
			$this->start_controls_tab(
				'course_price_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);

			$this->add_control(
				'course_price_normal_text_color',
				array(
					'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$course_price_wrapper span" => 'color: {{VALUE}};',
					),
					'default'   => '#212327',
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'course_purchase_price_normal_text_typography',
					'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$course_price_wrapper span, {{WRAPPER}} .tutor-fs-4",
				)
			);

			$this->end_controls_tab();

			/* Strikethrough Tab */
			$this->start_controls_tab(
				'course_price_strikethrough_style_tab',
				array(
					'label' => __( 'Strike', 'tutor-lms-elementor-addons' ),
				)
			);

			$this->add_control(
				'strikethrough_text_color',
				array(
					'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$course_price_wrapper div > del" => 'color: {{VALUE}};',
					),
					'default'   => '#7A7A7A',
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'strikethrough_text_typography',
					'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$course_price_wrapper div > del",
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		/* End Tabs */
		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		
		$course	= etlms_get_course();
		$price 	= tutor_utils()->get_course_price( get_the_ID() );
		if ( $course ) {
			if ( null != $price ) : ?>
				<div class="tutor-course-sidebar-card-pricing tutor-d-flex align-items-end tutor-justify-content-between">
					<div>
						<?php echo tutor_kses_html( $price ); ?>
					</div>
				</div>
			<?php else : ?>
				<div class="tutor-course-sidebar-card-pricing tutor-d-flex align-items-end tutor-justify-content-between">
					<div>
						<span class="tutor-fs-4 tutor-fw-bold tutor-color-black">
							<?php echo esc_html_x( 'Free', 'course price', 'tutor-lms-elementor-addons' ); ?>
						</span>
					</div>
				</div>
			<?php endif;
		}
	}
}
