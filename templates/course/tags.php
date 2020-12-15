<?php
do_action('tutor_course/single/before/tags');

$course_tags = get_tutor_course_tags();
if (is_array($course_tags) && count($course_tags)) { ?>
    <div class="tutor-single-course-segment etlms-course-tag">
        <div class="course-benefits-title">
            <h4 class="tutor-segment-title"><?php esc_html_e($settings['section_title_text'], 'tutor-elementor-addons'); ?></h4>
        </div>
        <div class="tutor-course-tags">
            <?php
            foreach ($course_tags as $course_tag) {
                $tag_link = get_term_link($course_tag->term_id);
                echo "<a href='$tag_link'> $course_tag->name </a>";
            }
            ?>
        </div>
    </div>
<?php
}

do_action('tutor_course/single/after/tags'); ?>