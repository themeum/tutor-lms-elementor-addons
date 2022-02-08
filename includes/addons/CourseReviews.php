<?php
/**
 * Course Reviews
 *
 * @since 1.0.0
 *
 * @package CourseReviews
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register content & styles controls
 */
class CourseReviews extends BaseAddon {

	/**
	 * Title of this addons
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Course Reviews', 'tutor-lms-elementor-addons' );
	}

	/**
	 * Content tab controls
	 *
	 * @return void
	 */
	protected function register_content_controls() {
		// reviews section.
		$this->start_controls_section(
			'reviews_section',
			array(
				'label' => __( 'Reviews', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'reviews_title',
				array(
					'label'       => __( 'Title', 'tutor-lms-elementor-addons' ),
					'type'        => Controls_Manager::TEXTAREA,
					'default'     => __( 'Student Ratings & Reviews', 'tutor-lms-elementor-addons' ),
					'placeholder' => __( 'Type your title here', 'tutor-lms-elementor-addons' ),
					'rows'        => 3,
				)
			);
		$this->end_controls_section();
	}

	/**
	 * Style tab controls
	 *
	 * @return void
	 */
	protected function register_style_controls() {
		/**
		 * Merge reviews style controls
		 */
		$review_selector       = '{{WRAPPER}} .tutor-ratingsreviews';
		$review_title_selector = '{{WRAPPER}} .tutor-course-topics-header-left .text-primary span';

		/* Title Section */
		$this->start_controls_section(
			'course_reviews_title_section',
			array(
				'label' => __( 'Review Section Title', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_reviews_title_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_title_selector => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_title_typo',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_title_selector,
			)
		);
		$this->add_responsive_control(
			'etlms_review_title_gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => -10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tutor-course-topics-header-left' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 8,
				),
			)
		);
		$this->end_controls_section();

		/* Review average section */
		$review_avg_section_selector     = $review_selector . ' .tutor-ratingsreviews-ratings-avg';
		$review_avg_text_selector        = $review_avg_section_selector . ' .tutor-rating-text-part';
		$review_avg_stars_selector       = $review_avg_section_selector . ' .tutor-rating-stars span';
		$review_avg_total_count_selector = $review_avg_section_selector . ' .tutor-rating-count-part';
		$this->start_controls_section(
			'course_rating_avg',
			array(
				'label' => __( 'Review Avg', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .text-medium-h1' => 'color: {{VALUE}};',
				),
				'default'   => '#161616',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .text-medium-h1',
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-stars span' => 'color: {{VALUE}};',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_stars_size',
			array(
				'label'      => __( 'Stars Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 64,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-stars span' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 18,
				),
			)
		);

		$this->add_control(
			'course_reviews_avg_rating_total_label_color',
			array(
				'label'     => __( 'Total Label Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-text-part' => 'color: {{VALUE}}',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_total_label_typo',
				'label'    => __( 'Total Label Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-text-part',
			)
		);
		$this->add_control(
			'course_reviews_avg_rating_total_count_color',
			array(
				'label'     => __( 'Total Count Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-count-part' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_reviews_avg_rating_total_count_typo',
				'label'    => __( 'Total Count Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-avg .tutor-rating-count-part',
			)
		);
		$this->end_controls_section();

		/* Review average right bar section */
		$review_right_wrapper = '{{WRAPPER}} .tutor-ratingsreviews-ratings-all';

		$this->start_controls_section(
			'review_avg_right_bar_main',
			array(
				'label' => __( 'Right Rating Bar', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'review_avg_right_bar_main_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' div.progress-bar' => 'background-color: {{VALUE}}',
				),
				'default'   => '#e3e5eb',
			)
		);
		$this->add_control(
			'review_avg_right_bar_main_fill_color',
			array(
				'label'     => __( 'Fill Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_right_wrapper . ' div.progress-bar .progress-value' => 'background-color: {{VALUE}}',
				),
				'default'   => '#ed9700',
			)
		);
		$this->add_control(
			'review_avg_right_bar_main_width',
			array(
				'label'      => __( 'Height', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$review_right_wrapper . ' div.progress-bar' => 'height: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 8,
				),
			)
		);

		// right rating star.
		$this->add_control(
			'review_avg_right_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .rating-progress .tutor-ratings .tutor-rating-stars span' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'review_avg_right_stars_size',
			array(
				'label'      => __( 'Star Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 64,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .rating-progress .tutor-ratings .tutor-rating-stars span' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				),
				'default'    => array(
					'size' => 18,
				),
			)
		);

		// right rating star end.

		// right rating star text.
		$this->add_control(
			'review_avg_right_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-ratingsreviews-ratings-all .rating-numbers .rating-num' => 'color: {{VALUE}};',
				),
				'default'   => '#525252',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'review_avg_right_text_typo',
				'label'    => __( 'Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tutor-ratingsreviews-ratings-all .rating-numbers .rating-num',
			)
		);
		// right rating star text end.

		$this->end_controls_section();
		/* Review list section */
		$review_list_section_selector = '{{WRAPPER}}' . ' .tutor-ratingsreviews-reviews';
		$this->start_controls_section(
			'review_list',
			array(
				'label' => __( 'Review list', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'review_list_image_width',
			array(
				'label'      => __( 'Image Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 20,
						'max' => 200,
					),
				),
				'selectors'  => array(
					$review_list_section_selector . ' img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}}/2)',
				),
				'default'    => array(
					'size' => 50,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'course_instructor_img_border',
				'selector' => $review_list_section_selector . ' img',
			)
		);

		$this->add_control(
			'course_reviews_avatar_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .etlms-course-instructor-avatar img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .etlms-course-instructor-avatar span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'selectors'  => array(
					$review_list_section_selector . ' img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'      => 50,
					'right'    => 50,
					'bottom'   => 50,
					'left'     => 50,
					'unit'     => '%',
					'isLinked' => true,
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'reviewer_name_color',
			array(
				'label'     => __( 'Name Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . '.tutor-reviewer-name' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#212327',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_name_typo',
				'label'    => __( 'Name Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} a.tutor-reviewer-name',
			)
		);
		$this->add_control(
			'reviewer_time_color',
			array(
				'label'     => __( 'Time Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-review-time' => 'color: {{VALUE}};',
				),
				'default'   => '#757C8E',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_time_typo',
				'label'    => __( 'Time Text Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_list_section_selector . ' .tutor-review-time',
			)
		);
		$this->add_control(
			'reviewer_stars_color',
			array(
				'label'     => __( 'Stars Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-rating-stars span' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'reviewer_rating_color',
			array(
				'label'     => __( 'Rating Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-ratings .tutor-rating-text.tutor-color-text-subsued' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#ED9700',
			)
		);
		$this->add_control(
			'reviewer_stars_size',
			array(
				'label'      => __( 'Stars Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 64,
					),
				),
				'selectors'  => array(
					$review_list_section_selector . ' .tutor-rating-stars span' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 14,
				),
			)
		);
		$this->add_control(
			'reviewer_content_color',
			array(
				'label'     => __( 'Comment Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$review_list_section_selector . ' .tutor-review-comment' => 'color: {{VALUE}}',
				),
				'default'   => '#5B616F',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_content_typo',
				'label'    => __( 'Comment Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $review_list_section_selector . ' .tutor-review-comment',
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Render content and show output
	 *
	 * @param array $instance | instance of addon.
	 *
	 * @return void
	 */
	protected function render( $instance = array() ) {
		$disable = ! (bool) get_tutor_option( 'enable_course_review' );
		if ( $disable ) {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				esc_html_e( 'Please enable course review from tutor settings', 'tutor-lms-elementor-addons' );
			}
			return;
		}

		global $wp_query;
		if ( empty( $wp_query->query_vars['course_subpage'] ) ) {
			$course = etlms_get_course();
			if ( $course ) {
				ob_start();
				$settings = $this->get_settings_for_display();
				// filter title from elementor.
				if ( '' !== $settings['reviews_title'] ) {
					add_filter(
						'tutor_course_reviews_section_title',
						function() use ( $settings ) {
							return esc_html( $settings['reviews_title'] );
						}
					);
				}
				include etlms_get_template( 'course/reviews' );
				$output = apply_filters( 'tutor_course/single/reviews_html', ob_get_clean() );
				// PHPCS - the variable $output holds safe data.
				echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
}
