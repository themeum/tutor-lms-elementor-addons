<?php
/**
 * Tabs menu items
 *
 * @package CourseCurriculum
 */

	$course_nav_items = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), get_the_ID() );
	/**
	 * Unset nav items that are not supposed to be here
	 *
	 * @since v2.0.0
	 */
	add_filter(
		'tutor_default_topics_active_tab',
		function() {
			return 'curriculum';
		}
	);
	unset( $course_nav_items['info'] );
	unset( $course_nav_items['reviews'] );
	?>
<div class="tutor-wrap etlms-course-curriculum">
		<?php do_action( 'tutor_course/single/before/inner-wrap' ); ?>
		<div class="tutor-default-tab tutor-course-details-tab tutor-tab-has-seemore tutor-mt-30">
			<div class="tutor-is-sticky">
				<?php tutor_load_template( 'single.course.enrolled.nav', array( 'course_nav_item' => $course_nav_items ) ); ?>
			</div>
			<div class="tutor-tab tutor-pt-24">
				<?php
				foreach ( $course_nav_items as $key => $subpage ) {
					?>
						<div class="tutor-tab-item <?php echo esc_attr( 'curriculum' === $key ? 'is-active' : '' ); ?>" id="tutor-course-details-tab-<?php echo esc_attr( $key ); ?>">
						<?php
							$method = $subpage['method'];
							if ( is_string( $method ) ) {
								$method();
							} else {
								$_object = $method[0];
								$_method = $method[1];
								$_object->$_method( get_the_ID() );
							}
						?>
						</div>
						<?php
				}
				?>
			</div>
		</div>
		<?php do_action( 'tutor_course/single/after/inner-wrap' ); ?>
</div>

