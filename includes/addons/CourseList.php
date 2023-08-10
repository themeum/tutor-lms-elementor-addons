<?php

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CourseList extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'enroll-button-align-';

	public function get_title() {
		return __( 'Course List', 'tutor-lms-elementor-addons' );
	}

	public function get_script_depends() {
		return array(
			'etlms-enroll-button',
		);
	}

	protected function register_content_controls() {
		$content_selector = '{{WRAPPER}} .etlms-course-list-main-wrap ';

		$meta_content_selector = $content_selector . '.tutor-meta';
		$this->start_controls_section(
			'course_list_content_section',
			array(
				'label' => __( 'Layout', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'course_list_skin',
			array(
				'label'   => __( 'Skin', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => array(
					'classic'   => __( 'Classic', 'tutor-lms-elementor-addons' ),
					'card'      => __( 'Card', 'tutor-lms-elementor-addons' ),
					'stacked'   => __( 'Stacked', 'tutor-lms-elementor-addons' ),
					'overlayed' => __( 'Overlayed', 'tutor-lms-elementor-addons' ),
				),

			)
		);

		$this->add_control(
			'course_list_column',
			array(
				'label'   => __( 'Columns', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => array(
					'1' => __( '1', 'tutor-lms-elementor-addons' ),
					'2' => __( '2', 'tutor-lms-elementor-addons' ),
					'3' => __( '3', 'tutor-lms-elementor-addons' ),
					'4' => __( '4', 'tutor-lms-elementor-addons' ),
				),
			)
		);

		$this->add_control(
			'course_list_perpage',
			array(
				'label'   => __( 'Course Per Page', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 6,
			)
		);

		$this->add_control(
			'card_hover_animation',
			array(
				'label'        => __( 'Hover Animation', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'No', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',

				'default'      => 'yes',
			)
		);
		$this->add_control(
			'course_list_image',
			array(
				'label'        => __( 'Show Image', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_list_masonry',
			array(
				'label'        => __( 'Masonry', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'No', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'course_list_image_size', // Actually its `image_size`.
				'label'     => __( 'Image Size', 'tutor-lms-elementor-addons' ),
				'default'   => 'medium_large',
				'condition' => array(
					'course_list_image' => 'yes',
				),
			)
		);

		$this->add_control(
			'course_list_meta_data',
			array(
				'label'        => __( 'Meta Data', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'course_list_meta_space',
			array(
				'label'      => __( 'Space Between' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 16,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_meta_data' => 'yes',
				),
				'selectors'  => array(
					$meta_content_selector => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);
		
		$this->add_control(
			'course_list_meta_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'course_list_rating_settings',
			array(
				'label'        => __( 'Rating', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_list_avatar_settings',
			array(
				'label'        => __( 'Avatar', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_list_author_settings',
			array(
				'label'        => __( 'Author', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_list_difficulty_settings',
			array(
				'label'        => __( 'Difficulty Level', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'condition' => array(
					'course_list_skin!' => 'overlayed'
				),
			)
		);

		$this->add_control(
			'course_list_category_settings',
			array(
				'label'        => __( 'Category', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes'
			)
		);

		$this->add_control(
			'course_list_wishlist_settings',
			array(
				'label'        => __( 'Wishlist', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => array(
					'course_list_skin!' => 'overlayed'
				),
			)
		);

		$this->add_control(
			'course_list_footer_settings',
			array(
				'label'        => __( 'Footer', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_list_pagination_settings',
			array(
				'label'        => __( 'Pagination', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		// Query section
		$this->start_controls_section(
			'course_list_query_section',
			array(
				'label' => __( 'Query', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$course_categories = etlms_course_categories();
		$course_authors    = etlms_course_authors();

		/* Start Tabs */
		$this->start_controls_tabs( 'course_list_query_tabs' );

			/* Include Tab */
			$this->start_controls_tab(
				'course_list_query_tab_include',
				array(
					'label' => __( 'Include', 'tutor-lms-elementor-addons' ),
				)
			);

			$this->add_control(
				'course_list_include_by_categories',
				array(
					'label'    => __( 'Categories', 'tutor-lms-elementor-addons' ),
					'type'     => Controls_Manager::SELECT2,
					'multiple' => true,
					'options'  => $course_categories,
					'default'  => array(),
				)
			);

			$this->add_control(
				'course_list_include_by_authors',
				array(
					'label'    => __( 'Authors', 'tutor-lms-elementor-addons' ),
					'type'     => Controls_Manager::SELECT2,
					'multiple' => true,
					'options'  => $course_authors,
					'default'  => array(),
				)
			);

			$this->end_controls_tab();

			/* Exclude Tab */
			$this->start_controls_tab(
				'course_list_query_tab_exclude',
				array(
					'label' => __( 'Exclude', 'tutor-lms-elementor-addons' ),
				)
			);

			$this->add_control(
				'course_list_exclude_by_categories',
				array(
					'label'    => __( 'Categories', 'tutor-lms-elementor-addons' ),
					'type'     => Controls_Manager::SELECT2,
					'multiple' => true,
					'options'  => $course_categories,
					'default'  => array(),
				)
			);

			$this->add_control(
				'course_list_exclude_by_authors',
				array(
					'label'    => __( 'Authors', 'tutor-lms-elementor-addons' ),
					'type'     => Controls_Manager::SELECT2,
					'multiple' => true,
					'options'  => $course_authors,
					'default'  => array(),
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		/* End Tabs */

		$this->add_control(
			'course_list_order_by',
			array(
				'label'   => __( 'Order By', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'post_date'  => __( 'Date', 'tutor-lms-elementor-addons' ),
					'post_title' => __( 'Title', 'tutor-lms-elementor-addons' ),
				),
				'default' => 'post_date',
			)
		);

		$this->add_control(
			'course_list_order',
			array(
				'label'   => __( 'Order', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'asc'  => __( 'ASC', 'tutor-lms-elementor-addons' ),
					'desc' => __( 'DESC', 'tutor-lms-elementor-addons' ),
				),
				'default' => 'desc',
			)
		);

		$this->end_controls_section();

		// pagination section
		$this->start_controls_section(
			'course_list_pagination_content_section',
			array(
				'label' => __( 'Pagination', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'course_list_pagination_type',
			array(
				'label'   => __( 'Pagination', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'prev_next',

				'options' => array(
					'prev_next'        => __( 'Previous/Next', 'tutor-lms-elementor-addons' ),
					'number_prev_next' => __( 'Numbers + Previous/Next', 'tutor-lms-elementor-addons' ),
					'numbers'          => __( 'Numbers', 'tutor-lms-elementor-addons' ),
				),
			)
		);

		$this->add_control(
			'course_list_pagination_page_limit',
			array(
				'label'   => __( 'Page Limit', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 20,
				'step'    => 1,
				'default' => 5,
			)
		);

		$this->add_control(
			'course_list_pagination_previous_label',
			array(
				'label'   => __( 'Previous Label', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '&laquo; Previous', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_list_pagination_next_label',
			array(
				'label'   => __( 'Next Label', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Next &raquo;', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_list_pagination_alignment',
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

				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .etlms-pagination' => 'justify-content:{{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_controls() {

		$wrapper 					= '{{WRAPPER}} .etlms-course-list-main-wrap ';
		$card 					   	= $wrapper . '.tutor-course-card';

		$footer_separator 			= $wrapper . '.tutor-loop-course-footer';
		$badge            			= $wrapper . '.tutor-course-difficulty-level';

		$avatar           		   	= $card . ' .tutor-avatar';
		$course_title     			= $card . ' .tutor-course-name';
		$meta             			= $card . ' .etlms-course-duration-meta';
		$author         			= $card . ' .etlms-course-author-meta';
		$category         			= $card . ' .etlms-course-category-meta';
		$ratings             		= $card . ' .tutor-ratings';
		$footer           			= $card . ' .tutor-card-footer';
		$price            			= $card . ' .tutor-course-price';
		$cart_button      			= $card . ' .tutor-card-footer .tutor-btn-outline-primary';
		$row_selector              	= $wrapper . '.tutor-course-list';
		$column_selector           	= $wrapper . '.etlms-course-list-col';
		$pagination_selector       	= $wrapper . '.etlms-course-list-pagination-wrap';
		/*
		@card selector change as per skin style
		*/

		$this->start_controls_section(
			'course_list_layout_style',
			array(
				'label' => __( 'Layout' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_list_columns_gap',
			array(
				'label'     => __( 'Columns Gap', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_unit' => array( 'px' ),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 32,
				),
				'condition' => array(
					'course_list_masonry!' => 'yes',
				),
				'selectors' => array(
					$row_selector => 'column-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'course_list_columns_gap_masonry',
			array(
				'label'     => __( 'Columns Gap', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_unit' => array( 'px' ),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition' => array(
					'course_list_masonry' => 'yes',
				),
				'selectors' => array(
					$column_selector => 'padding: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_list_rows_gap',
			array(
				'label'     => __( 'Rows Gap', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'size_unit' => array( 'px' ),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 32,
				),

				'selectors' => array(
					$row_selector => 'row-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_list_cols_alignment',
			array(
				'label'     => __( 'Alignment', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
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
				'selectors' => array(
					$wrapper . '.tutor-courses' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'course_list_style_section',
			array(
				'label' => __( 'Card', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_list_card_background_color',
			array(
				'label'      => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'course_list_skin',
							'operator' => 'in',
							'value'    => array( 'classic', 'card' ),
						),
					),
				),
				'selectors'  => array(
					$card => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_list_stacked_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'course_list_skin' => 'stacked',

				),
				'selectors' => array(
					$card . ' .etlms-course-card-inner' => 'background-color: {{VALUE}};',
				),
			)
		);

		// border tabs
		$this->start_controls_tabs( 'course_list_card_border_tabs' );

		// normal tab start
		$this->start_controls_tab(
			'course_list_card_normal_tab',
			array(
				'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'course_list_card_border',
				'label'     => __( 'Border', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin!' => 'stacked',
				),
				'selector'  => $card,
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'course_list_stacked_border',
				'label'     => __( 'Border', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin' => 'stacked',
				),
				'selector'  => $card . ' .etlms-course-card-inner',
			)
		);

		$this->add_control(
			'course_list_card_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 8,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_skin' => array( 'classic', 'card' ),

				),
				'selectors'  => array(
					$card => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_control(
			'course_list_stacked_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 10,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_skin' => 'stacked',

				),
				'selectors'  => array(
					$card . ' .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);

		$this->add_control(
			'course_list_overlayed_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 20,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_skin' => 'overlayed',

				),
				'selectors'  => array(
					$card . ' .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'carousel_card_box_shadow_control',
				'label'     => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin!' => 'stacked',
				),
				'selector'  => $card,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'carousel_stacked_box_shadow_control',
				'label'     => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin' => 'stacked',
				),
				'selector'  => $card . ' .etlms-course-card-inner',
			)
		);

		$this->end_controls_tab();
		// normal tab end

		// hover tab start
		$this->start_controls_tab(
			'course_list_card_hover_tab_alt',
			array(
				'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'course_list_card_hover_border',
				'label'     => __( 'Border', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin!' => 'stacked',
				),
				'selector'  => $card . ':hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'course_list_stacked_hover_border',
				'label'     => __( 'Border', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin' => 'stacked',
				),
				'selector'  => $card . ':hover .etlms-course-card-inner',
			)
		);

		$this->add_control(
			'course_list_card_hover_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 8,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_skin' => array( 'classic', 'card' ),

				),
				'selectors'  => array(
					$card . ':hover' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_control(
			'course_list_stacked_hover_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 10,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_skin' => 'stacked',

				),
				'selectors'  => array(
					$card . ':hover .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_control(
			'course_list_overlayed_hover_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 20,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_skin' => 'overlayed',

				),
				'selectors'  => array(
					$card . ':hover .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'carousel_card_hover_box_shadow_control',
				'label'     => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin!' => 'stacked',
				),
				'selector'  => $card . ':hover',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'carousel_stacked_hover_box_shadow_control',
				'label'     => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin' => 'stacked',
				),
				'selector'  => $card . ':hover .etlms-course-card-inner',
			)
		);

		$this->end_controls_tab();
		// hover tab end

		$this->end_controls_tabs();
		// border tabs end

		$this->add_control(
			'course_list_card_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$card . ' .tutor-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		/* Start Tabs */
		$this->start_controls_tabs( 'course_list_card_tabs' );
		/* Normal Tab */
		$this->start_controls_tab(
			'course_list_card_normal_tab_alt',
			array(
				'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_footer_separator_color',
			array(
				'label'     => __( 'Footer Separator Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$card . ' .tutor-card-footer' => 'border-top-color : {{VALUE}};',
				)
			)
		);

		$this->add_control(
			'course_list_footer_width',
			array(
				'label'      => __( 'Footer Separator Width', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,

					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),

				'selectors'  => array(
					$card . ' .tutor-card-footer' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		/* Hovered Tab */
		$this->start_controls_tab(
			'course_list_card_hover_tab',
			array(
				'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'course_box_hover_shadow',
			array(
				'label'        => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'No', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'conditions'   => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'course_list_skin',
							'operator' => 'in',
							'value'    => array( 'card', 'stacked' ),
						),
					),
				),
				'default'      => 'yes',

			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'carousel_card_box_shadow_hover',
				'label'     => __( 'Shadow Control', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin' => 'card',
				),
				'selector'  => $wrapper . '.etlms-card:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'carousel_stacked_box_shadow_hover',
				'label'     => __( 'Shadow Control', 'tutor-lms-elementor-addons' ),
				'condition' => array(
					'course_list_skin' => 'stacked',
				),
				'selector'  => $wrapper . '.etlms-card:hover .etlms-carousel-course-container',
			)
		);

		$this->add_control(
			'course_footer_separator_hover_color',
			array(
				'label'     => __( 'Footer Separator Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$footer_separator . ':hover' => 'border-color : {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_list_footer_hover_width',
			array(
				'label'      => __( 'Footer Separator Width', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,

					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),

				'selectors'  => array(
					$footer_separator . ':hover' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// card section end

		// image section start
		$this->start_controls_section(
			'course_list_image_settings',
			array(
				'label' => __( 'Image', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// start tabs
		$this->start_controls_tabs(
			'course_list_image_tabs'
		);
		// normal tab
		$this->start_controls_tab(
			'course_list_normal_tab',
			array(
				'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
			)
		);

		// for classic,card,stacked
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'course_list_overlay_classic_card_stacked_normal',
				'label'     => __( 'Overlay', 'tutor-lms-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'course_list_skin!' => 'overlayed',
				),
				'selector'  => $card . ' .tutor-course-thumbnail:after',
			)
		);

		// for overlayed skin only
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'course_list_overlay_normal',
				'label'     => __( 'Overlay', 'tutor-lms-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'course_list_skin' => 'overlayed',
				),
				'selector'  => $card . ' .tutor-course-thumbnail:after',
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'label'    => __( 'CSS Filters', 'tutor-lms-elementor-addons' ),
				'name'     => 'course_list_image_overlayed_normal_filters',
				'selector' => $card . ' .tutor-course-thumbnail',
			)
		);

		$this->end_controls_tab();

		// hover tab
		$this->start_controls_tab(
			'course_course_image_hover_tab',
			array(
				'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
			)
		);
		// for classic,card,stacked
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'course_list_overlay_classic_card_stacked_hover',
				'label'     => __( 'Overlay', 'tutor-lms-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'course_list_skin!' => 'overlayed',
				),
				'selector'  => $card . ':hover .tutor-course-thumbnail:after',
			)
		);

		// for overlayed skin only
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'course_list_overlay_hover',
				'label'     => __( 'Overlay', 'tutor-lms-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'course_list_skin' => 'overlayed',
				),
				'selector'  => $card . ':hover .tutor-course-thumbnail:after',
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'label'    => __( 'CSS Filters', 'tutor-lms-elementor-addons' ),
				'name'     => 'course_list_image_overlayed_hover_filters',
				'selector' => $card . ':hover .tutor-course-thumbnail',
			)
		);

		$this->add_control(
			'course_list_card_hover_animation',
			array(

				'label' => __( 'Hover Animation', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,

			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'course_list_image_separator',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		// badge
		$this->add_control(
			'course_list_badge_heading',
			array(
				'label' => __( 'Badge', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name' => 'course_list_skin',
							'operator' => '!=',
							'value' => 'overlayed'
						),
						array(
							'name' => 'course_list_difficulty_settings',
							'operator' => '==',
							'value' => 'yes'
						)
					)
				),
			)
		);

		$this->add_control(
			'course_list_badge_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$badge => 'background-color:{{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name' => 'course_list_skin',
							'operator' => '!=',
							'value' => 'overlayed'
						),
						array(
							'name' => 'course_list_difficulty_settings',
							'operator' => '==',
							'value' => 'yes'
						)
					)
				),
			)
		);

		$this->add_control(
			'course_list_badge_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$badge => 'color:{{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name' => 'course_list_skin',
							'operator' => '!=',
							'value' => 'overlayed'
						),
						array(
							'name' => 'course_list_difficulty_settings',
							'operator' => '==',
							'value' => 'yes'
						)
					)
				),
			)
		);

		$this->add_control(
			'course_list_border_radius',
			array(
				'label'      => __( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$badge => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name' => 'course_list_skin',
							'operator' => '!=',
							'value' => 'overlayed'
						),
						array(
							'name' => 'course_list_difficulty_settings',
							'operator' => '==',
							'value' => 'yes'
						)
					)
				),
			)
		);

		$this->add_control(
			'course_list_badge_size',
			array(
				'label'      => __( 'Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$badge => 'width: {{SIZE}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name' => 'course_list_skin',
							'operator' => '!=',
							'value' => 'overlayed'
						),
						array(
							'name' => 'course_list_difficulty_settings',
							'operator' => '==',
							'value' => 'yes'
						)
					)
				),
			)
		);

		$this->add_control(
			'course_list_badge_margin',
			array(
				'label'      => __( 'Margin', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$badge => 'margin: {{SIZE}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name' => 'course_list_skin',
							'operator' => '!=',
							'value' => 'overlayed'
						),
						array(
							'name' => 'course_list_difficulty_settings',
							'operator' => '==',
							'value' => 'yes'
						)
					)
				),
			)
		);

		$this->add_control(
			'course_list_badge_separator',
			array(
				'type' => Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name' => 'course_list_skin',
							'operator' => '!=',
							'value' => 'overlayed'
						),
						array(
							'name' => 'course_list_difficulty_settings',
							'operator' => '==',
							'value' => 'yes'
						)
					)
				),
			)
		);

		// avatar
		$this->add_control(
			'course_list_avatar_heading',
			array(
				'label' => __( 'Avatar', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
				'condition'	=> array(
					'course_list_avatar_settings' => 'yes'
				)
			)
		);

		$this->add_control(
			'course_list_avatar_size',
			array(
				'label'      => __( 'Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$avatar      => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;'
				),
			)
		);

		$this->add_control(
			'course_list_avatar_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$avatar      => 'border-radius: {{SIZE}}{{UNIT}};'
				),
			)
		);

		$this->end_controls_section();
		// image section end

		// content section start

		$this->start_controls_section(
			'course_list_content_styles',
			array(
				'label' => __( 'Content', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_list_content_title',
			array(
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_list_content_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$course_title . ', ' . $course_title . ' a' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_list_content_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_title,
			)
		);

		$this->add_control(
			'course_list_content_spacing',
			array(
				'label'      => __( 'Space', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'selectors'  => array(
					$course_title => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'course_list_meta_title',
			array(
				'label' => __( 'Meta', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_list_meta_key_color',
			array(
				'label'     => __( 'Key Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$meta . ' .tutor-meta-key, ' . $meta . ' .tutor-meta-icon' => 'color:{{VALUE}} !important;',
				),
				'condition' => array(
					'course_list_meta_data'	=> 'yes'
				)
			)
		);

		$this->add_control(
			'course_list_meta_color',
			array(
				'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$meta . '>*, ' . $meta . ' .tutor-meta-value, ' . $meta . ' a' => 'color:{{VALUE}} !important;',
				),
				'condition' => array(
					'course_list_meta_data'	=> 'yes'
				)
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_list_meta_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $meta,
				'condition' => array(
					'course_list_meta_data'	=> 'yes'
				)
			)
		);

		// Author
		$this->add_control(
			'course_list_author_meta_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'course_list_author_title',
			array(
				'label' => __( 'Author', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
				'condition'	=> array(
					'course_list_author_settings' => 'yes'
				)
			)
		);

		$this->add_control(
			'course_list_author_key_color',
			array(
				'label'     => __( 'Key Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$author . '.tutor-meta-key' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_list_author_color',
			array(
				'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$author . '.tutor-meta-value' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_list_author_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $author,
			)
		);

		// Category
		$this->add_control(
			'course_list_meta_divider_alt',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'course_list_category_title',
			array(
				'label' => __( 'Category', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
				'condition'	=> array(
					'course_list_category_settings' => 'yes'
				)
			)
		);

		$this->add_control(
			'course_list_category_key_color',
			array(
				'label'     => __( 'Key Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$category . '.tutor-meta-key' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_list_category_color',
			array(
				'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$category . '.tutor-meta-value' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_list_category_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $category,
			)
		);

		$this->end_controls_section();

		// content section end

		// rating section start
		$this->start_controls_section(
			'course_list_rating_styles',
			array(
				'label' => __( 'Rating', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_list_star_color',
			array(
				'label'     => __( 'Star Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$ratings . ' .tutor-ratings-stars' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'course_list_star_size',
			array(
				'label'      => __( 'Star Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'selectors'  => array(
					$ratings . ' .tutor-ratings-stars' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carouse_rating__typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $ratings . ' .tutor-ratings-average, '. $ratings . ' .tutor-ratings-count',
			)
		);

		$this->add_control(
			'course_list_star_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$ratings . ' .tutor-ratings-average, '. $ratings . ' .tutor-ratings-count' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'course_list_star_gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'selectors'  => array(
					$ratings . ' .tutor-ratings-average' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		// rating section end

		// pagination section start
		$this->start_controls_section(
			'course_list_pagination_styles',
			array(
				'label' => __( 'Pagination', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_list_pagination_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),

				'selector' => $pagination_selector,
			)
		);

		$this->add_control(
			'course_list_pagination_colors_title',
			array(
				'label' => __( 'Colors', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		// tabs start
		$this->start_controls_tabs(
			'course_list_pagination_style_tabs'
		);

		// normal tabs
		$this->start_controls_tab(
			'course_list_pagination_normal_tab',
			array(
				'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_list_pagination_normal_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					$pagination_selector . ' .etlms-pagination .page-numbers' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'course_list_pagination_normal_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					$pagination_selector . ' .etlms-pagination .page-numbers' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_list_pagination_normal_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => $pagination_selector . ' .etlms-pagination .page-numbers',
			)
		);

		$this->end_controls_tab();
		// normal tabs end

		// hover tabs
		$this->start_controls_tab(
			'course_list_pagination_hover_tab',
			array(
				'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_list_pagination_hover_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					$pagination_selector . ' .etlms-pagination .page-numbers:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'course_list_pagination_hover_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					$pagination_selector . ' .etlms-pagination .page-numbers:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_list_pagination_hover_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => $pagination_selector . ' .etlms-pagination .page-numbers:hover',
			)
		);

		$this->end_controls_tab();
		// hover tabs end

		// active tabs
		$this->start_controls_tab(
			'course_list_pagination_active_tab',
			array(
				'label' => __( 'Active', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_list_pagination_active_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					$pagination_selector . ' .etlms-pagination .current' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'course_list_pagination_active_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					$pagination_selector . ' .etlms-pagination .current' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_list_pagination_active_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => $pagination_selector . ' .etlms-pagination .current',
			)
		);

		$this->end_controls_tab();
		// active tabs end

		$this->end_controls_tabs();
		// tabs end
		$this->add_control(
			'pagination_after_tab_border',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'course_list_pagination_box_shadow',
				'label'     => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'selector'  => $pagination_selector . ' .etlms-pagination .page-numbers',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'course_list_pagination_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$pagination_selector . ' .etlms-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_list_pagination_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					$pagination_selector . ' .etlms-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_list_pagination_space',
			array(
				'label'      => __( 'Space Between', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					$pagination_selector . ' .etlms-pagination' => 'gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
		// pagination section end

		// footer section start
		$this->start_controls_section(
			'course_list_footer_styles',
			array(
				'label' => __( 'Footer', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_carouse_footer_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$footer => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_list_footer_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					$footer => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_list_footer_padding_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'course_list_price_title',
			array(
				'label' => __( 'Price', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carouse_price_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $price,
			)
		);

		$this->add_control(
			'course_list_price_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$price => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);

		$this->add_control(
			'course_list_cart_title',
			array(
				'label' => __( 'Cart Button', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_list_cart_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_button,
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'course_list_car_button_text_shadow',
				'label'    => __( 'Text Shadow', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_button,
			)
		);

		$this->start_controls_tabs(
			'course_list_cart_tabs'
		);
		// normal tab
		$this->start_controls_tab(
			'course_list_text_normal_tab',
			array(
				'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_list_cart_btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_list_cart_btn_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_course_cart_icon_color',
			array(
				'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button . ' [class^="tutor-icon-"]' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();
		// hover tab
		$this->start_controls_tab(
			'course_list_cart_hover_tab',
			array(
				'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_list_cart_btn_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button . ':hover' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
				),
			)
		);
		
		$this->add_control(
			'course_list_cart_btn_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button . ':hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_course_cart_icon_hover_color',
			array(
				'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button . ':hover [class^="tutor-icon-"]' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'course_list_footer_tab_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_list_cart_border',
				'label'    => __( 'Border Type', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_button,
			)
		);

		$this->add_control(
			'course_list_cart_border_radius',
			array(
				'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					$cart_button => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'course_list_cart_box_shadow',
				'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_button,
			)
		);

		$this->end_controls_section();
		// footer section end
	}

	protected function render() {

		ob_start();

		$settings = $this->get_settings_for_display();

		include etlms_get_template( 'course/course-list' );
		echo ob_get_clean();
	}
}
