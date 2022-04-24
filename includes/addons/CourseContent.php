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
					'{{WRAPPER}} .etlms-course-about.etlms-course-summary' => 'text-align: {{VALUE}};'
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
					'prefix_class'	=> 'etlms-course-content-benefits-display-',
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
			// $benefits_alignment = $this->etlms_alignment();
			// unset( $benefits_alignment['prefix'] );
			// $benefits_alignment['selectors'] = array(
			// 	'{{WRAPPER}} .etlms-course-specifications.etlms-course-benefits' => 'text-align: {{VALUE}};',
			// );
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
			$this->add_control(
				'course_instructor_bio',
				array(
					'label'        => __( 'Bio', 'tutor-lms-elementor-addons' ),
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

		// about course style controls.
		$paragraph_selector  = '{{WRAPPER}} .showmore-text';
		$short_text_selector = '{{WRAPPER}} .showmore-short-text';
		$heading_selector    = '{{WRAPPER}} .tutor-showmore-content .text-medium-h6';

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
				'label' => __( 'About Course Short Text', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_about_short_text_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$short_text_selector => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_about_short_text_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $short_text_selector,
			)
		);
		$this->end_controls_section();
		// short text controls end.
		/* Paragraph  Section */
		$this->start_controls_section(
			'course_about_paragraph_section',
			array(
				'label' => __( 'About Course Full Text', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_about_paragraph_color',
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
				'name'     => 'course_about_paragraph_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $paragraph_selector,
			)
		);
		$this->end_controls_section();
		// about course style controls end.

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
					'.etlms-course-content-benefits-display-list-item ul.etlms-course-specification-items li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'.etlms-course-content-benefits-display-inline ul.etlms-course-specification-items li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 10,
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

		// course instructors style controls.
		$course_instructor_wrap_selector = '{{WRAPPER}} .etlms-single-instructor-wrap';
		/* Title Section */
		$this->start_controls_section(
			'course_instructors_title_section',
			array(
				'label' => __( 'Course Instructor Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_instructors_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$course_instructor_wrap_selector .etlms-course-instructor-title" => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructors_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$course_instructor_wrap_selector .etlms-course-instructor-title",
			)
		);
		$this->add_responsive_control(
			'etlms_instructor_heading_gap',
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
					"$course_instructor_wrap_selector .etlms-course-instructor-title" => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
				'default'    => array(
					'size' => 25,
				),
			)
		);
		$this->end_controls_section();

		/* Instructor Section */
		$course_instructor_wrap                 = '{{WRAPPER}} .etlms-single-instructor-wrap';
		$course_instructor_img_selector         = $course_instructor_wrap . ' .instructor-avatar a';
		$course_instructor_name_selector        = $course_instructor_wrap . ' .instructor-name h3 a';
		$course_instructor_designation_selector = $course_instructor_wrap . ' .instructor-name p';
		$course_instructor_biography_selector   = $course_instructor_wrap . ' .instructor-bio';

		$this->start_controls_section(
			'course_instructor_section',
			array(
				'label' => __( 'Instructor Section', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_instructor_image_size',
			array(
				'label'      => __( 'Image Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$course_instructor_img_selector . ' span, ' . $course_instructor_img_selector . ' img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}}/2 - 3px)',
				),
				'default'    => array(
					'size' => 48,
				),
			)
		);

		// $this->add_group_control(
		// Group_Control_Background::get_type(),
		// array(
		// 'name'     => 'course_instructor_background',
		// 'label'    => __( 'Background Type', 'tutor-lms-elementor-addons' ),
		// 'types'    => array( 'classic', 'gradient' ),
		// 'selector' => $course_instructor_img_selector . ' span',
		// )
		// );

		// $this->add_group_control(
		// Group_Control_Border::get_type(),
		// array(
		// 'name'     => 'course_instructor_img_border',
		// 'selector' => $course_instructor_img_selector . ' span, ' . $course_instructor_img_selector . ' img',
		// )
		// );

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
					$course_instructor_img_selector . ' span, ' . $course_instructor_img_selector . ' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'course_instructor_name_color',
			array(
				'label'     => __( 'Name Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$course_instructor_name_selector => 'color: {{VALUE}}',
				),
				'default'   => '#161616',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_name_typo',
				'label'    => __( 'Name Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_instructor_name_selector,
			)
		);
		$this->add_control(
			'course_instructor_designation_color',
			array(
				'label'     => __( 'Designation Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$course_instructor_designation_selector => 'color: {{VALUE}}',
				),
				'default'   => '#7A7A7A',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_designation_typo',
				'label'    => __( 'Designation Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_instructor_designation_selector,
			)
		);

		$this->add_control(
			'course_instructor_bio_color',
			array(
				'label'     => __( 'Biography Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .instructor-bio span, {{WRAPPER}} .instructor-bio p, {{WRAPPER}} .instructor-bio b, {{WRAPPER}} .instructor-bio span strong, {{WRAPPER}} .instructor-bio p strong' => 'color: {{VALUE}}',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_bio_typo',
				'label'    => __( 'Biography Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_instructor_biography_selector,
			)
		);

		$this->end_controls_section();

		/* Instructor Rating Section */
		$course_instructor_wrap          = '{{WRAPPER}} .etlms-single-instructor-wrap';
		$course_instructor_info_selector = $course_instructor_wrap . ' .single-instructor-bottom';
		$ins_rating_star_selector        = $course_instructor_wrap . ' .tutor-rating-stars span';

		/* Bottom Info Section */
		$this->start_controls_section(
			'course_instructor_bottom_info_section',
			array(
				'label' => __( 'Instructor Bottom Info', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_instructor_rating_color',
			array(
				'label'     => __( 'Rating Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$ins_rating_star_selector => 'color: {{VALUE}};',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'course_instructor_rating_size',
			array(
				'label'      => __( 'Rating Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 64,
					),
				),
				'selectors'  => array(
					"$course_instructor_wrap .tutor-ratings .tutor-rating-stars span" => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 18,
				),
			)
		);

		$this->add_control(
			'course_instructor_label_color',
			array(
				'label'     => __( 'Label Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$course_instructor_wrap .tutor-ins-meta-item .tutor-color-text-subsued" => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_label_typography',
				'label'    => __( 'Label Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$course_instructor_wrap .tutor-ins-meta-item .tutor-color-text-subsued",
				'scheme'   => Typography::TYPOGRAPHY_1,
			)
		);
		$this->add_control(
			'course_instructor_value_color',
			array(
				'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"$course_instructor_wrap .tutor-ins-meta-item .tutor-color-text-primary"
					=> 'color: {{VALUE}} !important;',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_instructor_value_typography',
				'label'    => __( 'Value Typography', 'tutor-lms-elementor-addons' ),
				'selector' => "$course_instructor_wrap .tutor-ins-meta-item .tutor-color-text-primary",
			)
		);
		$this->add_control(
			'course_instructor_bottom_info_icon_size',
			array(
				'label'      => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 64,
					),
				),
				'selectors'  => array(
					"$course_instructor_wrap .tutor-ins-meta-item .tutor-icon-user-filled, $course_instructor_wrap .tutor-ins-meta-item .tutor-icon-mortarboard-line" => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 18,
				),
			)
		);
		$this->end_controls_section();

		// spacing section
		$this->start_controls_section(
			'course_instructors_space_section',
			array(
				'label' => __( 'Instructor Spacing', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_instructors_padding',
			array(
				'label'      => __( 'Instructor Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					$course_instructor_wrap . ' .single-instructor-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'default'    => array(
					'top'      => 20,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'separator'  => 'before',
			)
		);
		$this->add_control(
			'course_instructors_bottom_padding',
			array(
				'label'      => __( 'Bottom Info Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"$course_instructor_wrap .tutor-instructor-info-card-footer" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'      => 15,
					'right'    => 20,
					'bottom'   => 15,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'separator'  => 'before',
			)
		);

		$this->add_control(
			'course_instructor_bottom_space',
			array(
				'label'      => __( 'Space Between', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'selectors'  => array(
					"$course_instructor_wrap .tutor-instructor-info-card-footer" => 'margin-top: {{SIZE}}{{UNIT}};',
					"$course_instructor_wrap .single-instructor-wrap .single-instructor-top" => 'border: none;',
				),
				'default'    => array(
					'size' => 20,
				),
			)
		);

		$this->end_controls_section();
		// course instructors style controls end.

		/* Header Title Section */
		$curriculum_header_selector = '{{WRAPPER}} .etlms-course-curriculum #tutor-course-details-tab-curriculum h3';
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
					'{{WRAPPER}} .etlms-course-curriculum .tutor-accordion-item-header' => 'padding-left: {{SIZE}}{{UNIT}};',
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
							$lesson_selector . ' .lesson-preview-title' => 'color: {{VALUE}} !important;',
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
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li .tutor-color-muted' => 'color: {{VALUE}} !important;',
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
							$lesson_selector . ' .lesson-preview-title:hover' => 'color: {{VALUE}} !important;',
						),
					)
				);

				$this->add_control(
					'course_lesson_normal_info_hover_text_color',
					array(
						'label'     => __( 'Info Text Color', 'tutor-lms-elementor-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .etlms-course-curriculum .tutor-courses-lession-list li .tutor-color-muted:hover' => 'color: {{VALUE}} !important;',
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

		/**
		 * Merge reviews style controls
		 */
		$review_selector       = '{{WRAPPER}} .tutor-ratingsreviews';
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

		/* Review average section */
		// $review_avg_section_selector     = $review_selector . ' .tutor-ratingsreviews-ratings-avg';
		// $review_avg_text_selector        = $review_avg_section_selector . ' .tutor-rating-text-part';
		// $review_avg_stars_selector       = $review_avg_section_selector . ' .tutor-rating-stars span';
		// $review_avg_total_count_selector = $review_avg_section_selector . ' .tutor-rating-count-part';
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
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg > div' => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .text-medium-h1',
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-stars span' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-stars span' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-text-part' => 'color: {{VALUE}}',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_total_label_typo',
				'label'    => __( 'Total Label Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-text-part',
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_total_count_color',
			array(
				'label'     => __( 'Total Count Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-count-part' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_total_count_typo',
				'label'    => __( 'Total Count Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-count-part',
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

		// right rating star.
		$this->add_control(
			'review_avg_right_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .rating-progress .tutor-ratings .tutor-rating-stars span' => 'color: {{VALUE}} !important;',
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
					'{{WRAPPER}} .rating-progress .tutor-ratings .tutor-rating-stars span' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				),
				'default'    => array(
					'size' => 18,
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
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-all .rating-numbers .rating-num' => 'color: {{VALUE}};',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'review_avg_right_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-all .rating-numbers .rating-num',
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
			'course_reviews_avatar_border_radius',
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
			'reviewer_rating_color',
			array(
				'label'     => __( 'Rating Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-ratings .tutor-rating-text' => 'color: {{VALUE}} !important;',
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
