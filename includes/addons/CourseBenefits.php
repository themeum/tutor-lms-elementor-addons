<?php
/**
 * Course Benefits
 *
 * @since 1.0.0
 *
 * @package CourseBenefits
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Register controls for content and styles tab
 */
class CourseBenefits extends BaseAddon {

	/**
	 * Traits for layout and alignment controls
	 */
	use \TutorLMS\Elementor\AddonsTrait;

	/**
	 * Alignment prefix class
	 *
	 * @var string
	 */
	private static $prefix_class_alignment = 'elementor-align-';

	/**
	 * Title of this addon
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Course Benefits', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Register content tab controls
	 *
	 * @return void
	 */
	protected function register_content_controls() {
		$this->start_controls_section(
			'what_i_will_learn_section',
			array(
				'label' => __( 'Course Benefits', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'what_i_will_learn_title',
				array(
					'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
					'type'        => Controls_Manager::TEXTAREA,
					'default'     => __( 'What I will learn?', 'tutor-lms-elementor-addons' ),
					'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
					'rows'        => 3,
				)
			);
			$this->add_responsive_control(
				'course_benefits_layout',
				array(
					'label'     => __( 'Layout', 'tutor-lms-elementor-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => array(
						'list-item'  => array(
							'title' => __( 'List', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-list-ul',
						),
						'inline' => array(
							'title' => __( 'Inline', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-ellipsis-h',
						),
					),
					'default'   => 'list-item',
					'prefix_class'	=> 'etlms-course-benefits-display-',
					'selectors' => array(
						'{{WRAPPER}} .etlms-course-benefits ul.etlms-course-specification-items li'  => 'display: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'course_benefits_list_icon',
				array(
					'label'   => __( 'List Icon', 'tutor-lms-elementor-addons' ),
					'type'    => Controls_Manager::ICONS,
					'default' => array(
						'value'   => 'fas fa-check',
						'library' => 'solid',
					),
				)
			);
			$benefits_alignment = $this->etlms_alignment();
			unset( $benefits_alignment['prefix'] );
			$benefits_alignment['selectors'] = array(
				'.etlms-course-benefits' => 'text-align: {{VALUE}};',
			);
			$this->add_responsive_control(
				'course_benefits_alignments',
				$benefits_alignment,
			);
		$this->end_controls_section();
	}

	/**
	 * Style tab controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		// course benefit style controls.
		$course_benefit_selector       = '{{WRAPPER}} .etlms-course-benefits';
		$course_benefit_title_selector = "$course_benefit_selector .tutor-course-details-widget-title .tutor-color-text-primary";
		/* Title Section */
		$this->start_controls_section(
			'course_benefits_title_section',
			array(
				'label' => __( 'Course Benefit Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_benefits_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$course_benefit_title_selector => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_benefits_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_benefit_title_selector,
			)
		);
		$this->add_responsive_control(
			'course_benefit_etlms_heading_gap',
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
				'selectors'  => array(
					"$course_benefit_selector .tutor-course-details-widget-title" => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 15,
				),
			)
		);
		$this->end_controls_section();

		/* List  Section */
		$this->start_controls_section(
			'course_benefits_list_section',
			array(
				'label' => __( 'Course Benefit List', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'course_benefits_space_between',
			array(
				'label'      => __( 'Space Between', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}}.etlms-course-benefits-display-list-item ul.etlms-course-specification-items li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.etlms-course-benefits-display-inline ul.etlms-course-specification-items li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 15,
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_benefits_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => "$course_benefit_selector .etlms-course-specification-items li",
			)
		);
		$this->add_responsive_control(
			'course_benefits_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					"$course_benefit_selector .etlms-course-specification-items li" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'course_benefits_list_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"$course_benefit_selector .etlms-course-specification-items li" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		 /* Icon  Section */
		$this->start_controls_section(
			'course_benefits_icon_section',
			array(
				'label' => __( 'Course Benefit Icon', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_benefits_icon_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$course_benefit_selector .etlms-course-specification-items li i" => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'course_benefits_icon_size',
			array(
				'label'      => __( 'Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 100,
					),
				),
				'selectors'  => array(
					"$course_benefit_selector .etlms-course-specification-items li i" => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 16,
				),
			)
		);
		$this->end_controls_section();

		/* Text  Section */
		$this->start_controls_section(
			'course_benefits_text_section',
			array(
				'label' => __( 'Course Benefit Text', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_benefits_text_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$course_benefit_selector .etlms-course-specification-items li span" => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'course_benefits_text_indent',
			array(
				'label'      => __( 'Text Indent', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					"$course_benefit_selector .etlms-course-specification-items li span" => 'padding-left: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 7,
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_benefits_text_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$course_benefit_selector .etlms-course-specification-items li span",
			)
		);
		$this->end_controls_section();
		// course benefit style controls end.
	}

	/**
	 * Render output data
	 *
	 * @param array $instance | instance of addons.
	 *
	 * @return void
	 */
	protected function render( $instance = array() ) {
		$disable_option = ! (bool) get_tutor_option( 'enable_course_benefits' );
		if ( $disable_option ) {
			if ( $this->is_elementor_editor() ) {
				esc_html_e( 'Please enable course benefits from tutor settings', 'tutor-lms-elementor-addons' );
			}
			return;
		}

		$course   = etlms_get_course();
		$benefits = tutor_course_benefits();
		if ( $course && is_array( $benefits ) && count( $benefits ) ) {
			ob_start();
			$settings = $this->get_settings_for_display();
			include etlms_get_template( 'course/benefits' );
			$output = apply_filters( 'tutor_course/single/benefits_html', ob_get_clean() );
			// PHPCS - the variable $output holds safe data.
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			$op = '';
			if ( $this->is_elementor_editor() ) {
				$op = __( 'Please add Course Benefits from Tutor course builder', 'tutor-lms-elementor-addons' );
			}
			echo esc_html( $op );
		}
	}
}
