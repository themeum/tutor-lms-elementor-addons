<?php
/**
 * Course Thumbnail
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseThumbnail extends BaseAddon {

    public function get_title() {
        return __('Course Thumbnail', 'tutor-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-thumbnail';

        /* Style */
        $this->start_controls_section(
            'course_thumbnail_style_section',
            [
                'label' => __('Style', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Start Tabs */
        $this->start_controls_tabs('course_thumbnail_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_tags_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_normal_thumbnail_border',
                        'selector' => $selector
                    ]
                );

                $this->add_responsive_control(
                    'course_normal_thumbnail_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selector' => $selector
                    ]
                );

                $this->add_responsive_control(
                    'course_normal_thumbnail_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'course_normal_thumbnail_margin',
                    [
                        'label' => __( 'Margin', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'course_normal_thumbnail_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $selector,
                    ]
                );

            $this->end_controls_tab();

            /* Hovered Thumbnails */
            $hover_selector = $selector.':hover';
            $this->start_controls_tab(
                'course_hovered_thumbnail_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-elementor-addons' ),
                ]
            );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'course_hovered_thumbnail_border',
                        'selector' => $hover_selector
                    ]
                );

                $this->add_responsive_control(
                    'course_hovered_thumbnail_border_radius',
                    [
                        'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selector' => $hover_selector
                    ]
                );

                $this->add_responsive_control(
                    'course_hovered_thumbnail_padding',
                    [
                        'label' => __( 'Padding', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $hover_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'course_hovered_thumbnail_margin',
                    [
                        'label' => __( 'Margin', 'tutor-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em' ],
                        'selectors' => [
                            $hover_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'course_hovered_thumbnail_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
                        'selector' => $hover_selector,
                    ]
                );
            $this->end_controls_tab();

        $this->end_controls_tabs();
        /* End Tabs */

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        $course = etlms_get_course();
        if ($course) {
            echo "<div class='tutor-course-thumbnail'>";
            if(tutils()->has_video_in_single()){
                tutor_course_video();
            } else{
                get_tutor_course_thumbnail();
            }
            echo '</div>';
        }
    }
}
