
<div class="<?php tutor_container_classes(); ?> etlms-carousel-main-wrap">

<!--loading course init-->
<?php
$include_by_categories = $settings['course_carousel_include_by_categories'];
$exclude_by_categories = $settings['course_carousel_exclude_by_categories'];
$include_by_authors = $settings['course_carousel_include_by_authors'];
$exclude_by_authors = $settings['course_carousel_exclude_by_authors'];
$order_by = $settings['course_carousel_order_by'];
$order = $settings['course_carousel_order'];
$limit = $settings['course_carousel_post_limit'];

/*
* query arguements
*/
$args = [
    'post_type'      => tutor()->course_post_type,
    'post_status'    => 'publish',
    'posts_per_page' => $limit,
    'tax_query'      => array(
        'relation' => 'AND',
    )
];

if (!empty($include_by_categories)) {
    $tax_query =array(
        'taxonomy' => 'course-category',
        'field' => 'term_id',
        'terms' => $include_by_categories,
        'operator' => 'IN'
    );
    array_push($args['tax_query'], $tax_query);
}

if (!empty($exclude_by_categories)) {
    $tax_query =array(
        'taxonomy' => 'course-category',
        'field' => 'term_id',
        'terms' => $exclude_by_categories,
        'operator' => 'NOT IN'
    );
    array_push($args['tax_query'], $tax_query);
}

if (!empty($include_by_authors)) {
    $args['author__in'] = $include_by_authors;
}

if (!empty($exclude_by_authors)) {
    $args['author__not_in'] = $exclude_by_authors;
}

if (!empty($order_by)) {
    $args['orderby'] = $order_by;
    $args['order'] = $order;
}

// the query
$the_query = new WP_Query($args);

//wp_reset_postdata();
//do_action('tutor_course/archive/before_loop');

