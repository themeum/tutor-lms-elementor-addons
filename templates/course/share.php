<style>
.tutor-single-course-meta.tutor-meta-top ul li {
    width: 100%;
}

</style>
<?php

global $post;
$disable_course_share = get_tutor_option('disable_course_share');

if ( !$disable_course_share){ ?>
<div class="tutor-single-course-meta tutor-meta-top">

    <div class="etlms-social">
    	<?php if($settings['course_share_label_content']):?>
        <div class="etlms-social-label"><?php _e('Share:', 'tutor'); ?></div>
    	<?php endif;?>
        <?php 
        	$template = tutor_social_share(false);

        	$template = str_replace("tutor-social-share-wrap","etlms-social-share-wrap",$template);
        	if($settings['course_share_hover_animation']){
        		$template = str_replace("tutor_share","etlms-share-btn elementor-animation-".$settings['course_share_hover_animation'],$template);
        	}
        	else{
        		$template = str_replace("tutor_share","etlms-share-btn",$template);
        	}
        	
        	echo $template;
        ?>

    </div>

</div>
<?php } ?>