<?php do_action( 'tutor_course/single/before/benefits' ); ?>

<div class="etlms-course-specifications etlms-course-benefits">
	<div class="tutor-course-details-widget-title tutor-mb-16">
		<span class="tutor-color-text-primary tutor-text-medium-h6">
			<?php echo esc_html( $settings['what_i_will_learn_title'], 'tutor-lms-elementor-addons' ); ?>
		</span>
	</div>
	<ul class="etlms-course-specification-items">
		<?php
		$benefits = tutor_course_benefits();
		if ( is_array( $benefits ) && count( $benefits ) ) {
			foreach ( $benefits as $benefit ) :
				?>
			<li>
				<?php Elementor\Icons_Manager::render_icon( $settings['course_benefits_list_icon'], array( 'aria-hidden' => 'true' ) ); ?>
				<span>
					<?php echo esc_html( $benefit ); ?>
				</span>
			</li>
				<?php
			endforeach;
		} elseif ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			esc_html_e( 'Please add data from the course editor', 'tutor-lms-elementor-addons' );
		}
		?>
	</ul>
</div>

<?php do_action( 'tutor_course/single/after/benefits' ); ?>

