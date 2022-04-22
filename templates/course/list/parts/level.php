<?php if ( 'yes' === $settings['course_list_difficulty_settings'] && get_tutor_course_level() ) : ?>
	<span class="tutor-course-difficulty-level">
        <span class="tutor-badge-label label-primary">
            <?php echo get_tutor_course_level(); ?>
        </span>
    </span>
<?php endif; ?>