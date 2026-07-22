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
$icon_shape    = $settings['course_share_icon_shape'];

?>

<div class="etlms-course-share">
	<a data-tutor-modal-target="tutor-course-share-opener" href="#" class="tutor-btn tutor-btn-ghost etlms-course-share-btn">
		<?php if ( isset( $settings['course_share_icon']['value'] ) && '' !== $settings['course_share_icon']['value'] ) : ?>
			<span class="etlms-course-share-icon">
				<?php
				if ( isset( $settings['course_share_icon']['library'] ) && 'svg' === $settings['course_share_icon']['library'] ) {
					\Elementor\Icons_Manager::render_icon( $settings['course_share_icon'], array( 'aria-hidden' => 'true' ) );
				} else {
					?>
							<i aria-hidden="true" class="<?php echo esc_attr( $settings['course_share_icon']['value'] ); ?>"></i>
						<?php
				}
				?>
			</span>
		<?php else : ?>
			<span class="etlms-course-share-icon">
				<span class="tutor-icon-share" area-hidden="true"></span>
			</span>
		<?php endif; ?>
		<?php if ( 'yes' === $settings['course_share_label_content'] ) : ?>
			<span class="etlms-course-share-label tutor-ml-8">
				<?php _e( 'Share', 'tutor-lms-elementor-addons' ); ?>
			</span>
		<?php endif; ?>
	</a>
</div>

<div id="tutor-course-share-opener" class="tutor-modal etlms-course-share-modal" role="dialog" aria-modal="true" aria-labelledby="tutor-course-share-title" aria-hidden="true">
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
					<?php _e( 'Page Link', 'tutor-lms-elementor-addons' ); ?>
				</div>
				<div class="tutor-mb-32 tutor-position-relative">
					<input class="tutor-form-control" value="<?php echo esc_attr( get_permalink( get_the_ID() ) ); ?>" aria-label="<?php esc_attr_e( 'Course Link', 'tutor' ); ?>" readonly />
					<button class="tutor-btn tutor-btn-icon tutor-copy-text tutor-position-absolute tutor-bg-white" style="right: 2px; top: 2px;" data-text="<?php echo esc_attr( get_permalink( get_the_ID() ) ); ?>" aria-label="<?php esc_attr_e( 'Copy link', 'tutor' ); ?>">
						<span class="icon tutor-icon-copy" aria-hidden="true"></span>
					</button>
				</div>
				<div>
					<?php if ( 'yes' === $settings['course_social_icon'] ) : ?>
						<?php if ( '' !== $share_title ) : ?>
							<div class="etlms-course-share-modal-link tutor-color-black tutor-fs-6 tutor-fw-medium tutor-mb-16">
								<?php echo esc_html( $share_title ); ?>
							</div>
						<?php endif; ?>
						<div class="tutor-social-share-wrap" data-social-share-config="<?php echo esc_attr( wp_json_encode( $share_config ) ); ?>">
							<?php foreach ( $tutor_social_share_icons as $icon ) : ?>
								<button class="tutor_share etlms-social-icon-<?php echo esc_html( $icon_shape ); ?> <?php echo esc_html( $icon['share_class'] ); ?> ' elementor-animation-<?php echo esc_html( $settings['course_share_hover_animation'] ); ?> tutor-social-share-button" style="background: <?php echo esc_html( $icon['color'] ); ?>">
										<?php echo wp_kses( $icon['icon_html'], tutor_utils()->allowed_icon_tags() ); ?>
										<span>
											<?php echo esc_html( $icon['text'] ); ?>
										</span>
								</button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>