<?php

do_action('tutor_course/single/before/benefits');

$benefits = tutor_course_benefits();

if ( empty($benefits)){
	return;
}

if (is_array($benefits) && count($benefits)){
	?>

	<div class="etlms-course-specifications etlms-course-benefits">
        <h3><?php esc_html_e($settings['section_title_text'], 'tutor-elementor-addons'); ?></h3>
		<ul class="etlms-course-specification-items">
			<?php
			foreach ($benefits as $benefit) {
				echo "<li>";
				Elementor\Icons_Manager::render_icon( $settings['course_benefits_list_icon'], [ 'aria-hidden' => 'true' ] );
				echo "<span>{$benefit}</span></li>";
			}
			?>
		</ul>
	</div>

<?php } ?>

<?php do_action('tutor_course/single/after/benefits'); ?>

