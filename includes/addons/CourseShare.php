<?php
/**
 * Course Share Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseShare extends BaseAddon
{
    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_title()
    {
        return __('Social Share', 'tutor-elementor-addons');
    }

    protected function register_content_controls()
    {
    }
    
    protected function register_style_controls()
    {
        $selector = ".tutor-single-course-meta .tutor-social-share";
        $icon_selector = $selector.' .tutor-social-share-wrap button';

        /* Label */
        $this->start_controls_section(
            'course_share_label_section',
            [
                'label' => __('Label', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_share_label_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} '.$selector.' span' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_share_label_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => '{{WRAPPER}} '.$selector.' span',
            ]
        );
        $this->end_controls_section();

        /* Original icons */
        $this->start_controls_section(
            'course_share_original_icon_section',
            [
                'label' => __('Original Icon', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_share_original_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} '.$icon_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_share_original_icon_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => '{{WRAPPER}} '.$icon_selector,
            ]
        );
        $this->end_controls_section();

        /* Hovered icons */
        $this->start_controls_section(
            'course_share_hovered_icon_section',
            [
                'label' => __('Hovered Icon', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_share_hovered_icon_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} '.$icon_selector.':hover' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_share_hovered_icon_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => '{{WRAPPER}} '.$icon_selector.':hover',
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = [])
    {
        ob_start();
        include_once etlms_get_template('course/share');
        echo ob_get_clean();
    }
}
