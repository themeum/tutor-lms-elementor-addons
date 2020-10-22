<?php
/**
 * Course Author Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseAuthor extends BaseAddon {

    public function get_title() {
        return __('Course Author', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_author_content',
            [
                'label' => __('General Settings', 'tutor-elementor-addons'),
            ]
        );

        $this->add_control(
			'course_author_picture',
			[
				'label' => __( 'Profile Picture', 'tutor-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'course_author_name',
			[
				'label' => __( 'Display Name', 'tutor-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->add_control(
            'course_author_link',
            [
                'label'   => __('Link', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None', 
                    'new_window' => 'New Window', 
                    'same_window' => 'Same Window',
                ],
                'default' => 'new_window',
            ]
        );

        $this->add_responsive_control(
            'course_author_layout',
            [
                'label'        => __('Layout', 'tutor-elementor-addons'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'tutor-elementor-addons'),
                        'icon'  => 'fa fa-long-arrow-left',
                    ],
                    'up' => [
                        'title' => __('Center', 'tutor-elementor-addons'),
                        'icon'  => 'fa fa-long-arrow-up',
                    ],
                ],
                'prefix_class' => 'etlms-author-layout-%s',
                'default'      => 'left',
            ]
        );
        
        $this->add_responsive_control(
            'course_author_align',
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
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-align-%s',
                'default'      => 'left',
            ]
        );

        $this->end_controls_section();
	}
    
    protected function register_style_controls() {
        //Section Image
        $this->start_controls_section(
            'course_author_image_section',
            [
                'label' => __('Image', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $img_selector = '{{WRAPPER}} .tutor-single-course-avatar a span';
        $this->add_control(
            'image_width',
            [
                'label' => __( 'Width', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $img_selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_height',
            [
                'label' => __( 'Height', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $img_selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Section Label
        $author_selector = '{{WRAPPER}} .tutor-single-course-author-meta .tutor-single-course-author-name';
        $this->start_controls_section(
            'course_author_label_section',
            [
                'label' => __('Label', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_author_label_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$author_selector.' span' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_author_label_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $author_selector.' span',
            ]
        );
        $this->end_controls_section();

        //Section Name
        $this->start_controls_section(
            'course_author_name_section',
            [
                'label' => __('Name', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_author_name_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$author_selector.' a' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_author_name_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $author_selector.' a',
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        ob_start();
        $course = etlms_get_course();
        if ($course) {
            $settings = $this->get_settings_for_display();
            include_once etlms_get_template('course/author');
        }
        echo ob_get_clean();
    }
}
