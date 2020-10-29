<?php

namespace TutorLMS\Elementor\Addons;

trait ETLMS_Trait{

	/*
		*default_layout optional default value left 
		*return layout options for left,up
		*prefix class based on property
	*/
	public function etlms_layout($default_layout='left'){

        return    
        [
            'label' => __( 'Layout', 'tutor-elementor-addons' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __( 'Left', 'tutor-elementor-addons' ),
                    'icon' => 'fa fa-long-arrow-left',
                ],
                'up' => [
                    'title' => __( 'Center', 'tutor-elementor-addons' ),
                    'icon' => 'fa fa-long-arrow-up',
                ]

            ],
            'prefix_class' => self::$prefix_class_layout,
            'default' => $default_layout,
            'toggle' => false
        ];
	}

	/*
		*default_layout optional default value left 
		*return layout options for left,right,center
		*prefix class based on property
	*/
	public function etlms_alignment($default_alignment='left'){

		return 
		[
		    'label'        => __('Alignment', 'tutor-elementor-addons'),
		    'type'         => \Elementor\Controls_Manager::CHOOSE,
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
		            'icon'  => 'fa fa-align-right',
		        ],
		    ],
		    'prefix_class' => self::$prefix_class_alignment,
		    'default'      => $default_alignment,				
		];	
	}	
}