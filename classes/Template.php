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

    protected static $_instance = null;
    protected $template_id = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){
        add_filter( 'template_include', array( $this, 'single_course_template' ), 100 );
        add_action( 'tutor_elementor_single_course_content', array( $this, 'single_course_content' ), 5 );

        add_action('elementor/template-library/create_new_dialog_fields', array($this, 'tutor_course_template'));
        // Admin Actions
        add_action( 'save_post', array($this, 'elementor_template_new_post'), 99, 2 );


        add_action('template_redirect', array($this, 'is_tutor_single_page'));

        add_action('post_submitbox_misc_actions', array($this, 'course_template_mark_checkbox'));
    }

    public function is_tutor_single_page(){
        global $wp_query;

        $course_post_type = tutor()->course_post_type;

        if (is_single() &&  ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === $course_post_type){
            global $wpdb;

            $template_id = (int) $wpdb->get_var("SELECT post_id FROM {$wpdb->postmeta} where meta_key = '_tutor_lms_elementor_template_id' ORDER BY meta_id DESC ");

            $this->template_id = $template_id;
        }
    }


    /**
     * Load Single Course Elementor Template
     * @param $template
     * @since v.1.0.0
     */
    public function single_course_template( $template ) {
        global $wp_query;
        if ($wp_query->is_single && !empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === tutor()->course_post_type) {

            $template_id = $this->template_id;
            /**
             * If not exists any specific template for tutor single page, then return default System Template
             * @since v.1.0.0
             */

            if ( ! $template_id){
                return $template;
            }

            $student_must_login_to_view_course = tutor_utils()->get_option('student_must_login_to_view_course');
            if ($student_must_login_to_view_course) {
                if (!is_user_logged_in()) {
                    return tutor_get_template('login');
                }
            }

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
    public function single_course_content($post) {
        $template_id = $this->template_id;

        if ($template_id){
            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
        }else{
            echo '<h1>Mark a page/template as Tutor Single course from Elementor Page Settings</h1>';
        }
    }

    public function tutor_course_template(){
        ?>
        <div id="elementor-new-template__form__tutor-lms-single-course__wrapper" class="elementor-form-field">
            <div class="elementor-form-field__checkbox__wrapper">
                <label class="elementor-form-field__label">
                    <input type="checkbox" name="post_data[tutor_lms_single_course]" style="width: 18px; height: 18px">
                    <?php echo __( 'Tutor LMS Single Course Template', 'elementor-addons-for-tutor-lms' ); ?>
                </label>
            </div>
        </div>
        <?php
    }

    public function elementor_template_new_post($post_ID, $post){
        if ( ! empty($post->post_type) && $post->post_type === 'elementor_library'){
            $is_elementor_template = tutils()->array_get('post_data.tutor_lms_single_course', $_GET);
            if ( ! $is_elementor_template){
                $is_elementor_template = tutils()->array_get('tutor_lms_single_course', $_POST);
            }

            $editor_post_id = (int) sanitize_text_field(tutils()->array_get('editor_post_id', $_POST));

            if ($is_elementor_template){
                $this->_mark_elementor_template($post_ID);
            }elseif( ! $editor_post_id){
                delete_post_meta($post_ID, '_tutor_lms_elementor_template_id');
            }
        }
    }

    public function _mark_elementor_template($post_ID){
        global $wpdb;
        $wpdb->delete($wpdb->postmeta, array('meta_key' => '_tutor_lms_elementor_template_id'));
        update_post_meta($post_ID, '_tutor_lms_elementor_template_id', time());
    }


    public function course_template_mark_checkbox($post){
        if ($post->post_type !== 'elementor_library'){
            //return;
        }
        $is_elementor_template = (bool) get_post_meta($post->ID, '_tutor_lms_elementor_template_id', true)
        ?>

        <div class="misc-pub-section misc-pub-mark-course-single-template">
            <label>
                Tutor LMS :
                <input type="checkbox" name="tutor_lms_single_course" <?php checked($is_elementor_template, true) ?> >
                <span class="checkbox-title"><b>Single Course Template</b></span>
            </label>
        </div>
        <?php
    }


}
