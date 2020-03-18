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

class CourseThumbnail extends BaseAddon
{
    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_title()
    {
        return __('Course Thumbnail', 'tutor-elementor-addons');
    }
    
    protected function register_style_controls()
    {
        $selector = "{{WRAPPER}} .tutor-course-thumbnail";

        /* Original Thumbnails */
        $this->start_controls_section(
            'course_original_thumbnail_section',
            [
                'label' => __('Original Thumbnails', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'course_original_thumbnail_border',
                'selector' => $selector
            ]
        );

        $this->add_responsive_control(
            'course_original_thumbnail_border_radius',
            [
                'label' => __( 'Border Radius', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selector' => $selector
            ]
        );

        $this->add_responsive_control(
            'course_original_thumbnail_margin',
            [
                'label' => __( 'Margin', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selector' => $selector
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'course_original_thumbnail_box_shadow',
				'label' => __( 'Box Shadow', 'tutor-elementor-addons' ),
				'selector' => $selector,
			]
		);

        $this->end_controls_section();


        /* Hovered Thumbnails */
        $hover_selector = $selector.':hover';
        $this->start_controls_section(
            'course_hovered_thumbnail_section',
            [
                'label' => __('Hovered Thumbnails', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
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
            'course_hovered_thumbnail_margin',
            [
                'label' => __( 'Margin', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selector' => $hover_selector
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

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {
        echo "<div class='tutor-course-thumbnail'>";
            if(tutils()->has_video_in_single()){
                tutor_course_video();
            } else{
                get_tutor_course_thumbnail();
            }
        echo "</div>";
    }
}
