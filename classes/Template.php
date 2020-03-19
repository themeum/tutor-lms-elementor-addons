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

defined('ABSPATH') || exit;

class Template {
    /**
     * Init template
     * @since 1.0.0
     */
    public static function init() {
        add_filter( 'template_include', array( __CLASS__, 'single_course_template' ), 100 );
        add_action( 'tutor_elementor_single_course_content', array( __CLASS__, 'single_course_content' ), 5 );
    }

    /**
     * Load Single Course Elementor Template
     * @param $template
     * @since v.1.0.0
     */
    public static function single_course_template( $template ) {
        global $wp_query;
        if ($wp_query->is_single && !empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === tutor()->course_post_type) {
            $student_must_login_to_view_course = tutor_utils()->get_option('student_must_login_to_view_course');
            if ($student_must_login_to_view_course) {
                if (!is_user_logged_in()) {
                    return tutor_get_template('login');
                }
            }

            $template_id = 608;
            $template_slug = get_page_template_slug( $template_id );
            $template = etlms_get_template('single-course-fullwidth');
            if ( $template_slug === 'elementor_canvas' ) {
                $template = etlms_get_template('single-course-canvas');
            }

            return $template;
        }
        return $template;
    }

    /**
     * Load Single Course Elementor Content
     * @param $post
     * @since v.1.0.0
     */
    public static function single_course_content($post) {
        $template_id = 608;
        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
    }
}
