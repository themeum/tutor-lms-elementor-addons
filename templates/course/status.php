<?php
//get completed status from tutor
$completed_count = 15; 

$get_complete_percent = tutor_utils()->get_course_completed_percent();
$get_complete_percent ? $completed_count = $get_complete_percent : '';

$position = 'outside';
$display = 'show';
if(isset($settings['course_status_percent_position']))
{
	
	$position = $settings['course_status_percent_position'];
}    	
if(isset($settings['course_status_display_percent']))
{
	
	$display = $settings['course_status_display_percent'];
}

?>
<div class="etlms-course-enrolled-info">
<div class="etlms-course-status">
    <h4 class="etlms-segment-title">
    	<?php _e('Course Status', 'tutor'); ?>
    		
    </h4>
    <div class="etlms-progress-bar-wrap etlms-progress-<?= $position?>">

        <div class="etlms-progress-bar">

            <div class="etlms-progress-filled" style="width:<?= $completed_count.'%;'?>">
            	
            </div>
        </div>
        <?php if($display=='show'):?>
    	<div class="etlms-progress-percent">
    		<?php _e($completed_count,'tutor-elementor-addons'); ?>%
    	</div>
		<?php endif;?>

    </div>
</div>
</div>