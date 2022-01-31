<?php
/**
 * Course Curriculum
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CourseCurriculum extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	protected $topic_title;

	public function get_title() {
		return __( 'Course Curriculum', 'tutor-lms-elementor-addons' );
	}

	public function get_style_depends() {
		return array(
			'font-awesome-5-all',
			'font-awesome-4-shim',
		);
	}

	public function get_script_depends() {
		return array(
			'etlms-course-topics',
		);
	}

	protected function register_content_controls() {
		// what i will learn section.
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
					'label'        => __( 'Layout', 'tutor-lms-elementor-addons' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => array(
						'block'   => array(
							'title' => __( 'List', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-list-ul',
						),
						'inline' => array(
							'title' => __( 'Inline', 'tutor-lms-elementor-addons' ),
							'icon'  => 'fa fa-ellipsis-h',
						),
					),
					'default'      => 'inline',
					'selectors'		=> array(
						'{{WRAPPER}} .etlms-course-specification-items li'	=> 'display: {{VALUE}};'
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
				'.etlms-course-benefits' => 'text-align: {{VALUE}};'
			);
			$this->add_responsive_control(
				'course_benefits_alignments',
				$benefits_alignment,
			);
		$this->end_controls_section();
		// what i will learn section end.

		// about the instructor section.
		$this->start_controls_section(
			'instructor_section',
			array(
				'label' => __( 'About the Instructor', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'about_the_instructors_title',
				array(
					'label'       => __( 'About the Instructors Title', 'tutor-lms-elementor-addons' ),
					'type'        => Controls_Manager::TEXTAREA,
					'default'     => __( 'About the instructors', 'tutor-lms-elementor-addons' ),
					'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
					'rows'        => 3,
					'separator'   => 'after',
				)
			);
			$this->add_control(
				'course_instructor_profile',
				array(
					'label'        => __( 'Profile Picture', 'tutor-lms-elementor-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'separator'    => 'after',
					'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
					'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

			$this->add_control(
				'course_instructor_name',
				array(
					'label'        => __( 'Display Name', 'tutor-lms-elementor-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
					'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

			$this->add_control(
				'course_instructor_designation',
				array(
					'label'        => __( 'Designation', 'tutor-lms-elementor-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
					'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				)
			);

			// link.
			$this->add_control(
				'course_instructor_link',
				array(
					'label'       => __( 'Link', 'tutor-lms-elementor-addons' ),
					'type'        => Controls_Manager::SELECT,
					'description' => __( 'Link for the Author Name and Image', 'tutor-lms-elementor-addons' ),
					'options'     => array(
						'none'        => 'None',
						'new_window'  => 'New Window',
						'same_window' => 'Same Window',
					),

					'default'     => 'new_window',
				)
			);

			$this->add_responsive_control(
				'course_author_layout',
				$this->etlms_layout( 'up' ) // default layout up.
			);
		$this->end_controls_section();
		// about the instructor section end.

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
		// course curriculum section end.

		// reviews section.
		$this->start_controls_section(
			'reviews_section',
			array(
				'label' => __( 'Reviews', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'reviews_title',
				array(
					'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
					'type'        => Controls_Manager::TEXTAREA,
					'default'     => __( 'Student Ratings & Reviews', 'tutor-lms-elementor-addons' ),
					'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
					'rows'        => 3,
				)
			);
		$this->end_controls_section();
		// reviews section end.
	}

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
					$topic_header . ' .text-medium-h6.color-text-primary' => 'color: {{VALUE}} !important;',
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
					$topic_icon => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 18,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_topics_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_topic_title_area,
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
					$topic_icon => 'margin-left: {{SIZE}}{{UNIT}};',
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
							$topic_icon => 'color: {{VALUE}};',
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
							$selector . ' .tutor-accordion-item-header.is-active::after' => 'color: {{VALUE}};',
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
							$topic_icon . ':hover' => 'color: {{VALUE}} !important;',
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
				'selector' => $lesson_selector . '.text-regular-body a',
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
							$lesson_selector . ' span.color-text-hints' => 'color: {{VALUE}} !important;',
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
							$lesson_selector => 'border-top-width: {{SIZE}}{{UNIT}};',
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
							$lesson_selector => 'border-color: {{VALUE}};',
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
							$lesson_selector . ' span.color-text-hints:hover' => 'color: {{VALUE}} !important;',
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
							$lesson_selector . ':hover' => 'border-top-width: {{SIZE}}{{UNIT}};',
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
							$lesson_selector . ':hover' => 'border-color: {{VALUE}};',
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
					'top'    => 15,
					'right'  => 20,
					'bottom' => 15,
					'left'   => 20,
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

		/**
		 * Merge reviews style controls
		 */
		$review_selector       = '{{WRAPPER}} .tutor-ratingsreviews';
		$review_title_selector = '{{WRAPPER}} .tutor-course-topics-header-left .text-primary span';

		/* Title Section */
		$this->start_controls_section(
			'course_reviews_title_section',
			array(
				'label' => __( 'Review Section Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_reviews_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_title_selector => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_title_selector,
			)
		);
		$this->add_responsive_control(
			'etlms_review_title_gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => -10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tutor-course-topics-header-left' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 8,
				),
			)
		);
		$this->end_controls_section();

		/* Review average section */
		$review_avg_section_selector     = $review_selector . ' .tutor-ratingsreviews-ratings-avg';
		$review_avg_text_selector        = $review_avg_section_selector . ' .tutor-rating-text-part';
		$review_avg_stars_selector       = $review_avg_section_selector . ' .tutor-rating-stars span';
		$review_avg_total_count_selector = $review_avg_section_selector . ' .tutor-rating-count-part';
		$this->start_controls_section(
			'course_rating_avg',
			array(
				'label' => __( 'Review Avg', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_avg_text_selector => 'color: {{VALUE}}',
				),
				'default'   => '#161616',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_avg_text_selector,
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_avg_stars_selector => 'color: {{VALUE}}',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_stars_size',
			array(
				'label'      => __( 'Stars Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 64,
					),
				),
				'selectors'  => array(
					$review_avg_stars_selector => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 18,
				),
			)
		);

		$this->add_control(
			'course_reviews_avg_rating_total_label_color',
			array(
				'label'     => __( 'Total Label Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_avg_total_count_selector => 'color: {{VALUE}}',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_total_label_typo',
				'label'    => __( 'Total Label Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_avg_total_count_selector,
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_total_count_color',
			array(
				'label'     => __( 'Total Count Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_avg_section_selector . ' .text-medium-h1.color-text-primary' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_total_count_typo',
				'label'    => __( 'Total Count Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_avg_section_selector . ' .text-medium-h1.color-text-primary',
			)
		);
		$this->end_controls_section();

		/* Review average right bar section */
		$review_right_wrapper = '{{WRAPPER}} .tutor-ratingsreviews-ratings-all';

		$this->start_controls_section(
			'review_avg_right_bar_main',
			array(
				'label' => __( 'Right Rating Bar', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'review_avg_right_bar_main_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' div.progress-bar' => 'background-color: {{VALUE}}',
				),
				'default'   => '#e3e5eb',
			)
		);
		$this->add_control(
			'review_avg_right_bar_main_fill_color',
			array(
				'label'     => __( 'Fill Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' div.progress-bar .progress-value' => 'background-color: {{VALUE}}',
				),
				'default'   => '#ed9700',
			)
		);
		$this->add_control(
			'review_avg_right_bar_main_width',
			array(
				'label'      => __( 'Height', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$review_right_wrapper . ' div.progress-bar' => 'height: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 8,
				),
			)
		);

		// right rating star
		$this->add_control(
			'review_avg_right_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' .tutor-rating-stars span.ttr-star-line-filled' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'review_avg_right_stars_size',
			array(
				'label'      => __( 'Star Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 64,
					),
				),
				'selectors'  => array(
					$review_right_wrapper . '.tutor-rating-stars span' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 14,
				),
			)
		);

		// right rating star end

		// right rating star text
		$this->add_control(
			'review_avg_right_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' .rating-num.text-regular-caption' => 'color: {{VALUE}};',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'review_avg_right_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_right_wrapper . ' .rating-num.text-regular-caption',
			)
		);
		// right rating star text end.

		$this->end_controls_section();
		/* Review list section */
		$review_list_section_selector = '{{WRAPPER}}' . ' .tutor-ratingsreviews-reviews';
		$this->start_controls_section(
			'review_list',
			array(
				'label' => __( 'Review list', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'review_list_image_width',
			array(
				'label'      => __( 'Image Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 20,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$review_list_section_selector . ' img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}}/2)',
				),
				'default'    => array(
					'size' => 50,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_instructor_img_border',
				'selector' => $review_list_section_selector . ' img',
			)
		);

		$this->add_control(
			'course_instructors_avatar_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .etlms-course-instructor-avatar img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .etlms-course-instructor-avatar span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'selectors'  => array(
					$review_list_section_selector . ' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'      => 50,
					'right'    => 50,
					'bottom'   => 50,
					'left'     => 50,
					'unit'     => '%',
					'isLinked' => true,
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'reviewer_name_color',
			array(
				'label'     => __( 'Name Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . '.tutor-reviewer-name' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#212327',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_name_typo',
				'label'    => __( 'Name Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} a.tutor-reviewer-name',
			)
		);
		$this->add_control(
			'reviewer_time_color',
			array(
				'label'     => __( 'Time Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-review-time' => 'color: {{VALUE}};',
				),
				'default'   => '#757C8E',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_time_typo',
				'label'    => __( 'Time Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_list_section_selector . ' .tutor-review-time',
			)
		);
		$this->add_control(
			'reviewer_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-rating-stars span' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'reviewer_stars_size',
			array(
				'label'      => __( 'Stars Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 64,
					),
				),
				'selectors'  => array(
					$review_list_section_selector . ' .tutor-rating-stars span' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 14,
				),
			)
		);
		$this->add_control(
			'reviewer_content_color',
			array(
				'label'     => __( 'Comment Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-review-comment' => 'color: {{VALUE}}',
				),
				'default'   => '#5B616F',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_content_typo',
				'label'    => __( 'Comment Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_list_section_selector . ' .tutor-review-comment',
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
		if ( '' !== $settings['reviews_title'] ) {
			add_filter(
				'tutor_course_reviews_section_title',
				function() use ( $settings ) {
					return esc_html( $settings['reviews_title'] );
				}
			);
		}
		ob_start();
		$course = etlms_get_course();
		if ( $course ) {
			include etlms_get_template( 'course/course-topics' );
			echo ob_get_clean();
		}
	}

	/**
	 * Filter topics title
	 */
	public function filter_topics_title() {
		return $this->topic_title;
	}
}
