<?php
$excerpt = tutor_get_the_excerpt();
$disable_about = get_tutor_option('disable_course_about');
if (!empty($excerpt) && ! $disable_about) {
    ?>
    <div class="etlms-course-summery">
        <h4  class="tutor-segment-title"><?php esc_html_e('About Course', 'tutor-elementor-addons') ?></h4>
        <div class="tutor-course-excerpt">
        	<?php echo $excerpt; ?>
        </div>
    </div>
    <?php
}
 ?>