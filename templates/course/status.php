<?php
/**
 * Course progress template
 *
 * @package ETLMSCourseProgress
 */

$course_progress = tutor_utils()->get_course_completed_percent( get_the_ID(), 0, true );
$is_editor       = \Elementor\Plugin::instance()->editor->is_edit_mode();
$settings = $this->get_settings_for_display();

if ( is_array( $course_progress ) && count( $course_progress ) ) : ?>
	<div class="etlms-course-progress tutor-course-progress">
		<span class="etlms-course-progress-title tutor-fs-6 tutor-fw-medium tutor-color-black">
			<?php echo esc_html( $settings['course_progress_title_text'], 'tutor' ); ?>
		</span>

		<div class="etlms-course-progress-info tutor-fs-6 tutor-color-secondary tutor-d-flex tutor-align-center tutor-justify-between">
			<span class="etlms-course-progress-steps">
				<?php echo esc_html( $is_editor ? 5 : $course_progress['completed_count'] ); ?>/<?php echo esc_html( $is_editor ? 10 : $course_progress['total_count'] ); ?>
			</span>
			<span class="etlms-course-progress-percent"> 
				<?php echo esc_html( $is_editor ? '50%' : $course_progress['completed_percent'] . '%' ); ?>
				<?php esc_html_e( 'Complete', 'tutor-lms-elementor-addons' ); ?>
			</span>
		</div>

		<div class="tutor-progress-bar etlms-course-progress-bar tutor-mt-12" style="--tutor-progress-value:<?php echo esc_attr( $is_editor ? '50' : $course_progress['completed_percent'] ); ?>%;">
			<span class="tutor-progress-value" area-hidden="true"></span>
		</div>
	</div>
<?php endif; ?>
<?php do_action( 'tutor_course/single/enrolled/after/lead_info/progress_bar' ); ?>