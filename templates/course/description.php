<?php

do_action('tutor_course/single/before/content');
global $post;
?>

<div class="tutor-single-course-segment etlms-course-description">
    <div class="course-content-title">
        <h4 class="tutor-segment-title"><?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h4>
    </div>
    <div class="tutor-course-content-content">
        <?php if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo __('This is demo content for preview purposes. Dynamic content will be viewable from the frontend once you have published the course and template.', 'tutor-lms-elementor-addons');
        } else {
            the_content();
        } ?>
    </div>
</div>

<?php do_action('tutor_course/single/after/content'); ?>