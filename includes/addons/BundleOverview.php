<?php
/**
 * Bundle Overview Addon
 *
 * @since 1.0.0
 *
 * @package ELTMSBundleTitle
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class BundleOverview extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Bundle Overview', 'tutor-lms-elementor-addons' );
	}


	protected function register_content_controls() {
		$this->start_controls_section(
			'bundle_title_content',
			array(
				'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
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
		$this->start_controls_section(
			'course_enrolment_box_settings',
			array(
				'label' => __( 'Enrolment Box', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'course_enrolment_box',
			array(
				'label'        => __( 'Show', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'No', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		
		$this->end_controls_section();
				// enrolment button preview controls.
				$this->start_controls_section(
					'course_edit_mode_section',
					array(
						'label' => __( 'Preview Mode', 'tutor-lms-elementor-addons' ),
					)
				);
				$this->add_control(
					'course_enrolment_edit_mode',
					array(
						'label'   => __( 'Select Mode', 'tutor-lms-elementor-addons' ),
						'type'    => Controls_Manager::SELECT,
						'options' => array(
							'enrolment-box' => 'Enrolment Box',
							'enrolled-box'  => 'Enrolled Box',
						),
						'default' => 'enrolment-box',
					)
				);
				
				// enrolment button preview controls end.
		$this->end_controls_section();
	}
	/**
	 * Registering control .
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		$priceselector = '{{WRAPPER}} .woocommerce-Price-amount.amount';
		$cartselector  = '{{WRAPPER}} .tutor-btn-primary';
		// Style.
		$this->start_controls_section(
			'bundle_style_section',
			array(
				'label' => __( 'Price & cart button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'bundle_section_bg_color',
			array(
				'label'     => __( 'Section Background', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tutor-single-course-sidebar .tutor-sidebar-card .tutor-card-body' => 'background-color: {{VALUE}};',
				),
				'default'   => '#fff',
			)
		);
		$this->add_control(
			'bundle_title_color',
			array(
				'label'     => __( 'Price Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$priceselector => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bundle_title_typography',
				'label'    => __( 'Price Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $priceselector,
			)
		);
		$this->add_control(
			'bundle_carttitle_color',
			array(
				'label'     => __( 'Cart Button Text', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cartselector => 'color: {{VALUE}};',
				),
				'default'   => '#fff',
			)
		);
		$this->add_control(
			'bundle_cartbg_color',
			array(
				'label'     => __( 'Cart Button Background', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cartselector => 'background-color: {{VALUE}};',
				),
				'default'   => '#3e64de',
			)
		);
		$this->add_control(
			'bundle_cartborder_color',
			array(
				'label'     => __( 'Cart Button Border', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cartselector => 'border-color: {{VALUE}};',
				),
				'default'   => '#3e64de',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bundle_carttitle_typography',
				'label'    => __( 'Cart Button Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $cartselector,
			)
		);
		
		$this->end_controls_section();
				/**
		 * Enrolment meta info controls
		 *
		 * @since v2.0.0
		 */
		$bundle_enrolment_box_selector = '{{WRAPPER}} .tutor-card-footer';
		$this->start_controls_section(
			'bundle_enrolment_meta_info_section',
			array(
				'label' => __( 'Overview Box', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
			$this->add_control(
				'bundle_enrolment_box_background',
				array(
					'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						$bundle_enrolment_box_selector => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'bundle_enrolment_box_border',
					'selector' => $bundle_enrolment_box_selector,
				)
			);
			$this->add_control(
				'bundle_enrolment_box_border_radius',
				array(
					'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						$bundle_enrolment_box_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'default'    => array(
						'top'      => 6,
						'right'    => 6,
						'bottom'   => 6,
						'left'     => 6,
						'unit'     => 'px',
						'isLinked' => true,
					),
				)
			);

			// icon controls.
			$this->add_control(
				'bundle_enrolmentx_box_icon_size',
				array(
					'label'      => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'min' => 5,
							'max' => 200,
						),
					),
					'selectors'  => array(
						"$bundle_enrolment_box_selector ul li span[class^='tutor-icon-']" => 'font-size: {{SIZE}}{{UNIT}};',
					),
					'default'    => array(
						'size' => 15,
					),
				)
			);

			$this->add_control(
				'bundle_enrolmentx_box_icon_color',
				array(
					'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$bundle_enrolment_box_selector ul li span[class^='tutor-icon-']" => 'color: {{VALUE}};',
					),
					'default'   => '#212327',
				)
			);
			// icon controls end.

			// label controls.
			$this->add_control(
				'bundle_enrolment_meta_label_color',
				array(
					'label'     => __( 'Label Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$bundle_enrolment_box_selector ul li span:nth-child(2)" => 'color: {{VALUE}} !important;',
					),
					'default'   => '#757c8e',
				)
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'     => 'bundle_enrolment_meta_label_typo',
					'label'    => __( 'Label Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$bundle_enrolment_box_selector ul li span:nth-child(2)",
				)
			);
			// label controls end.
			// value controls end.

		$this->end_controls_section();
		 // enrolment meta info controls end.
	}

	/**
	 * Render content
	 *
	 * @return void
	 */
	protected function render() {
		$title  = __( 'Bundle Overview', 'tutor-lms-elementor-addons' );
		$course = etlms_get_bundle();
		if ( $course ) { 
				ob_start();
			$settings = $this->get_settings_for_display();
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				include etlms_get_template( 'course/enrollment-editor' );
			} else {
				include etlms_get_template( 'course/enrollment' );
			}
			$output = ob_get_clean();
			// PHPCS - the variable $output holds safe data.
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
