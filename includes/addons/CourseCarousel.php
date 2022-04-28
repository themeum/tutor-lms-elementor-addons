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

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseCarousel extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout = "elementor-layout-";
	private static $prefix_class_alignment = "enroll-button-align-";

	public function get_title() {
		return __('Course Carousel', 'tutor-lms-elementor-addons');
	}

	public function get_style_depends() {
		return [
			'slick-css',
			'slick-theme-css'
		];
	}

	public function get_script_depends() {
		return [
			'etlms-slick-library',
			'etlms-slick-slider',
			'etlms-enroll-button'
		];
	}

	protected function register_content_controls() {
		$content_selector = "{{WRAPPER}} .etlms-carousel-main-wrap ";

		$meta_content_selector = $content_selector . ".tutor-single-loop-meta";
		$this->start_controls_section(
			'course_carousel_content_section',
			[
				'label' => __('Layout', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'course_carousel_skin',
			[
				'label' => __('Skin', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => [
					'classic' => __('Classic', 'tutor-lms-elementor-addons'),
					'card' => __('Card', 'tutor-lms-elementor-addons'),
					'stacked' => __('Stacked', 'tutor-lms-elementor-addons'),
					'overlayed' => __('Overlayed', 'tutor-lms-elementor-addons')
				],

			]
		);

		$slides_to_show = range(1, 3);
		$slides_to_show = array_combine($slides_to_show, $slides_to_show);

		$this->add_responsive_control(
			'etlms_course_carousel_column',
			[
				'label' => __('Slides to Show', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'card_hover_animation',
			[
				'label' => __('Hover Animation', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'tutor-lms-elementor-addons'),
				'label_off' => __('No', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',

				'default' => 'yes',
			]
		);
		$this->add_control(
			'course_carousel_image',
			[
				'label' => __('Show Image', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'course_carousel_image_size', // Actually its `image_size`.
				'label' => __('Image Size', 'tutor-lms-elementor-addons'),
				'default' => 'medium_large',
				'condition' => [
					'course_carousel_image' => 'yes'
				]
			]
		);

		$this->add_control(
			'course_carousel_meta_data',
			[
				'label' => __('Meta Data', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'course_carousel_meta_space',
			[
				'label' => __('Space Between'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					]
				],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				"selectors" => [
					$meta_content_selector => "padding-right: {{SIZE}}{{UNIT}};"
				],
				'condition' => [
					'course_carousel_meta_data' => "yes"
				],
			]
		);

		$this->add_control(
			'course_carousel_meta_divider',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		$this->add_control(
			'course_carousel_rating_settings',
			[
				'label' => __('Rating', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',

			]
		);

		$this->add_control(
			'course_carousel_avatar_settings',
			[
				'label' => __('Avatar', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'course_carousel_author_settings',
			[
				'label' => __('Author', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_difficulty_settings',
			[
				'label' => __('Difficulty Level', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'course_carousel_category_settings',
			[
				'label' => __('Category', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'course_carousel_wishlist_settings',
			[
				'label' => __('Wishlist', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_footer_settings',
			[
				'label' => __('Footer', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();

		//Query section
        $this->start_controls_section(
            'course_carousel_query_section',
            [
                'label' => __('Query', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $course_categories = etlms_course_categories();
        $course_authors = etlms_course_authors();

        /* Start Tabs */
        $this->start_controls_tabs('course_carousel_query_tabs');

            /* Include Tab */
            $this->start_controls_tab(
                'course_carousel_query_tab_include',
                [
                    'label' => __( 'Include', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_carousel_include_by_categories',
                [
                    'label' => __( 'Categories', 'tutor-lms-elementor-addons' ),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => $course_categories,
                    'default' => []
                ]
            );

            $this->add_control(
                'course_carousel_include_by_authors',
                [
                    'label' => __( 'Authors', 'tutor-lms-elementor-addons' ),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => $course_authors,
                    'default' => []
                ]
            );

            $this->end_controls_tab();

            /* Exclude Tab */
            $this->start_controls_tab(
                'course_carousel_query_tab_exclude',
                [
                    'label' => __( 'Exclude', 'tutor-lms-elementor-addons' ),
                ]
            );

            $this->add_control(
                'course_carousel_exclude_by_categories',
                [
                    'label' => __( 'Categories', 'tutor-lms-elementor-addons' ),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => $course_categories,
                    'default' => []
                ]
            );

            $this->add_control(
                'course_carousel_exclude_by_authors',
                [
                    'label' => __( 'Authors', 'tutor-lms-elementor-addons' ),
                    'type' => Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => $course_authors,
                    'default' => []
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        /* End Tabs */

        $this->add_control(
            'course_carousel_order_by',
            [
                'label' => __( 'Order By', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post_date' => __( 'Date', 'tutor-lms-elementor-addons' ),
                    'post_title' => __( 'Title', 'tutor-lms-elementor-addons' ),
                ],
                'default' => 'post_date'
            ]
        );

        $this->add_control(
            'course_carousel_order',
            [
                'label' => __( 'Order', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => __( 'ASC', 'tutor-lms-elementor-addons' ),
                    'desc' => __( 'DESC', 'tutor-lms-elementor-addons' ),
                ],
                'default' => 'desc'
            ]
		);
		
		$this->add_control(
            'course_carousel_post_limit',
            [
                'label' => __( 'Limit', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 20,
                'step' => 1,
                'default' => 5
            ]
        );

        $this->end_controls_section();

		//carousel settings

		$this->start_controls_section(
			'course_carousel_settings_section',
			[
				'label' => __('Carousel Settings'),
				'type' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'course_carousel_settings_arrows',
			[
				'label' => __('Arrows', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_dots',
			[
				'label' => __('Dots', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'tutor-lms-elementor-addons'),
				'label_off' => __('Hide', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_transition',
			[
				'label' => __('Transition Duration'),
				'type' => Controls_Manager::TEXT,
				'default' => '600'
			]
		);

		$this->add_control(
			'course_carousel_settings_center_slides',
			[
				'label' => __('Centered Slides', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'tutor-lms-elementor-addons'),
				'label_off' => __('No', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'course_carousel_settings_scroll',
			[
				'label' => __('Smooth Scrolling', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'tutor-lms-elementor-addons'),
				'label_off' => __('No', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_autoplay',
			[
				'label' => __('Auto Play', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'tutor-lms-elementor-addons'),
				'label_off' => __('No', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_autoplay_speed',
			[
				'label' => __('Auto Play Speed'),
				'type' => Controls_Manager::TEXT,
				'default' => '5000'
			]
		);

		$this->add_control(
			'course_carousel_settings_infinite_loop',
			[
				'label' => __('Infinite Loop', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'tutor-lms-elementor-addons'),
				'label_off' => __('No', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_pause_onhover',
			[
				'label' => __('Paush on Hover', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'tutor-lms-elementor-addons'),
				'label_off' => __('No', 'tutor-lms-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$wrapper 					= "{{WRAPPER}} .etlms-carousel-main-wrap ";
		$card_selector 				= $wrapper . ".tutor-card";
		$image_selector 			= $wrapper . ".tutor-course-thumbnail";
		$badge_selector 			= $wrapper . ".tutor-course-difficulty-level";
		$avatar_selector 			= $wrapper . ".tutor-avatar";
		$course_title_selector 		= $wrapper . ".tutor-course-name";
		$meta_selector 				= $wrapper . ".etlms-course-duration-meta";
		$author_selector 			= $wrapper . ".etlms-course-author-meta";
		$category_selector 			= $wrapper . ".etlms-course-category-meta";
		$ratings_selector 			= $wrapper . ".tutor-ratings";
		$footer_selector 			= $wrapper . ".tutor-card-footer";
		$price_selector 			= $wrapper . ".tutor-course-price";
		$cart_button_selector 		= $wrapper . ".tutor-card-footer .tutor-btn-outline-primary";

		$arrow_icon_selector 		= $wrapper . ".etlms-carousel-arrow i";
		$arrow_shape_selector 		= $wrapper . ".etlms-carousel-arrow > i";
		$arrow_ghost_selector 		= $wrapper . ".etlms-carousel-arrow";
		$dots_selector 				= $wrapper . ".etlms-carousel-dots";
		$stacked_selector 			= $wrapper . ".etlms-carousel-course-container";

		$this->start_controls_section(
			'course_carousel_style_section',
			[
				'label' => __('Card', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_card_background_color',
			[
				'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'course_carousel_skin',
							'operator' => 'in',
							'value' => ['classic', 'card']
						]
					],
				],
				'default' => '#fff',
				'selectors' => [
					$card_selector => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_stacked_background_color',
			[
				'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'course_carousel_skin' => 'stacked',

				],
				'default' => '#fff',
				'selectors' => [
					$card_selector . ' .etlms-course-card-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		//border tabs
		$this->start_controls_tabs('course_carousel_card_border_tabs');

		//normal tab start
		$this->start_controls_tab('course_carousel_card_border_normal_tab', [
			'label' => __('Normal', 'tutor-lms-elementor-addons')
		]);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'course_carousel_card_border',
				'label' => __('Border', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin!' => 'stacked'
				],
				'selector' => $card_selector,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'course_carousel_stacked_border',
				'label' => __('Border', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin' => 'stacked'
				],
				'selector' => $card_selector . ' .etlms-course-card-inner',
			]
		);

		$this->add_control(
			'course_carousel_card_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'size' => 8,
					'unit' => 'px'
				],
				'condition' => [
					'course_carousel_skin' => ['classic', 'card'],

				],
				'selectors' => [
					$card_selector => 'border-radius: {{SIZE}}{{UNIT}} ;',
				],
			]
		);

		$this->add_control(
			'course_carousel_stacked_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'size' => 10,
					'unit' => 'px'
				],
				'condition' => [
					'course_carousel_skin' => 'stacked',

				],
				'selectors' => [
					$card_selector . ' .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				],
			]
		);
		$this->add_control(
			'course_carousel_card_overlayed_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'size' => 20,
					'unit' => 'px'
				],
				'condition' => [
					'course_carousel_skin' => 'overlayed',

				],
				'selectors' => [
					$card_selector . ' .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'carousel_card_box_shadow_control',
				'label' => __('Box Shadow', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin!' => 'stacked'
				],
				'selector' => $card_selector,
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'carousel_stacked_box_shadow_control',
				'label' => __('Box Shadow', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin' => 'stacked'
				],

				'selector' => $card_selector . ' .etlms-course-card-inner',
			]
		);

		$this->end_controls_tab();
		//normal tab end

		//hover tab start
		$this->start_controls_tab('course_carousel_card_border_hover_tab', [
			'label' => __('Hover', 'tutor-lms-elementor-addons')
		]);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'course_carousel_card_hover_border',
				'label' => __('Border', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin!' => 'stacked'
				],
				'selector' => $card_selector . ':hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'course_carousel_stacked_hover_border',
				'label' => __('Border', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin' => 'stacked'
				],
				'selector' => $card_selector . ':hover .etlms-course-card-inner',
			]
		);

		$this->add_control(
			'course_carousel_card_hover_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'size' => 8,
					'unit' => 'px'
				],
				'condition' => [

					'course_carousel_skin' => ['classic', 'card'],

				],
				'selectors' => [
					$card_selector . ':hover' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				],
			]
		);
		$this->add_control(
			'course_carousel_stacked_hover_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'size' => 10,
					'unit' => 'px'
				],
				'condition' => [
					'course_carousel_skin' => 'stacked',

				],
				'selectors' => [
					$card_selector . ':hover .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'course_carousel_overlayed_hover_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'size' => 20,
					'unit' => 'px'
				],
				'condition' => [
					'course_carousel_skin' => 'overlayed',

				],
				'selectors' => [
					$card_selector . ':hover .etlms-course-card-inner' => 'border-radius: {{SIZE}}{{UNIT}} ;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'carousel_card_hover_box_shadow_control',
				'label' => __('Box Shadow', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin!' => 'stacked'
				],
				'selector' => $card_selector . ':hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'carousel_stacked_hover_box_shadow_control',
				'label' => __('Box Shadow', 'tutor-lms-elementor-addons'),
				'condition' => [
					'course_carousel_skin' => 'stacked'
				],
				'selector' => $card_selector . ':hover .etlms-course-card-inner',
			]
		);

		$this->end_controls_tab();
		//hover tab end

		$this->end_controls_tabs();
		//border tabs end

		$this->add_control(
			'course_carousel_card_padding',
			[
				'label' => __('Padding', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					$card_selector . ' .tutor-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_carousel_overlay_color',
				'label' => __('Overlay', 'tutor-lms-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'condition' => [
					'course_carousel_skin' => 'overlayed'
				],
				'selector' => $card_selector . ' .tutor-course-thumbnail:after'
			]
		);

		/* Start Tabs */
		$this->start_controls_tabs('course_carousel_card_tabs');
		/* Normal Tab */
		$this->start_controls_tab(
			'course_carousel_card_normal_tab',
			[
				'label' => __('Normal', 'tutor-lms-elementor-addons'),
			]
		);

		$this->add_control(
			'course_coursel_footer_separator_color',
			[
				'label'     => __('Footer Separator Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$card_selector . ' .tutor-card-footer' => 'border-top-color : {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'course_carousel_footer_width',
			[
				'label' => __('Footer Separator Width', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,

					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					$card_selector . ' .tutor-card-footer' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_tab();

		/* Hovered Tab */
		$this->start_controls_tab(
			'course_carousel_card_hover_tab',
			[
				'label' => __('Hover', 'tutor-lms-elementor-addons'),
			]
		);

		$this->add_control(
			'course_coursel_footer_separator_hover_color',
			[
				'label'     => __('Footer Separator Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$card_selector . ':hover .tutor-card-footer' => 'border-top-color : {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'course_carousel_footer_hover_width',
			[
				'label' => __('Footer Separator Width', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,

					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					$card_selector . ':hover .tutor-card-footer' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// card section end

		//image section start
		$this->start_controls_section(
			'course_carousel_image_settings',
			[
				'label' => __('Image', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		//start tabs
		$this->start_controls_tabs('course_carousel_image_tabs');
		//normal tab
		$this->start_controls_tab(
			'course_course_normal_tab',
			[
				'label' => __('Normal', 'tutor-lms-elementor-addons')
			]
		);

		//for classic,card,stacked 
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'course_carousel_overlay_classic_card_stacked_normal',
				'label' => __('Overlay', 'tutor-lms-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'condition' => [
					'course_carousel_skin!' => 'overlayed'
				],
				'selector' => $card_selector . ' .tutor-course-thumbnail:after',
			]
		);

		//for overlayed skin only
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'course_carousel_overlay_normal',
				'label' => __('Overlay', 'tutor-lms-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'condition' => [
					'course_carousel_skin' => 'overlayed'
				],
				'selector' => $card_selector . ' .tutor-course-thumbnail:after',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'label' => __('CSS Filters', 'tutor-lms-elementor-addons'),
				'name' => 'course_carousel_image_normal_filters',
				'selector' => $card_selector . ' .tutor-course-thumbnail',
			]
		);

		$this->end_controls_tab();

		//hover tab
		$this->start_controls_tab(
			'course_course_image_hover_tab',
			[
				'label' => __('Hover', 'tutor-lms-elementor-addons')
			]
		);

		//for classic,card,stacked 
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'course_carousel_overlay_classic_card_stacked_hover',
				'label' => __('Overlay', 'tutor-lms-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'condition' => [

					'course_carousel_skin!' => 'overlayed'
				],
				'selector' =>  $card_selector . ':hover .tutor-course-thumbnail:after',
			]
		);

		//for overlayed skin only
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'course_carousel_overlay_hover',
				'label' => __('Overlay', 'tutor-lms-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'condition' => [
					'course_carousel_skin' => 'overlayed'
				],
				'selector' => $card_selector . ':hover .tutor-course-thumbnail:after',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'label' => __('CSS Filters', 'tutor-lms-elementor-addons'),
				'name' => 'course_carousel_image_hover_filters',
				'condition' => [
					'course_carousel_skin!' => 'overlayed'
				],
				'selector' => $card_selector . ':hover .tutor-course-thumbnail',
			]
		);

		$this->add_control(
			'course_carousel_img_hover_animation',
			[

				'label' => __('Hover Animation', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'selector' => $card_selector . ':hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'course_carousel_image_separator',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		//badge
		$this->add_control(
			'course_carousel_badge_heading',
			[
				'label' => __('Badge', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'course_carousel_badge_background_color',
			[
				'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$badge_selector => 'background-color:{{VALUE}};'
				],
				'condition'	=> array(
					'course_carousel_difficulty_settings' => 'yes'
				)
			]
		);

		$this->add_control(
			'course_carousel_badge_text_color',
			[
				'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$badge_selector => 'color:{{VALUE}};'
				],
				'condition'	=> array(
					'course_carousel_difficulty_settings' => 'yes'
				)
			]
		);

		$this->add_control(
			'course_carousel_border_radius',
			[
				'label' => __('Border Radius', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					$badge_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'	=> array(
					'course_carousel_difficulty_settings' => 'yes'
				)
			]
		);

		$this->add_control(
			'course_carousel_badge_size',
			[
				'label' => __('Size', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					$badge_selector => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> array(
					'course_carousel_difficulty_settings' => 'yes'
				)
			]
		);

		$this->add_control(
			'course_carousel_badge_margin',
			[
				'label' => __('Margin', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					$badge_selector => 'margin: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> array(
					'course_carousel_difficulty_settings' => 'yes'
				)
			]
		);

		$this->add_control(
			'course_carousel_badge_separator',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		//avatar
		$this->add_control(
			'course_carousel_avatar_heading',
			[
				'label' => __('Avatar', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HEADING,
				'condition'	=> array(
					'course_carousel_avatar_settings'	=> 'yes'
				)
			]
		);

		$this->add_control(
			'course_carousel_avatar_size',
			[
				'label' => __('Size', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'default'    => array(
					'unit' => 'px',
					'size' => 34,
				),
				'selectors' => [
					$avatar_selector => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'course_carousel_avatar_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25
				],
				'selectors' => [
					$avatar_selector => 'border-radius: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();
		//image section end

		//content section start
		$this->start_controls_section(
			'course_carousel_content_styles',
			[
				'label' => __('Content', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_content_title',
			[
				'label' => __('Title', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'course_carousel_content_color',
			[
				'label'     => __('Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$course_title_selector . ', ' . $course_title_selector . ' a' => "color:{{VALUE}};"
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'course_carousel_content_typo',
				'label'     => __('Typography', 'tutor-lms-elementor-addons'),
				'selector'  => $course_title_selector,
			]
		);

		$this->add_control(
			'course_carousel_content_spacing',
			[
				'label' => __('Space', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					$course_title_selector => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
			'course_carousel_meta_title',
			[
				'label' => __('Meta', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'course_carousel_meta_key_color',
			array(
				'label'     => __( 'Key Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$meta_selector . ' .tutor-meta-key, ' . $meta_selector . ' .tutor-meta-icon' => 'color:{{VALUE}} !important;',
				),
				'condition' => array(
					'course_carousel_meta_data'	=> 'yes'
				)
			)
		);

		$this->add_control(
			'course_carousel_meta_color',
			[
				'label'     => __('Value Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$meta_selector . '>*, ' . $meta_selector . ' .tutor-meta-value, ' . $meta_selector . ' a' => "color:{{VALUE}};"
				],
				'condition' => array(
					'course_carousel_meta_data'	=> 'yes'
				)
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'course_carousel_meta_typo',
				'label'     => __('Typography', 'tutor-lms-elementor-addons'),
				'selector'  => $meta_selector,
				'condition' => array(
					'course_carousel_meta_data'	=> 'yes'
				)
			]
		);

		// Author
		$this->add_control(
			'course_carousel_author_meta_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'course_carousel_author_title',
			array(
				'label' => __( 'Author', 'tutor-lms-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
				'condition'	=> array(
					'course_carousel_author_settings' => 'yes'
				)
			)
		);

		$this->add_control(
			'course_carousel_author_key_color',
			array(
				'label'     => __( 'Key Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$author_selector . '.tutor-meta-key' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_author_color',
			array(
				'label'     => __( 'Value Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$author_selector . '.tutor-meta-value' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_carousel_author_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $author_selector,
			)
		);

		// Category
		$this->add_control(
			'course_carousel_meta_divider_alt',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		$this->add_control(
			'course_carousel_category_title',
			[
				'label' => __('Category', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'course_carousel_category_key_color',
			array(
				'label'     => __( 'Key Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$category_selector . '.tutor-meta-key' => 'color:{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_category_color',
			[
				'label'     => __('Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$category_selector . '.tutor-meta-value' => 'color:{{VALUE}};'
				],
				'condition'	=> array(
					'course_carousel_category_settings'	=> 'yes'
				)
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'course_carousel_category_typo',
				'label'     => __('Typography', 'tutor-lms-elementor-addons'),
				'selector'  => $category_selector,
				'condition'	=> array(
					'course_carousel_category_settings'	=> 'yes'
				)
			]
		);

		$this->end_controls_section();

		//content section end		

		//rating section start
		$this->start_controls_section(
			'course_carousel_rating_styles',
			[
				'label' => __('Rating', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_star_color',
			[
				'label'     => __('Star Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$ratings_selector . ' .tutor-ratings-stars' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'course_carousel_star_size',
			[
				'label' => __('Star Size', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					$ratings_selector . ' .tutor-ratings-stars' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'course_carouse_rating__typo',
				'label'     => __('Typography', 'tutor-lms-elementor-addons'),
				'selector'  => $ratings_selector . ' .tutor-ratings-average, '. $ratings_selector . ' .tutor-ratings-count',
			]
		);

		$this->add_control(
			'course_carousel_star_text_color',
			[
				'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$ratings_selector . ' .tutor-ratings-average, '. $ratings_selector . ' .tutor-ratings-count' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'course_carousel_star_gap',
			[
				'label' => __('Gap', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					$ratings_selector . ' .tutor-ratings-average' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		//rating section end		

		//footer section start
		$this->start_controls_section(
			'course_carousel_footer_styles',
			[
				'label' => __('Footer', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'course_carouse_footer_background_color',
			[
				'label'     => __('Background Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$footer_selector => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'course_carousel_footer_padding',
			[
				'label' => __('Padding', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					$footer_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_footer_padding_divider',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		$this->add_control(
			'course_carousel_price_title',
			[
				'label' => __('Price', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'course_carouse_price_typo',
				'label'     => __('Typography', 'tutor-lms-elementor-addons'),
				'selector'  => $price_selector,
			]
		);

		$this->add_control(
			'course_carousel_price_text_color',
			[
				'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$price_selector => 'color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
			'course_carousel_cart_title',
			[
				'label' => __('Cart Button', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);

		// Button
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'course_carousel_cart_typo',
				'label'     => __('Typography', 'tutor-lms-elementor-addons'),
				'selector'  => $cart_button_selector,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'course_carousel_cart_text_shadow',
				'label' => __('Text Shadow', 'tutor-lms-elementor-addons'),
				'selector' => $cart_button_selector,
			]
		);

		$this->start_controls_tabs(
			'course_carousel_cart_tabs'
		);
		//normal tab
		$this->start_controls_tab(
			'course_carousel_text_normal_tab',
			[
				'label' => __('Normal', 'tutor-lms-elementor-addons')
			]
		);

		$this->add_control(
			'course_carousel_cart_btn_bg_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button_selector => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_cart_btn_text_color',
			[
				'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$cart_button_selector => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_course_cart_icon_color',
			[
				'label'     => __('Icon Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$cart_button_selector . ' [class^="tutor-icon-"]' => 'color: {{VALUE}} !important;',
				]
			]
		);

		$this->end_controls_tab();
		//hover tab
		$this->start_controls_tab(
			'course_carousel_cart_hover_tab',
			[
				'label' => __('Hover', 'tutor-lms-elementor-addons')
			]
		);

		$this->add_control(
			'course_carousel_cart_btn_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$cart_button_selector . ':hover' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'course_carousel_cart_btn_text_color_hover',
			[
				'label'     => __('Text Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$cart_button_selector . ':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_course_cart_icon_hover_color',
			[
				'label'     => __('Icon Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$cart_button_selector . ':hover [class^="tutor-icon-"]' => 'color: {{VALUE}} !important;',
				]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'course_carousel_footer_tab_divider',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'course_carousel_cart_border',
				'label' => __('Border Type', 'tutor-lms-elementor-addons'),
				'selector' => $cart_button_selector,
			]
		);

		$this->add_control(
			'course_carousel_cart_border_radius',
			[
				'label' => __('Border Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					$cart_button_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'course_carousel_cart_box_shadow',
				'label' => __('Box Shadow', 'tutor-lms-elementor-addons'),
				'selector' => $cart_button_selector,
			]
		);

		$this->end_controls_section();
		//footer section end		

		//arrow section start
		$this->start_controls_section(
			'course_carousel_arrow_styles',
			[
				'label' => __('Arrows', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_arrow_style',
			[
				'label' => __('Arrow Style', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', 'tutor-lms-elementor-addons'),
					'ghost' => __('Ghost / Outlined', 'tutor-lms-elementor-addons'),
					'fill' => __('Fill', 'tutor-lms-elementor-addons')
				]
			]
		);

		$this->add_control(
			'course_carousel_arrows_position',
			[
				'label' => __('Position', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'outside',
				'options' => [
					'inside' => __('Inside', 'tutor-lms-elementor-addons'),
					'outside' => __('Outside', 'tutor-lms-elementor-addons'),
				]
			]
		);
		$this->add_control(
			'course_carousel_arrow_shape_size',
			[
				'label' => __('Shape Size', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 28,
				],
				'condition' => [
					'course_carousel_arrow_style!' => 'default'
				],
				'selectors' => [
					$arrow_shape_selector => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_icon_size',
			[
				'label' => __('Icon Size', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 28,
				],
				'selectors' => [
					$arrow_icon_selector => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// arrow tabs
		$this->start_controls_tabs(
			'course_carousel_arrow_tabs'
		);
		// normal tab
		$this->start_controls_tab(
			'course_carousel_arrow_normal_tab',
			[
				'label' => __('Normal', 'tutor-lms-elementor-addons')
			]
		);

		$this->add_control(
			'course_carousel_arrow_color',
			[
				'label'     => __('Arrow Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$arrow_icon_selector => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_shape_color',
			[
				'label'     => __('Shape Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'course_carousel_arrow_style',
							'operator' => 'in',
							'value' => ['ghost', 'fill']
						]
					]
				],
				'selectors' => [
					$arrow_shape_selector => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_shape_border_width',
			[
				'label' => __('Border Width', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 0,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					$arrow_shape_selector => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'course_carousel_arrow_style' => 'ghost'
				]
			]
		);

		$this->add_control(
			'course_carousel_arrow_border_color',
			[
				'label' => __('Border Color', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					$arrow_shape_selector => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'course_carousel_arrow_style' => 'ghost'
				]
			]
		);

		$this->add_control(
			'course_carousel_arrow_shape_raius',
			[
				'label' => __('Shape Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 0,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					$arrow_shape_selector => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'course_carousel_arrow_style' => 'ghost'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'course_carousel_arrow_shape_shadow',
				'label' => __('Shadow', 'tutor-lms-elementor-addons'),
				'selector' => $arrow_shape_selector,
			]
		);

		$this->end_controls_tab();

		// hover tab
		$this->start_controls_tab(
			'course_carousel_arrow_hover_tab',
			[
				'label' => __('Hover', 'tutor-lms-elementor-addons')
			]
		);

		$this->add_control(
			'course_carousel_arrow_color_hover',
			[
				'label'     => __('Arrow Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$arrow_icon_selector . ":hover" => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_shape_color_hover',
			[
				'label'     => __('Shape Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$arrow_shape_selector . ":hover" => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_shape_border_width_hover',
			[
				'label' => __('Border Width', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 0,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'condition' => [
					'course_carousel_arrow_style' => 'ghost'
				],
				'selectors' => [
					$arrow_shape_selector . ":hover" => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_border_color_hover',
			[
				'label' => __('Border Color', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'course_carousel_arrow_style' => 'ghost'
				],
				'selectors' => [
					$arrow_shape_selector . ":hover" => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_shape_raius_hover',
			[
				'label' => __('Shape Radius', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 0,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition' => [
					'course_carousel_arrow_style' => 'ghost'
				],
				'selectors' => [
					$arrow_shape_selector . ":hover" => 'border-radius: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'course_carousel_arrow_shape_shadow_hover',
				'label' => __('Shadow', 'tutor-lms-elementor-addons'),
				'selector' => $arrow_shape_selector . ":hover",
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
		//arrow section end

		//dots style section start
		$this->start_controls_section(
			'course_carousel_dots_style',
			[
				'label' => __('Dots', 'tutor-lms-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_dots_position',
			[
				'label' => __('Position', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'outside',
				'options' => [
					'inside' => __('Inside', 'tutor-lms-elementor-addons'),
					'outside' => __('Outside', 'tutor-lms-elementor-addons'),
				],

			]
		);

		$this->add_control(
			'course_carousel_dots_size',
			[
				'label' => __('Size', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 3,
						'max' => 36,
					],
				],
				'selectors' => [
					$wrapper . ".slick-dots li button:before" => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'size' => 12,
				]
			]
		);

		$this->add_control(
			'course_carousel_dots_alignment',
			[
				'label'        => __('Alignment', 'tutor-lms-elementor-addons'),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'   => [
						'title' => __('Left', 'tutor-lms-elementor-addons'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'tutor-lms-elementor-addons'),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __('Right', 'tutor-lms-elementor-addons'),
						'icon'  => 'eicon-text-align-right'
					],

				],
				'selectors' => [
					$wrapper . ".slick-dots" => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'course_carousel_dots_gap',
			[
				'label' => __('Gap', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 68,
					],
				],
				'selectors' => [
					$wrapper . ".slick-dots" => 'bottom: -{{SIZE}}{{UNIT}};',
				],
				'default' => [
					'size' => 30,
				]
			]
		);

		$this->add_control(
			'course_carousel_dots_space',
			[
				'label' => __('Space Between', 'tutor-lms-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 36,
					],
				],
				'selectors' => [
					$wrapper . ".slick-dots li" => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'size' => 5,
				]
			]
		);

		$this->start_controls_tabs('course_carousel_dots_tabs');

		/*normal tab*/
		$this->start_controls_tab(
			'course_carousel_dots_normal_tab',
			[
				'label' => __('Normal', 'tutor-lms-elementor-addons')
			]
		);

		$this->add_control(
			'course_carousel_dots_fill_normal_color',
			[
				'label'     => __('Fill Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$wrapper . ".slick-dots li button:before" => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		/*hover tab*/
		$this->start_controls_tab(
			'course_carousel_dots_hover_tab',
			[
				'label' => __('Hover', 'tutor-lms-elementor-addons')
			]
		);

		$this->add_control(
			'course_carousel_dots_fill_hover_color',
			[
				'label'     => __('Fill Color', 'tutor-lms-elementor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					$wrapper . ".slick-dots li button:hover:before" => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		//dots style section end
	}

	protected function render() {
		ob_start();
		$settings = $this->get_settings_for_display();

		include etlms_get_template('course/course-carousel');
		echo ob_get_clean();
	}
}
