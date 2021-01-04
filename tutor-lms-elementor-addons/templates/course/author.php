<?php

global $post;
$profile_url = tutils()->profile_url($post->post_author);
$author_name = get_the_author_meta('display_name', $post->post_author);
$target_blank = ($settings['course_author_link'] == 'new_window') ? 'target="_blank"' : '';
?>
<div class="etlms-author">
    <?php if ($settings['course_author_picture']) { ?>
        <div class="tutor-single-course-avatar">
            <?php if ($settings['course_author_link'] == 'none') { ?>
                <a><?php echo tutils()->get_tutor_avatar($post->post_author); ?></a>
            <?php } else { ?>
                <a href="<?php echo $profile_url; ?>" <?php echo $target_blank; ?>> <?php echo tutils()->get_tutor_avatar($post->post_author); ?></a>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if ($settings['course_author_name']) { ?>
        <div class="tutor-single-course-author-name">
            <span><?php _e('by', 'tutor-lms-elementor-addons'); ?></span>
            <?php if ($settings['course_author_link'] == 'none') { 
                echo "<p>{$author_name}</p>";
            } else {
                echo '<a href="'.$profile_url.'" '. $target_blank .'>'.$author_name.'</a>';
            } ?>
        </div>
    <?php } ?>
</div>