
<div class="tutor-wrap">
<?php


if (!defined('ABSPATH'))
	exit;

	global $wp_query;
	if (is_user_logged_in()) {

		$is_administrator = current_user_can('administrator');
		$is_instructor = tutor_utils()->is_instructor_of_this_course();
		$course_content_access = (bool) get_tutor_option('course_content_access_for_ia');
		if (tutils()->is_enrolled() || ($course_content_access && ($is_administrator || $is_instructor))) {
			tutor_course_enrolled_nav();

			if (!empty($wp_query->query_vars['course_subpage'])) {
				$course_subpage = $wp_query->query_vars['course_subpage'];
				if ($course_subpage == 'questions') {
					tutor_course_question_and_answer();
				} else if ($course_subpage == 'announcements') {
					tutor_course_announcements();
				} else if ($course_subpage == 'overview') {
					get_tutor_posts_attachments();
				}
				do_action("tutor_course/single/enrolled/{$course_subpage}", get_the_ID());
			}

			do_action('tutor_course/single/enrolled/after/inner-wrap');
		}
	} 
	
	if (empty($wp_query->query_vars['course_subpage'])) {
		$topics = tutor_utils()->get_topics();
		$course_id = get_the_ID();
		$is_enrolled = tutor_utils()->is_enrolled($course_id);


		$topic_collapse_icon = 'fa fa-plus';
		$topic_expand_icon = 'fa fa-minus';

		if (isset($settings)) {
			$settings['course_topic_collapse_icon'] ? $topic_collapse_icon = $settings['course_topic_collapse_icon'] : '';
			$settings['course_topic_expand_icon'] ? $topic_expand_icon = $settings['course_topic_expand_icon'] : '';

			echo "<input type='hidden' id='etlms-course-topic-collapse-icon' value='" . $topic_collapse_icon . "'>";
			echo "<input type='hidden' id='etlms-course-topic-expand-icon' value='" . $topic_expand_icon . "'>";
		}
		?>

		<?php do_action('tutor_course/single/before/topics'); ?>

		<div class="tutor-course-topics-wrap">
			<div class="tutor-course-topics-header">
				<div class="tutor-course-topics-header-left">
					<h4 class="tutor-segment-title"><?php _e($settings['section_title_text'], 'tutor-lms-elementor-addons'); ?></h4>
				</div>
				<div class="tutor-course-topics-header-right">
					<?php
					$tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
					$tutor_course_duration = get_tutor_course_duration_context($course_id);

					if ($tutor_lesson_count) {
						echo "<span> $tutor_lesson_count";
						_e(' Lessons', 'tutor-lms-elementor-addons');
						echo "</span>";
					}
					if ($tutor_course_duration) {
						echo "<span>$tutor_course_duration</span>";
					}
					?>
				</div>
			</div>
			<div class="tutor-course-topics-contents">
				<?php
				if ($topics->have_posts()) {
					$index = 0;

					if ($topics->have_posts()) {
						while ($topics->have_posts()) {
							$topics->the_post();
							$topic_summery = get_the_content();
							$index++;
						?>

							<div class="etlms-course-topic <?php if ($index == 1) echo "etlms-topic-active"; ?>">
								<div class="etlms-course-curriculum-title <?php echo $topic_summery ? 'has-summery' : ''; ?>">
									<h4>
										<i class="<?php echo ($index == 1) ? $topic_expand_icon : $topic_collapse_icon; ?>" id="etlms-course-topic-icon"></i>
										<?php
										the_title();
										/* if ($topic_summery) {
											echo "<i id='topic-toggle' class='toogle-informaiton-icon' title='$topic_summery'>&quest;</i>";
										} */
										?>
									</h4>
								</div>

								<div class="tutor-course-lessons" style="<?php echo $index > 1 ? 'display: none' : ''; ?>">

									<?php
									$lessons = tutor_utils()->get_course_contents_by_topic(get_the_ID(), -1);

									if ($lessons->have_posts()) {
										while ($lessons->have_posts()){ $lessons->the_post();
											global $post;

											$video = tutor_utils()->get_video_info();

											$play_time = false;
											if ($video){
												$play_time = $video->playtime;
											}

											$lesson_icon = $play_time ? 'tutor-icon-youtube' : 'tutor-icon-document-alt';

											if ($post->post_type === 'tutor_quiz'){
												$lesson_icon = 'tutor-icon-doubt';
											}
											if ($post->post_type === 'tutor_assignments'){
												$lesson_icon = 'tutor-icon-clipboard';
											}
											?>

											<div class="tutor-course-lesson">
												<h5>
													<?php
													$lesson_title = '';
													if (has_post_thumbnail()){
														$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
														$lesson_title .= "<i style='background:url({$thumbnail_url})' class='tutor-lesson-thumbnail-icon $lesson_icon'></i>";
													}else{
														$lesson_title .= "<i class='$lesson_icon'></i>";
													}

													$countdown = '';
													if ($post->post_type === 'tutor_zoom_meeting'){
														$lesson_title = '<i class="zoom-icon"><img src="'.TUTOR_ZOOM()->url . 'assets/images/zoom-icon-grey.svg"></i>';
														
														$zoom_meeting = tutor_zoom_meeting_data($post->ID);
														$countdown = '<div class="tutor-zoom-lesson-countdown tutor-lesson-duration" data-timer="'.$zoom_meeting->countdown_date.'" data-timezone="'.$zoom_meeting->timezone.'"></div>';
													}

													// Show clickable content if enrolled
													// Or if it is public and not paid, then show content forcefully
													if ($is_enrolled || (get_post_meta($course_id, '_tutor_is_public_course', true)=='yes' && !tutor_utils()->is_course_purchasable($course_id))){
														$lesson_title .= "<a href='".get_the_permalink()."'> ".get_the_title()." </a>";

														$lesson_title .= $play_time ? "<span class='tutor-lesson-duration'>".tutor_utils()->get_optimized_duration($play_time)."</span>" : '';

														if ($countdown) {
															if ($zoom_meeting->is_expired) {
																$lesson_title .= '<span class="tutor-zoom-label">'.__('Expired', 'tutor-lms-elementor-addons').'</span>';
															} else if ($zoom_meeting->is_started) {
																$lesson_title .= '<span class="tutor-zoom-label tutor-zoom-live-label">'.__('Live', 'tutor-lms-elementor-addons').'</span>';
															}
															$lesson_title .= $countdown;
														}

														echo $lesson_title;
													}else{
														$lesson_title .= get_the_title();
														$lesson_title .= $play_time ? "<span class='tutor-lesson-duration'>".tutor_utils()->get_optimized_duration($play_time)."</span>" : '';
														echo apply_filters('tutor_course/contents/lesson/title', $lesson_title, get_the_ID());
													}

													?>
												</h5>
											</div>

											<?php
										}
										wp_reset_postdata();
									}
									?>
								</div>
							</div>
						<?php
						}
						wp_reset_postdata();
					}
				} else if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
					echo __('Please add data from the course editor', 'tutor-lms-elementor-addons');
				}
				?>
			</div>
		</div>

		<?php do_action('tutor_course/single/after/topics');

	} ?>

</div>