<?php
/**
 * Course benefits template
 *
 * @package ETLMSCourseBenefits
 */

do_action( 'tutor_course/single/before/benefits' );
$benefits = tutor_course_benefits();
$show_benefits = tutor_utils()->get_option( 'enable_course_benefits' );
?>
<?php if ( $show_benefits ) : ?>
<?php if (is_array($benefits) && count($benefits)): ?>
	<div class="etlms-course-widget etlms-course-benefits tutor-course-details-widget tutor-course-details-widget-col-2 tutor-mt-lg-50 tutor-mt-32 tutor-mb-32">
		<h3 class="tutor-course-details-widget-title tutor-fs-5 tutor-fw-bold tutor-color-black tutor-mb-16 etlms-course-widget-title">
			<?php echo esc_html( $settings['what_i_will_learn_title'], 'tutor-lms-elementor-addons' ); ?>
		</h3>
		<ul class="etlms-course-widget-list-items tutor-course-details-widget-list tutor-color-black tutor-fs-6 tutor-m-0 tutor-mt-16">
			<?php if ( is_array( $benefits ) && count( $benefits ) ) : ?>
			<?php foreach ($benefits as $benefit): ?>
				<li class="etlms-course-widget-list-item tutor-d-flex tutor-mb-12">
				<span class="tutor-mr-12 tutor-list-icon tutor-color-primary"><?php Elementor\Icons_Manager::render_icon( $settings['course_benefits_list_icon'], array( 'aria-hidden' => 'true' ) ); ?></span>
					<span class="tutor-list-label"><?php echo $benefit; ?></span>
				</li>
			<?php endforeach; ?>
			<?php elseif (\Elementor\Plugin::instance()->editor->is_edit_mode()) : ?>
			<?php esc_html_e( 'Please add data from the course editor', 'tutor-lms-elementor-addons' ); ?>
		<?php endif; ?>
		</ul>
	</div>
<?php 
endif;
endif;
do_action( 'tutor_course/single/after/benefits' ); 