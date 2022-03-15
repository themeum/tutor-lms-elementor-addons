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
	<a data-tutor-modal-target="tutor-course-share-opener" href="#" class="action-btn tutor-text-regular-body tutor-color-black tutor-d-flex align-items-center">
		<?php if ( isset( $settings['course_share_icon']['value'] ) && '' !== $settings['course_share_icon']['value'] ) : ?>
			<?php \Elementor\Icons_Manager::render_icon( $settings['course_share_icon'], array( 'aria-hidden' => 'true' ) ); ?>
		<?php else : ?>
			<i class="tutor-icon-share-filled"></i>
		<?php endif; ?>
		<span class="share-text">
			<?php if ( 'yes' === $settings['course_share_label_content'] ) : ?>
				<?php esc_html_e( 'Share', 'tutor-lms-elementor-addons' ); ?>
			<?php endif; ?>
		</span>
	</a>
</div>

<div id="tutor-course-share-opener" class="tutor-modal">
	<span class="tutor-modal-overlay"></span>
	<div class="tutor-modal-root">
		<div class="tutor-modal-inner tutor-modal-close-inner">
			<div class="tutor-modal-body etlms-course-share-popup" style="padding:40px">
				<button data-tutor-modal-close class="tutor-modal-close">
					<span class="tutor-icon-line-cross-line"></span>
				</button>
				<?php if ( '' !== $section_title ) : ?>
				<div class="tutor-text-medium-h5 color-text-primary tutor-mb-16">
					<?php echo esc_html( $section_title ); ?>
				</div>
				<?php endif; ?>
				<div class="tutor-text-regular-caption color-text-subsued tutor-mb-12">
					<?php esc_html_e( 'Page Link', 'tutor-lms-elementor-addons' ); ?>
				</div>
				<div class="tutor-mb-32">
					<input class="tutor-form-control" value="<?php echo get_permalink( get_the_ID() ); ?>" />
				</div>
				<div>
					<?php if ( '' !== $share_title ) : ?>
						<div class="color-text-primary tutor-text-medium-h6 tutor-mb-16">
							<?php echo esc_html( $share_title ); ?>
						</div>
					<?php endif; ?>
					<div class="tutor-social-share-wrap tutor-d-flex" data-social-share-config="<?php echo esc_attr( wp_json_encode( $share_config ) ); ?>">
						<?php foreach ( $tutor_social_share_icons as $icon ) : ?>
							<button class="tutor_share <?php echo esc_attr( $icon['share_class'] . ' elementor-animation-' . $settings['course_share_hover_animation'] ); ?>">
								<span class="social-icon">
									<?php
									if ( 'yes' === $settings['course_social_icon'] ) {
										echo $icon['icon_html'];
									}
									?>
								</span>
								<span>
									<?php
									if ( 'yes' === $settings['course_social_icon_text'] ) {
										echo esc_html( $icon['text'] );
									}
									?>
								</span>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
