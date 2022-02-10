<?php do_action( 'tutor_course/single/before/material_includes' ); ?>
<div class="etlms-course-specifications etlms-course-materials">
	<h3 class="tutor-color-text-primary tutor-text-medium-h6"><?php echo esc_html( $settings['section_title_text'], 'tutor-lms-elementor-addons' ); ?></h3>
	<ul class="etlms-course-specification-items etlms-course-materials">
		<?php
		$materials = tutor_course_material_includes();
		if ( is_array( $materials ) && count( $materials ) ) {
			foreach ( $materials as $material ) {
				echo '<li>';
				Elementor\Icons_Manager::render_icon( $settings['course_materials_list_icon'], array( 'aria-hidden' => 'true' ) );
				echo '<span>' . esc_textarea( $material ) . '</span></li>';
			}
		}
		?>
	</ul>
</div>

<?php do_action( 'tutor_course/single/after/material_includes' ); ?>
