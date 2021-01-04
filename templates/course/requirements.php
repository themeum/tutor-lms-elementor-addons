<?php do_action('tutor_course/single/before/requirements'); ?>

<div class="etlms-course-specifications etlms-course-requirements">
	<h3><?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h3>
	<ul class="etlms-course-specification-items">
		<?php
		$requirements = tutor_course_requirements();
		if (is_array($requirements) && count($requirements)) {
			foreach ($requirements as $requirement) {
				echo "<li>";
				Elementor\Icons_Manager::render_icon( $settings['course_requirements_list_icon'], [ 'aria-hidden' => 'true' ] );
				echo "<span>{$requirement}</span></li>";
			}
		} else if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
			echo __('Please add data from the course editor', 'tutor-lms-elementor-addons');
		}
		?>
	</ul>
</div>

<?php do_action('tutor_course/single/after/requirements'); ?>

