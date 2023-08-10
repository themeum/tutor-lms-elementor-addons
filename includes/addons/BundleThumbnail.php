<?php
/**
 * Bundle Thumbnail
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use TutorPro\CourseBundle\CustomPosts\ManagePostMeta;
use TutorPro\CourseBundle\MetaBoxes\BundlePrice;
use TutorPro\CourseBundle\Models\BundleModel;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class BundleThumbnail extends BaseAddon {

	public function get_title() {
		return __( 'Bundle Thumbnail', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Dependent scripts
	 *
	 * @return array, contains name of dependent script
	 */
	public function get_script_depends() {
		return array(
			'etlms-course-topics',
		);
	}

	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .tutor-course-thumbnail';
		$bundle_thumb_dis_info_background = '{{WRAPPER}} .tutor-bundle-discount-info';

		/* Style */
		$this->start_controls_section(
			'bundle_thumbnail_style_section',
			array(
				'label' => __( 'Style', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'bundle_thumb_dis_info_background',
			array(
				'label'     => __( 'Discount info Background', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$bundle_thumb_dis_info_background => 'background: {{VALUE}};',
				),
			)
		);

		/* Start Tabs */
		$this->start_controls_tabs( 'bundle_thumbnail_style_tabs' );
			/* Normal Tab */
			$this->start_controls_tab(
				'bundle_tags_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					array(
						'label'    => __( 'CSS Filters', 'tutor-lms-elementor-addons' ),
						'name'     => 'bundle_normal_thumbnail_filter',
						'selector' => $selector,					
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'bundle_normal_thumbnail_border',
						'selector' => $selector,
					)
				);

				$this->add_responsive_control(
					'bundle_normal_thumbnail_border_radius',
					array(
						'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'default'    => array(
							'top'      => 8,
							'right'    => 8,
							'bottom'   => 8,
							'left'     => 8,
							'unit'     => 'px',
							'isLinked' => true,
						),
					)
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'bundle_normal_thumbnail_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $selector,
					)
				);

			$this->end_controls_tab();

			/* Hovered Thumbnails */
			$hover_selector = $selector . ':hover';
			$this->start_controls_tab(
				'bundle_hovered_thumbnail_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);

				$this->add_group_control(
					Group_Control_Css_Filter::get_type(),
					array(
						'label'    => __( 'CSS Filters', 'tutor-lms-elementor-addons' ),
						'name'     => 'bundle_hover_thumbnail_filter',
						'selector' => $selector . ':hover',
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'bundle_hovered_thumbnail_border',
						'selector' => $hover_selector,
					)
				);

				$this->add_responsive_control(
					'bundle_hovered_thumbnail_border_radius',
					array(
						'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							$hover_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'bundle_hovered_thumbnail_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $hover_selector,
					)
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();
		/* End Tabs */

		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		$course    = etlms_get_bundle();
		$course_id = get_the_ID();
		$thumb_url = get_tutor_course_thumbnail_src( 'post-thumbnail', $course_id );
		if ( $course ) {?>

				<div class="tutor-course-thumbnail">
					<img src="<?php echo esc_url( $thumb_url ); ?>" />
					<?php
					$bundle_course_ids = BundleModel::get_bundle_course_ids( $course_id );
					$ribbon_type       = ManagePostMeta::get_ribbon_type( $course_id );
					$bundle_sale_price = BundlePrice::get_bundle_sale_price( $course_id );
					?>
						<!-- Show bundle discount badge -->
						<?php if ( BundleModel::RIBBON_NONE !== $ribbon_type && $bundle_sale_price > 0 ) : ?>
						<div class="tutor-bundle-discount-info">
							<div class="tutor-bundle-save-text"><?php esc_html_e( 'SAVE', 'tutor-pro' ); ?></div>
							<div class="tutor-bundle-save-amount"><?php echo esc_html( BundlePrice::get_bundle_discount_by_ribbon( $course_id, $ribbon_type ) ); ?></div>
						</div>
						<?php endif; ?>
				</div>
		   
			<?php
		}
	}
}
