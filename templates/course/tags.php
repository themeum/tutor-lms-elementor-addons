<?php do_action( 'tutor_course/single/before/tags' ); ?>
<?php $course_tags = get_tutor_course_tags(); ?>

<div class="etlms-course-widget etlms-course-tags">
	<h3 class="etlms-course-widget-title tutor-fs-5 tutor-color-black tutor-fw-bold tutor-mb-16">
		<?php echo esc_html( $settings['section_title_text'], 'tutor-lms-elementor-addons' ); ?>
	</h3>
	<div class="tutor-course-tags etlms-course-tag-list">
		<?php if ( is_array( $course_tags ) && count( $course_tags ) ) : ?>
		<?php foreach ( $course_tags as $course_tag ): ?>
			<a href="<?php echo esc_url( get_term_link( $course_tag->term_id ) ); ?>">
				<?php echo esc_html( $course_tag->name ); ?>
			</a>
		<?php endforeach; ?>
		<?php elseif ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) : ?>
			<?php echo __( 'Please add data from the course editor', 'tutor-lms-elementor-addons' ); ?>
		<?php endif; ?>
	</div>
</div>

<?php do_action( 'tutor_course/single/after/tags' ); ?>
