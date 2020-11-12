
<?php
/**
 * Template for displaying course instructors/ instructor

 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates

 */


$instructors = tutor_utils()->get_instructors_by_course();

//settings from elementor
$show_profile_picture = 'yes';
$display_name = 'yes';
$profile_link = 'none';
$border_radius = "50px";
if(isset($settings))
{
	$show_profile_picture= $settings['course_instructor_profile'];

	$display_name = $settings['course_instructor_name'];

	$profile_link = $settings['course_instructor_link'];

	$border_radius = $settings['course_instructor_img_border_radius'];
}

if ($instructors){
	$count = is_array($instructors) ? count($instructors) : 0;
	
	?>
	<div class="etlms-course-instructor-title">
		<h4 class="tutor-segment-title" align="left"><?php $count>1 ? _e('About the instructors', 'tutor') : _e('About the instructor', 'tutor'); ?></h4>
	</div>
	<div class="tutor-course-instructors-wrap tutor-single-course-segment etlms-course-instructors-wrap" id="single-course-ratings">
		<?php
		foreach ($instructors as $instructor){
		    $profile_url = tutor_utils()->profile_url($instructor->ID);
			?>
			<div class="single-instructor-wrap etlms-single-instructor-wrap">

			
				<div class="single-instructor-top">
					<a <?php if($profile_link !='none')
					{
						echo "href = $profile_url";
					}
					?> target="<?php if($profile_link =='new_window'){echo "_blank";}?>">	
                    <div class="tutor-instructor-left">
                    <?php if($show_profile_picture =='yes'):?>
                        <div class="instructor-avatar etlms-course-instructor-avatar">
                            
                                <?php echo tutor_utils()->get_tutor_avatar($instructor->ID); ?>
                        
                        </div>
                    <?php endif;?>

                        <div class="instructor-name etlms-instructors-info">
                        <?php if($display_name=='yes'):?>	
                            <a class="etlms-instructor-name"><?php echo $instructor->display_name; ?>
                        	</a>
                        	<br>
                        <?php endif;?>    
                            <?php
                            if ( ! empty($instructor->tutor_profile_job_title)){
                                echo "<a class='etlms-instructor-jobtitle'>{$instructor->tutor_profile_job_title}</a>";
                            }
                            ?>
                        </div>
                    </div>
                </a>
					<div class="instructor-bio">
						<?php echo $instructor->tutor_profile_bio ?>
					</div>
				</div>
			
                <?php
                $instructor_rating = tutor_utils()->get_instructor_ratings($instructor->ID);
                ?>

				<div class="etlms-single-instructor-bottom">
					<div class="ratings">
						<span class="rating-generated">
							<?php tutor_utils()->star_rating_generator($instructor_rating->rating_avg); ?>
						</span>

						<?php
						echo " <span class='rating-digits'>{$instructor_rating->rating_avg}</span> ";
						echo " <span class='rating-total-meta'>({$instructor_rating->rating_count} ".__('ratings', 'tutor').")</span> ";
						?>
					</div>

					<div class="courses">
						<p>
							<i class='tutor-icon-mortarboard'></i>
							<?php echo tutor_utils()->get_course_count_by_instructor($instructor->ID); ?> <span class="tutor-text-mute"> <?php _e('Courses', 'tutor'); ?></span>
						</p>
					</div>

					<div class="students">
						<?php
						$total_students = tutor_utils()->get_total_students_by_instructor($instructor->ID);
						?>

						<p>
							<i class='tutor-icon-user'></i>
							<?php echo $total_students; ?>
							<span class="tutor-text-mute">  <?php _e('students', 'tutor'); ?></span>
						</p>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}


