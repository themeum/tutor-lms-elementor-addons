<?php
/**
 * Course Categories Addon
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use TutorPro\CourseBundle\Models\BundleModel;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Bundle Categories addons
 * Handle all categories addon controls
 */
class BundleCategories extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	/**
	 * Layout prefix class
	 *
	 * @var $prefix_class_layout
	 */
	private static $prefix_class_layout = 'elementor-layout-';

	/**
	 * Alignment prefix class
	 *
	 * @var $prefix_class_alignment
	 */
	private static $prefix_class_alignment = 'elementor-align-';

	/**
	 * Categories label
	 */
	public function get_title() {
		return __( 'Bundle Categories', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Register addon controls
	 */
	protected function register_content_controls() {
		// layout.
		$this->start_controls_section(
			'course_category_content_settings',
			array(
				'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,

			)
		);

		$this->add_responsive_control(
			'course_category_layout',
			array(
				'label'        => __( 'Layout', 'tutor-lms-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'row'    => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'column' => array(
						'title' => __( 'Up', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-v-align-top',
					),
				),
				'default'      => 'row',
				'prefix_class' => self::$prefix_class_layout . '%s',
				'toggle'       => false,
				'selectors'    => array(
					'{{WRAPPER}} .etlms-course-categories' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_category_alignment',
			// alignment.
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
					'flex-end'   => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class' => self::$prefix_class_alignment . '%s',
				'default'      => 'flex-start',
				'selectors'    => array(
					'{{WRAPPER}}.elementor-layout-row .etlms-course-categories' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}}.elementor-layout-column .etlms-course-categories' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_category_gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .etlms-course-categories' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$selector       = '{{WRAPPER}} .etlms-course-categories a';
		$label_selector = '{{WRAPPER}} .etlms-course-categories .tutor-meta-key';
		$this->start_controls_section(
			'course_categories_style_section',
			array(
				'label' => __( 'Style', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		// * Start Tabs */
		$this->start_controls_tabs( 'course_thumbnail_style_tabs' );
			/* Normal Tab */
			$this->start_controls_tab(
				'course_categories_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				// label controls.
				$this->add_control(
					'course_categories_label_color',
					array(
						'label'     => __( 'Label Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$label_selector => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'course_categories_label_typo',
						'label'    => __( 'Label typography', 'tutor-lms-elementor-addons' ),
						'selector' => $label_selector,
					)
				);
				// value controls.
				$this->add_control(
					'course_categories_original_color',
					array(
						'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$selector => 'color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'course_categories_original_typo',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $selector,
					)
				);
			$this->end_controls_tab();

			/* Hovered Icon */
			$this->start_controls_tab(
				'course_categories_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);
				// label hover controls.
				$this->add_control(
					'course_categories_label_hovered_color',
					array(
						'label'     => __( 'Label Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$label_selector . ':hover' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'course_categories_label_hovered_typo',
						'label'    => __( 'Label Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $label_selector . ':hover',
					)
				);

				// value controls.
				$this->add_control(
					'course_categories_hovered_color',
					array(
						'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$selector . ':hover' => 'color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'course_categories_hovered_typo',
						'label'    => __( 'Value Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $selector . ':hover',
					)
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render addon, responsible for the editor and front end view
	 */
	protected function render() {
		global $post;
		$bundle            = etlms_get_bundle();
		$settings          = $this->get_settings_for_display();
		$bundle_categories = array();

		if ( $bundle ) {
			$bundle_categories = BundleModel::get_bundle_course_categories( $post->ID );

		}

		if ( is_array( $bundle_categories ) && count( $bundle_categories ) ) :
			$item = 1; ?>
			<div class="etlms-course-categories tutor-meta">
				<span class="tutor-meta-key"><?php esc_html_e( 'Categories:', 'tutor-lms-elementor-addons' ); ?></span>
				<span>
					<?php
						$category_links = array();
					foreach ( $bundle_categories as $bundle_category ) :
						$category_name = $bundle_category->name;

						$category_link = get_term_link( (int) $bundle_category->term_id );

						$category_links[] = wp_sprintf( '<a href="%1$s">%2$s</a>', esc_url( $category_link ), esc_html( $category_name ) );
						endforeach;
						echo implode( ', ', $category_links );
					?>
				</span>
			</div>
		<?php else : ?>
			<?php
			if ( $this->is_elementor_editor() ) :
				esc_html_e( 'Please add category from Tutor course builder', 'tutor-lms-elementor-addons' );
			endif;
		endif;
	}

}
