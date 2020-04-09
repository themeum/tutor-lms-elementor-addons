<?php
/**
 * Course Categories Addon
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseCategories extends BaseAddon {

    public function get_title() {
        return __('Course Categories', 'tutor-lms-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-single-course-meta-categories a';
        $this->start_controls_section(
            'course_categories_style_section',
            [
                'label' => __('Style', 'tutor-lms-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //* Start Tabs */
        $this->start_controls_tabs('course_thumbnail_style_tabs');
            /* Normal Tab */
            $this->start_controls_tab(
                'course_categories_normal_style_tab',
                [
                    'label' => __( 'Normal', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_categories_original_color',
                    [
                        'label'     => __('Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $selector => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'      => 'course_categories_original_typo',
                        'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                        'selector'  => $selector,
                    ]
                );
            $this->end_controls_tab();

            /* Hovered Icon */
            $this->start_controls_tab(
                'course_categories_hover_style_tab',
                [
                    'label' => __( 'Hover', 'tutor-lms-elementor-addons' ),
                ]
            );
                $this->add_control(
                    'course_categories_hovered_color',
                    [
                        'label'     => __('Color', 'tutor-lms-elementor-addons'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            $selector.':hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'      => 'course_categories_hovered_typo',
                        'label'     => __('Typography', 'tutor-lms-elementor-addons'),
                        'selector'  => $selector.':hover',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo '<div class="tutor-single-course-meta-categories"><a href="#">'. __('Course Categories', 'tutor-lms-elementor-addons') . '</a></div>';
        } else {
            $course_categories = get_tutor_course_categories();
            if(is_array($course_categories) && count($course_categories)) {
                $markup = '<div class="tutor-single-course-meta-categories">';
                    foreach ($course_categories as $course_category) {
                        $category_name = $course_category->name;
                        $category_link = get_term_link($course_category->term_id);
                        $markup .= " <a href='$category_link'>$category_name</a>";
                    }
                $markup .= "</div>";
                echo $markup;
            }
        }
    }
}
