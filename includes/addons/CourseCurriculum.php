<?php
/**
 * Course Curriculum
 *
 * @since v2.0.0
 *
 * @package  CourseCurriculum
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Course Content class
 *
 * Hold multiple addons controls. Course info, about the instructor, reviews, course curriculum
 *
 * @since v2.0.0
 */
class CourseCurriculum extends BaseAddon {
	/**
	 * Trait for reuse method
	 */
	use \TutorLMS\Elementor\AddonsTrait;

	/**
	 * Layout prefix class
	 *
	 * @var string
	 */
	private static $prefix_class_layout = 'elementor-layout-';

	/**
	 * Alignment prefix class
	 *
	 * @var string
	 */
	private static $prefix_class_alignment = 'elementor-align-';

	/**
	 * Curriculum Title
	 *
	 * @var string
	 */
	protected $topic_title;

	/**
	 * Addon's title, that will be visible on elementor editor
	 * panel.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Course Curriculum', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Dependent fonts
	 *
	 * @return array, contains font that need to load
	 */
	public function get_style_depends() {
		return array(
			'font-awesome-5-all',
			'font-awesome-4-shim',
		);
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

	/**
	 * Register controls for content tab
	 *
	 * @return void
	 */
	protected function register_content_controls() {
		// course curriculum section.
		$this->start_controls_section(
			'reviews_curriculum_section',
			array(
				'label' => __( 'Curriculum', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'section_title_text',
				array(
					'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
					'type'        => Controls_Manager::TEXTAREA,
					'default'     => __( 'Course Curriculum', 'tutor-lms-elementor-addons' ),
					'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
					'rows'        => 3,
					'separator'   => 'after',
				)
			);
		$this->end_controls_section();
	}

	/**
	 * Addon's style tab controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		$selector                       = '{{WRAPPER}} .etlms-course-curriculum';
		$topic_header                   = $selector . ' .tutor-course-topics-header';
		$course_topic                   = $selector . ' .tutor-accordion-item';
		$course_topic_title_area        = $course_topic . ' .tutor-accordion-item-header';
		$course_topic_active_title_area = $course_topic . ' .tutor-accordion-item-header.is-active';
		$topic_icon                     = $course_topic . '::after';

		/* Header Title Section */
		$this->start_controls_section(
			'course_topics_header_section',
			array(
				'label' => __( 'Curriculum Header', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_topics_header_title_color',
			array(
				'label'     => __( 'Title Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .etlms-course-curriculum .tutor-course-topics-header .tutor-color-text-primary' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_topics_header_title_typo',
				'label'    => __( 'Title Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $topic_header . ' div.text-medium-h6 span',
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
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					$topic_header => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 20,
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();

		/* Course Topics Section */
		$this->start_controls_section(
			'course_topics_title_section',
			array(
				'label' => __( 'Topic', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_curriculum_topic_icon_size',
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
					'{{WRAPPER}} .etlms-course-curriculum .tutor-accordion-item-header:after' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 32,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_topics_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .etlms-course-curriculum .tutor-accordion-item-header',
			)
		);

		// Text indent.
		$this->add_control(
			'course_topics_title_indent',
			array(
				'label'      => __( 'Text Indent', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .etlms-course-curriculum .tutor-accordion-item-header:after' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 5,
				),
			)
		);

		// title normal/hover tabs
		// * Start Tabs */
		$this->start_controls_tabs( 'course_topic_style_tabs' );
			/* Normal Tab */
			$this->start_controls_tab(
				'course_topic_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'course_curriculum_topic_icon_normal_color',
					array(
						'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-accordion-item-header:after' => 'color: {{VALUE}};',
						),
						'default'   => '#3e64de',
					)
				);

				$this->add_control(
					'course_topic_normal_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$course_topic_title_area => 'color: {{VALUE}} !important;',
						),
						'default'   => '#41454f',
					)
				);

				$this->add_control(
					'course_topic_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$course_topic_title_area => 'background-color: {{VALUE}};',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'      => 'course_topic_normal_border_type',
						'selector'  => $course_topic,
						'separator' => 'before',
					)
				);

				$this->add_control(
					'course_topic_normal_border_radius',
					array(
						'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							$course_topic => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'default'    => array(
							'top'      => 5,
							'right'    => 5,
							'bottom'   => 5,
							'left'     => 5,
							'unit'     => 'px',
							'isLinked' => true,
						),
					)
				);

			$this->end_controls_tab();

			/* Active Tab */
			$this->start_controls_tab(
				'course_topic_active_style_tab',
				array(
					'label' => __( 'Active', 'tutor-lms-elementor-addons' ),
				)
			);
				$this->add_control(
					'course_curriculum_topic_icon_active_color',
					array(
						'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-accordion-item-header.is-active:after' => 'color: {{VALUE}};',
						),
					)
				);

				$this->add_control(
					'course_topic_active_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$course_topic_active_title_area => 'color: {{VALUE}} !important;',
						),
						'default'   => '#175CFF',
					)
				);

				$this->add_control(
					'course_topic_active_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$course_topic_active_title_area => 'background-color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'      => 'course_topic_active_border_type',
						'selector'  => $selector . ' .tutor-accordion-item-header.is-active ',
						'separator' => 'before',
					)
				);

				$this->add_control(
					'course_topic_active_border_radius',
					array(
						'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							$selector . ' .tutor-accordion-item-header.is-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
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
					'course_curriculum_topic_icon_hover_color',
					array(
						'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-accordion-item-header:hover:after' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_topic_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$course_topic_title_area . ':hover' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_topic_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$course_topic_title_area . ':hover' => 'background-color: {{VALUE}};',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'      => 'course_topic_hover_border_type',

						'selector'  => $course_topic . ':hover',
						'separator' => 'before',
					)
				);

				$this->add_control(
					'course_topic_hover_border_radius',
					array(
						'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							$course_topic . ':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* Course Lesson Section */
		$lesson_selector = $selector . ' .tutor-accordion-item-body-content';

		$this->start_controls_section(
			'course_lesson_section',
			array(
				'label' => __( 'Lesson', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_curriculum_lesson_icon_size',
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
					$lesson_selector . ' .tutor-courses-lession-list span::before' => 'font-size: {{SIZE}}{{UNIT}};',
					$lesson_selector . ' .zoom-icon img' => 'width: calc({{SIZE}}{{UNIT}} + 2px);',
				),
				'default'    => array(
					'size' => 18,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_lesson_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .etlms-course-curriculum .lesson-preview-title',
			)
		);

		// title normal/hover tabs
		// * Start Tabs */
		$this->start_controls_tabs( 'course_lesson_style_tabs' );
			/* Normal Tab */
			$this->start_controls_tab(
				'course_lesson_normal_style_tab',
				array(
					'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
				)
			);

				$this->add_control(
					'course_curriculum_lesson_icon_normal_color',
					array(
						'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_selector . ' .tutor-courses-lession-list span.tutor-icon-24' => 'color: {{VALUE}};',
						),
						'default'   => '#939AA3',
					)
				);

				$this->add_control(
					'course_lesson_normal_text_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_selector . ' span.text-regular-body a' => 'color: {{VALUE}} !important;',
						),
						'default'   => '#161616',
					)
				);

				$this->add_control(
					'course_lesson_normal_info_text_color',
					array(
						'label'     => __( 'Info Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li .tutor-color-text-hints' => 'color: {{VALUE}} !important;',
						),
						'default'   => '#757c8e',
					)
				);

				$this->add_control(
					'course_lesson_normal_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_selector => 'background-color: {{VALUE}};',
						),
						'separator' => 'after',
					)
				);

