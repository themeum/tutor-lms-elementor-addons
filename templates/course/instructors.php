<?php

/**
 * Template for displaying course instructors/instructor
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 */

// Settings from Elementor.
$title 					= $settings['about_the_instructors_title'];
$show_profile_picture 	= $settings['course_instructor_profile'];
$display_name         	= $settings['course_instructor_name'];
$designation          	= $settings['course_instructor_designation'];
$profile_link         	= $settings['course_instructor_link'];
$target_blank         	= ( $settings['course_instructor_link'] == 'new_window' ) ? 'target="_blank"' : '';
$border_radius        	= $settings['course_instructors_avatar_border_radius'];
$instructors 			= tutor_utils()->get_instructors_by_course();
$is_enabled = tutor_utils()->get_option( 'display_course_instructors' );
do_action( 'tutor_course/single/enrolled/before/instructors' );

$instructors = tutor_utils()->get_instructors_by_course();

?>

<?php if ( $instructors && count( $instructors ) && $is_enabled ) : ?>
<div class="tutor-course-details-instructors etlms-course-instructors">
	<h3 class="tutor-fs-6 tutor-fw-medium tutor-color-black tutor-mb-16">
		<?php echo esc_html( $title ); ?>
	</h3>

	<?php foreach ( $instructors as $key => $instructor ) : ?>
		<div class="tutor-d-flex tutor-align-center<?php echo ( $key != count( $instructors ) - 1 ) ? ' tutor-mb-24' : ''; ?>">
			<?php if ( 'yes' === $show_profile_picture ) : ?>
				<div class="tutor-d-flex tutor-mr-16">
					<?php echo tutor_utils()->get_tutor_avatar( $instructor->ID, 'md' ); ?>
				</div>
			<?php endif; ?>
			<div>
				<?php if ( 'yes' === $display_name ) : ?>
					<a class="tutor-instructor-name tutor-fs-6 tutor-fw-bold tutor-color-black" href="<?php echo tutor_utils()->profile_url( $instructor->ID, true ); ?>" target="<?php echo esc_attr( $profile_link ); ?>">
						<?php echo esc_html( $instructor->display_name ); ?>
					</a>
				<?php endif; ?>
				<?php if ( 'yes' === $designation && ! empty( $instructor->tutor_profile_job_title ) ) : ?>
					<div class="tutor-instructor-designation tutor-fs-7 tutor-color-muted">
						<?php echo $instructor->tutor_profile_job_title; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
<?php endif;

do_action( 'tutor_course/single/enrolled/after/instructors' );