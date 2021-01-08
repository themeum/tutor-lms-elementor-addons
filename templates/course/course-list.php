<div class="<?php tutor_container_classes(); ?> etlms-course-list-main-wrap">

    <!--loading course init-->
    <?php

    /*
    * get settings from elementor
    */
    $course_list_perpage = $settings['course_list_perpage'];
    $course_list_column = $settings['course_list_column'];

    $include_by_categories = $settings['course_list_include_by_categories'];
    $exclude_by_categories = $settings['course_list_exclude_by_categories'];
    $include_by_authors = $settings['course_list_include_by_authors'];
    $exclude_by_authors = $settings['course_list_exclude_by_authors'];
    $order_by = $settings['course_list_order_by'];
    $order = $settings['course_list_order'];

    /*
    * query arguements
    */
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $args = [
        'post_type' => tutor()->course_post_type,
        'post_status' => 'publish',
        'posts_per_page' => $course_list_perpage,
        'paged' => $paged,
        'tax_query'=> array(
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

    do_action('tutor_elementor/before/course_list');

    if ($the_query->have_posts()) : ?>

        <!-- loop start -->
        <?php
        $shortcode_arg = isset($GLOBALS['tutor_shortcode_arg']) ? $GLOBALS['tutor_shortcode_arg']['column_per_row'] : null;
        $courseCols = $shortcode_arg === null ? tutor_utils()->get_option('courses_col_per_row', 4) : $shortcode_arg;
        ?>
        <!-- loop start -->

        <?php
        //set class masonry if yes
        $listStyle = "";
        if ("yes" == $settings['course_list_masonry']) {
            $listStyle = "masonry";
        } else {
            $listStyle = "tutor-courses";
        }
        ?>
        <div class="etlms-course-list-loop-wrap <?= $listStyle;?> tutor-courses-loop-wrap tutor-courses-layout-<?php echo $settings['course_list_column'] ?> etlms-course-list-<?= $settings['course_list_skin']; echo "yes"== $settings['course_list_masonry'] ?' etlms-masonry':'';?>">

            <?php while ($the_query->have_posts()) : $the_query->the_post();
            ?>
            
                <!-- course -wrapper -->
                <?php 
                    if(empty($settings['course_list_image'])){
                        $thumbnail_hide = "thumbnail-hide";
                    }else {
                        $thumbnail_hide = '';
                    }
                ?>
                <div class="tutor-course-col-<?= $course_list_column ?> etlms-course-list-col <?= $thumbnail_hide?>">
                    <?php
                        $image_size = $settings['course_list_image_size_size'];
                        $image_url = get_tutor_course_thumbnail($image_size, $url = true);
                        $animation = 'elementor-animation-'.$settings['course_list_card_hover_animation'];
                    ?>
                    <div class="etlms-card 
                    <?php 
                 
                    //course list style omit for overlayed skin
                    if ($settings['course_list_column'] == 1 AND $settings['course_list_skin'] != 'overlayed') { 
                        echo "etlms-course-list-style"; } 
                    echo "overlayed" == $settings['course_list_skin'] ? ' '.$animation:'';
                    if("yes"== $settings['card_hover_animation']){
                        echo " hover-animation";
                    }

                    ?>" >

                        <!-- header -->
                        
                        <div class="tutor-course-header <?php echo "overlayed" != $settings['course_list_skin'] ? ' '.$animation : '';
                            //"yes" == $settings['course_list_masonry'] ? 'etlms-masonry-brick' : '';
                        ?>">
                            <?php if("yes" == $settings['course_list_image']):?>
                            <a href="<?php the_permalink();?>">
                                <img src="<?= $image_url?>" alt="thumbnail" >
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
                                if ("yes" === $settings['course_list_difficulty_settings']) {
                                    echo '<span class="tutor-course-loop-level">' . get_tutor_course_level() . '</span>';
                                }
                                if ("yes" === $settings['course_list_wishlist_settings']) {
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
									<?php if ("yes" === $settings['course_list_rating_settings']) : ?>
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

									<?php if ("yes" === $settings['course_list_meta_data']) : ?>
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
											<?php if ("yes" === $settings['course_list_avatar_settings']) : ?>
												<a href="<?php echo $profile_url; ?>"> <?php echo tutor_utils()->get_tutor_avatar($post->post_author); ?></a>
											<?php endif; ?>
										</div>
										<?php if ("yes" == $settings['course_list_author_settings']) : ?>
											<div class="tutor-single-course-author-name">
												<span><?php _e('by', 'tutor-lms-elementor-addons'); ?></span>
												<a href="<?php echo $profile_url; ?>"><?php echo get_the_author(); ?></a>
											</div>
										<?php endif; ?>
										<div class="tutor-course-lising-category">
											<?php
											if ("yes" === $settings['course_list_category_settings']) {

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

								<?php
								$is_footer = $settings['course_list_footer_settings'];
								?>
								<div class="tutor-loop-course-footer etlms-carousel-footer" style="
									<?php if ($is_footer == 'yes') : ?>
										display:block;
										<?php else : ?>
										display: none;
									<?php endif; ?>    
									">
									<?php
									tutor_course_loop_price();
									?>
								</div>
							</div> <!-- etlms-course-container -->
				
					</div>
					
                </div>
                <!-- course -wrapper -->
				
            <?php
            endwhile;
            ?>
        </div>
        <!-- loop end -->

        <!-- pagination start -->
        <?php if("yes"==$settings['course_list_pagination_settings']):?>
        <?php
        /*
            *elementor pagination settings
            *pagination type
            *pagination label
        */
        $prev_next_pagination = true;
        $pagination_type = $settings['course_list_pagination_type'];

        //setting pagination type

        if ($pagination_type == 'numbers') {
            $prev_next_pagination = false;
        }

        $pagination_page_limit = $settings['course_list_pagination_page_limit'];
        $pagination_prev_label = $settings['course_list_pagination_previous_label'];
        $pagination_next_label = $settings['course_list_pagination_next_label'];

        $big = 999999999; // need an unlikely integer

        $pagination_link_arg = array(
            'base' => str_replace($big, '%#%', esc_url(site_url('courses/page/' . $big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'end_size' => $pagination_page_limit,
            'prev_next' => $prev_next_pagination,
            'prev_text' => __($pagination_prev_label, 'tutor-lms-elementor-addons'),
            'next_text' => __($pagination_next_label, 'tutor-lms-elementor-addons'),

            'total' => $the_query->max_num_pages
        );

        $pagination_links = paginate_links($pagination_link_arg);

        ?>
        <div class="etlms-course-list-pagination-wrap">

            <div class="etlms-pagination prev-next">
                <?php if ($pagination_type == "prev_next") : ?>

                    <?php if ($the_query->found_posts > $course_list_perpage) : ?>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $prev_page = $paged - 1;
                        $next_page = $paged + 1;
                        $prev_link = esc_url(site_url('courses/page/' . $prev_page));
                        $next_link = esc_url(site_url('courses/page/' . $next_page));
                        $max_page = $the_query->max_num_pages;
                        ?>
                        <?php if ($prev_page < 1) : ?>
                            <span class="page-numbers">
                                <?= $pagination_prev_label; ?>
                            </span>
                        <?php else : ?>
                            <a class="page-numbers" href="<?= $prev_link ?>">
                                <?= $pagination_prev_label; ?>

                            </a>
                        <?php endif; ?>

                        <?php if ($next_page > $max_page) : ?>
                            <span class="page-numbers">
                                <?= $pagination_next_label; ?>
                            </span>
                        <?php else : ?>
                            <a class="page-numbers" href="<?= $next_link ?>">
                                <?= $pagination_next_label; ?>

                            </a>
                        <?php endif; ?>

                    <?php endif; ?>

                <?php else : ?>
            </div>

            <div class="etlms-pagination pagination-numbers-prev-next">
                <?= $pagination_links; ?>
            </div>

        <?php endif; ?>
        </div>
        <?php endif;?>
        <!-- pagination end -->
    <?php

    else :

        /**
         * No course found
         */
        tutor_load_template('course-none');

    endif;

    tutor_course_archive_pagination();

    do_action('tutor_elementor/after/course_list');

    wp_reset_postdata();
    ?>
    <!--loading course init-->

    <input type="hidden" id="etlms_enroll_btn_type" value="<?= $settings['course_carousel_enroll_btn_type'] ?>">
    <input type="hidden" id="etlms_enroll_btn_cart" value="<?= $settings['course_coursel_button_icon'] ?>">
</div>