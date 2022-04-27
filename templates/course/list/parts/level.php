<?php if ( 'yes' === $settings['course_list_difficulty_settings'] && get_tutor_course_level() ) : ?>
	<span class="tutor-course-difficulty-level">
        <?php echo get_tutor_course_level(); ?>
    </span>
<?php endif; ?>