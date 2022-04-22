<?php

global $post;
$profile_url  = tutils()->profile_url( $post->post_author );
$author_name  = get_the_author_meta( 'display_name', $post->post_author );
$target_blank = ( $settings['course_author_link'] == 'new_window' ) ? 'target="_blank"' : '';
?>
<?php if ( $settings['course_author_picture'] || $settings['course_author_name'] ) : ?>
<div class="etlms-author tutor-meta">
	<?php if ( $settings['course_author_picture'] ) : ?>
		<div class="tutor-single-course-avatar">
			<?php if ( $settings['course_author_link'] == 'none' ) : ?>
				<?php echo tutils()->get_tutor_avatar( $post->post_author ); ?>
			<?php else : ?>
				<a href="<?php echo $profile_url; ?>" <?php echo $target_blank; ?>>
					<?php echo tutils()->get_tutor_avatar( $post->post_author ); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $settings['course_author_name'] ) : ?>
		<div class="tutor-single-course-author-name">
			<span><?php _e( 'by', 'tutor-lms-elementor-addons' ); ?></span>
			<?php if ( $settings['course_author_link'] == 'none' ) : ?>
				<span class='tutor-meta-value'><?php echo $author_name; ?></span>
			<?php else: ?>
				<a href="<?php echo $profile_url; ?>" <?php echo $target_blank; ?>><?php echo $author_name; ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>
