<?php

do_action('tutor_course/single/before/requirements');

$requirements = tutor_course_requirements();

if ( empty($requirements)){
	return;
}

if (is_array($requirements) && count($requirements)){
	?>

	<div class="etlms-course-specifications etlms-course-requirements">
        <h3><?php esc_html_e($settings['section_title_text'], 'tutor-elementor-addons'); ?></h3>
		<ul class="etlms-course-specification-items">
			<?php
			foreach ($requirements as $requirement) {
				echo "<li>";
				Elementor\Icons_Manager::render_icon( $settings['course_requirements_list_icon'], [ 'aria-hidden' => 'true' ] );
				echo "<span>{$requirement}</span></li>";
			}
			?>
		</ul>
	</div>

<?php } ?>

<?php do_action('tutor_course/single/after/requirements'); ?>

