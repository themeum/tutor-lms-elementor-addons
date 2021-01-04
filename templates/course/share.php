<?php

global $post;
$share_config = array(
	'title' => get_the_title(),
	'text'  => get_the_excerpt(),
	'image' => get_tutor_course_thumbnail('post-thumbnail', true),
);
?>
<div class="etlms-social">
	<?php if ($settings['course_share_label_content']) : ?>
		<div class="etlms-social-label"><?php _e('Share:', 'tutor-lms-elementor-addons'); ?></div>
	<?php endif; ?>
	<div class="tutor-social-share-wrap etlms-social-share-wrap" data-social-share-config="<?php echo esc_attr(wp_json_encode($share_config)); ?>">
		<?php
		$tutor_social_share_icons = tutils()->tutor_social_share_icons();
		$animation = ($settings['course_share_hover_animation']) ? 'elementor-animation-'.$settings['course_share_hover_animation'] : '';
		if (tutils()->count($tutor_social_share_icons)) {
			foreach ($tutor_social_share_icons as $icon) {
				echo "<button class='tutor_share etlms-share-btn {$icon['share_class']} {$animation}'> {$icon['icon_html']} </a>";
			}
		}
		?>
	</div>
</div>