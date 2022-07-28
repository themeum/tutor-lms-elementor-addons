<?php
/**
 * Tabs menu items
 *
 * @package Course Topics
 */
$course_nav_items = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), get_the_ID() );

?>
<div class="etlms-course-content">
	<?php do_action( 'tutor_course/single/before/inner-wrap' ); ?>

	<div class="tutor-default-tab tutor-course-details-tab">
		<div class="tutor-is-sticky">
			<?php tutor_load_template( 'single.course.enrolled.nav', array( 'course_nav_item' => $course_nav_items ) ); ?>
		</div>

		<div class="tutor-tab tutor-pt-24">
			<?php foreach ( $course_nav_items as $key => $subpage ) : ?>
				<?php $method = $subpage['method']; ?>
				<div id="tutor-course-details-tab-<?php echo esc_attr( $key ); ?>" class="tutor-tab-item<?php echo esc_attr( 'info' === $key ? ' is-active' : '' ); ?>">
				<?php
					if ( 'info' === $key ) {
						// ?Do action to show course prerequisite.
						do_action( 'tutor_course/single/tab/info/before' );
						include etlms_get_template( 'course/about' );
						include etlms_get_template( 'course/benefits' );
						tutor_course_topics();
					} else {
						if ( is_string( $method ) ) {
							$method();
						} else {
							$_object = $method[0];
							$_method = $method[1];
							$_object->$_method( get_the_ID() );
						}
					}
				?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php do_action( 'tutor_course/single/after/inner-wrap' ); ?>
</div>