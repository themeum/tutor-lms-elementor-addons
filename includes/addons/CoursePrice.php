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
						"$course_price_wrapper .tutor-text-bold-h4:not(.course-price)" => 'color: {{VALUE}};',
					),
					'default'   => '#212327',
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'course_price_normal_text_typography',
					'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$course_price_wrapper .tutor-text-bold-h4:not(.course-price)",
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
						"$course_price_wrapper del" => 'color: {{VALUE}};',
					),
					'default'   => '#7A7A7A',
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'strikethrough_text_typography',
					'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$course_price_wrapper del",
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		/* End Tabs */
		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		if ( tutils()->is_enrolled() ) {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				esc_html_e( 'Since you are already enrolled, the price will not appear', 'tutor-lms-elementor-addons' );
			}
			return;
		}
		$course         = etlms_get_course();
		$is_purchasable = tutor_utils()->is_course_purchasable();
		$product_id     = tutor_utils()->get_course_product_id();
		$product        = wc_get_product( $product_id );
		if ( $course ) {
			?>
			<?php
			if ( $product && $is_purchasable ) :
				$sale_price    = $product->get_sale_price();
				$regular_price = $product->get_regular_price();
				$symbol        = get_woocommerce_currency_symbol();
				?>
				<div class="tutor-course-sidebar-card-pricing tutor-d-flex align-items-end tutor-justify-content-between">
					<div>
						<span class="tutor-text-bold-h4 tutor-color-text-primary">
							<?php echo esc_html( $symbol . ( $sale_price ? $sale_price : $regular_price ) ); ?>
						</span>
						<?php if ( $regular_price && $sale_price && $sale_price != $regular_price ) : ?>
							<del class="tutor-text-regular-caption tutor-color-text-hints tutor-ml-7">
								<?php echo esc_html( $symbol . $regular_price ); ?>
							</del>
						<?php endif; ?>
					</div>
				</div>
			<?php else : ?>
				<div class="tutor-course-sidebar-card-pricing tutor-d-flex align-items-end tutor-justify-content-between">
					<div>
						<span class="text-bold-h4 tutor-color-text-primary"><?php echo esc_html_x( 'Free', 'course price', 'tutor-lms-elementor-addons' ); ?></span>
					</div>
				</div>
			<?php endif; ?>
			<?php
		}
	}
}
