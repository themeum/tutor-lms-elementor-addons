<?php
/**
 * Course Requirements template
 *
 * @package ETLMSCourseRequirements
 */

$requirements = tutor_course_requirements();
do_action( 'tutor_course/single/before/requirements' );
	?>
	<div class="etlms-course-specifications etlms-course-requirements">
		<h3 class="tutor-color-text-primary tutor-text-medium-h6"><?php echo esc_html( $settings['section_title_text'], 'tutor-lms-elementor-addons' ); ?></h3>
		<ul class="etlms-course-specification-items">
			<?php
			if ( is_array( $requirements ) && count( $requirements ) ) {
				foreach ( $requirements as $requirement ) {
					echo '<li>';
					Elementor\Icons_Manager::render_icon( $settings['course_requirements_list_icon'], array( 'aria-hidden' => 'true' ) );
					echo '<span>' . esc_html( $requirement ) . '</span></li>';
				}
			} elseif ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				echo __( 'Please add data from the course editor', 'tutor-lms-elementor-addons' );
			}
			?>
		</ul>
	</div>
	<?php do_action( 'tutor_course/single/after/requirements' ); ?>
