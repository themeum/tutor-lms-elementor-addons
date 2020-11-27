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

class CourseCarousel extends BaseAddon{

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "enroll-button-align-";

    public function get_title() {
        return __('Course Carousel', 'tutor-elementor-addons');
    }

    public function get_style_depends(){
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

	protected function register_content_controls(){
		$content_selector = "{{WRAPPER}} .etlms-carousel-main-wrap ";

		$meta_content_selector = $content_selector.".tutor-single-loop-meta";
		$this->start_controls_section(
			'course_carousel_content_section',
			[
				'label' => __('Layout','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'course_carousel_skin',
			[
				'label' => __('Skin','tutor-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'classic',
				'options' =>[
					'classic' => __('Classic','tutor-elementor-addons'),
					'card' => __('Card','tutor-elementor-addons'),
					'stacked' => __('Stacked','tutor-elementor-addons'),
					'overlayed' => __('Overlayed','tutor-elementor-addons')
				],
				
			]
		);
	
		$slides_to_show = range( 1, 10 );

		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'etlms_course_carousel_column',
			[
				'label' => __( 'Slides to Show', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'tutor-elementor-addons' ),
				] + $slides_to_show,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'course_carousel_image',
			[
				'label' => __( 'Show Image', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'course_carousel_image_size', // Actually its `image_size`.
				'label' => __( 'Image Size', 'tutor-elementor-addons' ),
				'default' => 'medium_large',
				'condition'=>[
					'course_carousel_image' => 'yes'
				]
			]
		);

		$this->add_control(
			'course_carousel_image_ratio',
			[
				'label' => __( 'Image Ratio', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one-one',
				'options' => [
					'one-one'  => __( '1:1', 'tutor-elementor-addons' ),
					'four-three' => __( '4:3', 'tutor-elementor-addons' ),
					'sixteen-nine' => __( '16:9', 'tutor-elementor-addons' ),
					'three-two' => __( '3:2', 'tutor-elementor-addons' ),
					
				],
				'condition' => [
					'course_carousel_image' => 'yes'
				]
			]
		);	

		$this->add_control(
			'course_carousel_meta_data',
			[
				'label' => __( 'Meta Data', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);		

		$this->add_control(
			'course_carousel_meta_space',
			[
				'label' => __('Space Between'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px'=> [
						'min' => 0,
						'max' => 100
					]
				],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'condition'=>[
					'course_carousel_meta_data' => "yes"
				],
				"selectors" =>[
					$meta_content_selector => "padding-right:{{SIZE}}{{UNIT}};"
				] 
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
				'label' => __( 'Rating', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				
			]
		);	        

		$this->add_control(
			'course_carousel_avatar_settings',
			[
				'label' => __( 'Avatar', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);	        

		$this->add_control(
			'course_carousel_difficulty_settings',
			[
				'label' => __( 'Difficulty Level', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);	  

		$this->add_control(
			'course_carousel_category_settings',
			[
				'label' => __( 'Category', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);	        

		$this->add_control(
			'course_carousel_wishlist_settings',
			[
				'label' => __( 'Wishlist', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);	        

		$this->add_control(
			'course_carousel_footer_settings',
			[
				'label' => __( 'Footer', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);	        
		$this->end_controls_section();

		//enroll button

		$this->start_controls_section(
			'course_coursel_enroll_section',
			[
				'label' => __('Enroll Button','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_responsive_control(
			'course_carousel_enroll_btn_align',
			$this->etlms_non_responsive_alignment('right')			
		);

		$this->add_control(
			'course_carousel_enroll_btn_type',
			[
				'label' => __('Button Type','tutor-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __('Default','tutor-elementor-addons'), 
					'default_with_cart_icon' => __('Default with Cart Icon','tutor-elementor-addons'), 
					'text_button' => __('Text Button','tutor-elementor-addons'), 
					'text_with_cart' => __('Text with Cart','tutor-elementor-addons'), 
				],
				'default' => 'text_with_cart'
			]

		);

        $this->add_control(
            'course_coursel_button_icon',
            [
                'label' => __('Icon','tutor-elementor-addons'),
                'type' => Controls_Manager::ICON,
                
                'label_block' => true,
                'conditions' => [
                    'relation'=>'or',
                    'terms' => [
                        [
                            'name' => 'course_carousel_enroll_btn_type',
                            'operator' => 'in',
                            'value' => ['default_with_cart_icon','text_with_cart']
                        ]
                    ]
                ],                
                'default' => 'fa fa-shopping-cart'
            ]
        );          

		$this->add_control(
			'course_carousel_btn_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
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
                'conditions' => [
                    'relation'=>'or',
                    'terms' => [
                        [
                            'name' => 'course_carousel_enroll_btn_type',
                            'operator' => 'in',
                            'value' => ['default_with_cart_icon','text_with_cart']
                        ]
                    ]
                ],				
				'selectors' => [
					$content_selector.".etlms-loop-cart-btn-wrap a >i" => 'padding-right: {{SIZE}}{{UNIT}};',
				],
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
				'label' => __( 'Arrows', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);		

		$this->add_control(
			'course_carousel_settings_dots',
			[
				'label' => __( 'Dots', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
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
				'label' => __( 'Centered Slides', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'tutor-elementor-addons' ),
				'label_off' => __( 'No', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'course_carousel_settings_scroll',
			[
				'label' => __( 'Smooth Scrolling', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'tutor-elementor-addons' ),
				'label_off' => __( 'No', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_autoplay',
			[
				'label' => __( 'Auto Play', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'tutor-elementor-addons' ),
				'label_off' => __( 'No', 'tutor-elementor-addons' ),
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
				'label' => __( 'Infinite Loop', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'tutor-elementor-addons' ),
				'label_off' => __( 'No', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_pause_onhover',
			[
				'label' => __( 'Paush on Hover', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'tutor-elementor-addons' ),
				'label_off' => __( 'No', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'course_carousel_settings_pause_oninteraction',
			[
				'label' => __( 'Paush on Interaction', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'tutor-elementor-addons' ),
				'label_off' => __( 'No', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();
	}

	protected function register_style_controls(){

		$wrapper = "{{WRAPPER}} .etlms-carousel-main-wrap ";
		$card_selector = $wrapper.".etlms-carousel-course-container";
		$footer_seperator_selector =  $wrapper.".tutor-loop-course-footer";
		$image_selector = $wrapper.".tutor-course-header a >img";
		$badge_selector = $wrapper.".tutor-course-loop-header-meta span:first-child";
		$avatar_selector = $wrapper.".tutor-single-course-avatar a >img";
		$avatar_span_selector = $wrapper.".tutor-single-course-avatar a >span";
		$course_title_selector = $wrapper.".tutor-course-loop-title h2 a";
		$meta_selector = $wrapper.".tutor-course-loop-meta";
		$category_selector = $wrapper.".tutor-course-lising-category a";
		$star_selector = $wrapper.".tutor-star-rating-group";
		$star_text_selector = $wrapper.".tutor-rating-count";
		$footer_selector = $wrapper.".tutor-loop-course-footer";
		$price_selector = $wrapper.".price";

        $cart_text_selector = $wrapper.".etlms-loop-cart-btn-wrap >a";
        $cart_selector = $wrapper.".etlms-loop-cart-btn-wrap a >i";
        $cart_button_selector = $wrapper.".etlms-loop-cart-btn-wrap a";

		$arrow_icon_selector = $wrapper.".etlms-carousel-arrow i";
		$arrow_shape_selector = $wrapper.".etlms-carousel-arrow >i";
		$arrow_ghost_selector = $wrapper.".etlms-carousel-arrow";
		$dots_selector = $wrapper.".etlms-carousel-dots";
		$stacked_selector = $wrapper.".etlms-carousel-course-container";

		$this->start_controls_section(
			'course_carousel_style_section',
			[
				'label' => __('Card','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_control(
            'course_carousel_card_background_color',
            [
                'label'     => __('Background Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'course_carousel_skin',
                            'operator' => 'in',
                            'value' => ['classic','card']
                        ]
                    ],
                ],
                'default' => '#fff',
                'selectors' => [
                    $wrapper.'.etlms-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );        

        $this->add_control(
            'course_carousel_stacked_background_color',
            [
                'label'     => __('Background Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'course_carousel_skin' => 'stacked',

                ],
                'default' => '#fff',
                'selectors' => [
                    $wrapper.'.etlms-carousel-course-container' => 'background-color: {{VALUE}};',
                ],
            ]
		);  
				
        //border tabs
        $this->start_controls_tabs('course_carousel_card_border_tabs');

            //normal tab start
            $this->start_controls_tab('course_carousel_card_border_normal_tab',[
                'label' => __('Normal','tutor-elementor-addons')
            ]);

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_carousel_card_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin!' => 'stacked'
                        ],
                        'selector' => $wrapper.".etlms-card",
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_carousel_stacked_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin' => 'stacked'
                        ],
                        'selector' => $stacked_selector,
                    ]
                );

                $this->add_control(
                    'course_carousel_card_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default' =>[
                            'size' => 8,
                            'unit' => 'px'
                        ],
                        'condition' => [
                            'course_carousel_skin!' => 'stacked',

                        ],
                        'selectors' => [
                            $wrapper.".etlms-card" => 'border-radius: {{SIZE}}{{UNIT}} ;',
                        ],
                    ]
                );  
                $this->add_control(
                    'course_carousel_stacked_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default' =>[
                            'size' => 8,
                            'unit' => 'px'
                        ],
                        'condition' => [
                            'course_carousel_skin' => 'stacked',

                        ],
                        'selectors' => [
                            $stacked_selector => 'border-radius: {{SIZE}}{{UNIT}} ;',
                        ],
                    ]
                );  
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'carousel_card_box_shadow_control',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin!' => 'stacked'
                        ],
                        'selector' => $wrapper.".etlms-card",
                    ]
                );                

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'carousel_stacked_box_shadow_control',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin' => 'stacked'
                        ],
                        'selector' => $stacked_selector,
                    ]
                );                

            $this->end_controls_tab();
            //normal tab end

            //hover tab start
            $this->start_controls_tab('course_list_card_border_hover_tab',[
                'label' => __('Hover','tutor-elementor-addons')
            ]);

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_carousel_card_hover_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin!' => 'stacked'
                        ],
                        'selector' => $wrapper.".etlms-card:hover",
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_carousel_stacked_hover_border',
                        'label' => __( 'Border', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin' => 'stacked'
                        ],
                        'selector' => $stacked_selector.":hover",
                    ]
                );

                $this->add_control(
                    'course_carousel_card_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default' =>[
                            'size' => 8,
                            'unit' => 'px'
                        ],
                        'condition' => [
                            'course_carousel_skin!' => 'stacked',

                        ],
                        'selectors' => [
                            $wrapper.".etlms-card:hover" => 'border-radius: {{SIZE}}{{UNIT}} ;',
                        ],
                    ]
                );  
                $this->add_control(
                    'course_carousel_stacked_hover_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'default' =>[
                            'size' => 8,
                            'unit' => 'px'
                        ],
                        'condition' => [
                            'course_carousel_skin' => 'stacked',

                        ],
                        'selectors' => [
                            $stacked_selector.":hover" => 'border-radius: {{SIZE}}{{UNIT}} ;',
                        ],
                    ]
                );  
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'carousel_card_hover_box_shadow_control',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin!' => 'stacked'
                        ],
                        'selector' => $wrapper.".etlms-card:hover",
                    ]
                );                

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'carousel_stacked_hover_box_shadow_control',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'condition' => [
                            'course_carousel_skin' => 'stacked'
                        ],
                        'selector' => $stacked_selector.":hover",
                    ]
                ); 

            $this->end_controls_tab();
            //hover tab end

        $this->end_controls_tabs();
        //border tabs end

		$this->add_control(
			'course_carousel_card_padding',
			[
				'label' => __( 'Padding', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					$card_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);        

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'course_list_overlay_color',
                'label' => __( 'Overlay', 'tutor-elementor-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [
                    'course_carousel_skin' => 'overlayed'
                ],
                'selector' => $wrapper.'.etlms-color-overlay'
            ]
        );
        /* Start Tabs */
        $this->start_controls_tabs('course_carousel_card_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_carousel_card_normal_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                                            



                $this->add_control(
                    'course_coursel_footer_seperator_color',
                    [
                        'label'     => __('Footer Seperator Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $footer_seperator_selector => 'border-color : {{VALUE}};'
                        ],
                    ]
                );                

				$this->add_control(
					'course_carousel_footer_width',
					[
						'label' => __( 'Footer Seperator Width', 'tutor-elementor-addons' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
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
							$footer_seperator_selector => 'border-width: {{SIZE}}{{UNIT}};',
						],
					]
				);


            $this->end_controls_tab();

            /* Hovered Tab */
            $this->start_controls_tab(
                'course_carousel_card_hover_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );


                $this->add_control(
                    'course_coursel_footer_seperator_hover_color',
                    [
                        'label'     => __('Footer Seperator Color', 'tutor-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $footer_seperator_selector.":hover" => 'border-color : {{VALUE}};'
                        ],
                    ]
                );                

				$this->add_control(
					'course_carousel_footer_hover_width',
					[
						'label' => __( 'Footer Seperator Width', 'tutor-elementor-addons' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
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
							$footer_seperator_selector.":hover" => 'border-width: {{SIZE}}{{UNIT}};',
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
				'label' => __('Image', 'tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_image_spacing',
			[
				'label' => __('Spacing','tutor-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'min' => 0,
					'max' => 100,
					'step' => 1
				],
				'selectors'=>[
					$image_selector => "padding:{{SIZE}}{{UNIT}}"
				]
			]
		);

		//start tabs
		$this->start_controls_tabs('course_carousel_image_tabs');
		//normal tab
		$this->start_controls_tab(
			'course_course_normal_tab',
			[
				'label' => __('Normal','tutor-elementor-addons')
			]
		);

			//for classic,card,stacked 
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'course_carousel_overlay_classic_card_stacked_normal',
					'label' => __( 'Overlay', 'tutor-elementor-addons' ),
					'types' => [ 'classic', 'gradient' ],
					'condition' => [
						'course_carousel_skin!' => 'overlayed'
					],
					'selector' => $wrapper.".etlms-common-overlay"
				]
			); 

			//for overlayed skin only
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'course_carousel_overlay_normal',
					'label' => __( 'Overlay', 'tutor-elementor-addons' ),
					'types' => [ 'classic', 'gradient' ],
					'condition' => [
						'course_carousel_skin' => 'overlayed'
					],
					'selector' => $wrapper.'.etlms-color-overlay'
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'label' => __('CSS Filters','tutor-elementor-addons'),
					'name' => 'course_carousel_image_normal_filters',
					'condition' => [
						'course_carousel_skin!' => 'overlayed'
					],
					'selector' => $wrapper.".etlms-common-overlay",
				]
			);
			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'label' => __('CSS Filters','tutor-elementor-addons'),
					'name' => 'course_carousel_image_overlayed_normal_filters',
					'condition' => [
						'course_carousel_skin' => 'overlayed'
					],
					'selector' => $wrapper.".etlms-color-overlay",
				]
			);

		$this->end_controls_tab();

		//hover tab
		$this->start_controls_tab(
			'course_course_image_hover_tab',
			[
				'label' => __('Hover','tutor-elementor-addons')
			]
		);
	
			//for classic,card,stacked 
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'course_carousel_overlay_classic_card_stacked_hover',
					'label' => __( 'Overlay', 'tutor-elementor-addons' ),
					'types' => [ 'classic', 'gradient' ],
					'condition' => [
						'course_carousel_skin!' => 'overlayed'
					],
					'selector' => $wrapper.".etlms-common-overlay:hover"
				]
			); 

			//for overlayed skin only
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'course_carousel_overlay_hover',
					'label' => __( 'Overlay', 'tutor-elementor-addons' ),
					'types' => [ 'classic', 'gradient' ],
					'condition' => [
						'course_carousel_skin' => 'overlayed'
					],
					'selector' => $wrapper.'.etlms-color-overlay:hover'
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'label' => __('CSS Filters','tutor-elementor-addons'),
					'name' => 'course_carousel_image_hover_filters',
					'condition' => [
						'course_carousel_skin!' => 'overlayed'
					],
					'selector' => $wrapper.".etlms-common-overlay:hover",
				]
			);
			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'label' => __('CSS Filters','tutor-elementor-addons'),
					'name' => 'course_carousel_image_overlayed_hover_filters',
					'condition' => [
						'course_carousel_skin' => 'overlayed'
					],
					'selector' => $wrapper.".etlms-color-overlay:hover",
				]
			);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'course_carousel_image_seperator',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		//badge
		$this->add_control(
			'course_carousel_badge_heading',
			[
				'label' => __('Badge','tutor-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);		

        $this->add_control(
            'course_carousel_badge_background_color',
            [
                'label'     => __('Background Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $badge_selector => 'background-color:{{VALUE}};'
                ],
            ]
        );         

        $this->add_control(
            'course_carousel_badge_text_color',
            [
                'label'     => __('Text Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $badge_selector => 'color:{{VALUE}};'
                ],
            ]
        ); 

		$this->add_control(
			'course_carousel_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					$badge_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'course_carousel_badge_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $badge_selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );         

        $this->add_control(
            'course_carousel_badge_margin',
            [
                'label' => __( 'Margin', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $badge_selector => 'margin: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        

		$this->add_control(
			'course_carousel_badge_seperator',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		//avatar
		$this->add_control(
			'course_carousel_avatar_heading',
			[
				'label' => __('Avatar','tutor-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);

        $this->add_control(
            'course_carousel_avatar_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $avatar_selector => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    $avatar_span_selector => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        

        $this->add_control(
            'course_carousel_avatar_border_radius',
            [
                'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'default'=>[
                	'unit' => 'px',
                	'size' => 25
                ],
                'selectors' => [
                    $avatar_selector => 'border-radius: {{SIZE}}{{UNIT}};',
                    $avatar_span_selector => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  

		$this->end_controls_section();
		//image section end

		//content section start

		$this->start_controls_section(
			'course_carousel_content_styles',
			[
				'label' => __('Content','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_content_title',
			[
				'label' => __('Title', 'tutor-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);

        $this->add_control(
            'course_carousel_content_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $course_title_selector => "color:{{VALUE}};"
                ],
            ]
        );  

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_carousel_content_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $course_title_selector,
            ]
        );

        $this->add_control(
            'course_carousel_content_spacing',
            [
                'label' => __( 'Space', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    $course_title_selector => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        ); 

        $this->add_control(
        	'course_carousel_meta_title',
        	[
        		'label' => __('Meta','tutor-elementor-addons'),
        		'type' => Controls_Manager::HEADING
        	]
        );

        $this->add_control(
            'course_carousel_meta_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $meta_selector => "color:{{VALUE}};"
                ],
            ]
        );         

        $this->add_control(
            'course_carousel_meta_separator_color',
            [
                'label'     => __('Separator Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => ''
                ],
            ]
        );  

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_carousel_meta_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $meta_selector,
                
            ]
        );        

        $this->add_control(
        	'course_carousel_meta_divier',
        	[
        		'type' => Controls_Manager::DIVIDER
        	]
        );


		$this->add_control(
			'course_carousel_category_title',
			[
				'label' => __('Category', 'tutor-elementor-addons'),
				'type' => Controls_Manager::HEADING
			]
		);

        $this->add_control(
            'course_carousel_category_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $category_selector => 'color:{{VALUE}};'
                ],
            ]
        );  

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_carousel_category_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $category_selector,
            ]
        );

        $this->add_control(
            'course_carousel_category_spacing',
            [
                'label' => __( 'Space', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    $category_selector => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        ); 

		$this->end_controls_section();

		//content section end		

		//rating section start
		$this->start_controls_section(
			'course_carousel_rating_styles',
			[
				'label' => __('Rating','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_control(
            'course_carousel_star_color',
            [
                'label'     => __('Star Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $star_selector => 'color: {{VALUE}};',
                ],
            ]
        );                
        $this->add_control(
            'course_carousel_star_size',
            [
                'label' => __( 'Star Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    $star_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_carouse_rating__typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $star_text_selector,
            ]
        );

        $this->add_control(
            'course_carousel_star_text_color',
            [
                'label'     => __('Text Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $star_text_selector => 'color: {{VALUE}};',
                ],
            ]
        );                
        $this->add_responsive_control(
            'course_carousel_star_gap',
            [
                'label' => __( 'Gap', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    $star_text_selector => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );         
		$this->end_controls_section();		
		//rating section end		

		//footer section start
		$this->start_controls_section(
			'course_carousel_footer_styles',
			[
				'label' => __('Footer','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
        $this->add_control(
            'course_carouse_footer_background_color',
            [
                'label'     => __('Background Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $footer_selector => 'background-color: {{VALUE}};',
                ],
            ]
        ); 	

        $this->add_responsive_control(
            'course_carousel_footer_padding',
            [
                'label' => __( 'Padding', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
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
        		'label' => __('Price','tutor-elementor-addons'),
        		'type' => Controls_Manager::HEADING
        	]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_carouse_price_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  =>$price_selector,
            ]
        );

        $this->add_control(
            'course_carousel_price_text_color',
            [
                'label'     => __('Text Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$price_selector => 'color: {{VALUE}};',
				],
				'seperator' => 'after'
            ]
        );

        $this->add_control(
        	'course_carousel_cart_title',
        	[
        		'label' => __('Cart Button','tutor-elementor-addons'),
        		'type' => Controls_Manager::HEADING
        	]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_carousel_cart_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $cart_text_selector,
            ]
        );

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'course_carousel_cart_text_shadow',
				'label' => __( 'Text Shadow', 'tutor-elementor-addons' ),
				'selector' => $cart_text_selector,
			]
		);

        $this->start_controls_tabs(
            'course_carousel_cart_tabs'
        );
        //normal tab
        $this->start_controls_tab(
            'course_carousel_text_normal_tab',
            [
                'label' => __('Normal','tutor-elementor-addons')
            ]
        );
            $this->add_control(
                'course_course_text_normal_color',
                [
                    'label'     => __('Text Color', 'tutor-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $cart_text_selector => 'color: {{VALUE}} ',
                    ],
                ]
            );          

            $this->add_control(
                'course_course_cart_icon_color',
                [
                    'label'     => __('Icon Color', 'tutor-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $cart_selector => 'color: {{VALUE}}',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'default_with_cart_icon'
                            ],
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'text_with_cart'
                            ]
                        ]
                    ]  //condition end
                ]
            );            

            $this->add_control(
                'course_course_cart_background_color',
                [
                    'label'     => __('Background Color', 'tutor-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $cart_button_selector => 'background-color: {{VALUE}}',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'default_with_cart_icon'
                            ],
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'default'
                            ]
                        ]
                    ]  //condition end                    
                ]
            );

        $this->end_controls_tab();      
        //hover tab
        $this->start_controls_tab(
            'course_carousel_cart_hover_tab',
            [
                'label' => __('Hover','tutor-elementor-addons')
            ]
        );
            $this->add_control(
                'course_course_text_hover_color',
                [
                    'label'     => __('Text Color', 'tutor-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $cart_text_selector.":hover" => 'color: {{VALUE}} ',
                    ],
                ]
            );          

            $this->add_control(
                'course_course_cart_icon_hover_color',
                [
                    'label'     => __('Icon Color', 'tutor-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $cart_selector.":hover" => 'color: {{VALUE}}',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'default_with_cart_icon'
                            ],
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'text_with_cart'
                            ]
                        ]
                    ]                  
                ]
            ); 

            $this->add_control(
                'course_course_cart_background_hover_color',
                [
                    'label'     => __('Background Color', 'tutor-elementor-addons'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $cart_button_selector => 'background-color: {{VALUE}}',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'default_with_cart_icon'
                            ],
                            [
                                'name' => 'course_carousel_enroll_btn_type',
                                'operator' => '==',
                                'value' => 'default'
                            ]
                        ]
                    ]  //condition end                    
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
                'label' => __( 'Border Type', 'tutor-elementor-addons' ),
                'selector' => $cart_button_selector,
            ]
        );

        $this->add_control(
            'course_carousel_cart_border_radius',
            [
                'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
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
                'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                'selector' => $cart_button_selector,
            ]
        );

        $this->add_control(
        	'course_carousel_cart_border_divider',
        	[
        		'type' => Controls_Manager::DIVIDER
        	]
        );

        $this->add_responsive_control(
            'course-carousel_cart_button_padding',
            [
                'label' => __( 'Padding', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    $cart_button_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );        

		$this->end_controls_section();		
		//footer section end		

		//arrow section start
		$this->start_controls_section(
			'course_carousel_arrow_styles',
			[
				'label' => __('Arrows','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_arrow_style',
			[
				'label' => __('Arrow Style','tutor-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default','tutor-elementor-addons'),
					'ghost' => __('Ghost / Outlined','tutor-elementor-addons'),
					'fill' => __('Fill','tutor-elementor-addons')
				]
			]
		);

		$this->add_control(
			'course_carousel_arrows_position',
			[
				'label' => __('Position','tutor-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'outside',
				'options' => [
					'inside' => __('Inside','tutor-elementor-addons'),
					'outside' => __('Outside','tutor-elementor-addons'),
				]
			]
		);
		$this->add_control(
			'course_carousel_arrow_shape_size',
			[
				'label' => __( 'Shape Size', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'condition' =>[
					'course_carousel_arrow_style!'=>'default'
				],
				'selectors' => [
					$arrow_shape_selector => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'course_carousel_arrow_icon_size',
			[
				'label' => __( 'Icon Size', 'tutor-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
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
				'label' => __('Normal','tutor-elementor-addons')
			]
		);

            $this->add_control(
                'course_carousel_arrow_color',
                [
                    'label'     => __( 'Arrow Color', 'tutor-elementor-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $arrow_icon_selector => 'color: {{VALUE}};',
                    ],
                ]
            );            

            $this->add_control(
                'course_carousel_arrow_shape_color',
                [
                    'label'     => __( 'Shape Color', 'tutor-elementor-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'conditions' => [
                    	'relation' => 'or',
                    	'terms' => [
                    		[
                    			'name' => 'course_carousel_arrow_style',
                    			'operator' => 'in',
                    			'value' => ['ghost','fill']
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
					'label' => __( 'Border Width', 'tutor-elementor-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
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
					'condition' =>[
						'course_carousel_arrow_style' => 'ghost'
					]
				]
			);

            $this->add_control(
                'course_carousel_arrow_border_color',
                [
                    'label' => __( 'Border Color', 'tutor-elementor-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        $arrow_shape_selector => 'border-color: {{VALUE}}',
                    ],
					'condition' =>[
						'course_carousel_arrow_style' => 'ghost'
					]                    
                ]
            );

			$this->add_control(
				'course_carousel_arrow_shape_raius',
				[
					'label' => __( 'Shape Radius', 'tutor-elementor-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
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
					'label' => __( 'Shadow', 'tutor-elementor-addons' ),
					'selector' => $arrow_shape_selector,
				]
			);

		$this->end_controls_tab();		

		// hover tab
		$this->start_controls_tab(
			'course_carousel_arrow_hover_tab',
			[
				'label' => __('Hover','tutor-elementor-addons')
			]
		);

            $this->add_control(
                'course_carousel_arrow_color_hover',
                [
                    'label'     => __( 'Arrow Color', 'tutor-elementor-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $arrow_icon_selector.":hover" => 'color: {{VALUE}};',
                    ],
                ]
            );            

            $this->add_control(
                'course_carousel_arrow_shape_color_hover',
                [
                    'label'     => __( 'Shape Color', 'tutor-elementor-addons' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $arrow_shape_selector.":hover"=> 'background-color: {{VALUE}};',
                    ],
                ]
            );

			$this->add_control(
				'course_carousel_arrow_shape_border_width_hover',
				[
					'label' => __( 'Border Width', 'tutor-elementor-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
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
						$arrow_shape_selector.":hover" => 'border-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

            $this->add_control(
                'course_carousel_arrow_border_color_hover',
                [
                    'label' => __( 'Border Color', 'tutor-elementor-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                    	'course_carousel_arrow_style' => 'ghost'
                    ],
                    'selectors' => [
                        $arrow_shape_selector.":hover" => 'border-color: {{VALUE}}',
                    ],
                ]
            );

			$this->add_control(
				'course_carousel_arrow_shape_raius_hover',
				[
					'label' => __( 'Shape Radius', 'tutor-elementor-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
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
						$arrow_shape_selector.":hover" => 'border-radius: {{SIZE}}{{UNIT}};',
					],

				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'course_carousel_arrow_shape_shadow_hover',
					'label' => __( 'Shadow', 'tutor-elementor-addons' ),
					'selector' => $arrow_shape_selector.":hover",
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
				'label' => __('Dots','tutor-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'course_carousel_dots_position',
			[
				'label' => __('Position','tutor-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'outside',
				'options' => [
					'inside' => __('Inside','tutor-elementor-addons'),
					'outside' => __('Outside','tutor-elementor-addons'),
				],

			]
		);



        // $this->add_control(
        //     'course_carousel_dots_radius',
        //     [
        //         'label' => __( 'Radius', 'tutor-elementor-addons' ),
        //         'type' => Controls_Manager::SLIDER,
        //         'size_units' => [ 'px' ],
        //         'range' => [
        //             'px' => [
        //                 'min' => 5,
        //                 'max' => 200,
        //             ],
        //         ],
        //         'selectors' => [
        //             $wrapper.".slick-dots li.slick-active button:before" => 'border-radius: {{SIZE}}{{UNIT}};',
        //             $wrapper.".slick-dots li button:before" => 'border-radius: {{SIZE}}{{UNIT}};',
        //         ],
        //     ]
        // );        

        $this->add_control(
            'course_carousel_dots_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $wrapper.".slick-dots li button:before" => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );        



        $this->add_control(
        	'course_carousel_dots_alignment',
		[
		    'label'        => __('Alignment', 'tutor-elementor-addons'),
		    'type'         => Controls_Manager::CHOOSE,
		    'options'      => [
		        'left'   => [
		            'title' => __('Left', 'tutor-elementor-addons'),
		            'icon'  => 'fa fa-align-left',
		        ],
		        'center' => [
		            'title' => __('Center', 'tutor-elementor-addons'),
		            'icon'  => 'fa fa-align-center',
		        ],
		        'right'  => [
		            'title' => __('Right', 'tutor-elementor-addons'),
		            'icon'  => 'fa fa-align-right'
		        ],

		    ],
			'selectors' => [
				$wrapper.".slick-dots" => 'text-align: {{VALUE}};',
			],		    				
		]
        );

        $this->add_control(
            'course_carousel_dots_space',
            [
                'label' => __( 'Space Between', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $wrapper.".slick-dots li"=> 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('course_carousel_dots_tabs');

        /*normal tab*/
        $this->start_controls_tab(
        	'course_carousel_dots_normal_tab',
        	[
        		'label' => __('Normal','tutor-elementor-addons')
        	]
        );

	        $this->add_control(
	            'course_carousel_dots_fill_normal_color',
	            [
	                'label'     => __('Fill Color', 'tutor-elementor-addons'),
	                'type'      => Controls_Manager::COLOR,
	                'selectors' => [
						$wrapper.".slick-dots li button:before" => 'color: {{VALUE}}',
					],
	            ]
			);
			
        $this->end_controls_tab();

        /*hover tab*/
        $this->start_controls_tab(
        	'course_carousel_dots_hover_tab',
        	[
        		'label' => __('Hover','tutor-elementor-addons')
        	]
        ); 

	        $this->add_control(
	            'course_carousel_dots_fill_hover_color',
	            [
	                'label'     => __('Fill Color', 'tutor-elementor-addons'),
	                'type'      => Controls_Manager::COLOR,
	                'selectors' => [
						$wrapper.".slick-dots li button:hover:before" => 'color: {{VALUE}}',
					],
	            ]
	        );	

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();
		//dots style section end
	}

	protected function render(){
		ob_start();
		$settings = $this->get_settings_for_display();

		include_once etlms_get_template('course/course-carousel');
		echo ob_get_clean();
	}

}