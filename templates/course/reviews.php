<?php
do_action('tutor_course/single/enrolled/before/reviews');
?>

<div class="etlms-course-reviews">
    <div class="course-student-rating-title">
        <h4 class="tutor-segment-title"><?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h4>
    </div>
    <div class="tutor-course-reviews-wrap">

        <?php
        $reviews = tutor_utils()->get_course_reviews();
        if (is_array($reviews) && count($reviews)) { ?>

            <div class="tutor-course-student-rating-wrap">
                <div class="course-avg-rating-wrap">
                    <div class="tutor-row tutor-align-items-center">
                        <div class="tutor-col-auto">
                            <p class="course-avg-rating">
                                <?php
                                $rating = tutor_utils()->get_course_rating();
                                echo number_format($rating->rating_avg, 1);
                                ?>
                            </p>
                            <p class="course-avg-rating-html">
                                <?php tutor_utils()->star_rating_generator($rating->rating_avg); ?>
                            </p>
                            <p class="tutor-course-avg-rating-total">Total <span><?php echo $rating->rating_count; ?></span> Ratings</p>

                        </div>
                        <div class="tutor-col">
                            <div class="course-ratings-count-meter-wrap">
                                <?php
                                foreach ($rating->count_by_value as $key => $value) {
                                    $rating_count_percent = ($value > 0) ? ($value  * 100) / $rating->rating_count : 0;
                                ?>
                                    <div class="course-rating-meter">
                                        <div class="rating-meter-col"><i class="tutor-icon-star-line"></i></div>
                                        <div class="rating-meter-col"><?php echo $key; ?></div>
                                        <div class="rating-meter-col rating-meter-bar-wrap">
                                            <div class="rating-meter-bar">
                                                <div class="rating-meter-fill-bar" style="width: <?php echo $rating_count_percent; ?>%;"></div>
                                            </div>
                                        </div>
                                        <div class="rating-meter-col rating-text-col">
                                            <?php
                                            echo $value . ' ';
                                            echo $value > 1 ? __('ratings', 'tutor-lms-elementor-addons') : __('rating', 'tutor-lms-elementor-addons'); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="etlms-course-reviews-list">
                <?php
                foreach ($reviews as $review) {
                    $profile_url = tutor_utils()->profile_url($review->user_id);
                ?>
                    <div class="etlms-review-individual-item tutor-review-<?php echo $review->comment_ID; ?>">
                        <div class="etlms-review-left">
                            <div class="etlms-review-avatar">
                                <a href="<?php echo $profile_url; ?>"> <?php echo tutor_utils()->get_tutor_avatar($review->user_id); ?> </a>
                            </div>
                            <div class="etlms-review-user-info">
                                <div class="review-time-name">
                                    <h4> <a href="<?php echo $profile_url; ?>"> <?php echo $review->display_name; ?> </a> </h4>
                                    <p class="review-meta">
                                        <?php echo sprintf(__('%s ago', 'tutor-lms-elementor-addons'), human_time_diff(strtotime($review->comment_date))); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="etlms-review-content">
                            <div class="individual-review-rating-wrap">
                                <?php tutor_utils()->star_rating_generator($review->rating); ?>
                            </div>
                            <?php echo wpautop(stripslashes($review->comment_content)); ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        <?php
        } else if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo __('Course review not found', 'tutor-lms-elementor-addons');
        }
        ?>

    </div>
</div>

<?php do_action('tutor_course/single/enrolled/after/reviews');

if (is_user_logged_in() && tutils()->is_enrolled()) {
    tutor_course_target_review_form_html();
}
?>