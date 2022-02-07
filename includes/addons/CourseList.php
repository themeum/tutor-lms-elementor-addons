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

		$meta_content_selector = $content_selector . '.tutor-single-loop-meta';
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
					'5' => __( '5', 'tutor-lms-elementor-addons' ),
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
					'size' => 0,
					'unit' => 'px',
				),
				'condition'  => array(
					'course_list_meta_data' => 'yes',
				),
				'selectors'  => array(
					$meta_content_selector => 'padding-right:{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_meta_divider',
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
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_list_category_settings',
			array(
				'label'        => __( 'Category', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => '',
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
				'default' => __( 'Next', 'tutor-lms-elementor-addons' ),
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
						'icon'  => 'fa fa-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'fa fa-align-right',
					),
				),

				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .etlms-pagination' => 'justify-content:{{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// enroll button

		$this->start_controls_section(
			'course_coursel_enroll_section',
			array(
				'label' => __( 'Enroll Button', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		// $this->add_responsive_control(
		// 	'course_carousel_enroll_btn_align',
		// 	$this->etlms_non_responsive_alignment( 'right' )
		// );

		$this->add_control(
			'course_carousel_enroll_btn_type',
			array(
				'label'   => __( 'Button Type', 'tutor-lms-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'                => __( 'Default', 'tutor-lms-elementor-addons' ),
					'default_with_cart_icon' => __( 'Default with Cart Icon', 'tutor-lms-elementor-addons' ),
					'text_button'            => __( 'Text Button', 'tutor-lms-elementor-addons' ),
					'text_with_cart'         => __( 'Text with Cart', 'tutor-lms-elementor-addons' ),
				),
				'default' => 'text_with_cart',
			)
		);

		// $this->add_control(
		// 	'course_coursel_button_icon',
		// 	array(
		// 		'label'       => __( 'Icon', 'tutor-lms-elementor-addons' ),
		// 		'type'        => Controls_Manager::ICON,

		// 		'label_block' => true,
		// 		'conditions'  => array(
		// 			'relation' => 'or',
		// 			'terms'    => array(
		// 				array(
		// 					'name'     => 'course_carousel_enroll_btn_type',
		// 					'operator' => 'in',
		// 					'value'    => array( 'default_with_cart_icon', 'text_with_cart' ),
		// 				),
		// 			),
		// 		),
		// 		'default'     => 'fa fa-shopping-cart',
		// 	)
		// );

		$this->add_control(
			'course_carousel_btn_icon_spacing',
			array(
				'label'      => __( 'Icon Spacing', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => 'in',
							'value'    => array( 'default_with_cart_icon', 'text_with_cart' ),
						),
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					$content_selector . '.etlms-loop-cart-btn-wrap a >i' => 'padding-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_controls() {

		$wrapper = '{{WRAPPER}} .etlms-course-list-main-wrap ';

		$footer_seperator_selector = $wrapper . '.tutor-loop-course-footer';
		$image_selector            = $wrapper . '.tutor-course-header img';
		$badge_selector            = $wrapper . '.tutor-course-loop-header-meta span:first-child';
		$avatar_selector           = $wrapper . '.tutor-single-course-avatar a >img';
		$avatar_span_selector      = $wrapper . '.tutor-single-course-avatar a >span';
		$course_title_selector     = $wrapper . '.tutor-course-loop-title h2 a';
		$meta_selector             = $wrapper . '.tutor-course-loop-meta';
		$category_selector         = $wrapper . '.tutor-course-lising-category a';
		$star_selector             = $wrapper . '.tutor-star-rating-group,' . $wrapper . ' .tutor-star-rating-group i.tutor-icon-star-full';
		$star_text_selector        = $wrapper . '.tutor-rating-count';
		$footer_selector           = $wrapper . '.tutor-loop-course-footer';
		$price_selector            = $wrapper . '.price';
		$cart_text_selector        = $wrapper . '.tutor-loop-course-footer .list-item-button a, ' . $wrapper . ' .tutor-loop-course-footer span.cart-text, ' . $wrapper . ' .tutor-loop-course-footer span.ttr-cart-line-filled';
		$cart_selector             = $wrapper . '.tutor-loop-course-footer .list-item-button span.ttr-cart-line-filled';
		$cart_button_selector      = $wrapper . ' .tutor-loop-course-footer .list-item-button';
		$row_selector              = $wrapper . '.etlms-course-list-col';
		$column_selector           = $wrapper . '.etlms-course-list-col';
		$pagination_selector       = $wrapper . '.etlms-course-list-pagination-wrap';
		$card_selector             = $wrapper . '.etlms-card';
		$stacked_selector          = $wrapper . '.etlms-carousel-course-container';
		/*
		@card selector change as per skin style
		*/

		$card_selector = $wrapper . '.etlms-carousel-course-container';

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
					'size' => 15,
				),
				'condition' => array(
					'course_list_masonry!' => 'yes',
				),
				'selectors' => array(
					$column_selector => 'padding: 0 {{SIZE}}{{UNIT}};',
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
					'size' => 30,
				),

				'selectors' => array(
					$row_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
						'icon'  => 'fa fa-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'fa fa-align-right',
					),

				),
				'selectors' => array(
					$wrapper . '.tutor-courses' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'course_carousel_style_section',
			array(
				'label' => __( 'Card', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_carousel_card_background_color',
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
				'default'    => '#fff',
				'selectors'  => array(
					$wrapper . '.etlms-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_stacked_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'course_list_skin' => 'stacked',

				),
				'default'   => '#fff',
				'selectors' => array(
					$wrapper . '.etlms-carousel-course-container' => 'background-color: {{VALUE}};',
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
				'selector'  => $wrapper . '.etlms-card',
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
				'selector'  => $stacked_selector,
			)
		);

		$this->add_control(
			'course_carousel_card_border_radius',
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
					$wrapper . '.etlms-card' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_control(
			'course_carousel_stacked_border_radius',
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
					$stacked_selector => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_control(
			'course_carousel_overlayed_border_radius',
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
					$stacked_selector => 'border-radius: {{SIZE}}{{UNIT}} ;',
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
				'selector'  => $wrapper . '.etlms-card',
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
				'selector'  => $stacked_selector,
			)
		);

		$this->end_controls_tab();
		// normal tab end

		// hover tab start
		$this->start_controls_tab(
			'course_list_card_hover_tab',
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
				'selector'  => $wrapper . '.etlms-card:hover',
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
				'selector'  => $stacked_selector . ':hover',
			)
		);

		$this->add_control(
			'course_carousel_card_hover_border_radius',
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
					$wrapper . '.etlms-card:hover' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_control(
			'course_carousel_stacked_hover_border_radius',
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
					$stacked_selector . ':hover' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				),
			)
		);
		$this->add_control(
			'course_carousel_overlayed_hover_border_radius',
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
					$stacked_selector . ':hover' => 'border-radius: {{SIZE}}{{UNIT}} ;',
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
				'selector'  => $wrapper . '.etlms-card:hover',
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
				'selector'  => $stacked_selector . ':hover',
			)
		);

		$this->end_controls_tab();
		// hover tab end

		$this->end_controls_tabs();
		// border tabs end

		$this->add_control(
			'course_carousel_card_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$card_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		/* Start Tabs */
		$this->start_controls_tabs( 'course_carousel_card_tabs' );
		/* Normal Tab */
		$this->start_controls_tab(
			'course_carousel_card_normal_tab',
			array(
				'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
			)
		);

		$this->add_control(
			'course_coursel_footer_seperator_color',
			array(
				'label'     => __( 'Footer Seperator Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$footer_seperator_selector => 'border-color : {{VALUE}};',
				),
				'default'	=> "#EBEBEB",
			)
		);

		$this->add_control(
			'course_carousel_footer_width',
			array(
				'label'      => __( 'Footer Seperator Width', 'tutor-lms-elementor-addons' ),
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
					$footer_seperator_selector => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		/* Hovered Tab */
		$this->start_controls_tab(
			'course_carousel_card_hover_tab',
			array(
				'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'course_coursel_box_hover_shadow',
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
			'course_coursel_footer_seperator_hover_color',
			array(
				'label'     => __( 'Footer Seperator Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$footer_seperator_selector . ':hover' => 'border-color : {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_footer_hover_width',
			array(
				'label'      => __( 'Footer Seperator Width', 'tutor-lms-elementor-addons' ),
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
					$footer_seperator_selector . ':hover' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// card section end

		// image section start
		$this->start_controls_section(
			'course_carousel_image_settings',
			array(
				'label' => __( 'Image', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_carousel_image_spacing',
			array(
				'label'      => __( 'Spacing', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'selectors'  => array(
					$image_selector => 'padding:{{SIZE}}{{UNIT}}',
				),
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
				'selector'  => $wrapper . '.tutor-course-header:before',
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
				'selector'  => $wrapper . '.etlms-card:before',
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'label'    => __( 'CSS Filters', 'tutor-lms-elementor-addons' ),
				'name'     => 'course_caroulse_image_overlayed_normal_filters',
				'selector' => $wrapper . '.tutor-course-header',
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
				'selector'  => $wrapper . '.etlms-card:hover .tutor-course-header:before',
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
				'selector'  => $wrapper . '.etlms-card:hover:before',
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'label'    => __( 'CSS Filters', 'tutor-lms-elementor-addons' ),
				'name'     => 'course_caroulse_image_overlayed_hover_filters',
				'selector' => $wrapper . '.etlms-card:hover .tutor-course-header',
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
			'course_carousel_image_seperator',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		// badge
		$this->add_control(
			'course_carousel_badge_heading',
			array(
				'label' => __( 'Badge', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_carousel_badge_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$badge_selector => 'background-color:{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_badge_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$badge_selector => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_border_radius',
			array(
				'label'      => __( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					$badge_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_badge_size',
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
					$badge_selector => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_badge_margin',
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
					$badge_selector => 'margin: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_badge_seperator',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		// avatar
		$this->add_control(
			'course_carousel_avatar_heading',
			array(
				'label' => __( 'Avatar', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_carousel_avatar_size',
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
					$avatar_selector      => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					$avatar_span_selector => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_avatar_border_radius',
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
				'default'    => array(
					'unit' => 'px',
					'size' => 25,
				),
				'selectors'  => array(
					$avatar_selector      => 'border-radius: {{SIZE}}{{UNIT}};',
					$avatar_span_selector => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
		// image section end

		// content section start

		$this->start_controls_section(
			'course_carousel_content_styles',
			array(
				'label' => __( 'Content', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_carousel_content_title',
			array(
				'label' => __( 'Title', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_carousel_content_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$course_title_selector => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carousel_content_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $course_title_selector,
			)
		);

		$this->add_control(
			'course_carousel_content_spacing',
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
					$course_title_selector => 'padding: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'course_carousel_meta_title',
			array(
				'label' => __( 'Meta', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_carousel_meta_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$meta_selector . ',' . $meta_selector . ' span.tutor-meta-level' . ',' . $meta_selector . ' span.tutor-meta-value' => 'color:{{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carousel_meta_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $meta_selector . ',' . $meta_selector . ' span.tutor-meta-level' . ',' . $meta_selector . ' span.tutor-meta-value',

			)
		);

		$this->add_control(
			'course_carousel_meta_divier',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'course_carousel_category_title',
			array(
				'label' => __( 'Category', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'course_carousel_category_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$category_selector => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carousel_category_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $category_selector,
			)
		);

		$this->add_control(
			'course_carousel_category_spacing',
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
					$category_selector => 'padding: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->end_controls_section();

		// content section end

		// rating section start
		$this->start_controls_section(
			'course_carousel_rating_styles',
			array(
				'label' => __( 'Rating', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_carousel_star_color',
			array(
				'label'     => __( 'Star Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$star_selector => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'course_carousel_star_size',
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
					$star_selector => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carouse_rating__typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $star_text_selector,
			)
		);

		$this->add_control(
			'course_carousel_star_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$star_text_selector => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'course_carousel_star_gap',
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
					$star_text_selector => 'padding-left: {{SIZE}}{{UNIT}};',
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
					'.etlms-pagination .page-numbers' => 'color: {{VALUE}}',

				),
			)
		);

		$this->add_control(
			'course_list_pagination_normal_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'.etlms-pagination .page-numbers' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_list_pagination_normal_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => '.etlms-pagination .page-numbers',
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
					'.etlms-pagination .page-numbers:hover' => 'color: {{VALUE}}',

				),
			)
		);

		$this->add_control(
			'course_list_pagination_hover_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'.etlms-pagination .page-numbers:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_list_pagination_hover_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => '.etlms-pagination .page-numbers:hover',
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
					'.etlms-pagination .current' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'course_list_pagination_active_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'.etlms-pagination .current' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_list_pagination_active_border',
				'label'    => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => '.etlms-pagination .current',
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
				'selector'  => '.etlms-pagination .page-numbers',
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
					'.etlms-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'.etlms-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'.etlms-pagination' => 'gap: {{SIZE}}{{UNIT}}',

				),
			)
		);

		$this->end_controls_section();
		// pagination section end

		// footer section start
		$this->start_controls_section(
			'course_carousel_footer_styles',
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
					$footer_selector => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_carousel_footer_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					$footer_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_footer_padding_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'course_carousel_price_title',
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
				'selector' => $price_selector,
			)
		);

		$this->add_control(
			'course_carousel_price_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$price_selector => 'color: {{VALUE}};',
				),
				'seperator' => 'after',
			)
		);

		$this->add_control(
			'course_carousel_cart_title',
			array(
				'label' => __( 'Cart Button', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carousel_cart_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_text_selector,
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'course_list_car_button_text_shadow',
				'label'    => __( 'Text Shadow', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_text_selector,
			)
		);

		$this->start_controls_tabs(
			'course_carousel_cart_tabs'
		);
		// normal tab
		$this->start_controls_tab(
			'course_carousel_text_normal_tab',
			array(
				'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'course_course_text_normal_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_text_selector => 'color: {{VALUE}} ',
				),
			)
		);

		$this->add_control(
			'course_course_cart_icon_color',
			array(
				'label'      => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					$cart_selector => 'color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'default_with_cart_icon',
						),
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'text_with_cart',
						),
					),
				),  // condition end
			)
		);

		$this->add_control(
			'course_course_cart_background_color',
			array(
				'label'      => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					$cart_button_selector => 'background-color: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'default_with_cart_icon',
						),
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'default',
						),
					),
				),  // condition end
			)
		);

		$this->end_controls_tab();
		// hover tab
		$this->start_controls_tab(
			'course_carousel_cart_hover_tab',
			array(
				'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_control(
			'course_course_text_hover_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_text_selector . ':hover' => 'color: {{VALUE}} ',
				),
			)
		);

		$this->add_control(
			'course_course_cart_icon_hover_color',
			array(
				'label'      => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					$cart_selector . ':hover' => 'color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'default_with_cart_icon',
						),
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'text_with_cart',
						),
					),
				),
			)
		);

		$this->add_control(
			'course_course_cart_background_hover_color',
			array(
				'label'      => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					$cart_button_selector => 'background-color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'default_with_cart_icon',
						),
						array(
							'name'     => 'course_carousel_enroll_btn_type',
							'operator' => '==',
							'value'    => 'default',
						),
					),
				),  // condition end
			)
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'course_carousel_footer_tab_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_carousel_cart_border',
				'label'    => __( 'Border Type', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_button_selector,
			)
		);

		$this->add_control(
			'course_carousel_cart_border_radius',
			array(
				'label'     => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					$cart_button_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'course_carousel_cart_box_shadow',
				'label'    => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
				'selector' => $cart_button_selector,
			)
		);

		$this->add_control(
			'course_carousel_cart_border_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_responsive_control(
			'course-carousel_cart_button_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					$cart_button_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
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
