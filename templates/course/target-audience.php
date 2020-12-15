<?php

do_action('tutor_course/single/before/audience');

$target_audience = tutor_course_target_audience();

if ( empty($target_audience)){
	return;
}

if (is_array($target_audience) && count($target_audience)){
	?>

	<div class="etlms-course-specifications etlms-course-target_audience">
        <h3><?php _e('Target Audience', 'tutor-elementor-addons'); ?></h3>
		<ul class="etlms-course-specification-items">
			<?php
			foreach ($target_audience as $audience) {
				echo "<li>";
				Elementor\Icons_Manager::render_icon( $settings['course_target_audience_list_icon'], [ 'aria-hidden' => 'true' ] );
				echo "<span>{$audience}</span></li>";
			}
			?>
		</ul>
	</div>

<?php } ?>

<?php do_action('tutor_course/single/after/audience'); ?>

