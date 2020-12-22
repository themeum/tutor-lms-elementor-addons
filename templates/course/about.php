<?php
$excerpt = tutor_get_the_excerpt();
$disable_about = get_tutor_option('disable_course_about');
if (!$disable_about) {
?>
    <div class="etlms-course-summery">
        <h4 class="tutor-segment-title"><?php esc_html_e($settings['section_title_text'], 'tutor-elementor-addons'); ?></h4>
        <div class="tutor-course-excerpt">
            <?php echo $excerpt;
            if (!empty($excerpt)) {
                echo $excerpt;
            } else if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                echo '<span style="margin: 5px">' . __('Please add data from the course editor', 'tutor-elementor-addons') . '</span>';
            }
            ?>
        </div>
    </div>
<?php
}
?>