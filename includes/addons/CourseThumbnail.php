<?php
/**
 * Course Thumbnail
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseThumbnail extends BaseAddon {

    public function get_title() {
        return __('Course Thumbnail', 'tutor-lms-elementor-addons');
    }

    /**
	 * Dependent scripts
	 *
	 * @return array, contains name of dependent script
	 */
	public function get_script_depends() {
		return array(
			'etlms-course-topics',
		);
	}
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-thumbnail';

        /* Style */
        $this->start_controls_section(
            'course_thumbnail_style_section',
            [
                'label' => __('Style', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* Start Tabs */
        $this->start_controls_tabs('course_thumbnail_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_tags_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_group_control(
                    Group_Control_Css_Filter::get_type(),
                    [
                        'label' => __('CSS Filters','tutor-lms-elementor-addons'),
                        'name' => 'course_normal_thumbnail_filter',
                        'selector' => $selector,
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
                        'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'default' => [
                            'top' => 8,
                            'right' => 8,
                            'bottom' => 8,
                            'left' => 8,
                            'unit' => 'px',
                            'isLinked' => true
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'course_normal_thumbnail_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
                        'selector' => $selector,
                    ]
                );

            $this->end_controls_tab();

            /* Hovered Thumbnails */
            $hover_selector = $selector.':hover';
            $this->start_controls_tab(
                'course_hovered_thumbnail_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Css_Filter::get_type(),
                    [
                        'label' => __('CSS Filters','tutor-lms-elementor-addons'),
                        'name' => 'course_hover_thumbnail_filter',
                        'selector' => $selector.':hover',
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
                        'label' => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            $hover_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'course_hovered_thumbnail_box_shadow',
                        'label' => __( 'Box Shadow', 'tutor-lms-elementor-addons' ),
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
            echo "<div class='tutor-course-thumbnail tutor-course-details-page'>";
            if(tutils()->has_video_in_single()){
                tutor_course_video();
            } else{
                get_tutor_course_thumbnail();
            }
            echo '</div>';
        }
    }
}
