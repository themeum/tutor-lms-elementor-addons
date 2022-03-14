<?php
/**
 * Enrollment editor mode template
 *
 * @package Enrollment Widget
 */

$tutor_course_sell_by = apply_filters( 'tutor_course_sell_by', null );
$enrollment_mode      = $settings['course_enrolment_edit_mode'];
$product_id           = tutor_utils()->get_course_product_id();
$product              = wc_get_product( $product_id );
$is_purchasable       = tutor_utils()->is_course_purchasable();
$sidebar_meta         = apply_filters(
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
$button_size          = $settings['course_enroll_buttons_size'];

?>

<div class="tutor-course-sidebar-card">
	<!-- Course Entry -->
	<div class="tutor-course-sidebar-card-body tutor-p-30 <?php echo ! is_user_logged_in() ? 'tutor-course-entry-box-login' : ''; ?>">

		<?php
			$button_class = 'tutor-is-fullwidth tutor-btn  tutor-is-fullwidth tutor-pr-0 tutor-pl-0  start-continue-retake-button';
		?>
			<?php if ( 'enrolled-box' === $enrollment_mode ) : ?>
				<a href="#" class="<?php echo esc_attr( $button_class ); ?> start-continue-retake-button" data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
						<?php esc_html_e( 'Start Learning', 'tutor-lms-elementor-addons' ); ?>
				</a>		
				<form>
					<button type="submit" class="tutor-mt-25 tutor-btn tutor-btn-tertiary tutor-is-outline tutor-btn-lg tutor-btn-full tutor-course-complete-button" name="complete_course_btn" value="complete_course">
						<?php esc_html_e( ' Complete Course', 'tutor-lms-elementor-addons' ); ?>                        
					</button>
				</form>
			<?php else : ?>
				<?php if ( $is_purchasable ) : ?>	

				<form action="<?php echo esc_url( apply_filters( 'tutor_course_add_to_cart_form_action', get_permalink( get_the_ID() ) ) ); ?>" method="post" enctype="multipart/form-data">
					<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"  class="tutor-btn tutor-btn-icon tutor-btn-primary tutor-btn-lg tutor-btn-full tutor-mt-24 tutor-add-to-cart-button">
						<span class="btn-icon tutor-icon-cart-filled"></span>
						<span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
					</button>
				</form>

			<?php else : ?>

			<?php endif; ?>

			<button type="submit" class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-full tutor-mt-24 tutor-enroll-course-button" name="complete_course_btn" value="complete_course">
				<?php esc_html_e( 'Enroll Course', 'tutor-lms-elementor-addons' ); ?>
			</button>

			<?php endif; ?>
			<!-- enrollment info -->
			<?php if ( 'enrolled-box' === $enrollment_mode ) : ?>
				<div class="etlms-enrolled-info-wrapper text-regular-caption tutor-color-text-hints tutor-mt-12 tutor-bs-d-flex tutor-bs-justify-content-center">
					<span class="tutor-icon-26 tutor-color-success tutor-icon-purchase-filled tutor-mr-6"></span>
					<span class="tutor-enrolled-info-text">
						<span class="text">
						You enrolled this course on	
						</span>					
						<span class="text-bold-small tutor-color-success tutor-ml-3 tutor-enrolled-info-date">
						January 31, 2022(Dummy date)					
						</span>
					</span>
				</div>
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

