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
			'icon_class' => 'tutor-icon-level-line',
			'label'      => __( 'Level', 'tutor' ),
			'value'      => get_tutor_course_level( get_the_ID() ),
		),
		array(
			'icon_class' => 'tutor-icon-student-line-1',
			'label'      => __( 'Total Enrolled', 'tutor' ),
			'value'      => tutor_utils()->get_option( 'enable_course_total_enrolled' ) ? tutor_utils()->count_enrolled_users_by_course() : null,
		),
		array(
			'icon_class' => 'tutor-icon-clock-filled',
			'label'      => __( 'Duration', 'tutor' ),
			'value'      => get_tutor_option( 'enable_course_duration' ) ? get_tutor_course_duration_context() : null,
		),
		array(
			'icon_class' => 'tutor-icon-refresh-l',
			'label'      => __( 'Last Updated', 'tutor' ),
			'value'      => get_tutor_option( 'enable_course_update_date' ) ? tutor_get_formated_date( get_option( 'date_format' ), get_the_modified_date() ) : null,
		),
	),
	get_the_ID()
);
$button_size  = $settings['course_enroll_buttons_size'];

?>

<div class="tutor-course-sidebar-card">
	<!-- Course Entry -->
	<div class="tutor-course-sidebar-card-body tutor-p-30 <?php echo ! is_user_logged_in() ? 'tutor-course-entry-box-login' : ''; ?>">

		<?php
			$button_class = 'tutor-is-fullwidth tutor-btn tutor-is-outline tutor-btn-lg tutor-btn-full tutor-is-fullwidth tutor-course-retake-button tutor-mb-10';
		?>
			<?php if ( 'enrolled' === $enrollment_mode ) : ?>
				<?php if ( is_array( $course_progress ) && count( $course_progress ) ) : ?>
					<div class="tutor-course-progress-wrapper tutor-mb-30" style="width: 100%;">
						<span class="color-text-primary text-medium-h6">
							<?php esc_html_e( 'Course Progress', 'tutor' ); ?>
						</span>
						<div class="list-item-progress tutor-mt-16">
							<div class="text-regular-body color-text-subsued tutor-bs-d-flex tutor-bs-align-items-center tutor-bs-justify-content-between">
								<span class="progress-steps">
									<?php echo esc_html( $course_progress['completed_count'] ); ?>/
									<?php echo esc_html( $course_progress['total_count'] ); ?>
								</span>
								<span class="progress-percentage"> 
									<?php echo esc_html( $course_progress['completed_percent'] . '%' ); ?>
									<?php esc_html_e( 'Complete', 'tutor' ); ?>
								</span>
							</div>
							<div class="progress-bar tutor-mt-10" style="--progress-value:<?php echo esc_attr( $course_progress['completed_percent'] ); ?>%;">
								<span class="progress-value"></span>
							</div>
						</div>
					</div>
				<?php endif; ?>					
			<a href="#" class="<?php echo esc_attr( $button_class ); ?> start-continue-retake-button" data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
				<?php esc_html_e( 'Continue Learning', 'tutor-lms-elementor-addons' ); ?>
			</a>
			<button type="submit" class="tutor-mt-25 tutor-btn tutor-btn-tertiary tutor-is-outline tutor-btn-lg tutor-btn-full" name="complete_course_btn" value="complete_course">
				<?php esc_html_e( ' Complete Course', 'tutor-lms-elementor-addons' ); ?>                        
			</button>
			<?php else : ?>			
				<div>
					<?php tutor_load_template( 'single.course.add-to-cart-' . $tutor_course_sell_by ); ?>
				</div>

				<button type="submit" class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-full tutor-mt-24 tutor-enroll-course-button" name="complete_course_btn" value="complete_course">
					<?php esc_html_e( 'Enroll Course', 'tutor-lms-elementor-addons' ); ?>
				</button>
				<button type="submit" name="add-to-cart" value=""  class="tutor-btn tutor-btn-icon tutor-btn-primary tutor-btn-lg tutor-btn-full tutor-mt-24 tutor-add-to-cart-button">
					<span class="btn-icon ttr-cart-filled"></span>
					<span><?php echo esc_html( 'Add to cart', 'tutor' ); ?></span>
				</button>
			<?php endif; ?>
	</div>
	<!-- Course Info -->
	<?php// if ( 'enrolled' === $enrollment_mode ) : ?>
	<div class="tutor-course-sidebar-card-footer tutor-p-30">
		<ul class="tutor-course-sidebar-card-meta-list tutor-m-0 tutor-pl-0">
			<?php foreach ( $sidebar_meta as $meta ) : ?>
				<?php
				if ( ! $meta['value'] ) {
					continue;}
				?>
				<li class="tutor-bs-d-flex tutor-bs-align-items-center tutor-bs-justify-content-between">
					<div class="flex-center">
						<span class="tutor-icon-24 <?php echo $meta['icon_class']; ?> color-text-primary"></span>
						<span class="text-regular-caption color-text-hints tutor-ml-5">
							<?php echo esc_html( $meta['label'] ); ?>
						</span>
					</div>
					<div>
						<span class="text-medium-caption color-text-primary">
							<?php echo wp_kses_post( $meta['value'] ); ?>
						</span>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>	
	<?php// endif; ?>
</div>

