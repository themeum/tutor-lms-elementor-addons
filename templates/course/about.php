<?php
$excerpt = tutor_get_the_excerpt();
$disable_about = get_tutor_option('disable_course_about');
if (!empty($excerpt) && ! $disable_about) {
    ?>
    <div class="etlms-course-summery">
        <h4  class="etlms-segment-title"><?php esc_html_e('About Course', 'tutor-elementor-addons') ?></h4>
        <div class="etlms-course-excerpt">
        	<?php echo $excerpt; ?>
        		
        </div>
    </div>
    <?php
}
	// else
	// {
	// 	esc_html_e('About content is not available','tutor-elementor-addons')
	// }
 ?>