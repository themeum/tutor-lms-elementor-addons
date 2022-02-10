<?php do_action( 'tutor_course/single/before/tags' ); ?>

<div class="tutor-single-course-segment etlms-course-tag">
	<div class="course-benefits-title">
		<h4 class="tutor-color-text-primary tutor-text-medium-h6"><?php echo esc_html( $settings['section_title_text'], 'tutor-lms-elementor-addons' ); ?></h4>
	</div>
	<div class="tutor-course-tags">
		<?php
		$course_tags = get_tutor_course_tags();
		if ( is_array( $course_tags ) && count( $course_tags ) ) {
			foreach ( $course_tags as $course_tag ) {
				$tag_link = get_term_link( $course_tag->term_id );
				?>
				<a href="<?php echo esc_url( $tag_link ); ?>">
					<?php echo esc_html( $course_tag->name ); ?>
				</a>
				<?php
			}
		} elseif ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			echo '<span style="margin: 5px">' . esc_html( 'Please add data from the course editor', 'tutor-lms-elementor-addons' ) . '</span>';
		}
		?>
	</div>
</div>

<?php do_action( 'tutor_course/single/after/tags' ); ?>
