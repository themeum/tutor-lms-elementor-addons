<div class="tutor-course-details-ratings etlms-rating">
    <span class="tutor-ratings">
        <?php
        $course_rating = tutor_utils()->get_course_rating();
        tutor_utils()->star_rating_generator($course_rating->rating_avg);
        ?>
        <span class="tutor-ratings-count">
            <?php
            echo $course_rating->rating_avg;
            echo '(' . $course_rating->rating_count .' '. __( 'Ratings', 'tutor-lms-elementor-addons' ) . ')';
            ?>
        </span>
    </span>
</div>