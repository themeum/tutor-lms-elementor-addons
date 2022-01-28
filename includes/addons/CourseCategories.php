<?php
/**
 * Course Categories Addon
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Course Categories addons
 * Handle all categories addon controls
 */
class CourseCategories extends BaseAddon {

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
		return __( 'Course Categories', 'tutor-lms-elementor-addons' );
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
			// layout options.
			$this->etlms_layout()
		);
		$this->add_responsive_control(
			'course_category_alignment',
			// alignment.
			$this->etlms_alignment()
		);

		$category_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';

		$this->add_responsive_control(
			'course_category_gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,

					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'.elementor-layout-left .etlms-single-course-meta-categories a:not(:last-child)' => $category_spacing,
					'.elementor-layout-up .etlms-single-course-meta-categories a:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'.elementor-layout--tabletleft .etlms-single-course-meta-categories a:not(:last-child)' => $category_spacing,
					'.elementor-layout--tabletup .etlms-single-course-meta-categories a:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'.elementor-layout--mobileleft .etlms-single-course-meta-categories a:not(:last-child)' => $category_spacing,
					'.elementor-layout--mobileup .etlms-single-course-meta-categories a:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .etlms-single-course-meta-categories a';
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
				$this->add_control(
					'course_categories_original_color',
					array(
						'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
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
				$this->add_control(
					'course_categories_hovered_color',
					array(
						'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
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
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
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
	protected function render( $instance = array() ) {
		$course            = etlms_get_course();
		$course_categories = array();
		if ( $course ) {
			$course_categories = get_tutor_course_categories();
		}
		if ( is_array( $course_categories ) && count( $course_categories ) ) {
			$item   = 1;
			$markup = '<div class="etlms-single-course-meta-categories">';
			foreach ( $course_categories as $course_category ) {
				$category_name = $course_category->name;
				$category_link = get_term_link( $course_category->term_id );
				$comma         = ( $item < count( $course_categories ) ) ? ',' : '';
				$markup       .= "<a href='$category_link'>{$category_name}{$comma}</a>";
				$item++;
			}
			$markup .= '</div>';
			echo $markup;
		}
	}
}
