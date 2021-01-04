<?php

$position = 'outside';
$display = 'show';

if (isset($settings['course_status_percent_position'])) {
    $position = $settings['course_status_percent_position'];
}
if (isset($settings['course_status_display_percent'])) {
    $display = $settings['course_status_display_percent'];
}

//Get completed percentage for course
$completed_count = (\Elementor\Plugin::instance()->editor->is_edit_mode()) ? 15 :tutor_utils()->get_course_completed_percent();

do_action('tutor_course/single/enrolled/before/lead_info/progress_bar');
?>
<div class="etlms-course-enrolled-info">
    <div class="etlms-course-status">
        <h4 class="tutor-segment-title">
            <?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?>
        </h4>
        <div class="etlms-progress-bar-wrap etlms-progress-<?= $position ?>">
            <div class="etlms-progress-bar">
                <div class="etlms-progress-filled" style="width:<?= $completed_count . '%;' ?>">
                </div>
            </div>
            <?php if ($display == 'show') : ?>
                <div class="etlms-progress-percent">
                    <h4><?php _e($completed_count, 'tutor-lms-elementor-addons'); ?>%</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
do_action('tutor_course/single/enrolled/after/lead_info/progress_bar');
?>