<?php
/**
 * Course Author Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseAuthor extends BaseAddon {

    use \TutorLMS\Elementor\AddonsTrait;

    private static $prefix_class_layout = "elementor-layout-";
    private static $prefix_class_alignment = "elementor-align-"; 

    public function get_title() {
        return __('Course Author', 'tutor-lms-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_author_content',
            [
                'label' => __('General Settings', 'tutor-lms-elementor-addons'),
            ]
        );

        $this->add_control(
			'course_author_picture',
			[
				'label' => __( 'Profile Picture', 'tutor-lms-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'course_author_name',
			[
				'label' => __( 'Display Name', 'tutor-lms-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off' => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->add_control(
            'course_author_link',
            [
                'label'   => __('Link', 'tutor-lms-elementor-addons'),
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
            $this->etlms_layout() //alignment
        );
        
        $this->add_responsive_control(
            'course_author_align',
            $this->etlms_alignment() //alignment
        );

        $this->end_controls_section();
	}
    
    protected function register_style_controls() {
        //Section Image
        $this->start_controls_section(
            'course_author_image_section',
            [
                'label' => __('Image', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $img_selector = '.etlms-author .tutor-single-course-avatar a';
        $this->add_responsive_control(
            'image_size',
            [
                'label' => __( 'Size', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 16,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    $img_selector.' span, '.$img_selector.' img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}}/2)',
                ],
                'default' => [
					'size' => 26,
				]
            ]
        );

        $this->add_responsive_control(
            'image_gap',
            [
                'label' => __( 'Gap', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '.elementor-layout-left '. $img_selector.' span, .elementor-layout-left '.$img_selector.' img' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '.elementor-layout-up '. $img_selector.' span, .elementor-layout-up '.$img_selector.' img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
					'size' => 5,
				],
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'tutor-lms-elementor-addons' ),
				'selector' => $img_selector.' span, '.$img_selector.' img',
			]
        );

        $this->add_control(
            'image_radius',
            [
                'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    $img_selector.' span, '.$img_selector.' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => '%',
                    'isLinked' => true
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'add_to_cart_btn_normal_box_shadow',
                'label' => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
                'selector' => $img_selector.' span, '.$img_selector.' img',
            ]
        );

        $this->end_controls_section();

        //Section Label
        $author_selector = '{{WRAPPER}} .etlms-author .tutor-single-course-author-name';
        $this->start_controls_section(
            'course_author_label_section',
            [
                'label' => __('Label', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_author_label_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
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
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $author_selector.' span',
            ]
        );
        $this->end_controls_section();

        //Section Name
        $this->start_controls_section(
            'course_author_name_section',
            [
                'label' => __('Name', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_author_name_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$author_selector.' a' => 'color: {{VALUE}}',
                ],
                'default'   => '#161616'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_author_name_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $author_selector.' a',
                'scheme'    => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $disable_course_author = (bool) get_tutor_option('disable_course_author');

        if ($disable_course_author) {
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo __('Please enable course author from tutor settings', 'tutor-lms-elementor-addons');
            }
            return;
        }

        $course = etlms_get_course();
        if ($course) {
            ob_start();
            $settings = $this->get_settings_for_display();
            include etlms_get_template('course/author');
            echo ob_get_clean();
        }
    }
}
