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

use Elementor\Plugin;

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
        add_filter( 'template_include', [ $this, 'single_course_template' ], 100 );
        add_action( 'tutor_elementor_single_course_content', [ $this, 'single_course_content' ], 5 );

        add_action('elementor/template-library/create_new_dialog_fields', [ $this, 'tutor_course_template'] );
        // Admin Actions
        add_action( 'save_post', [ $this, 'elementor_template_new_post' ], 99, 2 );

        add_action('template_redirect', [ $this, 'is_tutor_single_page'] );
        add_action('post_submitbox_misc_actions', [ $this, 'course_template_mark_checkbox'] );

        add_action( 'add_meta_boxes', [ $this, 'etlms_setup_course_editor'], 11 );
    }

    /**
     * Is tutor singe page
     * @since v.1.0.0
     */
    public function is_tutor_single_page() {
        global $wp_query;
        $course_post_type = tutor()->course_post_type;
        if (is_single() &&  ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === $course_post_type){
            $this->template_id = $this->get_tutor_elementor_template_id();
        }
    }
    
    /**
     * Get tutor elementor template id
     * @since v.1.0.0
     */
    public function get_tutor_elementor_template_id() {
        global $wpdb;
        return (int) $wpdb->get_var("SELECT post_id FROM {$wpdb->postmeta} where meta_key = '_tutor_lms_elementor_template_id' ORDER BY meta_id DESC ");
    }

    /**
     * Load Single Course Elementor Template
     * @param $template
     * @since v.1.0.0
     */
    public function single_course_template($template) {
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

    /**
     * Load Single Course Elementor Template
     * @param $template
     * @since v.1.0.0
     */
    public function tutor_course_template() {
        ?>
        <div id="elementor-new-template__form__tutor-lms-single-course__wrapper" class="elementor-form-field">
            <div class="elementor-form-field__checkbox__wrapper">
                <label class="elementor-form-field__label">
                    <input type="checkbox" name="post_data[tutor_lms_single_course]" style="width: 18px; height: 18px">
                    <?php echo __( 'Tutor LMS Single Course Template', 'tutor-lms-elementor-addons' ); ?>
                </label>
            </div>
        </div>
        <?php
    }

    /**
     * Elementor new template create action
     * @param $post_ID, $post
     * @since v.1.0.0
     */
    public function elementor_template_new_post($post_ID, $post) {
        if ( ! empty($post->post_type) && $post->post_type === 'elementor_library') {
            $is_elementor_template = tutils()->array_get('post_data.tutor_lms_single_course', $_GET);
            if ( ! $is_elementor_template){
                $is_elementor_template = tutils()->array_get('tutor_lms_single_course', $_POST);
            }

            $editor_post_id = (int) sanitize_text_field(tutils()->array_get('editor_post_id', $_POST));

            if ($is_elementor_template) {
                $this->_mark_elementor_template($post_ID);
            } elseif ( ! $editor_post_id) {
                delete_post_meta($post_ID, '_tutor_lms_elementor_template_id');
            }
        }
    }

    /**
     * Update template_id for single course
     * @param $post_ID
     * @since v.1.0.0
     */
    public function _mark_elementor_template($post_ID) {
        global $wpdb;
        $wpdb->delete($wpdb->postmeta, array('meta_key' => '_tutor_lms_elementor_template_id'));
        update_post_meta($post_ID, '_tutor_lms_elementor_template_id', time());
    }

    /**
     * Page edit callback for create sidebar option
     * @param $post
     * @since v.1.0.0
     */
    public function course_template_mark_checkbox($post) {
        if ($post->post_type !== 'elementor_library') {
            //return;
        }
        $is_elementor_template = (bool) get_post_meta($post->ID, '_tutor_lms_elementor_template_id', true); ?>

        <div class="misc-pub-section misc-pub-mark-course-single-template">
            <label>
                Tutor LMS :
                <input type="checkbox" name="tutor_lms_single_course" <?php checked($is_elementor_template, true) ?> >
                <span class="checkbox-title"><b>Single Course Template</b></span>
            </label>
        </div>
        <?php
    }

    /**
     * Edit template option in course page
     * @param $post
     * @since v.1.0.0
     */
    public function etlms_before_main_editor( $post ) {
        $template_id = $this->get_tutor_elementor_template_id();
        if( !$template_id ) {
            $type = 'page';
            $post_data = array(
                'post_type' => 'elementor_library',
                'post_title' => 'Tutor Single Course',
                'post_status' => 'publish',
            );
            $meta = [];
            /**
             * Create new post meta data.
             *
             * Filters the meta data of any new post created.
             *
             * @since 2.0.0
             *
             * @param array $meta Post meta data.
             */
            $meta = apply_filters( 'elementor/admin/create_new_post/meta', $meta );

            $document = Plugin::$instance->documents->create( $type, $post_data, $meta );

            $template_id = $document->get_main_id();

            $this->_mark_elementor_template($template_id);
        }

        $edit_url = add_query_arg([
				'post' => $template_id,
				'course' => $post->ID,
				'action' => 'elementor',
			],
			admin_url( 'post.php' )
		);
		?>
        <div id="elementor-switch-mode">
			<a href="<?php echo $edit_url; ?>" type="button" class="button button-primary button-hero">
				<span class="elementor-switch-mode-off">
					<i class="eicon-elementor-square" aria-hidden="true"></i>
					<?php _e( 'Edit with Elementor', 'elementor' ); ?>
				</span>
			</a>
		</div>
        <?php
    }

    /**
     * Course editor setup for Elementor
     * @since v.1.0.0
     */
    public function etlms_setup_course_editor() {
        if ( get_post_type() == tutor()->course_post_type ) {
            add_action( 'edit_form_after_title', [ $this, 'etlms_before_main_editor' ] );
        }
    }
}
