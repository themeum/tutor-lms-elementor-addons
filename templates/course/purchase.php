<?php
/**
 * Course Enrolment template
 *
 * @since v2.0.0
 *
 * @package ETLMCourseEnrolment
 */

use Tutor\Models\CourseModel;

// Utility data.
$user_id               = get_current_user_id();
$course_id             = get_the_ID();
$is_enrolled           = apply_filters( 'tutor_alter_enroll_status', tutor_utils()->is_enrolled() );
$lesson_url            = tutor_utils()->get_course_first_lesson();
$is_administrator      = tutor_utils()->has_user_role( 'administrator' );
$is_instructor         = tutor_utils()->is_instructor_of_this_course();
$course_content_access = (bool) get_tutor_option( 'course_content_access_for_ia' );
$is_privileged_user    = $course_content_access && ( $is_administrator || $is_instructor );
$tutor_course_sell_by  = apply_filters( 'tutor_course_sell_by', null );
$is_public             = get_post_meta( get_the_ID(), '_tutor_is_public_course', true ) == 'yes';
$can_complete_course   = CourseModel::can_complete_course( $course_id, $user_id );
$completion_mode       = tutor_utils()->get_option( 'course_completion_process' );
// Monetization info
$monetize_by    = tutor_utils()->get_option( 'monetize_by' );
$is_purchasable = tutor_utils()->is_course_purchasable();

// Get login url if
$is_tutor_login_disabled = ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true );
$auth_url                = $is_tutor_login_disabled ? ( isset( $_SERVER['REQUEST_SCHEME'] ) ? wp_login_url( $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ) : '' ) : '';
$default_meta            = array(
	array(
		'icon_class' => 'tutor-icon-mortarboard',
		'label'      => __( 'Total Enrolled', 'tutor-lms-elementor-addons' ),
		'value'      => tutor_utils()->get_option( 'enable_course_total_enrolled' ) ? tutor_utils()->count_enrolled_users_by_course() : null,
	),
	array(
		'icon_class' => 'tutor-icon-clock-line',
		'label'      => __( 'Duration', 'tutor-lms-elementor-addons' ),
		'value'      => get_tutor_option( 'enable_course_duration' ) ? get_tutor_course_duration_context() : null,
	),
	array(
		'icon_class' => 'tutor-icon-refresh-o',
		'label'      => __( 'Last Updated', 'tutor-lms-elementor-addons' ),
		'value'      => get_tutor_option( 'enable_course_update_date' ) ? date_i18n( get_option( 'date_format' ), strtotime( get_the_modified_date() ) ) : null,
	),
);

// Add level if enabled
if ( tutor_utils()->get_option( 'enable_course_level', true, true ) ) {
	array_unshift(
		$default_meta,
		array(
			'icon_class' => 'tutor-icon-level',
			'label'      => __( 'Level', 'tutor-lms-elementor-addons' ),
			'value'      => get_tutor_course_level( get_the_ID() ),
		)
	);
}

// Right sidebar meta data
$sidebar_meta = apply_filters( 'tutor/course/single/sidebar/metadata', $default_meta, get_the_ID() );
$login_url    = tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ? '' : wp_login_url( tutor()->current_url );
?>

