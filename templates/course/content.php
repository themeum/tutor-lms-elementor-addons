<?php
/**
 * Tabs menu items
 *
 * @package Course Topics
 */

$course_nav_items = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), get_the_ID() );

?>
<div class="tutor-wrap etlms-course-curriculum">
	<?php do_action( 'tutor_course/single/before/inner-wrap' ); ?>
	<div class="tutor-course-details-tab tutor-tab-has-seemore tutor-mt-32">
		<div class="tutor-is-sticky">
			<?php tutor_load_template( 'single.course.enrolled.nav', array( 'course_nav_item' => $course_nav_items ) ); ?>
		</div>
		<div class="tutor-tab tutor-pt-24">
			<?php
			foreach ( $course_nav_items as $key => $subpage ) {
				?>
					<div id="tutor-course-details-tab-<?php echo $key; ?>" class="tutor-tab-item<?php echo $key == 'info' ? ' is-active' : ''; ?>">
					<?php
						$method = $subpage['method'];
					if ( 'info' === $key ) {
						include ETLMS_TEMPLATE . 'about.php';
						include ETLMS_TEMPLATE . 'benefits.php';
						include ETLMS_TEMPLATE . 'instructors.php';
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
					<?php
			}
			?>
		</div>
	</div>
	<?php do_action( 'tutor_course/single/after/inner-wrap' ); ?>
</div>