				$this->add_control(
					'course_lesson_normal_border_width',
					array(
						'label'      => __( 'Border Width', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => array( 'px' ),
						'range'      => array(
							'px' => array(
								'min' => 0,
								'max' => 10,
							),
						),
						'selectors'  => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li' => 'border-top-width: {{SIZE}}{{UNIT}};',
						),
						'default'    => array(
							'size' => 1,
						),
					)
				);

				$this->add_control(
					'course_lesson_normal_border_color',
					array(
						'label'     => __( 'Border Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li' => 'border-color: {{VALUE}};',
						),
						'default'   => '#E1EBF0',
					)
				);

			$this->end_controls_tab();

			/* Hovered lesson */
			$this->start_controls_tab(
				'course_lesson_hover_style_tab',
				array(
					'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
				)
			);

				$this->add_control(
					'course_curriculum_lesson_icon_hover_color',
					array(
						'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_selector . ' .tutor-courses-lession-list span.tutor-icon-24:hover' => 'color: {{VALUE}};',
						),
					)
				);

				$this->add_control(
					'course_lesson_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_selector . ' span.text-regular-body a:hover' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_lesson_normal_info_hover_text_color',
					array(
						'label'     => __( 'Info Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li .tutor-color-text-hints:hover' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_lesson_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_selector . ':hover' => 'background-color: {{VALUE}};',
						),
						'separator' => 'after',
					)
				);

				$this->add_control(
					'course_lesson_normal_border_hover_width',
					array(
						'label'      => __( 'Border Width', 'tutor-lms-elementor-addons' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => array( 'px' ),
						'range'      => array(
							'px' => array(
								'min' => 0,
								'max' => 10,
							),
						),
						'selectors'  => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li:hover' => 'border-top-width: {{SIZE}}{{UNIT}};',
						),
						'default'    => array(
							'size' => 1,
						),
					)
				);

				$this->add_control(
					'course_lesson_normal_border_hover_color',
					array(
						'label'     => __( 'Border Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li:hover' => 'border-color: {{VALUE}};',
						),
					)
				);

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Spacing */
		$this->start_controls_section(
			'topic_lesson_spacing_section',
			array(
				'label' => __( 'Spacing', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'topic_title_padding',
			array(
				'label'      => __( 'Topic Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					$course_topic_title_area => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'    => 15,
					'right'  => 20,
					'bottom' => 15,
					'left'   => 20,
					'unit'   => 'px',
				),
			)
		);

		$this->add_responsive_control(
			'lesson_title_padding',
			array(
				'label'      => __( 'Lesson Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					$lesson_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'    => 0,
					'right'  => 10,
					'bottom' => 0,
					'left'   => 10,
					'unit'   => 'px',
				),
			)
		);

		$this->add_control(
			'course_curriculum_topic_space',
			array(
				'label'      => __( 'Space Between Topic', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 50,
					),
				),
				'selectors'  => array(
					$course_topic . ':not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 20,
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget
	 *
	 * @param array $instance | widget instance.
	 */
	protected function render( $instance = array() ) {
		$settings          = $this->get_settings_for_display();
		$this->topic_title = $settings['section_title_text'];
		// Filter course topic title.
		if ( '' !== $this->topic_title ) {
			add_filter(
				'tutor_course_topics_title',
				array( $this, 'filter_topics_title' )
			);
		}
		ob_start();
		$course = etlms_get_course();
		if ( $course ) {
			include etlms_get_template( 'course/curriculum' );
			$output = ob_get_clean();
			// PHPCS - the variable $title_html holds safe data.
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Filter topics title
	 */
	public function filter_topics_title() {
		return $this->topic_title;
	}
}
