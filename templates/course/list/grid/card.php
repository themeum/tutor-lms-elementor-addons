<?php $animation_class = 'elementor-animation-' . $settings['course_list_card_hover_animation'] . $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>
<div class="tutor-card tutor-course-card tutor-loop-course-container <?php echo $animation_class; ?>">
	<div class="tutor-row tutor-gx-0">
		<div class="tutor-col-lg-4">
			<?php
				require etlms_get_template( 'course/list/grid/parts/thumbnail' );
				require etlms_get_template( 'course/list/parts/wishlist' );
				require etlms_get_template( 'course/list/parts/level' );
			?>
		</div>

		<div class="tutor-col-lg-8 tutor-d-flex tutor-flex-column">
			<div class="tutor-card-body">
				<?php
					require etlms_get_template( 'course/list/parts/ratings' );
					require etlms_get_template( 'course/list/parts/title' );
					require etlms_get_template( 'course/list/parts/meta' );
					require etlms_get_template( 'course/list/parts/info' );
					if ( 'yes' === $settings['course_list_current_user_progress'] ) {
						include etlms_get_template( 'course/status' );
					}
				?>
			</div>

			<?php require etlms_get_template( 'course/list/parts/footer' ); ?>
		</div>
	</div>
</div>
