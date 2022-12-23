<?php
/**
 * Course Share Template
 *
 * @package ETLMSCourseShare
 */
$tutor_social_share_icons = tutor_utils()->tutor_social_share_icons();
if ( ! tutor_utils()->count( $tutor_social_share_icons ) ) {
	return;
}

$share_config  = array(
	'title' => get_the_title(),
	'text'  => get_the_excerpt(),
	'image' => get_tutor_course_thumbnail( 'post-thumbnail', true ),
);
$section_title = $settings['course_share_section_title'];
$share_title   = $settings['course_share_title'];

?>

<div class="etlms-course-share">
	<a data-tutor-modal-target="tutor-course-share-opener" href="#" class="tutor-btn tutor-btn-ghost etlms-course-share-btn">
		<?php if ( isset( $settings['course_share_icon']['value'] ) && '' !== $settings['course_share_icon']['value'] ) : ?>
			<span class="etlms-course-share-icon">
				<?php \Elementor\Icons_Manager::render_icon( $settings['course_share_icon'], array( 'aria-hidden' => 'true' ) ); ?>
			</span>
		<?php else : ?>
			<span class="etlms-course-share-icon">
				<span class="tutor-icon-share" area-hidden="true"></span>
			</span>
		<?php endif; ?>
		<?php if ( 'yes' === $settings['course_share_label_content'] ) : ?>
			<span class="etlms-course-share-label tutor-ml-8">
				<?php _e('Share', 'tutor-lms-elementor-addons'); ?>
			</span>
		<?php endif; ?>
	</a>
</div>

<div id="tutor-course-share-opener" class="tutor-modal etlms-course-share-modal">
    <span class="tutor-modal-overlay"></span>
    <div class="tutor-modal-window">
        <div class="tutor-modal-content tutor-modal-content-white">
            <button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
                <span class="tutor-icon-times" area-hidden="true"></span>
            </button>
            <div class="tutor-modal-body">
				<?php if ( '' !== $section_title ) : ?>
				<div class="etlms-course-share-modal-title tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-16">
					<?php echo esc_html( $section_title ); ?>
                </div>
				<?php endif; ?>
                <div class="etlms-course-share-modal-sub-title tutor-fs-7 tutor-color-secondary tutor-mb-12">
                    <?php _e('Page Link', 'tutor-lms-elementor-addons') ?>
                </div>
                <div class="tutor-mb-32">
                    <input class="tutor-form-control" value="<?php echo get_permalink( get_the_ID() ); ?>" />
                </div>
                <div>
                    <?php if ( '' !== $share_title ) : ?>
						<div class="etlms-course-share-modal-link tutor-color-black tutor-fs-6 tutor-fw-medium tutor-mb-16">
							<?php echo esc_html( $share_title ); ?>
						</div>
					<?php endif; ?>
                    <div class="tutor-social-share-wrap" data-social-share-config="<?php echo esc_attr(wp_json_encode($share_config)); ?>">
                        <?php foreach ($tutor_social_share_icons as $icon) : ?>
                            <button class="tutor_share <?php echo esc_html( $icon['share_class'] ); ?> ' elementor-animation-<?php echo esc_html( $settings['course_share_hover_animation'] ); ?>" style="background: <?php echo esc_html( $icon['color'] ); ?>">
                                <?php if ( 'yes' === $settings['course_social_icon'] ) : ?>
                                    <?php echo $icon['icon_html']; ?>
                                <?php endif; ?>
                                <?php if ( 'yes' === $settings['course_social_icon_text'] ) : ?>
                                    &nbsp;<?php echo esc_html( $icon['text'] ); ?>
                                <?php endif; ?>
                            </button>
						<?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>