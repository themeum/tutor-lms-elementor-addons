<?php do_action('tutor_course/single/before/audience'); ?>

<div class="etlms-course-specifications etlms-course-target_audience">
	<h3><?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h3>
	<ul class="etlms-course-specification-items">
		<?php
		$target_audience = tutor_course_target_audience();
		if (is_array($target_audience) && count($target_audience)) {
			foreach ($target_audience as $audience) {
				echo "<li>";
				Elementor\Icons_Manager::render_icon( $settings['course_target_audience_list_icon'], [ 'aria-hidden' => 'true' ] );
				echo "<span>{$audience}</span></li>";
			}
		} else if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
			echo __('Please add data from the course editor', 'tutor-lms-elementor-addons');
		}
		?>
	</ul>
</div>

<?php do_action('tutor_course/single/after/audience'); ?>

