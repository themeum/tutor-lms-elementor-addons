<?php
/**
 * Course Author Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseAuthor extends BaseAddon
{
    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_title()
    {
        return __('Course Author', 'tutor-elementor-addons');
    }

    protected function register_content_controls()
    {
    }
    
    protected function register_style_controls()
    {
        //Section Image
        $this->start_controls_section(
            'course_author_image_section',
            [
                'label' => __('Image', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $img_selector = "{{WRAPPER}} .tutor-single-course-avatar a span";
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
        $author_selector = "{{WRAPPER}} .tutor-single-course-author-meta .tutor-single-course-author-name";
        $this->end_controls_section();
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

    protected function render($instance = [])
    {
        ob_start();
        include_once etlms_get_template('course/author');
        echo ob_get_clean();
    }
}
