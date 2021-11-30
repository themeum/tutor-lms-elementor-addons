<?php
/**
 * Course EnrolmentBox
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CourseEnrolmentBox extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Course Enrolment Box', 'tutor-lms-elementor-addons' );
	}

	protected function register_content_controls() {
		// Slider Button stle
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
		$this->end_controls_section();

		$this->start_controls_section(
			'course_enroll_button_section',
			array(
				'label' => __( 'Button', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_responsive_control(
			'course_enroll_buttons_align',
			//$this->etlms_alignment( 'center' ) // alignment
			$this->title_alignment_with_selectors( '{{WRAPPER}}', 'text-align: {{VALUE}};' )
		);

		$this->add_control(
			'course_enroll_buttons_size',
			array(
				'label'        => __( 'Size', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'small'  => __( 'Small', 'tutor-lms-elementor-addons' ),
					'medium' => __( 'Medium', 'tutor-lms-elementor-addons' ),
					'large'  => __( 'Large', 'tutor-lms-elementor-addons' ),
				),
				'prefix_class' => 'course-enroll-buttons-size-',
				'default'      => 'medium',
			)
		);

		$this->add_control(
			'course_enroll_buttons_width',
			array(
				'label'        => __( 'Width', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'auto'  => __( 'Auto', 'tutor-lms-elementor-addons' ),
					'fill'  => __( 'Fill', 'tutor-lms-elementor-addons' ),
					'fixed' => __( 'Fixed', 'tutor-lms-elementor-addons' ),
				),
				'prefix_class' => 'course-enroll-buttons-width-',
				'default'      => 'fill',
			)
		);

		$this->add_responsive_control(
			'course_enroll_buttons_fixed_width',
			array(
				'label'      => __( 'Fixed Width', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 50,
						'max' => 400,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 160,
				),
				'condition'  => array(
					'course_enroll_buttons_width' => 'fixed',
				),
				'selectors'  => array(
					'{{WRAPPER}} button, {{WRAPPER}} .tutor-button' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$selector = '{{WRAPPER}} .tutor-course-sidebar-card';
		/* Add to Cart Section */
		$add_to_cart_btn_selector  = $selector . ' .tutor-btn:not(.tutor-is-outline).tutor-btn-primary.tutor-add-to-cart-button';

		$this->start_controls_section(
			'add_to_cart_btn',
			array(
				'label' => __( 'Add to Cart Button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolment_box'],
			)
		);
		/* Start Tabs */
		$this->start_controls_tabs( 'add_to_cart_btn_tabs' );
			/* Normal Tab */
			$this->start_controls_tab(
				'add_to_cart_btn_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'add_to_cart_btn_normal_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$add_to_cart_btn_selector => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_control(
					'add_to_cart_btn_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$add_to_cart_btn_selector => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'add_to_cart_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => '{{WRAPPER}} .tutor-add-to-cart-button span',
					)
				);
				$this->add_control(
					'add_to_cart_btn_normal_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$add_to_cart_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'add_to_cart_btn_normal_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $add_to_cart_btn_selector,
					)
				);
				$this->add_control(
					'add_to_cart_btn_normal_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$add_to_cart_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'default'   => array(
							'top'      => 3,
							'right'    => 3,
							'bottom'   => 3,
							'left'     => 3,
							'unit'     => 'px',
							'isLinked' => true,
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'add_to_cart_btn_normal_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $add_to_cart_btn_selector,
					)
				);
			$this->end_controls_tab();

			/* Hover Tab */
			$add_to_cart_btn_selector_hover = $add_to_cart_btn_selector . ':hover';
			$this->start_controls_tab(
				'add_to_cart_btn_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'add_to_cart_btn_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$add_to_cart_btn_selector_hover => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$add_to_cart_btn_selector_hover => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $add_to_cart_btn_selector_hover,
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$add_to_cart_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $add_to_cart_btn_selector_hover,
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$add_to_cart_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $add_to_cart_btn_selector_hover,
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* Enroll Button Section */
		$enroll_btn_selector = $selector . '.tutor-course-sidebar-card .tutor-btn.tutor-is-outline.tutor-enroll-course-button';

		$this->start_controls_section(
			'enroll_btn',
			array(
				'label' => __( 'Enroll Button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolment_box'],
			)
		);
		/* Start Tabs */
		$this->start_controls_tabs( 'enroll_btn_tabs' );

			/* Normal Tab */
			$this->start_controls_tab(
				'enroll_btn_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'enroll_btn_normal_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$enroll_btn_selector => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'enroll_btn_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$enroll_btn_selector => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'enroll_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => '{{WRAPPER}} .tutor-btn.tutor-btn-lg.tutor-enroll-course-button',
					)
				);
				$this->add_control(
					'enroll_btn_normal_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$enroll_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'enroll_btn_normal_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $enroll_btn_selector,
					)
				);
				$this->add_control(
					'enroll_btn_normal_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$enroll_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'default'   => array(
							'top'      => 3,
							'right'    => 3,
							'bottom'   => 3,
							'left'     => 3,
							'unit'     => 'px',
							'isLinked' => true,
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'enroll_btn_normal_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $enroll_btn_selector,
					)
				);
			$this->end_controls_tab();

			/* Hover Tab */
			$enroll_btn_selector_hover = $enroll_btn_selector . ':hover';
			$this->start_controls_tab(
				'enroll_btn_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'enroll_btn_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$enroll_btn_selector_hover => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'enroll_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$enroll_btn_selector_hover => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'enroll_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $enroll_btn_selector_hover,
					)
				);
				$this->add_control(
					'enroll_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$enroll_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'enroll_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $enroll_btn_selector_hover,
					)
				);
				$this->add_control(
					'enroll_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$enroll_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'enroll_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $enroll_btn_selector_hover,
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* Start, Continue, Retake button section */
		$start_btn_selector = '{{WRAPPER}} .tutor-btn.tutor-is-outline.start-continue-retake-button';
		$this->start_controls_section(
			'start_btn',
			array(
				'label' => __( 'Start/Continue/Retake Button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
		/* Start Tabs */
		$this->start_controls_tabs( 'start_btn_tabs' );

			/* Normal Tab */
			$this->start_controls_tab(
				'start_btn_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'start_btn_normal_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .tutor-btn.tutor-is-outline.start-continue-retake-button' => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'start_btn_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$start_btn_selector => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'start_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $start_btn_selector,
					)
				);
				$this->add_control(
					'start_btn_normal_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$start_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'start_btn_normal_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $start_btn_selector,
					)
				);
				$this->add_control(
					'start_btn_normal_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$start_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'default'   => array(
							'top'      => 3,
							'right'    => 3,
							'bottom'   => 3,
							'left'     => 3,
							'unit'     => 'px',
							'isLinked' => true,
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'start_btn_normal_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $start_btn_selector,
					)
				);
			$this->end_controls_tab();

			/* Hover Tab */
			$start_btn_selector_hover = $start_btn_selector . ':hover';
			$this->start_controls_tab(
				'start_btn_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'start_btn_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .tutor-btn.tutor-is-outline.start-continue-retake-button:hover' => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'start_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$start_btn_selector_hover => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'start_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $start_btn_selector_hover,
					)
				);
				$this->add_control(
					'start_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$start_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'start_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $start_btn_selector_hover,
					)
				);
				$this->add_control(
					'start_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$start_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'start_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $start_btn_selector_hover,
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* Enrolled info */
		$enrolled_info_selector      = '{{WRAPPER}} .text-regular-caption';
		$enrolled_info_icon_selector = $enrolled_info_selector . ' span.ttr-purchase-filled';
		$enrolled_info_date_selector = $enrolled_info_selector . ' span';
		$this->start_controls_section(
			'enrolled_info_section',
			array(
				'label' => __( 'Enrolled Info', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
		$this->add_control(
			'enrolled_info_icon_color',
			array(
				'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$enrolled_info_icon_selector => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'enrolled_info_icon_size',
			array(
				'label'      => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 6,
						'max' => 100,
					),
				),
				'selectors'  => array(
					$enrolled_info_icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 16,
				),
			)
		);
		$this->add_control(
			'enrolled_info_label_color',
			array(
				'label'     => __( 'Label Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$enrolled_info_selector => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'enrolled_info_label_typo',
				'label'    => __( 'Label Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $enrolled_info_selector,
			)
		);
		$this->add_control(
			'enrolled_info_date_color',
			array(
				'label'     => __( 'Date Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$enrolled_info_date_selector => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'enrolled_info_date_typo',
				'label'    => __( 'Date Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $enrolled_info_date_selector,
			)
		);
		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		$course = etlms_get_course();
		if ( $course ) {
			ob_start();
			$settings = $this->get_settings_for_display();
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				include etlms_get_template( 'course/enrollment-editor' );
			} else {
				include tutor()->path . 'templates/single/course/course-entry-box.php';
			}
			echo ob_get_clean();
		}
	}
}