<div class="tutor-card tutor-card-md tutor-sidebar-card">
	<!-- Course Entry -->
	<div class="tutor-card-body">
		<?php
		if ( $is_enrolled || $is_privileged_user ) {
			ob_start();

			// Course Info
			$completed_percent   = tutor_utils()->get_course_completed_percent();
			$is_completed_course = tutor_utils()->is_completed_course();
			$retake_course       = tutor_utils()->can_user_retake_course();
			$course_id           = get_the_ID();
			$course_progress     = tutor_utils()->get_course_completed_percent( $course_id, 0, true );
			?>
			<!-- course progress -->
			<?php if ( tutor_utils()->get_option( 'enable_course_progress_bar', true, true ) && is_array( $course_progress ) && count( $course_progress ) ) : ?>
				<div class="tutor-course-progress-wrapper tutor-mb-32">
					<h3 class="tutor-color-black tutor-fs-5 tutor-fw-bold tutor-mb-16">
						<?php echo esc_html( $settings['course_progress_title_text'] ); ?>
					</h3>
					<div class="list-item-progress">
						<div class="tutor-fs-6 tutor-color-secondary tutor-d-flex tutor-align-items-center tutor-justify-between">
							<span class="progress-steps">
								<?php
								printf(
									// translators: 1: completed lessons, 2: total lessons.
									esc_html__( '%1$d/%2$d', 'tutor-lms-elementor-addons' ),
									(int) $course_progress['completed_count'],
									(int) $course_progress['total_count']
								);
								?>
							</span>
							<?php if ( 'show' === $settings['course_status_display_percent'] ) : ?>
								<span class="progress-percentage">
									<?php
									printf(
										// translators: %d: complete percent value.
										esc_html__( '%d%% Complete', 'tutor-lms-elementor-addons' ),
										(int) $course_progress['completed_percent'],
									);
									?>
								</span>
							<?php endif; ?>
						</div>
						<div class="tutor-progress-bar tutor-mt-12" style="--tutor-progress-value:<?php echo esc_attr( $course_progress['completed_percent'] ); ?>%;">
							<span class="tutor-progress-value" area-hidden="true"></span>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php
				$start_content = '';
				do_action( 'tutor_course/single/actions_btn_group/before' );
			if ( $lesson_url ) {
						$start_content = ob_start();
						/**
					 * Course retake button.
					 *
					 * Todo: `href` attribute is exist for backward compatibility.
					 *       we need to make it `data-link` attribute and update the js code at course-landing.js
					 *
					 * @since 1.0.0
					 * @since 2.4.0 refactored and hide it when strict mode enabled and course not completed.
					 */
				if ( $retake_course && ( CourseModel::MODE_FLEXIBLE === $completion_mode || $is_completed_course ) ) {
					?>
							<button type="button" 
									class="tutor-btn tutor-btn-block tutor-btn-outline-primary start-continue-retake-button tutor-course-retake-button" 
									href="<?php echo esc_url( $lesson_url ); ?>"
									data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
						<?php esc_html_e( 'Retake This Course', 'tutor-lms-elementor-addons' ); ?>
							</button>
						<?php
				}


						/**
						 * Start/Continue learning button
						 *
						 * @since 1.0.0
						 * @since 2.4.0 refactored for enhance readibility.
						 */
						$link_text = '';
				if ( ! $is_completed_course ) {
					if ( 0 === (int) $completed_percent ) {
						$link_text = __( 'Start Learning', 'tutor-lms-elementor-addons' );
					}
					if ( $completed_percent > 0 && $completed_percent < 100 ) {
						$link_text = __( 'Continue Learning', 'tutor-lms-elementor-addons' );
					}

					/**
					 * `Review Progress` link text shown when
					 * - strict mode enabled
					 * - course progress 100%
					 * - in course progress any quiz or assignemnt result is not passed.
					 *
					 * @since 2.4.0
					 */
					if ( 100 === (int) $completed_percent && false === CourseModel::can_complete_course( $course_id, $user_id ) ) {
						$lesson_url = CourseModel::get_review_progress_link( $course_id, $user_id );
						$link_text  = __( 'Review Progress', 'tutor-lms-elementor-addons' );
					}
				}

				if ( strlen( $link_text ) > 0 ) {
					?>
							<a 	href="<?php echo esc_url( $lesson_url ); ?>" 
								class="tutor-btn tutor-btn-block tutor-btn-primary tutor-mt-20">
							<?php echo esc_html( $link_text ); ?>
							</a>
						<?php
				}
						$start_content = ob_get_clean();
			}


			echo apply_filters( 'tutor_course/single/start/button', $start_content, get_the_ID() );

			// Show Course Completion Button.
			if ( ! $is_completed_course ) {
				ob_start();
				?>
				<form method="post" class="tutor-mt-20">
					<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>

					<input type="hidden" value="<?php echo esc_attr( get_the_ID() ); ?>" name="course_id"/>
					<input type="hidden" value="tutor_complete_course" name="tutor_action"/>

					<button type="submit" class="tutor-btn tutor-btn-outline-primary tutor-btn-block" name="complete_course_btn" value="complete_course">
						<?php esc_html_e( 'Complete Course', 'tutor-lms-elementor-addons' ); ?>
					</button>
				</form>
				<?php
				echo apply_filters( 'tutor_course/single/complete_form', ob_get_clean() );
			}

			?>
				<?php
					// check if has enrolled date.
					$post_date = is_object( $is_enrolled ) && isset( $is_enrolled->post_date ) ? $is_enrolled->post_date : '';
				if ( '' !== $post_date ) :
					?>
					<div class="tutor-fs-7 tutor-color-muted tutor-mt-20 tutor-d-flex etlms-enrolled-info-wrapper">
						<span class="tutor-fs-5 tutor-color-success tutor-icon-purchase-mark tutor-mr-8"></span>
						<span class="tutor-enrolled-info-text">
						<?php esc_html_e( 'You enrolled in this course on', 'tutor-lms-elementor-addons' ); ?>
							<span class="tutor-fs-7 tutor-fw-bold tutor-color-success tutor-ml-4 tutor-enrolled-info-date">
							<?php
								echo esc_html( tutor_get_formated_date( get_option( 'date_format' ), $post_date ) );
							?>
							</span>
						</span>
					</div>
				<?php endif; ?>
			<?php
			do_action( 'tutor_course/single/actions_btn_group/after' );
			echo apply_filters( 'tutor/course/single/entry-box/is_enrolled', ob_get_clean(), get_the_ID() );
		} elseif ( $is_public ) {
			// Get the first content url
			$first_lesson_url                       = tutor_utils()->get_course_first_lesson( get_the_ID(), tutor()->lesson_post_type );
			! $first_lesson_url ? $first_lesson_url = tutor_utils()->get_course_first_lesson( get_the_ID() ) : 0;
			ob_start();
			?>
				<a href="<?php echo esc_url( $first_lesson_url ); ?>" class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block">
					<?php esc_html_e( 'Start Learning', 'tutor-lms-elementor-addons' ); ?>
				</a>
			<?php
			echo apply_filters( 'tutor/course/single/entry-box/is_public', ob_get_clean(), get_the_ID() );
		} else {
			// The course enroll options like purchase or free enrolment
			$price = apply_filters( 'get_tutor_course_price', null, get_the_ID() );

			if ( tutor_utils()->is_course_fully_booked( null ) ) {
				ob_start();
				?>
					<div class="tutor-alert tutor-warning tutor-mt-28">
						<div class="tutor-alert-text">
							<span class="tutor-icon-circle-info tutor-alert-icon tutor-mr-12" area-hidden="true"></span>
							<span>
								<?php esc_html_e( 'This course is full right now. We limit the number of students to create an optimized and productive group dynamic.', 'tutor-lms-elementor-addons' ); ?>
							</span>
						</div>
					</div>
				<?php
				echo apply_filters( 'tutor/course/single/entry-box/fully_booked', ob_get_clean(), get_the_ID() );
			} elseif ( $is_purchasable && $price && $tutor_course_sell_by ) {
				// Load template based on monetization option
				ob_start();
				tutor_load_template( 'single.course.add-to-cart-' . $tutor_course_sell_by );
				echo apply_filters( 'tutor/course/single/entry-box/purchasable', ob_get_clean(), get_the_ID() );
			} else {
				ob_start();
				?>
					<div class="tutor-course-single-pricing">
						<span class="tutor-fs-4 tutor-fw-bold tutor-color-black">
							<?php esc_html_e( 'Free', 'tutor-lms-elementor-addons' ); ?>
						</span>
					</div>

					<div class="tutor-course-single-btn-group <?php echo is_user_logged_in() ? '' : 'tutor-course-entry-box-login'; ?>" data-login_url="<?php echo $login_url; ?>">
						<form class="tutor-enrol-course-form" method="post">
							<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
							<input type="hidden" name="tutor_course_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
							<input type="hidden" name="tutor_course_action" value="_tutor_course_enroll_now">
							<button type="submit" class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block tutor-mt-24 tutor-enroll-course-button">
								<?php esc_html_e( 'Enroll now', 'tutor-lms-elementor-addons' ); ?>
							</button>
						</form>
					</div>

					<div class="tutor-fs-7 tutor-color-muted tutor-mt-20 tutor-text-center">
						<?php esc_html_e( 'Free access this course', 'tutor-lms-elementor-addons' ); ?>
					</div>
				<?php
				echo apply_filters( 'tutor/course/single/entry-box/free', ob_get_clean(), get_the_ID() );
			}
		}

		do_action( 'tutor_course/single/entry/after', get_the_ID() );
		?>
	</div>

	<!-- Course Info -->
	<?php if ( 'yes' === $settings['course_purchase_enrolment_box'] ) : ?>
	<div class="tutor-card-footer">
		<ul class="tutor-ul">
			<?php foreach ( $sidebar_meta as $key => $meta ) : ?>
				<?php
				if ( ! $meta['value'] ) {
					continue;
				}
				?>
				<li class="tutor-row tutor-align-items-center<?php echo $key > 0 ? ' tutor-mt-12' : ''; ?>">
					<div class="tutor-col-6">
						<span class="<?php echo esc_attr( $meta['icon_class'] ); ?> tutor-color-black etlms-enrolled-icon"></span>
						<span class="tutor-fs-7 tutor-color-muted tutor-ml-8 etlms-enrolled-label">
							<?php echo esc_html( $meta['label'] ); ?>
						</span>
					</div>
					<div class="tutor-col-6">
						<span class="tutor-fs-7 tutor-fw-medium tutor-color-black etlms-enrolled-label-value">
							<?php echo wp_kses_post( $meta['value'] ); ?>
						</span>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
</div>

<?php
if ( ! is_user_logged_in() ) {
	tutor_load_template_from_custom_path( tutor()->path . '/views/modal/login.php' );
}
?>
