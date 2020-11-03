<?php
/**
 * Course Materials
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseMaterials extends BaseAddon {

    public function get_title() {
        return __('Course Materials', 'tutor-elementor-addons');
    }

    protected function register_content_controls() {
		$this->start_controls_section(
            'course_materials_content',
            [
                'label' => __('General Settings', 'tutor-elementor-addons'),
            ]
        );

        $this->add_responsive_control(
            'course_material_layout',
            [
                'label'        => __('Layout', 'tutor-elementor-addons'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'list'   => [
                        'title' => __('List', 'tutor-elementor-addons'),
                        'icon'  => 'fa fa-list-ul',
                    ],
                    'inline' => [
                        'title' => __('Inline', 'tutor-elementor-addons'),
                        'icon'  => 'fa fa-ellipsis-h',
                    ],
                ],
                'prefix_class' => 'etlms-author-material-%s',
                'default'      => 'list',
            ]
        );
        
        $this->add_control(
			'course_material_list_icon',
			[
				'label' => __('Icon', 'tutor-elementor-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'solid',
				],
			]
		);

        $this->end_controls_section();
	}
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .etlms-course-specifications.etlms-course-materials';
        $title_selector = $selector.' h3';
        $content_selector = $selector.' .etlms-course-specification-items li';
        $icon_selector = $content_selector.' i';

        /* Title Section */
        $this->start_controls_section(
            'course_materials_title_section',
            [
                'label' => __('Section Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_materials_title_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$title_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_materials_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->end_controls_section();

        /* Icon  Section */
        $this->start_controls_section(
            'course_materials_icon_section',
            [
                'label' => __('Icon', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_materials_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$icon_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_materials_icon_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $icon_selector,
            ]
        );
        $this->end_controls_section();

        /* Content  Section */
        $this->start_controls_section(
            'course_materials_content_section',
            [
                'label' => __('Content', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_materials_content_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$content_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_materials_content_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $content_selector,
            ]
        );
        $this->end_controls_section();

        /* Spacing  Section */
        $this->start_controls_section(
            'course_materials_spacing_section',
            [
                'label' => __('Spacing', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_materials_padding',
            [
                'label' => __('Padding', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $content_selector.' li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'course_materials_margin',
            [
                'label' => __('Margin', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $content_selector.' li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        ob_start();
        $course = etlms_get_course();
        if ($course) {
            $settings = $this->get_settings_for_display();
            include_once etlms_get_template('course/materials');
        }
        echo ob_get_clean();
    }
}
