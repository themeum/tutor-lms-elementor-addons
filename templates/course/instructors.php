<?php

/**
 * Template for displaying course instructors/ instructor
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 */

$instructors = tutor_utils()->get_instructors_by_course();

//settings from elementor
$show_profile_picture = $settings['course_instructor_profile'];
$display_name = $settings['course_instructor_name'];
$designation = $settings['course_instructor_designation'];
$profile_link = $settings['course_instructor_link'];
$target_blank = ($settings['course_instructor_link'] == 'new_window') ? 'target="_blank"' : '';
$border_radius = $settings['course_instructors_avatar_border_radius'];

if ($instructors) {
	do_action('tutor_course/single/enrolled/before/instructors');
?>
	<div class="etlms-course-instructor-title">
		<h4 class="tutor-segment-title"><?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h4>
	</div>
	<div class="tutor-course-instructors-wrap tutor-single-course-segment etlms-course-instructors-wrap" id="single-course-ratings">
		<?php
		foreach ($instructors as $instructor) {
			$profile_url = ($profile_link != 'none') ? tutor_utils()->profile_url($instructor->ID) : ''; ?>
			<div class="single-instructor-wrap etlms-single-instructor-wrap">
				<div class="single-instructor-top">
					<div class="tutor-instructor-left">
						<?php if ($show_profile_picture == 'yes') : ?>
							<div class="instructor-avatar">
								<a href="<?php echo $profile_url; ?>" <?php echo $target_blank; ?>>
									<?php echo tutor_utils()->get_tutor_avatar($instructor->ID); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
					<div class="tutor-instructor-right">
						<div class="instructor-name">
							<?php if ($display_name == 'yes') : ?>
								<h3><a href="<?php echo $profile_url; ?>"><?php echo $instructor->display_name; ?></a> </h3>
							<?php endif; ?>
							<?php
							if ($designation == 'yes' && !empty($instructor->tutor_profile_job_title)) {
								echo "<p>{$instructor->tutor_profile_job_title}</p>";
							}
							?>
						</div>
						<div class="instructor-bio">
							<?php echo $instructor->tutor_profile_bio ?>
						</div>
					</div>
				</div>

				<?php
				$instructor_rating = tutor_utils()->get_instructor_ratings($instructor->ID);
				?>

				<div class="single-instructor-bottom">
					<div class="ratings">
						<span class="rating-generated">
							<?php tutor_utils()->star_rating_generator($instructor_rating->rating_avg); ?>
						</span>

						<?php
						echo " <span class='rating-digits'>{$instructor_rating->rating_avg}</span> ";
						echo " <span class='rating-total-meta'>({$instructor_rating->rating_count} ".__('ratings', 'tutor-lms-elementor-addons').")</span> ";
						?>
					</div>

					<div class="courses">
						<p>
							<i class='tutor-icon-mortarboard'></i>
							<?php echo tutor_utils()->get_course_count_by_instructor($instructor->ID); ?> <span class="tutor-text-mute"> <?php _e('Courses', 'tutor-lms-elementor-addons'); ?></span>
						</p>
					</div>

					<div class="students">
						<?php
						$total_students = tutor_utils()->get_total_students_by_instructor($instructor->ID);
						?>
						<p>
							<i class='tutor-icon-user'></i>
							<?php echo $total_students; ?>
							<span class="tutor-text-mute">  <?php _e('students', 'tutor-lms-elementor-addons'); ?></span>
						</p>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
	<?php
}

do_action('tutor_course/single/enrolled/after/instructors');