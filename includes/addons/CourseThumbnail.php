<?php
/**
 * Course Thumbnail
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseThumbnail extends BaseAddon
{
    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_title()
    {
        return __('Thumbnail', 'tutor-elementor-addons');
    }

    protected function register_content_controls()
    {
    }
    
    protected function register_style_controls()
    {
        $selector = ".tutor-single-course-meta-last-update";
        $this->start_controls_section(
            'course_last_update_section',
            [
                'label' => __('Style', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_last_update_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} '.$selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_last_update_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => '{{WRAPPER}} '.$selector,
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
