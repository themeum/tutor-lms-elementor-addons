<?php

/**
 * Template for displaying course instructors/instructor
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 */

// Settings from elementor
$show_profile_picture 	= $settings['course_instructor_profile'];
$display_name         	= $settings['course_instructor_name'];
$designation          	= $settings['course_instructor_designation'];
$profile_link         	= $settings['course_instructor_link'];
$target_blank         	= ( $settings['course_instructor_link'] == 'new_window' ) ? 'target="_blank"' : '';
$border_radius        	= $settings['course_instructors_avatar_border_radius'];
$instructors 			= tutor_utils()->get_instructors_by_course();
?>

<?php do_action( 'tutor_course/single/enrolled/before/instructors' ); ?>

<?php if($instructors && count($instructors)) : ?>
	<div class="etlms-course-instructors">
		<h3 class="etlms-course-instructor-title tutor-fs-5 tutor-fw-bold tutor-color-black tutor-mb-24">
			<?php echo esc_html( $settings['about_the_instructors_title'], 'tutor-lms-elementor-addons' ); ?>
		</h3>

		<?php foreach($instructors as $instructor): ?>
			<div class="tutor-card etlms-card tutor-mb-32">
				<div class="tutor-card-body">
					<div class="tutor-d-flex">
						<?php if ( $show_profile_picture == 'yes' ) : ?>
							<div class="tutor-mr-16">
								<?php echo tutor_utils()->get_tutor_avatar($instructor->ID, 'md'); ?>
							</div>
						<?php endif; ?>

						<div>
							<?php if ( $display_name == 'yes' ) : ?>
							<div class="etlms-instructor-name tutor-fs-6 tutor-fw-medium">
								<a class="tutor-color-black" href="<?php echo tutor_utils()->profile_url($instructor->ID, true); ?>"><?php echo $instructor->display_name; ?></a>
							</div>
							<?php endif; ?>
							
							<?php if ( 'yes' === $designation && ! empty( $instructor->tutor_profile_job_title ) ) : ?>
								<div class="etlms-instructor-designation tutor-fs-7 tutor-color-muted tutor-break-word tutor-mt-4">
									<?php echo esc_html( $instructor->tutor_profile_job_title ); ?>
								</div>
							<?php endif; ?>

							<?php if ( 'yes' === $settings['course_instructor_bio'] ) : ?>
								<div class="etlms-instructor-bio tutor-fs-6 tutor-color-secondary tutor-mt-20">
									<?php echo tutor_utils()->clean_html_content( $instructor->tutor_profile_bio ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="tutor-card-footer">
					<div class="tutor-row">
						<div class="tutor-col tutor-mb-12 tutor-mb-md-0">
							<?php 
								$instructor_rating = tutor_utils()->get_instructor_ratings( $instructor->ID );
								tutor_utils()->star_rating_generator_v2( $instructor_rating->rating_avg, $instructor_rating->rating_count, true ); 
							?>
						</div>
						<div class="tutor-col-md-auto">
							<div class="tutor-meta">
								<div>
									<span class="etlms-meta-icon tutor-icon-user-line tutor-meta-icon tutor-color-black" area-hidden="true"></span>
									<span class="tutor-meta-value">
										<?php echo tutor_utils()->get_total_students_by_instructor($instructor->ID); ?>
									</span>
									<span class="tutor-meta-key">
										<?php _e('Students', 'tutor'); ?>
									</span>
								</div>
								
								<div>
									<span class="etlms-meta-icon tutor-icon-mortarboard tutor-meta-icon tutor-color-black" area-hidden="true"></span>
									<span class="tutor-meta-value">
										<?php echo tutor_utils()->get_course_count_by_instructor($instructor->ID); ?>
									</span>
									<span class="tutor-meta-key">
										<?php _e('Courses', 'tutor'); ?>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php do_action( 'tutor_course/single/enrolled/after/instructors' ); ?>