<?php
/**
 * Enrollment editor mode template
 *
 * @package Enrollment Widget
 */

$tutor_course_sell_by = apply_filters( 'tutor_course_sell_by', null );
$enrollment_mode      = $settings['course_enrolment_edit_mode'];

$is_purchasable = tutor_utils()->is_course_purchasable();
$sidebar_meta   = apply_filters(
	'tutor/course/single/sidebar/metadata',
	array(
		array(
			'icon_class' => 'tutor-icon-level-line',
			'label'      => __( 'Level', 'tutor-lms-elementor-addons' ),
			'value'      => get_tutor_course_level( get_the_ID() ),
		),
		array(
			'icon_class' => 'tutor-icon-student-line-1',
			'label'      => __( 'Total Enrolled', 'tutor-lms-elementor-addons' ),
			'value'      => tutor_utils()->get_option( 'enable_course_total_enrolled' ) ? tutor_utils()->count_enrolled_users_by_course() : null,
		),
		array(
			'icon_class' => 'tutor-icon-clock-filled',
			'label'      => __( 'Duration', 'tutor-lms-elementor-addons' ),
			'value'      => get_tutor_option( 'enable_course_duration' ) ? get_tutor_course_duration_context() : null,
		),
		array(
			'icon_class' => 'tutor-icon-refresh-l',
			'label'      => __( 'Last Updated', 'tutor-lms-elementor-addons' ),
			'value'      => get_tutor_option( 'enable_course_update_date' ) ? tutor_get_formated_date( get_option( 'date_format' ), get_the_modified_date() ) : null,
		),
	),
	get_the_ID()
);
$button_size    = $settings['course_enroll_buttons_size'];

?>

<div class="tutor-course-sidebar-card">
	<!-- Course Entry -->
	<div class="tutor-course-sidebar-card-body tutor-p-32 <?php echo ! is_user_logged_in() ? 'tutor-course-entry-box-login' : ''; ?>">

		<?php
			$button_class = 'tutor-is-fullwidth tutor-btn  tutor-is-fullwidth tutor-pr-0 tutor-pl-0  start-continue-retake-button';
		?>
			<?php if ( 'enrolled-box' === $enrollment_mode ) : ?>
				<div class="tutor-course-progress-wrapper tutor-mb-30" style="width: 100%;">
					<span class="color-text-primary text-medium-h6">
						<?php echo esc_html( $settings['course_progress_title_text'], 'tutor-lms-elementor-addons' ); ?>
					</span>
					<div class="list-item-progress tutor-mt-16">
						<div class="text-regular-body color-text-subsued tutor-d-flex tutor-align-items-center tutor-justify-content-between">
							<span class="progress-steps">
								<?php echo esc_html( 5 ); ?>/
								<?php echo esc_html( 10 ); ?>
							</span>
							<span class="progress-percentage"> 
								<?php echo esc_html( '50%' ); ?>
								<?php esc_html_e( 'Complete', 'tutor-lms-elementor-addons' ); ?>
							</span>
						</div>
						<div class="progress-bar tutor-mt-10" style="--progress-value: 50%;">
							<span class="progress-value"></span>
						</div>
					</div>
				</div>
				<a href="#" class="<?php echo esc_attr( $button_class ); ?> start-continue-retake-button" data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
						<?php esc_html_e( 'Start Learning', 'tutor-lms-elementor-addons' ); ?>
				</a>		
				<form>
					<button type="submit" class="tutor-mt-25 tutor-btn tutor-btn-tertiary tutor-is-outline tutor-btn-lg tutor-btn-full tutor-course-complete-button" name="complete_course_btn" value="complete_course">
						<?php esc_html_e( ' Complete Course', 'tutor-lms-elementor-addons' ); ?>                        
					</button>
				</form>
				<a href="http://localhost/tutor-v2?cert_hash=de57e7493295963c&amp;regenerate=1" class="tutor-btn tutor-mt-5 tutor-mb-5 tutor-is-fullwidth" style="margin-top:10px;">
					<?php esc_html_e( 'View Certificate', 'tutor-lms-elementor-addons' ); ?>
				</a>
			<?php else : ?>
				<?php if ( $is_purchasable ) : ?>	
					<?php tutor_load_template( 'single.course.add-to-cart-' . $tutor_course_sell_by ); ?>

			<?php else : ?>
				<div class="tutor-course-sidebar-card-pricing tutor-d-flex align-items-end tutor-justify-content-between">
					<div>
						<span class="text-bold-h4 tutor-color-text-primary"><?php esc_html_e( 'Free', 'tutor-lms-elementor-addons' ); ?></span>
					</div>
				</div>
			<?php endif; ?>

			<button type="submit" class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-full tutor-mt-24 tutor-enroll-course-button" name="complete_course_btn" value="complete_course">
				<?php esc_html_e( 'Enroll Course', 'tutor-lms-elementor-addons' ); ?>
			</button>

			<?php endif; ?>
			<!-- enrollment info -->
			<?php if ( 'enrolled-box' === $enrollment_mode ) : ?>
				<div class="etlms-enrolled-info-wrapper text-regular-caption tutor-color-text-hints tutor-mt-12 tutor-d-flex tutor-justify-content-center tutor-align-items-center">
					<span class="tutor-icon-26 tutor-color-success tutor-icon-purchase-filled tutor-mr-6"></span>
					<span class="tutor-enrolled-info-text">
						<span class="text">
						<?php esc_html_e( 'You enrolled this course on', 'tutor-lms-elementor-addons' ); ?>	
						</span>					
						<span class="text-bold-small tutor-color-success tutor-ml-3 tutor-enrolled-info-date">
						<?php esc_html_e( 'January 31, 2022(Dummy date)', 'tutor-lms-elementor-addons' ); ?>					
						</span>
					</span>
				</div>
			<?php endif; ?>
	</div>
	<!-- Course Info -->

	<div class="tutor-course-sidebar-card-footer tutor-p-32">
		<ul class="tutor-course-sidebar-card-meta-list tutor-m-0 tutor-pl-0">
			<?php foreach ( $sidebar_meta as $meta ) : ?>
				<?php
				if ( ! $meta['value'] ) {
					continue;}
				?>
				<li class="tutor-d-flex tutor-align-items-center tutor-justify-content-between">
					<div class="flex-center">
						<span class="tutor-icon-24 <?php echo $meta['icon_class']; ?> color-text-primary"></span>
						<span class="text-regular-caption color-text-hints tutor-ml-4">
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
</div>

