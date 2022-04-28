<?php
/**
 * Course benefits template
 *
 * @package ETLMSCourseBenefits
 */

do_action( 'tutor_course/single/before/benefits' );
$benefits = tutor_course_benefits();
?>

<div class="etlms-course-widget etlms-course-benefits tutor-mb-32">
	<h3 class="etlms-course-widget-title tutor-fs-5 tutor-color-black tutor-fw-bold tutor-mb-16">
		<?php echo esc_html( $settings['what_i_will_learn_title'], 'tutor-lms-elementor-addons' ); ?>
	</h3>
	<ul class="etlms-course-widget-list-items tutor-fs-6 tutor-color-black">
		<?php if ( is_array( $benefits ) && count( $benefits ) ) : ?>
		<?php foreach ($benefits as $benefit): ?>
			<li class="etlms-course-widget-list-item">
				<span class="tutor-mr-12 tutor-list-icon tutor-color-primary"><?php Elementor\Icons_Manager::render_icon( $settings['course_benefits_list_icon'], array( 'aria-hidden' => 'true' ) ); ?></span>
				<span class="tutor-flex-shrink-0 tutor-list-label"><?php echo esc_html( $benefit ); ?></span>
			</li>
		<?php endforeach; ?>
		<?php elseif (\Elementor\Plugin::instance()->editor->is_edit_mode()) : ?>
			<?php esc_html_e( 'Please add data from the course editor', 'tutor-lms-elementor-addons' ); ?>
		<?php endif; ?>
	</ul>
</div>

<?php do_action( 'tutor_course/single/after/benefits' ); ?>