<?php
/**
 * TutorLMS Elementor Traits
 *
 * @category   Elementor
 * @package    TutorLMS_Addons
 * @author     Themeum <www.themeum.com>
 * @copyright  2020 Themeum <www.themeum.com>
 * @version    Release: @1.0.0
 * @since      1.0.0
 */

namespace TutorLMS\Elementor;

defined('ABSPATH') || exit;

trait AddonsTrait {
	
	/**
	 * default_layout optional default value left 
	 * @return return layout options for left,up
	 */
	public function etlms_layout($default_layout = 'left') {
		return [
			'label' => __('Layout', 'tutor-lms-elementor-addons'),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __('Left', 'tutor-lms-elementor-addons'),
					'icon' => 'eicon-h-align-left',
				],
				'up' => [
					'title' => __('Up', 'tutor-lms-elementor-addons'),
					'icon' => 'eicon-v-align-top'
				]

			],
			'prefix_class' => self::$prefix_class_layout . '%s',
			'default' => $default_layout,

			'toggle' => false
		];
	}

	/**
	 * default_layout optional default value left 
	 * @return layout options for left,right,center
	 */
	public function etlms_alignment($default_alignment = 'left') {
		return [
			'label'        => __('Alignment', 'tutor-lms-elementor-addons'),
			'type'         => \Elementor\Controls_Manager::CHOOSE,
			'options'      => [
				'left'   => [
					'title' => __('Left', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __('Center', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __('Right', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-right'
				]
			],
			'prefix_class' => self::$prefix_class_alignment . '%s',
			'default'      => $default_alignment,
		];
	}

	//icon left right alignment
	public function etlms_icon_align($prefix_class, $default_layout = 'right') {
		return [
			'label' => __('Icon Position', 'tutor-lms-elementor-addons'),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __('Left', 'tutor-lms-elementor-addons'),
					'icon' => 'eicon-h-align-left',
				],
				'right' => [
					'title' => __('Right', 'tutor-lms-elementor-addons'),
					'icon' => 'eicon-h-align-right'
				]

			],
			'prefix_class' => $prefix_class . '%s',
			'default' => $default_layout,

			'toggle' => false
		];
	}

	public function etlms_align_with_justify($default_alignment = 'left') {
		return [
			'label'        => __('Alignment', 'tutor-lms-elementor-addons'),
			'type'         => \Elementor\Controls_Manager::CHOOSE,
			'options'      => [
				'left'   => [
					'title' => __('Left', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __('Center', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __('Right', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-right'
				],
				'justify'  => [
					'title' => __('Justified', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-justify'
				]
			],
			'prefix_class' => self::$prefix_class_alignment . '%s',
			'default'      => $default_alignment
		];
	}

	public function etlms_non_responsive_layout($default_layout = 'left') {
		return [
			'label' => __('Layout', 'tutor-lms-elementor-addons'),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __('Left', 'tutor-lms-elementor-addons'),
					'icon' => 'eicon-h-align-left',
				],
				'up' => [
					'title' => __('Center', 'tutor-lms-elementor-addons'),
					'icon' => 'eicon-v-align-top'
				]

			],
			'prefix_class' => self::$prefix_class_layout,
			'default' => $default_layout,

			'toggle' => false
		];
	}

	public function etlms_non_responsive_alignment($default_alignment = 'left') {
		return [
			'label'        => __('Alignment', 'tutor-lms-elementor-addons'),
			'type'         => \Elementor\Controls_Manager::CHOOSE,
			'options'      => [
				'left'   => [
					'title' => __('Left', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __('Center', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __('Right', 'tutor-lms-elementor-addons'),
					'icon'  => 'fa fa-align-right'
				]
			],
			'prefix_class' => self::$prefix_class_alignment,
			'default'      => $default_alignment
		];
	}
}
