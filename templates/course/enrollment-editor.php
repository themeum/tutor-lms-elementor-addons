<?php
/**
 * Enrollment editor mode template
 *
 * @package Enrollment Widget
 */

$tutor_course_sell_by = apply_filters( 'tutor_course_sell_by', null );
$enrollment_mode      = $settings['course_enrolment_edit_mode'];

$sidebar_meta = apply_filters(
	'tutor/course/single/sidebar/metadata',
	array(
		array(
			'icon_class' => 'ttr-level-line',
			'label'      => __( 'Level', 'tutor' ),
			'value'      => get_tutor_course_level( get_the_ID() ),
		),
		array(
			'icon_class' => 'ttr-student-line-1',
			'label'      => __( 'Total Enrolled', 'tutor' ),
			'value'      => tutor_utils()->get_option( 'enable_course_total_enrolled' ) ? tutor_utils()->count_enrolled_users_by_course() : null,
		),
		array(
			'icon_class' => 'ttr-clock-filled',
			'label'      => __( 'Duration', 'tutor' ),
			'value'      => get_tutor_option( 'enable_course_duration' ) ? get_tutor_course_duration_context() : null,
		),
		array(
			'icon_class' => 'ttr-refresh-l',
			'label'      => __( 'Last Updated', 'tutor' ),
			'value'      => get_tutor_option( 'enable_course_update_date' ) ? tutor_get_formated_date( get_option( 'date_format' ), get_the_modified_date() ) : null,
		),
	),
	get_the_ID()
);
?>

<div class="tutor-course-sidebar-card">
	<!-- Course Entry -->
	<div class="tutor-course-sidebar-card-body tutor-p-30 <?php echo ! is_user_logged_in() ? 'tutor-course-entry-box-login' : ''; ?>">

		<?php
			$button_class = 'tutor-is-fullwidth tutor-btn tutor-is-outline tutor-btn-lg tutor-btn-full tutor-is-fullwidth tutor-course-retake-button tutor-mb-10';
		?>
			<?php if ( 'enrolled-box' === $enrollment_mode ) : ?>
			<a href="#" class="<?php echo esc_attr( $button_class ); ?>" data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
				<?php esc_html_e( 'Retake This Course', 'tutor' ); ?>
			</a>
			<a href="#" class="<?php echo esc_attr( $button_class ); ?>" data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
				<?php esc_html_e( 'Start Learning', 'tutor' ); ?>
			</a>
			<a href="#" class="<?php echo esc_attr( $button_class ); ?>" data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
				<?php esc_html_e( 'Continue Learning', 'tutor' ); ?>
			</a>

			<button type="submit" class="tutor-mt-25 tutor-btn tutor-btn-tertiary tutor-is-outline tutor-btn-lg tutor-btn-full" name="complete_course_btn" value="complete_course">
				<?php esc_html_e( 'Complete Course', 'tutor' ); ?>
			</button>
			<?php else : ?>
				<div>
					<?php tutor_load_template( 'single.course.add-to-cart-' . $tutor_course_sell_by ); ?>
				</div>

				<button type="submit" class="tutor-mt-25 tutor-btn tutor-btn-tertiary tutor-is-outline tutor-btn-lg tutor-btn-full" name="complete_course_btn" value="complete_course">
					<?php esc_html_e( 'Enroll Course', 'tutor' ); ?>
				</button>
			<?php endif; ?>
			<div class="text-regular-caption color-text-hints tutor-mt-12 tutor-bs-d-flex tutor-bs-justify-content-center">
				<span class="tutor-icon-26 color-success ttr-purchase-filled tutor-mr-6"></span>
				<?php esc_html_e( 'You enrolled this course on', 'tutor' ); ?>
				<span class="text-bold-small color-success tutor-ml-3">
					<?php echo esc_html( tutor_get_formated_date( get_option( 'date_format' ), date( 'Y-m-d' ) ) ); ?>
				</span>			
			</div>
	</div>
</div>
