<?php
/**
 * Course Reviews
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseReviews extends BaseAddon {

    public function get_title() {
        return __('Course Reviews', 'tutor-elementor-addons');
    }
    
    protected function register_style_controls() {
        $selector = '{{WRAPPER}} .tutor-course-reviews';
        $title_selector = $selector.' .tutor-segment-title';

        /* Title Section */
        $this->start_controls_section(
            'course_reviews_title_section',
            [
                'label' => __('Section Title', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_reviews_title_color',
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
                'name'      => 'course_reviews_title_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $title_selector,
            ]
        );
        $this->end_controls_section();

        /* Review average section */
        $review_avg_section_selector = $selector." .course-avg-rating-wrap";
        $review_avg_text_selector = $review_avg_section_selector.' .course-avg-rating';
        $review_avg_stars_selector = $review_avg_section_selector." .tutor-star-rating-group";
        $review_avg_total_count_selector = $review_avg_section_selector.' .tutor-course-avg-rating-total';
        $this->start_controls_section(
            'course_rating_avg',
            [
                'label' => __('Review Avg', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_reviews_avg_rating_text_color',
            [
                'label'     => __('Text Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_text_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_reviews_avg_rating_text_typo',
                'label'     => __('Text Typography', 'tutor-elementor-addons'),
                'selector'  => $review_avg_text_selector,
            ]
        );
        $this->add_control(
            'course_reviews_avg_rating_stars_color',
            [
                'label'     => __('Stars Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_stars_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_control(
            'course_reviews_avg_rating_stars_size',
            [
                'label' => __( 'Stars Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $review_avg_stars_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_reviews_avg_rating_stars_typo',
                'label'     => __('Stars Typography', 'tutor-elementor-addons'),
                'selector'  => $review_avg_stars_selector,
            ]
        );
        $this->add_control(
            'course_reviews_avg_rating_total_label_color',
            [
                'label'     => __('Total Label Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_total_count_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_reviews_avg_rating_total_label_typo',
                'label'     => __('Total Label Typography', 'tutor-elementor-addons'),
                'selector'  => $review_avg_total_count_selector,
            ]
        );
        $this->add_control(
            'course_reviews_avg_rating_total_count_color',
            [
                'label'     => __('Total Count Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_total_count_selector.' span' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_reviews_avg_rating_total_count_typo',
                'label'     => __('Total Count Typography', 'tutor-elementor-addons'),
                'selector'  => $review_avg_total_count_selector.' span',
            ]
        );
        $this->end_controls_section();

        /* Review average right bar section */
        $review_avg_section_count_meter = $review_avg_section_selector.' .course-ratings-count-meter-wrap';
        $review_avg_right_bar_selector = $review_avg_section_count_meter.' .rating-meter-bar-wrap';
        $review_avg_right_bar_main_selector = $review_avg_right_bar_selector.' .rating-meter-bar';
        $review_avg_right_bar_fill_selector = $review_avg_right_bar_main_selector.' .rating-meter-fill-bar';
        $this->start_controls_section(
            'review_avg_right_bar_main',
            [
                'label' => __('Right Rating Bar', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'review_avg_right_bar_main_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_right_bar_main_selector => 'background-color: {{VALUE}}',
				],
            ]
        );
        $this->add_control(
            'review_avg_right_bar_main_fill_color',
            [
                'label'     => __('Fill Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_right_bar_fill_selector => 'background-color: {{VALUE}}',
				],
            ]
        );
        $this->add_control(
            'review_avg_right_bar_main_width',
            [
                'label' => __( 'Height', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $review_avg_right_bar_main_selector.', '.$review_avg_right_bar_fill_selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'review_avg_right_bar_main_padding',
            [
                'label' => __('Padding', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $review_avg_right_bar_main_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'review_avg_right_bar_main_margin',
            [
                'label' => __('Margin', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $review_avg_right_bar_main_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        $review_avg_right_stars_selector = $review_avg_section_count_meter.' .rating-meter-col i';
        $this->start_controls_section(
            'review_avg_right_stars',
            [
                'label' => __('Right Rating Stars', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'review_avg_right_stars_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_right_stars_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_control(
            'review_avg_right_stars_size',
            [
                'label' => __( 'Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $review_avg_right_stars_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'review_avg_right_text',
            [
                'label' => __('Right Rating Text', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'review_avg_right_text_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$review_avg_section_count_meter.' .rating-meter-col' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'review_avg_right_text_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $review_avg_section_count_meter.' .rating-meter-col',
            ]
        );
        $this->end_controls_section();

         /* Review list section */
         $review_list_section_selector = $selector.' .tutor-course-reviews-list';
         $reviewer_image_selector = $review_list_section_selector.' .review-avatar span';
         $reviewer_name_selector = $review_list_section_selector.' .review-time-name p:first-child a';
         $reviewer_time_selector = $review_list_section_selector.' .review-time-name p.review-meta';
         $reviewer_stars_selector = $review_list_section_selector.' .tutor-star-rating-group';
         $reviewer_content_selector = $review_list_section_selector.' .review-content p';
         $this->start_controls_section(
            'review_list',
            [
                'label' => __('Review list', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'review_list_image_width',
            [
                'label' => __( 'Image Width', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $reviewer_image_selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'review_list_image_height',
            [
                'label' => __( 'Image Height', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $reviewer_image_selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'reviewer_name_color',
            [
                'label'     => __('Name Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$reviewer_name_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'reviewer_name_typo',
                'label'     => __('Name Typography', 'tutor-elementor-addons'),
                'selector'  => $reviewer_name_selector,
            ]
        );
        $this->add_control(
            'reviewer_time_color',
            [
                'label'     => __('Time Text Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$reviewer_time_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'reviewer_time_typo',
                'label'     => __('Time Text Typography', 'tutor-elementor-addons'),
                'selector'  => $reviewer_time_selector,
            ]
        );
        $this->add_control(
            'reviewer_stars_color',
            [
                'label'     => __('Stars Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$reviewer_stars_selector.' i' => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_control(
            'reviewer_stars_size',
            [
                'label' => __( 'Stars Size', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    $reviewer_stars_selector => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'reviewer_content_color',
            [
                'label'     => __('Comment Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$reviewer_content_selector => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'reviewer_content_typo',
                'label'     => __('Comment Typography', 'tutor-elementor-addons'),
                'selector'  => $reviewer_content_selector,
            ]
        );
        $this->add_control(
            'review_list_padding',
            [
                'label' => __('Padding', 'tutor-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    $review_list_section_selector.' .tutor-review-individual-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = []) {
        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            ob_start();
            include_once etlms_get_template('course/reviews');
            echo ob_get_clean();
        } else {
            $disable_review = get_tutor_option('disable_course_review');
            if ( !$disable_review ) {
                echo '<div class="tutor-course-reviews">';
                    tutor_course_target_reviews_html();
                echo '</div>';
            }
        }
    }
}
