<?php
/**
 * Template for displaying course ratings
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

?>
<div class="tutor-course-details-ratings etlms-rating">
	<span class="tutor-ratings">
	<?php
		$course_rating = tutor_utils()->get_course_rating();
		tutor_utils()->star_rating_generator( $course_rating->rating_avg );
	?>
		<span class="tutor-ratings-count">
			<?php
			printf(
				// translators: 1: rating average, 2: number of ratings.
				esc_html( _n( '%1$s (%2$s Rating)', '%1$s (%2$s Ratings)', (int) $course_rating->rating_count, 'tutor-lms-elementor-addons' ) ),
				esc_html( $course_rating->rating_avg ),
				(int) $course_rating->rating_count
			);
			?>
		</span>
	</span>
</div>
