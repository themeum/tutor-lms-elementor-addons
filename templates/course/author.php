<?php

global $post;
$disable_course_author = get_tutor_option('disable_course_author');
$profile_url = tutils()->profile_url($post->post_author);
$author_name = get_the_author_meta('display_name', $post->post_author);

if (!$disable_course_author) { ?>
    <div class="etlms-author">
        <?php if ($settings['course_author_picture']) { ?>
            <div class="tutor-single-course-avatar">
                <a href="<?php echo $profile_url; ?>"> <?php echo tutils()->get_tutor_avatar($post->post_author); ?></a>
            </div>
        <?php } ?>
        <?php if ($settings['course_author_name']) { ?>
            <div class="tutor-single-course-author-name">
                <span><?php _e('by', 'tutor'); ?></span>
                <?php if ($settings['course_author_link'] == 'none') { 
                    echo "<p>{$author_name}</p>";
                } else {
                    $target_blank = ($settings['course_author_link'] == 'new_window') ? 'target="_blank"' : '';
                    echo '<a href="'.$profile_url.'" '. $target_blank .'>'.$author_name.'</a>';
                } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>