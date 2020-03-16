<?php
/**
 * Course Last Update
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseLastUpdate extends BaseAddon
{
    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_title()
    {
        return __('Course Last Update', 'tutor-elementor-addons');
    }

    protected function register_content_controls()
    {
    }
    
    protected function register_style_controls()
    {
        $selector = "{{WRAPPER}} .tutor-single-course-meta-last-update";
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
					$selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_last_update_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector,
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = [])
    {
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo '<div class="tutor-single-course-meta-last-update">April 9, 2020</div>';
        } else {
            $disable_update_date = get_tutor_option('disable_course_update_date');
            if(!$disable_update_date) {
                $markup = '';
                $markup .= "<div class='tutor-single-course-meta-last-update'>";
                $markup .= esc_html(get_the_modified_date());
                $markup .= "</div>";
                echo $markup;
            }
        }
    }
}