if ( $the_query->have_posts()) : ?>

    <!-- loop start -->
    <?php
    $shortcode_arg = isset($GLOBALS['tutor_shortcode_arg']) ? $GLOBALS['tutor_shortcode_arg']['column_per_row'] : null;
    $courseCols = $shortcode_arg === null ? tutor_utils()->get_option('courses_col_per_row', 4) : $shortcode_arg;
    ?>
    <!-- loop start -->
    <?php 
        if(empty($settings['course_carousel_image'])){
            $thumbnail_hide = "thumbnail-hide";
        }else {
            $thumbnail_hide = "";
        }
    ?>
    <div class="etlms-carousel-loop-wrap tutor-courses tutor-courses-loop-wrap tutor-courses-layout-<?php echo $courseCols; ?> etlms-coursel-<?= $settings['course_carousel_skin'] ?> etlms-carousel-dots-<?= $settings['course_carousel_dots_position'] .' '.$thumbnail_hide ?>" id="etlms-slick-responsive">

        <?php while ($the_query->have_posts()) : $the_query->the_post();
        ?>
            <!-- slick-slider-main-wrapper -->

            <div class="<?php tutor_course_loop_col_classes(); ?>">
            <?php
                $image_size = $settings['course_carousel_image_size_size'];
                $image_url = get_tutor_course_thumbnail($image_size, $url = true);
                $animation = 'elementor-animation-'.$settings['course_carousel_img_hover_animation'];
            ?>
            <div class="etlms-card <?= "overlayed" == $settings['course_carousel_skin'] ? $animation : ''; 
            if("yes"== $settings['card_hover_animation']){
                echo " hover-animation";
            }
            ?>">

                    <!-- header -->
                    
                    <div class="tutor-course-header 
                    <?php 
                        
                        echo "overlayed" != $settings['course_carousel_skin'] ?' '. $animation : '';
                        
                    ?> 
                    ">
                        <?php if("yes" == $settings['course_carousel_image']):?>
                        <a href="<?php the_permalink();?>">
                            <img src="<?= $image_url?>" alt="">
                        </a> 
                        <?php endif;?>                              
                        <div class="tutor-course-loop-header-meta">
                            <?php
                            $course_id = get_the_ID();
                            $is_wishlisted = tutor_utils()->is_wishlisted($course_id);
                            $has_wish_list = '';
                            if ($is_wishlisted) {
                                $has_wish_list = 'has-wish-listed';
                            }

                            $action_class = '';
                            if (is_user_logged_in()) {
                                $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                            } else {
                                $action_class = apply_filters('tutor_popup_login_class', 'cart-required-login');
                            }
                            if ("yes" === $settings['course_carousel_difficulty_settings']) {
                                echo '<span class="tutor-course-loop-level">' . get_tutor_course_level() . '</span>';
                            }
                            if ("yes" === $settings['course_carousel_wishlist_settings']) {
                                echo '<span class="tutor-course-wishlist"><a href="javascript:;" class="tutor-icon-fav-line ' . $action_class . ' ' . $has_wish_list . ' " data-course-id="' . $course_id . '"></a> </span>';
                            }


                            ?>
                        </div> 

                    </div>
                  
                    <!--header end-->
                    <!-- start loop content wrap -->
                    <div class="etlms-carousel-course-container">
                        <div class="tutor-loop-course-container">

                            <!-- loop rating -->
                            <?php if ("yes" === $settings['course_carousel_rating_settings']) : ?>
                                <div class="tutor-loop-rating-wrap">
                                    <?php
                                    $course_rating = tutor_utils()->get_course_rating();
                                    tutor_utils()->star_rating_generator($course_rating->rating_avg);
                                    ?>
                                    <span class="tutor-rating-count">
                                        <?php
                                        if ($course_rating->rating_avg > 0) {
                                            echo apply_filters('tutor_course_rating_average', $course_rating->rating_avg);
                                            echo '<i>(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) . ')</i>';
                                        }
                                        ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <!-- loop title -->
                            <div class="tutor-course-loop-title">
                                <h2><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div>

                            <!-- loop meta -->
                            <?php
                            /**
                             * @package TutorLMS/Templates
                             * @version 1.4.3
                             */

                            global $post, $authordata;

                            $profile_url = tutor_utils()->profile_url($authordata->ID);
                            ?>


                            <?php if ("yes" === $settings['course_carousel_meta_data']) : ?>
                                <div class="tutor-course-loop-meta">
                                    <?php
                                    $course_duration = get_tutor_course_duration_context();
                                    $course_students = tutor_utils()->count_enrolled_users_by_course();
                                    ?>
                                    <div class="tutor-single-loop-meta">
                                        <i class='tutor-icon-user'></i><span><?php echo $course_students; ?></span>
                                    </div>
                                    <?php
                                    if (!empty($course_duration)) { ?>
                                        <div class="tutor-single-loop-meta">
                                            <i class='tutor-icon-clock'></i> <span><?php echo $course_duration; ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>

                            <div class="tutor-loop-author">
                                <div class="tutor-single-course-avatar">
                                    <?php if ("yes" === $settings['course_carousel_avatar_settings']) : ?>
                                        <a href="<?php echo $profile_url; ?>"> <?php echo tutor_utils()->get_tutor_avatar($post->post_author); ?></a>
                                    <?php endif; ?>
                                </div>
                                <div class="tutor-single-course-author-name">
                                    <span><?php _e('by', 'tutor-lms-elementor-addons'); ?></span>
                                    <a href="<?php echo $profile_url; ?>"><?php echo get_the_author(); ?></a>
                                </div>

                                <div class="tutor-course-lising-category">
                                    <?php
                                    if ("yes" === $settings['course_carousel_category_settings']) {

                                        $course_categories = get_tutor_course_categories();
                                        if (!empty($course_categories) && is_array($course_categories) && count($course_categories)) {
                                    ?>
                                            <span><?php esc_html_e('In', 'tutor-lms-elementor-addons') ?></span>
                                    <?php
                                            foreach ($course_categories as $course_category) {
                                                $category_name = $course_category->name;
                                                $category_link = get_term_link($course_category->term_id);
                                                echo "<a href='$category_link'>$category_name </a>";
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- end content wrap -->
                        </div>

                        <!-- loop footer -->
                        <?php if ("yes" === $settings['course_carousel_footer_settings']) : ?>
                            <div class="tutor-loop-course-footer etlms-carousel-footer">
                                <?php
                                tutor_course_loop_price()
                                ?>
                            </div>
                        <?php endif; ?>    
                    </div> <!-- etlms-course-container -->
                    


                </div><!--card-end-->
            </div>

            <!-- slick-slider-main-wrapper -->

        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
    <!--arrow start-->
    <?php if("yes" == $settings['course_carousel_settings_arrows']):?>
    <div class="etlms-carousel-arrow etlms-carousel-arrow-prev arrow-<?= $settings['course_carousel_arrow_style'] ?> etlms-carousel-arrow-position-<?= $settings['course_carousel_arrows_position']; ?> ">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
    </div>
    <div class="etlms-carousel-arrow etlms-carousel-arrow-next arrow-<?= $settings['course_carousel_arrow_style'] ?> etlms-carousel-arrow-position-<?= $settings['course_carousel_arrows_position']; ?>">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
    </div>
    <?php endif;?>
    <!--arrow end-->

    <!-- loop end -->
<?php

else :

    /**
     * No course found
     */
    tutor_load_template('course-none');

endif;

tutor_course_archive_pagination();

do_action('tutor_course/archive/after_loop');
?>
<!--loading course init-->

<!-- handle elementor settings -->
<?php
$carousel_column = "3";
$carousel_column_tablet = "2";
$carousel_column_mobile = "1";
$carousel_arrows = 'yes';
$carousel_dots = "yes";
$carousel_transition = '600';
$carousel_center = 'yes';
$carousel_smooth_scroll = 'yes';
$carousel_autoplay = 'yes';
$carousel_autoplay_speed = '5000';
$carousel_infinite_loop = 'yes';
$carousel_pause_on_hover = 'yes';


if (isset($settings)) {

    $settings['etlms_course_carousel_column'] != '' ? $carousel_column =  $settings['etlms_course_carousel_column'] : '';

    $settings['etlms_course_carousel_column_tablet'] != '' ? $carousel_column_tablet =  $settings['etlms_course_carousel_column_tablet'] : '';

    $settings['etlms_course_carousel_column_mobile'] != '' ? $carousel_column_mobile =  $settings['etlms_course_carousel_column_mobile'] : '';

    isset($settings['course_carousel_column_mobile']) ? $carousel_column_mobile = $settings['course_carousel_column_mobile'] : '';

    $settings['course_carousel_settings_arrows'] == 'yes' ? '' : $carousel_arrows = 'no';

    $settings['course_carousel_settings_dots'] == 'yes' ? '' : $carousel_dots = 'no';

    $carousel_transition = $settings['course_carousel_settings_transition'];

    $settings['course_carousel_settings_center_slides'] == 'yes' ? '' : $carousel_center = 'no';

    $settings['course_carousel_settings_scroll'] == 'yes' ? $carousel_smooth_scroll = 'linear' : $carousel_smooth_scroll = 'ease';

    $settings['course_carousel_settings_autoplay'] == 'yes' ? '' : $carousel_autoplay = 'no';

    $carousel_autoplay_speed = $settings['course_carousel_settings_autoplay_speed'];

    $settings['course_carousel_settings_infinite_loop'] == 'yes' ? '' : $carousel_infinite_loop = 'no';

    $settings['course_carousel_settings_pause_onhover'] == 'yes' ? '' : $carousel_pause_on_hover = 'no';

   
}
?>
<div id="etlms_carousel_settings" arrows="<?= $carousel_arrows ?>" dots="<?= $carousel_dots ?>" transition="<?= $carousel_transition ?>" center="<?= $carousel_center ?>" smoth_scroll="<?= $carousel_smooth_scroll ?>" auto_play="<?= $carousel_autoplay ?>" auto_play_speed="<?= $carousel_autoplay_speed ?>" infinite_loop="<?= $carousel_infinite_loop ?>" pause_on_hover="<?= $carousel_pause_on_hover ?>" desktop="<?= $carousel_column ?>" medium="<?= $carousel_column_tablet ?>" mobile="<?= $carousel_column_mobile ?>">


</div>
<input type="hidden" id="etlms_enroll_btn_type" value="<?= $settings['course_carousel_enroll_btn_type'] ?>">
<input type="hidden" id="etlms_enroll_btn_cart" value="<?= $settings['course_coursel_button_icon'] ?>">
</div>