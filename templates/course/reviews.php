<?php
/**
 * Template for displaying course reviews
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.5
 */

$disable = ! get_tutor_option( 'enable_course_review' );
if ( $disable ) {
	return;
}

$per_page     = tutor_utils()->get_option( 'pagination_per_page', 10 );
$current_page = max( 1, (int) tutor_utils()->avalue_dot( 'current_page', $_POST ) );
$offset       = ( $current_page - 1 ) * $per_page;

$course_id   = isset( $_POST['course_id'] ) ? (int) $_POST['course_id'] : get_the_ID();
$is_enrolled = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );

$reviews       = tutor_utils()->get_course_reviews( $course_id, $offset, $per_page );
$reviews_total = tutor_utils()->get_course_reviews( $course_id, null, null, true );
$rating        = tutor_utils()->get_course_rating( $course_id );
$my_rating     = tutor_utils()->get_reviews_by_user( 0, 0, 150, false, $course_id );

if ( isset( $_POST['course_id'] ) ) {
	// It's load more
	tutor_load_template( 'single.course.reviews-loop', array( 'reviews' => $reviews ) );
	return;
}

do_action( 'tutor_course/single/enrolled/before/reviews' );
?>

<div class="etlms-course-widget etlms-course-reviews tutor-pagination-wrapper-replaceable">
	<h3 class="etlms-course-widget-title tutor-fs-5 tutor-color-black tutor-fw-bold tutor-mb-16">
		<?php
			$review_title = apply_filters( 'tutor_course_reviews_section_title', 'Student Ratings & Reviews' );
			echo esc_html( $review_title, 'tutor-lms-elementor-addons' );
		?>
	</h3>

	<?php if ( ! is_array( $reviews ) || ! count( $reviews ) ) : ?>
		<?php tutor_utils()->tutor_empty_state( __( 'No Review Yet', 'tutor-lms-elementor-addons' ) ); ?>
	<?php else : ?>
		<div class="tutor-card tutor-review-card">
			<div class="tutor-review-summary tutor-p-24 tutor-p-lg-40">
				<div class="tutor-row tutor-gx-xl-5 tutor-align-center">
					<div class="tutor-review-summary-average tutor-col-lg-auto tutor-text-center tutor-mb-16 tutor-mb-lg-0">
						<div class="tutor-review-summary-average-rating tutor-mb-20">
							<?php echo number_format( $rating->rating_avg, 1 ); ?>
						</div>

						<div class="tutor-review-summary-average-stars">
							<div class="tutor-d-inline-block">
								<?php tutor_utils()->star_rating_generator_v2( $rating->rating_avg, null, false, '', 'lg' ); ?>
							</div>
						</div>

						<div class="tutor-review-summary-average-label tutor-fs-6 tutor-color-secondary tutor-mt-12">
							<?php esc_html_e( 'Total ', 'tutor' ); ?>
							<?php echo $reviews_total; ?>
							<?php echo esc_html( _n( ' Rating', ' Ratings', count( $reviews ), 'tutor-lms-elementor-addons' ) ); ?>
						</div>
					</div>

					<div class="tutor-col-lg">
						<div class="tutor-review-summary-ratings">
							<?php foreach ( $rating->count_by_value as $key => $value ) : ?>
								<?php $rating_count_percent = ( $value > 0 ) ? ( $value * 100 ) / $rating->rating_count : 0; ?>
								<div class="tutor-row tutor-align-center tutor-review-summary-rating">
									<div class="tutor-col-auto">
										<div class="tutor-ratings">
											<div class="tutor-ratings-stars">
												<span class="tutor-icon-star-line" area-hidden="true"></span>
											</div>
											<div class="tutor-fs-6 tutor-ratings-label tutor-ml-8">
												<?php echo $key; ?>
											</div>
										</div>
									</div>

									<div class="tutor-col">
										<div class="tutor-progress-bar tutor-ratings-progress-bar" style="--tutor-progress-value: <?php echo $rating_count_percent; ?>%">
											<span class="tutor-progress-value" area-hidden="true"></span>
										</div>
									</div>

									<div class="tutor-col-4 tutor-col-lg-3">
										<span class="tutor-fs-6 tutor-ratings-label"><?php echo $value . ' ' . ( $value > 1 ? __( 'Ratings', 'tutor-lms-elementor-addons' ) : __( 'Rating', 'tutor-lms-elementor-addons' ) ); ?></span>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="tutor-hr" area-hidden="true"></div>
			
			<div class="tutor-reviews tutor-card-list tutor-pagination-content-appendable">
				<?php tutor_load_template('single.course.reviews-loop', array('reviews' => $reviews)); ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="tutor-row tutor-mt-40 tutor-mb-20">
		<div class="tutor-col">
			<?php if ( $is_enrolled ) : ?>
				<button class="tutor-btn tutor-btn-primary write-course-review-link-btn">
					<i class="tutor-icon-star-line-filled tutor-icon-24 tutor-mr-4"></i>
					<?php
						$is_new = ! $my_rating || empty( $my_rating->rating ) || empty( $my_rating->comment_content );
						$is_new ? esc_html_e( 'Write a review', 'tutor-lms-elementor-addons' ) : esc_html_e( 'Edit review', 'tutor-lms-elementor-addons' );
					?>
				</button>
			<?php endif; ?>
		</div>
		<div class="tutor-col-auto">
			<?php
				$pagination_data = array(
					'total_items' => $reviews_total,
					'per_page'    => $per_page,
					'paged'       => $current_page,
					'layout'      => array(
						'type'           => 'load_more',
						'load_more_text' => __( 'Load More', 'tutor-lms-elementor-addons' ),
					),
					'ajax'        => array(
						'action'    => 'tutor_single_course_reviews_load_more',
						'course_id' => $course_id,
					),
				);

				$pagination_template_frontend = tutor()->path . 'templates/dashboard/elements/pagination.php';
				tutor_load_template_from_custom_path( $pagination_template_frontend, $pagination_data );
				?>
		</div>
	</div>
</div>

<?php if ( $is_enrolled ) : ?>
	<div class="tutor-course-enrolled-review-wrap tutor-mt-16">
		<div class="tutor-write-review-form" style="display: none;">
			<form method="post">
				<div class="tutor-star-rating-container">
					<input type="hidden" name="course_id" value="<?php echo esc_attr( $course_id ); ?>"/>
					<input type="hidden" name="review_id" value="<?php echo esc_attr( $my_rating ? $my_rating->comment_ID : '' ); ?>"/>
					<input type="hidden" name="action" value="tutor_place_rating"/>
					<div class="tutor-form-group">
						<?php
							tutor_utils()->star_rating_generator( tutor_utils()->get_rating_value( $my_rating ? $my_rating->rating : 0 ) );
						?>
					</div>
					<div class="tutor-form-group">
						<textarea name="review" placeholder="<?php esc_html_e( 'write a review', 'tutor-lms-elementor-addons' ); ?>"><?php echo esc_textarea( $my_rating ? $my_rating->comment_content : '' ); ?></textarea>
					</div>
					<div class="tutor-form-group">
						<button type="submit" class="tutor_submit_review_btn tutor-btn tutor-btn-primary">
							<?php esc_html_e( 'Submit Review', 'tutor-lms-elementor-addons' ); ?>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>

<?php do_action( 'tutor_course/single/enrolled/after/reviews' ); ?>
