<?php
/**
 * TutorLMS Addons Manager
 *
 * @category   Elementor
 * @package    TutorLMS_Addons
 * @author     Themeum <www.themeum.com>
 * @copyright  2020 Themeum <www.themeum.com>
 * @version    Release: @1.0.0
 * @since      1.0.0
 */

namespace TutorLMS\Elementor;

defined( 'ABSPATH' ) || exit;

use Elementor\Plugin;

class AddonsManager {
	/**
	 * Init manager
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		add_action( 'elementor/widgets/register', array( __CLASS__, 'register' ) );
	}

	/**
	 * Include addons
	 *
	 * @since 1.0.0
	 */
	public static function register() {
		global $post;

		include_once ETLMS_DIR_PATH . 'includes/addons/Base.php';
		$all_addons = self::get_all_addons();

		/**
		 * If single course and built with elementor then remove description addon for avoiding the_content overlap
		 */
		if ( $post->post_type && $post->post_type == tutor()->course_post_type ) {
			$document = Plugin::$instance->documents->get( $post->ID );
			if ( $document && $document->is_built_with_elementor() ) {
				unset( $all_addons['CourseDescription'] );
			}
		}
		foreach ( $all_addons as $key => $props ) {
			self::register_addon( $key, $props );
		}
	}

	/**
	 * Register addons
	 *
	 * @since 1.0.0
	 */
	protected static function register_addon( $key, $props ) {
		$elementor  = \Elementor\Plugin::instance();
		$addon_file = ETLMS_DIR_PATH . 'includes/addons/' . $key . '.php';
		if ( is_readable( $addon_file ) ) {
			include_once $addon_file;
			$addon_instance = '\TutorLMS\Elementor\Addons\\' . $key;
			if ( class_exists( $addon_instance ) ) {
				$elementor->widgets_manager->register( new $addon_instance() );
			}
		}
	}

	/**
	 * Get all addons
	 *
	 * @return array
	 */
	public static function get_all_addons() {
		return array(
			'CourseRating'         => array(
				'title' => __( 'Course Rating', 'tutor-lms-elementor-addons' ),
			),
			'CourseTitle'          => array(
				'title' => __( 'Course Title', 'tutor-lms-elementor-addons' ),
			),
			'CourseAuthor'         => array(
				'title' => __( 'Course Author', 'tutor-lms-elementor-addons' ),
			),
			'CourseLevel'          => array(
				'title' => __( 'Course Level', 'tutor-lms-elementor-addons' ),
			),
			'CourseSocialShare'    => array(
				'title' => __( 'Course Social Share', 'tutor-lms-elementor-addons' ),
			),
			'CourseCategories'     => array(
				'title' => __( 'Course Categories', 'tutor-lms-elementor-addons' ),
			),
			'CourseDuration'       => array(
				'title' => __( 'Course Duration', 'tutor-lms-elementor-addons' ),
			),
			'CourseTotalEnrolled'  => array(
				'title' => __( 'Course Total Enrolled', 'tutor-lms-elementor-addons' ),
			),
			'CourseLastUpdate'     => array(
				'title' => __( 'Course Last Update', 'tutor-lms-elementor-addons' ),
			),
			'CourseStatus'         => array(
				'title' => __( 'Course Status', 'tutor-lms-elementor-addons' ),
			),
			'CourseThumbnail'      => array(
				'title' => __( 'Course Thumbnail', 'tutor-lms-elementor-addons' ),
			),
			'CoursePrice'          => array(
				'title' => __( 'Course Price', 'tutor-lms-elementor-addons' ),
			),
			'CourseEnrolmentBox'   => array(
				'title' => __( 'Course Enrolment Box', 'tutor-lms-elementor-addons' ),
			),
			'CoursePurchase'   => array(
				'title' => __( 'Course Purchase', 'tutor-lms-elementor-addons' ),
			),
			'CourseMaterials'      => array(
				'title' => __( 'Course Materials', 'tutor-lms-elementor-addons' ),
			),
			'CourseRequirements'   => array(
				'title' => __( 'Course Requirements', 'tutor-lms-elementor-addons' ),
			),
			'CourseTags'           => array(
				'title' => __( 'Course Tags', 'tutor-lms-elementor-addons' ),
			),
			'CourseTargetAudience' => array(
				'title' => __( 'Course Target Audience', 'tutor-lms-elementor-addons' ),
			),
			'CourseAbout'          => array(
				'title' => __( 'Course About', 'tutor-lms-elementor-addons' ),
			),
			'CourseDescription'    => array(
				'title' => __( 'Course Description', 'tutor-lms-elementor-addons' ),
			),
			'CourseBenefits'       => array(
				'title' => __( 'Course Benefits', 'tutor-lms-elementor-addons' ),
			),
			'CourseContent'     => array(
				'title' => __( 'Course Content', 'tutor-lms-elementor-addons' ),
			),
			'CourseCurriculum'     => array(
				'title' => __( 'Course Curriculum', 'tutor-lms-elementor-addons' ),
			),
			'CourseInstructors'    => array(
				'title' => __( 'Course Instructors', 'tutor-lms-elementor-addons' ),
			),
			'CourseReviews'        => array(
				'title' => __( 'Course Reviews', 'tutor-lms-elementor-addons' ),
			),
			'CourseCarousel'       => array(
				'title' => __( 'Course Carousel', 'tutor-lms-elementor-addons' ),
			),
			'CourseList'           => array(
				'title' => __( 'Course List', 'tutor-lms-elementor-addons' ),
			),
			'CourseWishlist'           => array(
				'title' => __( 'Course Wishlist', 'tutor-lms-elementor-addons' ),
			),
		);
	}
}
