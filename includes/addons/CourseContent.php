<?php
/**
 * Course Curriculum
 *
 * @since v2.0.0
 *
 * @package  CourseContent
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
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
class CourseContent extends BaseAddon {
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
		return __( 'Course Content', 'tutor-lms-elementor-addons' );
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
		// about course section start.
		$this->start_controls_section(
			'course_about_content_section',
			array(
				'label' => __( 'About Course', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'about_section_title_text',
			array(
				'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'About Course', 'tutor-lms-elementor-addons' ),
				'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
				'rows'        => 3,
			)
		);

		$this->add_responsive_control(
			'course_about_align',
			array(
				'label'        => __( 'Alignment', 'tutor-lms-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'selectors'		=> array(
					'{{WRAPPER}} .tutor-course-details-content' => 'text-align: {{VALUE}};'
				),
				'default'      => 'left',
			)
		);

		$this->end_controls_section();
		// about course section end.

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

			$this->add_responsive_control(
				'course_benefits_alignments_only',
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
					'default'      => 'left',
					'selectors'	=> array(
						'{{WRAPPER}} .etlms-course-specifications.etlms-course-benefits' => 'text-align: {{VALUE}};',
					),
					'toggle'       => false,
				)
			);
		$this->end_controls_section();
		// what i will learn section end.

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

	/**
	 * Addon's style tab controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		$selector                       = '{{WRAPPER}} #tutor-course-details-tab-curriculum';
		$course_topic                   = $selector . ' .tutor-accordion-item';
		$course_topic_title_area        = $course_topic . ' .tutor-accordion-item-header';
		$course_topic_active_title_area = $course_topic . ' .tutor-accordion-item-header.is-active';

		$topic_header       = '{{WRAPPER}} .tutor-accordion-item-header';
		$topic_header_icon  = '{{WRAPPER}} .tutor-accordion-item-header:after';

		// about course style controls.
		$paragraph_selector  = '{{WRAPPER}} .tutor-course-details-content';
		$heading_selector    = '{{WRAPPER}} .tutor-course-details-heading';

		/* Heading Section */
		$this->start_controls_section(
			'course_about_heading_section',
			array(
				'label' => __( 'About Course Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_about_heading_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$heading_selector => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_about_heading_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $heading_selector,
			)
		);

		$this->add_responsive_control(
			'etlms_about_heading_gap',
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
					$heading_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 10,
				),
			)
		);

		$this->end_controls_section();

		// short text controls start.
		$this->start_controls_section(
			'course_about_short_text_section',
			array(
				'label' => __( 'About Course Text', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_about_short_text_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$paragraph_selector => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_about_short_text_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $paragraph_selector,
			)
		);
		$this->end_controls_section();


		// course benefit style controls.
		$course_benefit_selector       = '{{WRAPPER}} .etlms-course-benefits';
		$course_benefit_title_selector = "{{WRAPPER}} .etlms-course-widget-title";
		$course_benefit_list_selector  = '{{WRAPPER}} .etlms-course-widget-list-items';
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
					"$course_benefit_selector .etlms-course-widget-title" => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					$course_benefit_list_selector .' li' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;'
				)
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_benefits_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => $course_benefit_list_selector . ' li',
			)
		);

		$this->add_responsive_control(
			'course_benefits_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$course_benefit_list_selector . ' li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					$course_benefit_list_selector . ' li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					$course_benefit_list_selector . ' li .tutor-list-icon' => 'color: {{VALUE}}'
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
					$course_benefit_list_selector . ' li .tutor-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
					$course_benefit_list_selector . ' li .tutor-list-label' => 'color: {{VALUE}}'
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
					$course_benefit_list_selector . ' li .tutor-list-icon' => 'padding-right: {{SIZE}}{{UNIT}};'
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_benefits_text_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_benefit_list_selector . ' li .tutor-list-label',
			)
		);
		$this->end_controls_section();
		// course benefit style controls end.

		/* Header Title Section */
		$curriculum_header_selector = '{{WRAPPER}} #tutor-course-details-tab-info .tutor-course-content-title';
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
					$curriculum_header_selector => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_topics_header_title_typo',
				'label'    => __( 'Title Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $curriculum_header_selector
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
					$curriculum_header_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => -10,
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
					$topic_header_icon => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 16,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_topics_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $topic_header,
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
							$topic_header_icon => 'color: {{VALUE}};',
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
							$topic_header => 'color: {{VALUE}} !important;',
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
							$topic_header => 'background-color: {{VALUE}};',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'      => 'course_topic_normal_border_type',
						'selector'  => $topic_header,
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
							$topic_header => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .tutor-accordion-item-header.is-active:after' => 'color: {{VALUE}};',
						),
					)
				);

				$this->add_control(
					'course_topic_active_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .tutor-accordion-item-header.is-active' => 'color: {{VALUE}} !important;',
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
							'{WRAPPER}} .tutor-accordion-item-header.is-active' => 'background-color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'      => 'course_topic_active_border_type',
						'selector'  => '{WRAPPER}} .tutor-accordion-item-header.is-active',
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
							'{WRAPPER}} .tutor-accordion-item-header.is-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .tutor-accordion-item-header:hover:after' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_topic_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$topic_header . ':hover' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_topic_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$topic_header . ':hover' => 'background-color: {{VALUE}};',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					array(
						'name'      => 'course_topic_hover_border_type',
						'selector'  => $topic_header . ':hover',
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
							$topic_header . ':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* Course Lesson Section */
		$lesson_content = '{{WRAPPER}} .tutor-course-content-list li.tutor-course-content-list-item';
		$lesson_icon 	= '{{WRAPPER}} .tutor-accordion-item-body-content .tutor-course-content-list-item-icon';
		$lesson_title 	= '{{WRAPPER}} .tutor-accordion-item-body-content .tutor-course-content-list-item-title';
		$lesson_info 	= '{{WRAPPER}} .tutor-course-content-list-item div .tutor-color-muted';

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
					$lesson_icon => 'font-size: {{SIZE}}{{UNIT}};',
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
				'selector' => $lesson_title,
			)
		);

		// title normal/hover tabs.
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
							$lesson_icon => 'color: {{VALUE}};',
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
							$lesson_title => 'color: {{VALUE}} !important;',
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
							$lesson_info => 'color: {{VALUE}} !important;',
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
							$lesson_content => 'background-color: {{VALUE}};',
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
							$lesson_content => 'border-top-width: {{SIZE}}{{UNIT}};',
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
							$lesson_content => 'border-color: {{VALUE}};',
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
							$lesson_icon . ':hover' => 'color: {{VALUE}};',
						),
					)
				);

				$this->add_control(
					'course_lesson_hover_color',
					array(
						'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_title . ':hover' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_lesson_normal_info_hover_text_color',
					array(
						'label'     => __( 'Info Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_info . ':hover' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_lesson_hover_background_color',
					array(
						'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							$lesson_content . ':hover' => 'background-color: {{VALUE}};',
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
							$lesson_content => 'border-top-width: {{SIZE}}{{UNIT}};',
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
							$lesson_content => 'border-color: {{VALUE}};',
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
					$topic_header => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					$lesson_content => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'    => 8,
					'right'  => 16,
					'bottom' => 8,
					'left'   => 16,
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
					'{{WRAPPER}} .tutor-accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
		$review_selector       = '{{WRAPPER}} #tutor-course-details-tab-reviews';
		$review_title_selector = '{{WRAPPER}} #tutor-course-details-tab-reviews h3';

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
					$review_title_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 8,
				),
			)
		);
		$this->end_controls_section();

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
					"$review_selector .tutor-review-summary-average-rating" => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$review_selector .tutor-review-summary-average-rating"
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} .tutor-review-summary .tutor-ratings-stars span"  => 'color: {{VALUE}};',
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
					"{{WRAPPER}} .tutor-review-summary .tutor-ratings-stars span" => 'font-size: {{SIZE}}{{UNIT}};',
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
					"$review_selector .tutor-total-rating-count" => 'color: {{VALUE}}',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_total_label_typo',
				'label'    => __( 'Total Label Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$review_selector .tutor-total-rating-count",
			)
		);

		$this->end_controls_section();

		/* Review average right bar section */
		$review_right_wrapper = "{{WRAPPER}} .tutor-review-summary";

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
					$review_right_wrapper . ' .tutor-progress-bar' => 'background-color: {{VALUE}}',
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
					$review_right_wrapper . ' .tutor-progress-value' => 'background-color: {{VALUE}}',
				),
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
					$review_right_wrapper . ' .tutor-ratings-progress-bar' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
				'default'    => array(
					'size' => 8,
				),
			)
		);

		// right rating star.
		$this->add_control(
			'review_avg_right_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' .tutor-ratings-stars' => 'color: {{VALUE}};',
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
					$review_right_wrapper . ' .tutor-ratings-stars' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 15,
				),
			)
		);

		// right rating star end.

		// right rating star text.
		$this->add_control(
			'review_avg_right_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' .tutor-individual-star-rating' => 'color: {{VALUE}};',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'review_avg_right_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_right_wrapper . ' .tutor-individual-star-rating',
			)
		);
		// right rating star text end.

		$this->end_controls_section();
		/* Review list section */
		$review_list_section_selector = '{{WRAPPER}}' . ' .tutor-reviews.tutor-card-list';
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
					$review_list_section_selector . ' .tutor-avatar' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}}/2)',
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
				'selector' => $review_list_section_selector . ' .tutor-avatar',
			)
		);

		$this->add_control(
			'course_reviews_avatar_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$review_list_section_selector . ' .tutor-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					$review_list_section_selector . ' .tutor-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'selectors'  => array(
					$review_list_section_selector . ' .tutor-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tutor-reviewer-name a' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#212327',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_name_typo',
				'label'    => __( 'Name Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-reviewer-name a',
			)
		);
		$this->add_control(
			'reviewer_time_color',
			array(
				'label'     => __( 'Time Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-reviewed-on' => 'color: {{VALUE}};',
				),
				'default'   => '#757C8E',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_time_typo',
				'label'    => __( 'Time Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_list_section_selector . ' .tutor-reviewed-on',
			)
		);
		$this->add_control(
			'reviewer_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-card-list-item .tutor-ratings-stars span' => 'color: {{VALUE}};',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'reviewer_rating_color',
			array(
				'label'     => __( 'Rating Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . '.tutor-review-comment' => 'color: {{VALUE}} !important;',
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
				'selectors' => array(
					'{{WRAPPER}} .tutor-card-list-item .tutor-ratings-stars span' => 'font-size: {{SIZE}}{{UNIT}};',
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
				'selector' => $review_list_section_selector . ' .tutor-review-comment'
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
			include etlms_get_template( 'course/content' );
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