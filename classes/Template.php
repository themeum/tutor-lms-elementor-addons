<?php

/**
 * TutorLMS Elementor Hooks
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

class Template {

	protected static $_instance = null;
	protected $template_id      = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_filter( 'template_include', array( $this, 'single_course_template' ), 100 );
		add_filter( 'template_include', array( $this, 'single_bundle_template' ), 100 );
		add_action( 'tutor_elementor_single_course_content', array( $this, 'single_course_content' ), 5 );

		add_action( 'elementor/template-library/create_new_dialog_fields', array( $this, 'tutor_course_template' ) );
		// Admin Actions
		add_action( 'save_post', array( $this, 'elementor_template_new_post' ), 99, 2 );

		add_action( 'template_redirect', array( $this, 'is_tutor_single_page' ) );
	}

	/**
	 * Is tutor singe page
	 *
	 * @since v.1.0.0
	 */
	public function is_tutor_single_page() {
		global $wp_query;
		$course_post_type = tutor()->course_post_type;
		if ( is_single() && ! empty( $wp_query->query_vars['post_type'] ) && $wp_query->query_vars['post_type'] === $course_post_type ) {
			$this->template_id = $this->get_tutor_elementor_template_id();
		}
	}

	/**
	 * Get tutor elementor template id
	 *
	 * @since v.1.0.0
	 */
	public function get_tutor_elementor_template_id() {
		global $wpdb;
		$post_id = $wpdb->get_var(
			"   SELECT 
                    ID
                FROM 
                    {$wpdb->posts}
                INNER JOIN 
                    {$wpdb->postmeta} postmeta ON ID = postmeta.post_id
                    AND postmeta.meta_key = '_tutor_lms_elementor_template_id'
                WHERE 
                    post_status = 'publish'
                ORDER BY 
                    ID DESC
            "
		);
		return (int) $post_id;
	}

	public function single_bundle_template($template){
		global $wp_query, $post;
		if ( ! post_type_supports( 'course-bundle', 'elementor' ) ) {
			return $template;
		}

		if ( $wp_query->is_single && ! empty( $wp_query->query_vars['post_type'] ) && $wp_query->query_vars['post_type'] === 'course-bundle' ) {

			$document             = Plugin::$instance->documents->get( $post->ID );
			$built_with_elementor = $document && $document->is_built_with_elementor();
			$template_id          = $this->template_id;

			/**
			 * If not exists any specific template tutor single page or not elementor document, then return default System Template
			 *
			 * @since v.1.0.0
			 */
			if ( ! $template_id && ! $built_with_elementor ) {
				return $template;
			}

			$student_must_login_to_view_course = tutor_utils()->get_option( 'student_must_login_to_view_course' );
			if ( $student_must_login_to_view_course ) {
				if ( ! is_user_logged_in() ) {
					return tutor_get_template( 'login' );
				}
			}
			$template      = etlms_get_template( 'single-course-bundle' );
			return $template;
		}
		return $template;
	}

	/**
	 * Load Single Course Elementor Template
	 *
	 * @param $template
	 * @since v.1.0.0
	 */
	public function single_course_template( $template ) {
		global $wp_query, $post;

		if ( ! post_type_supports( tutor()->course_post_type, 'elementor' ) ) {
			return $template;
		}

		if ( $wp_query->is_single && ! empty( $wp_query->query_vars['post_type'] ) && $wp_query->query_vars['post_type'] === tutor()->course_post_type ) {

			$document             = Plugin::$instance->documents->get( $post->ID );
			$built_with_elementor = $document && $document->is_built_with_elementor();
			$template_id          = $this->template_id;

			/**
			 * If not exists any specific template tutor single page or not elementor document, then return default System Template
			 *
			 * @since v.1.0.0
			 */
			if ( ! $template_id && ! $built_with_elementor ) {
				return $template;
			}

			$student_must_login_to_view_course = tutor_utils()->get_option( 'student_must_login_to_view_course' );
			if ( $student_must_login_to_view_course ) {
				if ( ! is_user_logged_in() ) {
					return tutor_get_template( 'login' );
				}
			}

			$template      = etlms_get_template( 'single-course-fullwidth' );
			$template_slug = get_page_template_slug( $template_id );
			if ( $template_slug === 'elementor_canvas' ) {
				$template = etlms_get_template( 'single-course-canvas' );
			}

			return $template;
		}
		return $template;
	}

	/**
	 * sigle bundle load
	 */

	public function single_bundle_content( $post ) {
		$document = Plugin::$instance->documents->get( $post->ID );

		if ( $document && $document->is_built_with_elementor() ) {
			the_content();
			return;
		}

		$template_id = $this->template_id;
		if ( $template_id ) {
			echo Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
		} else { ?>
			<h1><?php esc_html_e( 'Mark a page/template as Tutor Single course from Elementor Page Settings', 'tutor-lms-elementor-addons' ); ?></h1>
			
		<?php }
	}


	/**
	 * Load Single Course Elementor Content
	 *
	 * @param $post
	 * @since v.1.0.0
	 */
	
	public function single_course_content( $post ) {
		$document = Plugin::$instance->documents->get( $post->ID );

		if ( $document && $document->is_built_with_elementor() ) {
			 the_content();
			return;
		}

		$template_id = $this->template_id;
		if ( $template_id ) {
			echo Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
		} else { ?>
			<h1><?php esc_html_e( 'Mark a page/template as Tutor Single course from Elementor Page Settings', 'tutor-lms-elementor-addons' ); ?></h1>
			
		<?php }
	}


	/**
	 * Load Single Course Elementor Template
	 *
	 * @param $template
	 * @since v.1.0.0
	 */
	public function tutor_course_template() {
		?>
		<div id="elementor-new-template__form__tutor-lms-single-course__wrapper" class="elementor-form-field">
			<div class="elementor-form-field__checkbox__wrapper">
				<label class="elementor-form-field__label">
					<input type="checkbox" name="post_data[tutor_lms_single_course]" style="width: 18px; height: 18px">
					<?php esc_html_e( 'Tutor LMS Single Course Template', 'tutor-lms-elementor-addons' ); ?>
				</label>
			</div>
		</div>
		<?php
	}

	/**
	 * Elementor new template create action
	 *
	 * @param $post_ID, $post
	 * @since v.1.0.0
	 */
	public function elementor_template_new_post( $post_ID, $post ) {
		if ( ! empty( $post->post_type ) && $post->post_type === 'elementor_library' ) {
			$is_elementor_template = tutils()->array_get( 'post_data.tutor_lms_single_course', $_GET );
			if ( ! $is_elementor_template ) {
				$is_elementor_template = tutils()->array_get( 'tutor_lms_single_course', $_POST );
			}

			$editor_post_id = (int) sanitize_text_field( tutils()->array_get( 'editor_post_id', $_POST ) );

			if ( $is_elementor_template ) {
				$this->_mark_elementor_template( $post_ID );
			} elseif ( ! $editor_post_id ) {
				delete_post_meta( $post_ID, '_tutor_lms_elementor_template_id' );
			}
		}
	}

	/**
	 * Update template_id for single course
	 *
	 * @param $post_ID
	 * @since v.1.0.0
	 */
	public function _mark_elementor_template( $post_ID ) {
		global $wpdb;
		$wpdb->delete( $wpdb->postmeta, array( 'meta_key' => '_tutor_lms_elementor_template_id' ) );
		update_post_meta( $post_ID, '_tutor_lms_elementor_template_id', time() );
	}

}
