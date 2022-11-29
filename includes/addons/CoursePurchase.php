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
				/**
		 * Enrolment box control
		 *
		 * @since v2.0.1
		 */
		$this->start_controls_section(
			'course_purchase_enrolment_box_settings',
			array(
				'label' => __( 'Enrolment Box', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'course_purchase_enrolment_box',
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
		$this->end_controls_section();
		// enrolment button preview controls end.
		/**
		 * Course price controls
		 *
		 * @since v2.0.0
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
					'{{WRAPPER}} .tutor-course-sidebar-card-pricing' => 'align-items: {{VALUE}};',
				),
				'left'
			)
		);

		$this->end_controls_section();
		*/
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
					'show' => __( 'Show', 'tutor-lms-elementor-addons' ),
					'hide'  => __( 'Hide', 'tutor-lms-elementor-addons' ),
				),
				'default'   => 'show',
			)
		);

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
				'prefix_class' => 'etlms-enrollment-btn-align-',
				'default'      => 'left',
				'condition'    => array(
					'course_enrolment_edit_mode' => 'enrolled-box',
				),
				'selectors'    => array(
					'{{WRAPPER}}.etlms-enrollment-btn-align-left' => 'text-align: left !important;',
					'{{WRAPPER}}.etlms-enrollment-btn-align-center' => 'text-align: center !important;',
					'{{WRAPPER}}.etlms-enrollment-btn-align-right .tutor-card-body' => 'text-align: right !important;',
					'{{WRAPPER}}.etlms-enrollment-btn-align-center .etlms-course-enroll-date, .etlms-enrollment-btn-align-right .etlms-course-enroll-date' => 'text-align: left !important;',
					'{{WRAPPER}}.etlms-enrollment-btn-align-center .tutor-card-body .tutor-course-progress-wrapper, {{WRAPPER}}.etlms-enrollment-btn-align-right .tutor-card-body .tutor-course-progress-wrapper' => 'text-align: left;'
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
					'{{WRAPPER}}.etlms-enrollment-btn-align-left .tutor-card-body' => 'text-align: left !important;',
					'{{WRAPPER}}.etlms-enrollment-btn-align-center .tutor-card-body' => 'text-align: center !important;',
					'{{WRAPPER}}.etlms-enrollment-btn-align-right .tutor-card-body' => 'text-align: right !important;',
					'{{WRAPPER}}.etlms-enrollment-btn-align-center .etlms-course-enroll-date, .etlms-enrollment-btn-align-right .etlms-course-enroll-date' => 'text-align: left !important;',
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
				'prefix_class' => 'etlms-course-enroll-buttons-size-large-',
				'default'      => 'medium',
				'selectors'	   => array(
					'{{WRAPPER}}.etlms-course-enroll-buttons-size-large .tutor-btn' => 'font-size: 18px; padding: 10px 20px;',
					'.etlms-course-enroll-buttons-size-small .tutor-btn' => 'font-size: 14px; padding: 5px 12px;'
				)
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
				'prefix_class' => 'etlms-course-enroll-buttons-width-',
				'default'      => 'fill',
				'selectors' => array(
					'{{WRAPPER}}.etlms-course-enroll-buttons-width-auto .tutor-btn' => 'width: auto !important; display: inline-flex !important;',
				)
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
					'{{WRAPPER}} button, {{WRAPPER}} .tutor-btn, {{WRAPPER}} .tutor-button, {{WRAPPER}} .start-continue-retake-button, {{WRAPPER}} .edd-add-to-cart.button' => 'width: {{SIZE}}{{UNIT}};',
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
					"$progress_wrapper > h3" => 'color: {{VALUE}};',
				),
				'default'   => '#212327',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_status_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$progress_wrapper > h3",
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
					"$progress_wrapper .list-item-progress .tutor-progress-value" => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'course_status_bar_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$progress_wrapper .list-item-progress .tutor-progress-bar" => 'background-color: {{VALUE}};',
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
					"$progress_wrapper .list-item-progress .tutor-progress-bar" => 'height: {{SIZE}}{{UNIT}};',
					"$progress_wrapper .list-item-progress .tutor-progress-bar .tutor-progress-value" => 'height: 100%;',
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
					"$progress_wrapper .list-item-progress .tutor-progress-bar" => 'border-radius: {{SIZE}}{{UNIT}};',
					"$progress_wrapper .list-item-progress .tutor-progress-bar .tutor-progress-value"   => 'border-radius: {{SIZE}}{{UNIT}};',
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
		// course price controls end.
		$selector = '{{WRAPPER}} .tutor-sidebar-card';
		/* Add to Cart Section */
		$add_to_cart_btn_selector = '{{WRAPPER}} .tutor-enrol-course-form .tutor-enroll-course-button';

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
							$add_to_cart_btn_selector . ', {{WRAPPER}} .edd-submit.button' => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'add_to_cart_btn_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$add_to_cart_btn_selector . ', {{WRAPPER}} .edd-submit.button.white' => 'background-color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'add_to_cart_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector span, {{WRAPPER}} .edd-submit.button",
					)
				);
				$this->add_control(
					'add_to_cart_btn_normal_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$add_to_cart_btn_selector . ', {{WRAPPER}} [type=submit].edd-submit'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'add_to_cart_btn_normal_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $add_to_cart_btn_selector . ', {{WRAPPER}} [type=submit].edd-submit',
					)
				);
				$this->add_control(
					'add_to_cart_btn_normal_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$add_to_cart_btn_selector . ', {{WRAPPER}} [type=submit].edd-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'selector' => $add_to_cart_btn_selector . ', {{WRAPPER}} [type=submit].edd-submit',
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
							"$add_to_cart_btn_selector:hover,  {{WRAPPER}} input.edd-add-to-cart:hover" => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							"$add_to_cart_btn_selector:hover, {{WRAPPER}} .edd-submit.button.white:hover" => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector span:hover, {{WRAPPER}} [type=submit].edd-submit:hover",
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							"$add_to_cart_btn_selector:hover, {{WRAPPER}} [type=submit].edd-submit:hover" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector:hover, {{WRAPPER}} [type=submit].edd-submit:hover",
					)
				);
				$this->add_control(
					'add_to_cart_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							"$add_to_cart_btn_selector:hover, {{WRAPPER}} [type=submit].edd-submit:hover" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'add_to_cart_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => "$add_to_cart_btn_selector:hover, {{WRAPPER}} [type=submit].edd-submit:hover",
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
		$start_btn_selector = '{{WRAPPER}} .tutor-card .start-continue-retake-button';
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
		$complete_btn_selector = '{{WRAPPER}} .tutor-card [name=complete_course_btn]';
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

		// view cart button start.
		$view_cart_btn_selector = '{{WRAPPER}} .tutor-card .tutor-woocommerce-view-cart';
		$this->start_controls_section(
			'view_cart_btn',
			array(
				'label' => __( 'View Cart Button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
		/* Start Tabs */
		$this->start_controls_tabs( 'view_cart_btn_tabs' );

			/* Normal Tab */
			$this->start_controls_tab(
				'view_cart_btn_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'view_cart_btn_normal_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_cart_btn_selector => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'view_cart_btn_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_cart_btn_selector => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'view_cart_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $view_cart_btn_selector,
					)
				);
				$this->add_control(
					'view_cart_btn_normal_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$view_cart_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'view_cart_btn_normal_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $view_cart_btn_selector,
					)
				);
				$this->add_control(
					'view_cart_btn_normal_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$view_cart_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'name'     => 'view_cart_btn_normal_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $view_cart_btn_selector,
					)
				);
			$this->end_controls_tab();

			/* Hover Tab */
			$view_cart_btn_selector_hover = $view_cart_btn_selector . ':hover';
			$this->start_controls_tab(
				'view_cart_btn_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'view_cart_btn_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_cart_btn_selector_hover => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'view_cart_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_cart_btn_selector_hover => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'view_cart_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $view_cart_btn_selector_hover,
					)
				);
				$this->add_control(
					'view_cart_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$view_cart_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'view_cart_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $view_cart_btn_selector_hover,
					)
				);
				$this->add_control(
					'view_cart_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$view_cart_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'view_cart_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $view_cart_btn_selector_hover,
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		// view cart button end.

        // view certificate button start.
		$view_certificate_btn_selector = '{{WRAPPER}} .tutor-card .tutor-btn-view-certificate';
		$this->start_controls_section(
			'view_certificate_btn',
			array(
				'label' => __( 'View Certificate Button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
		/* Start Tabs */
		$this->start_controls_tabs( 'view_certificate_btn_tabs' );

			/* Normal Tab */
			$this->start_controls_tab(
				'view_certificate_btn_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'view_certificate_btn_normal_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_certificate_btn_selector => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'view_certificate_btn_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_certificate_btn_selector => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'view_certificate_btn_normal_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $view_certificate_btn_selector,
					)
				);
				$this->add_control(
					'view_certificate_btn_normal_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$view_certificate_btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'view_certificate_btn_normal_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $view_certificate_btn_selector,
					)
				);
				$this->add_control(
					'view_certificate_btn_normal_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$view_certificate_btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'name'     => 'view_certificate_btn_normal_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $view_certificate_btn_selector,
					)
				);
			$this->end_controls_tab();

			/* Hover Tab */
			$view_certificate_btn_selector_hover = $view_certificate_btn_selector . ':hover';
			$this->start_controls_tab(
				'view_certificate_btn_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'view_certificate_btn_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_certificate_btn_selector_hover => 'color: {{VALUE}} !important;',
						),
					)
				);
				$this->add_control(
					'view_certificate_btn_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$view_certificate_btn_selector_hover => 'background-color: {{VALUE}}',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'view_certificate_btn_hover_typography',
						'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
						'selector' => $view_certificate_btn_selector_hover,
					)
				);
				$this->add_control(
					'view_certificate_btn_hover_padding',
					array(
						'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', 'em' ),
						'selectors'  => array(
							$view_certificate_btn_selector_hover => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'     => 'view_certificate_btn_hover_border',
						'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
						'selector' => $view_certificate_btn_selector_hover,
					)
				);
				$this->add_control(
					'view_certificate_btn_hover_border_radius',
					array(
						'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::DIMENSIONS,
						'selectors' => array(
							$view_certificate_btn_selector_hover => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					array(
						'name'     => 'view_certificate_btn_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
						'selector' => $view_certificate_btn_selector_hover,
					)
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	    // view certificate button end.
		
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
					"$enrolled_info_wrapper .tutor-icon-purchase-mark" => 'color: {{VALUE}};',
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
					"$enrolled_info_wrapper .tutor-icon-purchase-mark" => 'font-size: {{SIZE}}{{UNIT}};',
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
					"$enrolled_info_wrapper .tutor-enrolled-info-text" => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'enrolled_info_label_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$enrolled_info_wrapper .tutor-enrolled-info-text",
			)
		);
		$this->add_control(
			'enrolled_info_date_color',
			array(
				'label'     => __( 'Date Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$enrolled_info_wrapper .tutor-enrolled-info-date" => 'color: {{VALUE}};',
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
		 * Enrolment meta info controls
		 *
		 * @since v2.0.0
		 */
		$enrolment_box_selector = '{{WRAPPER}} .tutor-card';
		$this->start_controls_section(
			'enrolment_meta_info_section',
			array(
				'label' => __( 'Enrolment Box', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				// 'condition' => ['course_enrolment_edit_mode' => 'enrolled_box'],
			)
		);
			$this->add_control(
				'enrolment_content_background',
				array(
					'label'     => __( 'Content Background', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						$enrolment_box_selector . ' .tutor-card-body' => 'background-color: {{VALUE}};',
					),
					'default' 	=> '#F4F6F9',
				)
			);
			$this->add_control(
				'enrolment_meta_info_background',
				array(
					'label'     => __( 'Meta Info Background', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						$enrolment_box_selector . ' .tutor-card-footer' => 'background-color: {{VALUE}};',
					),
					'default' 	=> '#fff',
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
						"$enrolment_box_selector .tutor-card-footer .etlms-enrolled-icon" => 'font-size: {{SIZE}}{{UNIT}};',
					),
					'default'    => array(
						'size' => 15,
					),
				)
			);

			$this->add_control(
				'enrolmentx_box_icon_color',
				array(
					'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						"$enrolment_box_selector .tutor-card-footer .etlms-enrolled-icon" => 'color: {{VALUE}};',
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
						"$enrolment_box_selector .tutor-card-footer .etlms-enrolled-label" => 'color: {{VALUE}};',
					),
					'default'   => '#757c8e',
				)
			);
			$this->add_group_control(
				Typography::get_type(),
				array(
					'name'     => 'enrolment_meta_label_typo',
					'label'    => __( 'Label Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$enrolment_box_selector .tutor-card-footer .etlms-enrolled-label",
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
						"$enrolment_box_selector .tutor-card-footer .etlms-enrolled-label-value, $enrolment_box_selector .tutor-card-footer .etlms-enrolled-label-value .tutor-color-secondary" => 'color: {{VALUE}};',
					),
					'default'   => '#212327',
				)
			);
			$this->add_group_control(
				Typography::get_type(),
				array(
					'name'     => 'enrolment_meta_value_typo',
					'label'    => __( 'Value Typography', 'tutor-lms-elementor-addons' ),
					'selector' => "$enrolment_box_selector .tutor-card-footer .etlms-enrolled-label-value, $enrolment_box_selector .tutor-card-footer .etlms-enrolled-label-value .tutor-color-secondary",
				)
			);
			// value controls end.

		$this->end_controls_section();
		 // enrolment meta info controls end.
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