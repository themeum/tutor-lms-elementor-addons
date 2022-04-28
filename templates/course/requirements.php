<?php
/**
 * Course Requirements template
 *
 * @package ETLMSCourseRequirements
 */
do_action( 'tutor_course/single/before/requirements' );
$requirements = tutor_course_requirements();
?>
<div class="etlms-course-widget etlms-course-requirements">
	<h3 class="etlms-course-widget-title tutor-fs-5 tutor-color-black tutor-fw-bold tutor-mb-16">
		<?php echo esc_html( $settings['section_title_text'], 'tutor-lms-elementor-addons' ); ?>
	</h3>
	<ul class="etlms-course-widget-list-items tutor-fs-6 tutor-color-black">
		<?php if ( is_array( $requirements ) && count( $requirements ) ) : ?>
		<?php foreach ($requirements as $requirement): ?>
			<li class="etlms-course-widget-list-item">
				<span class="tutor-mr-12 tutor-list-icon tutor-color-primary"><?php Elementor\Icons_Manager::render_icon( $settings['course_requirements_list_icon'], array( 'aria-hidden' => 'true' ) ); ?></span>
				<span class="tutor-list-label"><?php echo esc_html( $requirement ); ?></span>
			</li>
		<?php endforeach; ?>
		<?php elseif ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) : ?>
			<?php echo __( 'Please add data from the course editor', 'tutor-lms-elementor-addons' ); ?>
		<?php endif; ?>
	</ul>
</div>
<?php do_action( 'tutor_course/single/after/requirements' ); ?>