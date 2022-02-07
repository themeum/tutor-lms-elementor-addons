<?php
/**
 * Course Benefits
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CourseBenefits extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Course Benefits', 'tutor-lms-elementor-addons' );
	}

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
						'block'  => array(
							'title' => __( 'List', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-list-ul',
						),
						'inline' => array(
							'title' => __( 'Inline', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-ellipsis-h',
						),
					),
					'default'   => 'inline',
					'selectors' => array(
						'{{WRAPPER}} .etlms-course-specification-items li'  => 'display: {{VALUE}};',
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

	protected function register_style_controls() {
		$selector       = '.etlms-course-specifications.etlms-course-benefits';
		$title_selector = $selector . ' h3';
		$list_selector  = $selector . ' .etlms-course-specification-items li';
		$icon_selector  = $list_selector . ' i';
		$text_selector  = $list_selector . ' span';

		/* Title Section */
		$this->start_controls_section(
			'course_benefits_title_section',
			array(
				'label' => __( 'Section Title', 'tutor-lms-elementor-addons' ),
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
			'etlms_heading_gap',
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
				'selectors'  => array(
					$title_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'label' => __( 'List', 'tutor-lms-elementor-addons' ),
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
					'.etlms-author-specifications-list ' . $list_selector . ':not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'.etlms-author-specifications-inline ' . $list_selector . ':not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
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
				'selector' => $list_selector,
			)
		);
		$this->add_responsive_control(
			'course_benefits_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$list_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					$list_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		 /* Icon  Section */
		$this->start_controls_section(
			'course_benefits_icon_section',
			array(
				'label' => __( 'Icon', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_benefits_icon_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$icon_selector => 'color: {{VALUE}}',
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
					$icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
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
				'label' => __( 'Text', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_benefits_text_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$text_selector => 'color: {{VALUE}}',
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
					$text_selector => 'padding-left: {{SIZE}}{{UNIT}};',
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
				'selector' => $text_selector,
			)
		);
		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		$disable_option = (bool) get_tutor_option( 'disable_course_benefits' );
		if ( $disable_option ) {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				echo __( 'Please enable course benefits from tutor settings', 'tutor-lms-elementor-addons' );
			}
			return;
		}
		$course = etlms_get_course();
		if ( $course ) {
			ob_start();
			$settings = $this->get_settings_for_display();
			include etlms_get_template( 'course/benefits' );
			$output = apply_filters( 'tutor_course/single/benefits_html', ob_get_clean() );
			echo $output;
		}
	}
}
