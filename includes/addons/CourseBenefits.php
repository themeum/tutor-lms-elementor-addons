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
						'flex'  => array(
							'title' => __( 'List', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-list-ul',
						),
						'inline' => array(
							'title' => __( 'Inline', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-ellipsis-h',
						),
					),
					'default'   => 'flex',
					'prefix_class'	=> 'etlms-course-content-benefits-display-',
					'selectors' => array(
						'{{WRAPPER}} .tutor-course-details-widget-col-2 ul'  => 'display: {{VALUE}} !important;',
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

			// Alignment
			$this->add_responsive_control(
				'course_benefits_alignments',
				array(
					'label'     => __( 'Alignment', 'tutor-lms-elementor-addons' ),
					'type'      => \Elementor\Controls_Manager::CHOOSE,
					'options'   => array(
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
					'default'   => 'flex-start',
					'selectors' => array(
						'{{WRAPPER}}.etlms-course-benefits-display-list-item' => 'text-align: {{VALUE}};',
					),
				)
			);

		$this->end_controls_section();
	}

	/**
	 * Style tab controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		$title_selector = '{{WRAPPER}} .etlms-course-widget-title';
		$list_selector  = '{{WRAPPER}} .etlms-course-widget-list-items';

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
					$title_selector => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_benefits_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $title_selector,
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
					$title_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
				)
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
					$list_selector . ' li:not(last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				)
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_benefits_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => $list_selector . ' li',
			)
		);

		$this->add_responsive_control(
			'course_benefits_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$list_selector . ' li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					$list_selector . ' li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					$list_selector . ' li .tutor-list-icon' => 'color: {{VALUE}}'
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
					$list_selector . ' li .tutor-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
					$list_selector . ' li .tutor-list-label' => 'color: {{VALUE}}'
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
					$list_selector . ' li .tutor-list-icon' => 'margin-right: {{SIZE}}{{UNIT}};'
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_benefits_text_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $list_selector . ' li .tutor-list-label',
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Render output data
	 *
	 * @param array $instance | instance of addons.
	 *
	 * @return void
	 */
	protected function render( $instance = array() ) {
		$is_enabled = (bool) get_tutor_option( 'enable_course_benefits' );
		$is_editor  = \Elementor\Plugin::instance()->editor->is_edit_mode();
		if ( ! $is_enabled && $is_editor ) {
			esc_html_e( 'Please enable course benefits from tutor settings', 'tutor-lms-elementor-addons' );
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