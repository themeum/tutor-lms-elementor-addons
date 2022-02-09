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
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CoursePurchase extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'etlms-enrollment-btn-align-';

	public function get_title() {
		return __( 'Course Purchase', 'tutor-lms-elementor-addons' );
	}

	protected function register_content_controls() {
		// enrollment button preview controls.
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
		// enrollment button preview controls end.
		/**
		 * Course price controls
		 *
		 * @since v2.0.0
		 */
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
		// course price controls end.

		/**
		 * Course progress controls
		 *
		 * @since v2.0.0
		 */
		$this->start_controls_section(
			'course_status_content_section',
			array(
				'label' => 'Course Progress',
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'course_progress_title_text',
			array(
				'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Course Progress', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows'        => 3,
			)
		);

		$this->add_control(
			'course_status_display_percent',
			array(
				'label'     => __( 'Display Percentage', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'block' => __( 'Show', 'tutor-lms-elementor-addons' ),
					'none'  => __( 'Hide', 'tutor-lms-elementor-addons' ),
				),
				'default'   => 'block',
				'selectors' => array(
					'{{WRAPPER}} .progress-percentage' => 'display: {{VALUE}};',
				),
			)
		);

		// $this->add_control(
		// 'course_status_percent_position',
		// array(
		// 'label'     => __( 'Position', 'tutor-lms-elementor-addons' ),
		// 'type'      => Controls_Manager::SELECT,
		// 'options'   => array(
		// 'inside'  => __( 'Inside', 'tutor-lms-elementor-addons' ),
		// 'outside' => __( 'Outside', 'tutor-lms-elementor-addons' ),
		// 'ontop'   => __( 'On top', 'tutor-lms-elementor-addons' ),
		// ),
		// 'condition' => array(
		// 'course_status_display_percent' => 'show',
		// ),
		// 'default'   => 'inside',
		// )
		// );

		$this->end_controls_section();
		// course progress controls end.

		$this->start_controls_section(
			'course_enroll_button_section',
			array(
				'label' => __( 'Button', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_responsive_control(
			'course_enroll_buttons_align',
			array(
				'label'        => __( 'Alignment', 'tutor-lms-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class' => self::$prefix_class_alignment . '%s',
				'default'      => 'left',
				'condition'    => array(
					'course_enrolment_edit_mode' => 'enrolled-box',

				),
				'selectors'    => array(
					'.etlms-course-enrolment-box.course-enroll-buttons-width-auto .tutor-course-sidebar-card-body:not(.tutor-course-progress-wrapper)' => 'display: flex;
					flex-direction: column;',
					'.etlms-enrollment-btn-align-left .tutor-course-sidebar-card-body:not(.tutor-course-progress-wrapper)' => 'align-items: flex-start;',
					'.etlms-enrollment-btn-align-center .tutor-course-sidebar-card-body:not(.tutor-course-progress-wrapper)' => 'align-items: center;',
					'.etlms-enrollment-btn-align-right .tutor-course-sidebar-card-body:not(.tutor-course-progress-wrapper)' => 'align-items: flex-end;',

					'.etlms-course-enrolment-box.course-enroll-buttons-width-auto form' => 'display: flex; flex-direction: column;',
					'.etlms-enrollment-btn-align-left form ' => 'align-items: flex-start;',
					'.etlms-enrollment-btn-align-right form ' => 'align-items: flex-end;',
					'.etlms-enrollment-btn-align-center form ' => 'align-items: center;',
				),
			)
		);

		$this->add_responsive_control(
			'course_enrolment_buttons_align',
			array(
				'label'        => __( 'Alignment', 'tutor-lms-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class' => self::$prefix_class_alignment . '%s',
				'default'      => 'left',
				'condition'    => array(
					'course_enrolment_edit_mode' => 'enrolment-box',

				),
				'selectors'    => array(
					'.etlms-course-enrolment-box .tutor-course-sidebar-card-body' => 'text-align: {{VALUE}};',
				),
			)
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
					'{{WRAPPER}} button, {{WRAPPER}} .tutor-button, {{WRAPPER}} .start-continue-retake-button' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_controls() {
		/**
		 * Course progress controls
		 *
		 * @since v2.0.0
		 */
		$progress_wrapper = '{{WRAPPER}} .tutor-course-progress-wrapper';

		/* Section Title */
		$this->start_controls_section(
			'course_status_title_section',
			array(
				'label' => __( 'Course Progress Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_status_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .text-medium-h6" => 'color: {{VALUE}};',
				),
				'default'   => '#212327',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_status_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$progress_wrapper .text-medium-h6",
			)
		);
		$this->add_responsive_control(
			'etlms_heading_gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => -50,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => '16',
				),
				'selectors'  => array(
					"$progress_wrapper .list-item-progress" => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/* Section Bar */
		$this->start_controls_section(
			'course_status_bar_section',
			array(
				'label' => __( 'Progress Bar', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_status_bar_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .list-item-progress .progress-bar .progress-value" => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_status_bar_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .list-item-progress .progress-bar" => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_status_progress_bar_height',
			array(
				'label'      => __( 'Height', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 6,
						'max'  => 64,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 4,
					'unit' => 'px',
				),
				'selectors'  => array(
					"$progress_wrapper .list-item-progress .progress-bar" => 'height: {{SIZE}}{{UNIT}};',
					"$progress_wrapper .list-item-progress .progress-bar .progress-value" => 'height: 100%;',
				),
			)
		);

		$this->add_control(
			'course_status_progress_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 2,
					'unit' => 'px',
				),
				'selectors'  => array(
					"$progress_wrapper .list-item-progress .progress-bar" => 'border-radius: {{SIZE}}{{UNIT}};',
					"$progress_wrapper .list-item-progress .progress-bar .progress-value"   => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_status_progress_text',
			array(
				'label' => __( 'Progress Text', 'tutor-lms-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_status_progress_text_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .progress-percentage, $progress_wrapper .progress-steps" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_status_progress_text_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$progress_wrapper .progress-percentage, $progress_wrapper .progress-steps",
			)
		);

		$this->end_controls_section();
		// course progress controls end.
		/**
		 * Course price controls
		 *
		 * @since v2.0.0
		 */
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
		// course price controls end.
		$selector = '{{WRAPPER}} .tutor-course-sidebar-card';
		/* Add to Cart Section */
		$add_to_cart_btn_selector = '{{WRAPPER}} .tutor-btn-primary.tutor-add-to-cart-button';

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
							$add_to_cart_btn_selector => 'background-color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'add_to_cart_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector span",
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
							"$add_to_cart_btn_selector:hover" => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							"$add_to_cart_btn_selector:hover" => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector span:hover",
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							"$add_to_cart_btn_selector:hover" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector:hover",
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							"$add_to_cart_btn_selector:hover" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector:hover",
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* Enroll Button Section */
		$enroll_btn_selector = '{{WRAPPER}} .tutor-course-sidebar-card-body .tutor-enroll-course-button';

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
		$start_btn_selector = '{{WRAPPER}} .tutor-course-sidebar-card-body .start-continue-retake-button';
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
							$start_btn_selector => 'color: {{VALUE}} !important;',
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
							$start_btn_selector_hover => 'color: {{VALUE}} !important;',
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

		/* course complete button controls */
		$complete_btn_selector = '{{WRAPPER}} .tutor-course-sidebar-card-body .tutor-course-complete-button';
		$this->start_controls_section(
			'complete_btn',
			array(
				'label' => __( 'Complete Button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
		/* Start Tabs */
		$this->start_controls_tabs( 'complete_btn_tabs' );

			/* Normal Tab */
			$this->start_controls_tab(
				'complete_btn_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'complete_btn_normal_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$complete_btn_selector => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'complete_btn_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$complete_btn_selector => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'complete_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $complete_btn_selector,
					)
				);
				$this->add_control(
					'complete_btn_normal_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$complete_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'complete_btn_normal_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $complete_btn_selector,
					)
				);
				$this->add_control(
					'complete_btn_normal_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$complete_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'name'     => 'complete_btn_normal_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $complete_btn_selector,
					)
				);
			$this->end_controls_tab();

			/* Hover Tab */
			$complete_btn_selector_hover = $complete_btn_selector . ':hover';
			$this->start_controls_tab(
				'complete_btn_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'complete_btn_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$complete_btn_selector_hover => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'complete_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$complete_btn_selector_hover => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'complete_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $complete_btn_selector_hover,
					)
				);
				$this->add_control(
					'complete_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$complete_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'complete_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $complete_btn_selector_hover,
					)
				);
				$this->add_control(
					'complete_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$complete_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'complete_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $complete_btn_selector_hover,
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		// course complete button end.

		/* Enrolled info */
		$enrolled_info_wrapper = '{{WRAPPER}} .etlms-enrolled-info-wrapper';
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
					"$enrolled_info_wrapper .tutor-icon-purchase-filled" => 'color: {{VALUE}};',
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
					"$enrolled_info_wrapper .tutor-icon-purchase-filled" => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 16,
				),
			)
		);
		$this->add_control(
			'enrolled_info_label_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$enrolled_info_wrapper span.text" => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'enrolled_info_label_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$enrolled_info_wrapper span.text",
			)
		);
		$this->add_control(
			'enrolled_info_date_color',
			array(
				'label'     => __( 'Date Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$enrolled_info_wrapper span.tutor-enrolled-info-date" => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'enrolled_info_date_typo',
				'label'    => __( 'Date Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$enrolled_info_wrapper span.tutor-enrolled-info-date",
			)
		);
		$this->end_controls_section();

		/**
		 * Enrollment meta info controls
		 *
		 * @since v2.0.0
		 */
		$enrolment_box_selector = '{{WRAPPER}} .tutor-course-sidebar-card';
		$this->start_controls_section(
			'enrolment_meta_info_section',
			array(
				'label' => __( 'Enrolment Box', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
			$this->add_control(
				'enrolment_box_background',
				array(
					'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						$enrolment_box_selector => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'enrolment_box_border',
					'selector' => $enrolment_box_selector,
				)
			);
			$this->add_control(
				'enrolment_box_border_radius',
				array(
					'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						$enrolment_box_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'enrolmentx_box_icon_size',
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
						"$enrolment_box_selector .tutor-course-sidebar-card-meta-list .tutor-icon-24" => 'font-size: {{SIZE}}{{UNIT}};',
					),
					'default'    => array(
						'size' => 24,
					),
				)
			);

			$this->add_control(
				'enrolmentx_box_icon_color',
				array(
					'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$enrolment_box_selector .tutor-course-sidebar-card-meta-list .tutor-icon-24" => 'color: {{VALUE}};',
					),
					'default'   => '#212327',
				)
			);
			// icon controls end.

			// label controls.
			$this->add_control(
				'enrolment_meta_label_color',
				array(
					'label'     => __( 'Label Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$enrolment_box_selector .tutor-course-sidebar-card-meta-list .text-regular-caption" => 'color: {{VALUE}};',
					),
					'default'   => '#757c8e',
				)
			);
			$this->add_group_control(
				Typography::get_type(),
				array(
					'name'     => 'enrolment_meta_label_typo',
					'label'    => __( 'Label Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$enrolment_box_selector .tutor-course-sidebar-card-meta-list .text-regular-caption",
				)
			);
			// label controls end.

			// value controls.
			$this->add_control(
				'enrolment_meta_value_color',
				array(
					'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$enrolment_box_selector .tutor-course-sidebar-card-meta-list .text-medium-caption" => 'color: {{VALUE}};',
					),
					'default'   => '#212327',
				)
			);
			$this->add_group_control(
				Typography::get_type(),
				array(
					'name'     => 'enrolment_meta_value_typo',
					'label'    => __( 'Value Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$enrolment_box_selector .tutor-course-sidebar-card-meta-list .text-medium-caption",
				)
			);
			// value controls end.

		$this->end_controls_section();
		 // enrollment meta info controls end.
	}

	protected function render( $instance = array() ) {
		$course = etlms_get_course();
		if ( $course ) {
			ob_start();
			$settings = $this->get_settings_for_display();
			if ( $this->is_elementor_editor() ) {
				include etlms_get_template( 'course/purchase-editor' );
			} else {
				include etlms_get_template( 'course/purchase' );
			}
			$output = ob_get_clean();
			// PHPCS - the variable $output holds safe data.
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
