<?php

/**
 * Template for displaying course instructors/ instructor
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 */

$instructors = tutor_utils()->get_instructors_by_course();

// settings from elementor
$show_profile_picture = $settings['course_instructor_profile'];
$display_name         = $settings['course_instructor_name'];
$designation          = $settings['course_instructor_designation'];
$profile_link         = $settings['course_instructor_link'];
$target_blank         = ( $settings['course_instructor_link'] == 'new_window' ) ? 'target="_blank"' : '';
$border_radius        = $settings['course_instructors_avatar_border_radius'];

if ( $instructors ) {
	do_action( 'tutor_course/single/enrolled/before/instructors' );
	?>
	<div class="etlms-single-instructor-wrap tutor-mt-32">
		<div class="etlms-course-instructor-title tutor-color-text-primary tutor-text-medium-h6 tutor-mb-25">
			<span><?php echo esc_html( $settings['about_the_instructors_title'], 'tutor-lms-elementor-addons' ); ?></span>
		</div>
		<div class="tutor-instructor-info-card tutor-mb-15 etlms-course-instructors-wrap" id="single-course-ratings">
			<?php
			foreach ( $instructors as $instructor ) {
				$profile_url = ( $profile_link != 'none' ) ? tutor_utils()->profile_url( $instructor->ID ) : '';
				?>
				<div class="single-instructor-wrap etlms-single-instructor-wrap">
					<div class="single-instructor-top">
						<div class="tutor-instructor-left">
							<?php if ( $show_profile_picture == 'yes' ) : ?>
								<div class="instructor-avatar">
									<a href="<?php echo esc_url( $profile_url ); ?>" <?php echo esc_attr( $target_blank ); ?>>
										<?php echo get_avatar( $instructor->ID ); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
						<div class="tutor-instructor-right">
							<div class="instructor-name">
								<?php if ( $display_name == 'yes' ) : ?>
									<h3><a href="<?php echo $profile_url; ?>"><?php echo $instructor->display_name; ?></a> </h3>
								<?php endif; ?>
								<?php
								if ( $designation == 'yes' && ! empty( $instructor->tutor_profile_job_title ) ) {
									echo "<p>{$instructor->tutor_profile_job_title}</p>";
								}
								?>
							</div>
							<div class="instructor-bio">
								<?php echo $instructor->tutor_profile_bio; ?>
							</div>
						</div>
					</div>

					<?php
					$instructor_rating = tutor_utils()->get_instructor_ratings( $instructor->ID );
					?>
					<!-- new single instructor bottom info  -->
					<div class="tutor-instructor-info-card-footer tutor-d-sm-flex tutor-align-items-center tutor-justify-content-between tutor-px-30 tutor-py-15">
						<?php
							$instructor_rating = tutor_utils()->get_instructor_ratings( $instructor->ID );
							tutor_utils()->star_rating_generator_v2( $instructor_rating->rating_avg, $instructor_rating->rating_count, true );
						?>
						<div class="tutor-ins-meta tutor-d-flex">
							<div class="tutor-ins-meta-item tutor-color-design-dark flex-center">
								<span class="tutor-icon-30 tutor-icon-user-filled"></span>
								<span class="text-bold-body tutor-color-text-primary tutor-mr-4">
									<?php echo esc_html( tutor_utils()->get_total_students_by_instructor( $instructor->ID ) ); ?>
								</span>
								<span class="text-regular-caption tutor-color-text-subsued">
									<?php esc_html_e( 'Students', 'tutor-lms-elementor-addons' ); ?>
								</span>
							</div>
							<div class="tutor-ins-meta-item tutor-color-design-dark flex-center ">
								<span class="tutor-icon-30 tutor-icon-mortarboard-line"></span>
								<span class="text-bold-body tutor-color-text-primary tutor-mr-4">
									<?php echo esc_html( tutor_utils()->get_course_count_by_instructor( $instructor->ID ) ); ?>
								</span>
								<span class="text-regular-caption tutor-color-text-subsued">
									<?php esc_html_e( 'Courses', 'tutor-lms-elementor-addons' ); ?>
								</span>
							</div>
						</div>
					</div>
					<!-- new single instructor bottom info end -->
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

do_action( 'tutor_course/single/enrolled/after/instructors' );
