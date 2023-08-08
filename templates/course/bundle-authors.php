<?php
/**
 * Template for displaying bundle authors in bundle details.
 *
 * @package TutorPro\CourseBundle
 * @subpackage Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 2.2.0
 */

use TutorPro\CourseBundle\Models\BundleModel;

$bundle_id = isset( $data['bundle_id'] ) ? $data['bundle_id'] : get_the_ID();
$authors   = BundleModel::get_bundle_course_authors( $bundle_id ?? 0 );
$title 					= $settings['about_the_instructors_title'];
$show_profile_picture 	= $settings['course_instructor_profile'];
$display_name         	= $settings['course_instructor_name'];

?>
<div class="tutor-courses-instructors tutor-courses-instructors tutor-d-flex tutor-flex-column" style="gap: 24px">
	<h2 class="tutor-fs-5 tutor-fw-bold tutor-color-black tutor-mb-12">
		<?php echo esc_html( $title ); ?>
	</h2>
	<?php if ( is_array( $authors ) && count( $authors ) ) : ?>
		<?php
		foreach ( $authors as $author ) :
			$profile_url = tutor_utils()->profile_url( $author->user_id, true );
			?>
			<div class="tutor-d-flex tutor-align-center">
			<?php if ( 'yes' === $show_profile_picture ) : ?>
				<div class="tutor-d-flex tutor-mr-16">
					<div class="tutor-avatar tutor-avatar-md">
						<div class="tutor-ratio tutor-ratio-1x1">
							<img src="<?php echo esc_url( get_avatar_url( $author->user_id ) ); ?>" alt="<?php echo esc_attr( $author->display_name ); ?>"> 
						</div>
					</div>			
				</div>
			 <?php endif; ?>	
				<div>	
				<?php if ( 'yes' === $display_name ) : ?>
					<a class="tutor-fs-6 tutor-fw-bold tutor-color-black" href="<?php echo esc_url( $profile_url ); ?>" target="_blank">
						<?php echo esc_html( $author->display_name ); ?>
					</a>
				<?php endif; ?>                       
					<div class="tutor-instructor-designation tutor-fs-7 tutor-color-muted">
						<?php echo esc_html( $author->designation ); ?>					
					</div>				
				</div>
			</div>            
		<?php endforeach; ?>
	<?php else : ?>
		<div class="tutor-fs-7 tutor-color-muted">
			<?php esc_html_e( 'No authors found', 'tutor-lms-elementor-addons' ); ?>
		</div>
	<?php endif; ?>
</div>
