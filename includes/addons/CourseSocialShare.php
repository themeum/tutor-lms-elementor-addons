<?php
/**
 * Course Share Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseSocialShare extends BaseAddon {

    public function get_title() {
        return __('Course Social Share', 'tutor-lms-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-meta .tutor-social-share';
        $icon_selector = $selector.' .tutor-social-share-wrap button';

        /* Label */
        $this->start_controls_section(
            'course_share_label_section',
            [
                'label' => __('Label', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_share_label_color',
            [
                'label'     => __('Color', 'tutor-lms-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$selector.' span' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_share_label_typo',
                'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                'selector'  => $selector.' span',
            ]
        );
        $this->end_controls_section();

        /* Original icons */
        $this->start_controls_section(
            'course_social_share_icon_section',
            [
                'label' => __('Icon', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //* Start Tabs */
        $this->start_controls_tabs('course_thumbnail_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_social_share_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
                ]
            );
               
                $this->add_control(
                    'course_share_original_icon_color',
                    [
                        'label'     => __('Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $icon_selector => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'      => 'course_share_original_icon_typo',
                        'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                        'selector'  => $icon_selector,
                    ]
                );
            $this->end_controls_tab();

            /* Hovered Icon */
            $this->start_controls_tab(
                'course_social_share_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_share_hovered_icon_color',
                    [
                        'label'     => __('Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $icon_selector.':hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'      => 'course_share_hovered_icon_typo',
                        'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                        'selector'  => $icon_selector.':hover',
                    ]
                );
            $this->end_controls_tab();

        $this->end_controls_tabs();
        /* End Tabs */
        $this->end_controls_section();

        //Section Alignment
        $this->start_controls_section(
            'course_share_alignment_section',
            [
                'label' => __('Alignment', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'course_share_align',
            [
                'label'        => __('Alignment', 'tutor-lms-elementor-addons'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'flex-start'   => [
                        'title' => __('Left', 'tutor-lms-elementor-addons'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'tutor-lms-elementor-addons'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'  => [
                        'title' => __('Right', 'tutor-lms-elementor-addons'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'      => 'flex-end',
                'selectors' => [
					$selector => 'justify-content: {{VALUE}}',
				],
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        ob_start();
        include_once etlms_get_template('course/share');
        echo ob_get_clean();
    }
}
