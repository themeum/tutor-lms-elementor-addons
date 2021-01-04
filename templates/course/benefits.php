<?php do_action('tutor_course/single/before/benefits'); ?>

<div class="etlms-course-specifications etlms-course-benefits">
	<h3><?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h3>
	<ul class="etlms-course-specification-items">
		<?php
		$benefits = tutor_course_benefits();
		if (is_array($benefits) && count($benefits)) {
			foreach ($benefits as $benefit) {
				echo "<li>";
				Elementor\Icons_Manager::render_icon($settings['course_benefits_list_icon'], ['aria-hidden' => 'true']);
				echo "<span>{$benefit}</span></li>";
			}
		} else if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
			echo __('Please add data from the course editor', 'tutor-lms-elementor-addons');
		}
		?>
	</ul>
</div>

<?php do_action('tutor_course/single/after/benefits'); ?>

