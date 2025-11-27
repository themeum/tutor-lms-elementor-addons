<?php $animation_class = $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>
<div class="tutor-course-card etlms-course-card-stacked <?php echo esc_html( $animation_class ); ?>">
	<?php
		require etlms_get_template( 'course/list/parts/thumbnail' );
		require etlms_get_template( 'course/list/parts/wishlist' );
		require etlms_get_template( 'course/list/parts/level' );
	?>

	<div class="tutor-card etlms-course-card-inner">
		<div class="tutor-card-body">
			<?php
				require etlms_get_template( 'course/list/parts/ratings' );
				require etlms_get_template( 'course/list/parts/title' );
				require etlms_get_template( 'course/list/parts/meta' );
				require etlms_get_template( 'course/list/parts/info' );
			?>
		</div>

		<?php require etlms_get_template( 'course/list/parts/footer' ); ?>
	</div>
</div>
