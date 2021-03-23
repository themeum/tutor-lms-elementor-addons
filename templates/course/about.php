<?php
$excerpt = tutor_get_the_excerpt();
?>
<div class="etlms-course-summery">
    <h4 class="tutor-segment-title"><?php esc_html_e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h4>
    <div class="tutor-course-excerpt">
        <?php
        if ( !empty( $excerpt ) ) {
            echo nl2br( $excerpt );
        } else if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            echo '<span style="margin: 5px">' . __('Please add data from the course editor', 'tutor-lms-elementor-addons') . '</span>';
        }
        ?>
    </div>
</div>
