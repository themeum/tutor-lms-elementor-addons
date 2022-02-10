<?php do_action( 'tutor_course/single/before/audience' ); ?>

<div class="etlms-course-specifications etlms-course-target_audience">
	<h3 class="tutor-color-text-primary tutor-text-medium-h6"><?php echo esc_html( $settings['section_title_text'], 'tutor-lms-elementor-addons' ); ?></h3>
	<ul class="etlms-course-specification-items">
		<?php
		$target_audience = tutor_course_target_audience();
		if ( is_array( $target_audience ) && count( $target_audience ) ) {
			foreach ( $target_audience as $audience ) {
				echo '<li>';
				Elementor\Icons_Manager::render_icon( $settings['course_target_audience_list_icon'], array( 'aria-hidden' => 'true' ) );
				echo '<span>' . esc_html( $audience ) . '</span></li>';
			}
		}
		?>
	</ul>
</div>

<?php do_action( 'tutor_course/single/after/audience' ); ?>
