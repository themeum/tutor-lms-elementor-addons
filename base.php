<?php
/**
 * Plugin base file
 *
 * @category   Elementor
 * @package    TutorLMS_Addons
 * @author     Themeum <www.themeum.com>
 * @copyright  2020 Themeum <www.themeum.com>
 * @version    Release: @1.0.0
 * @since      1.0.0
 */

namespace TutorLMS\Elementor;

use Elementor\Elements_Manager;

defined('ABSPATH') || die();

class Base {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', [$this, 'i18n']);
    }

    public function i18n() {
        load_plugin_textdomain('tutor-lms-elementor-addons');
    }

    public function init() {
        if (!function_exists('tutor_lms') || !did_action('elementor/loaded')) {
            $this->admin_notice();
            return;
        }

        $this->load_files();

        // Register custom category
        add_action('elementor/elements/categories_registered', [$this, 'add_category']);

        AddonsManager::init();
        AssetsManager::init();
        Template::instance();

        do_action('tutor_elementor_addons_loaded');
    }

    public function load_files() {
        include_once(ETLMS_DIR_PATH . 'includes/functions.php');
        include_once(ETLMS_DIR_PATH . 'classes/Template.php');
        include_once(ETLMS_DIR_PATH . 'classes/AssetsManager.php');
        include_once(ETLMS_DIR_PATH . 'classes/AddonsManager.php');
    }

    public function admin_notice() {
        if (defined('TUTOR_VERSION')) {
            //Version Check
            if (version_compare(TUTOR_VERSION, '1.5.2', '<')) {
                add_action('admin_notices', array($this, 'notice_required_tutor'));
            }
        } else {
            //Required Tutor Message
            add_action('admin_notices', array($this, 'notice_required_tutor'));
        }

        if (!did_action('elementor/loaded')) {
            //Required Elementor Plugin
            add_action('admin_notices', array($this, 'notice_required_elementor'));
        }
    }

    /**
     * Notice for tutor lms plugin required
     */
    public function notice_required_tutor() {
        $class = 'notice notice-warning';
        $message = __('In order to use Tutor LMS Elementor Integration, you must have install and activated TutorLMS v.1.5.2', 'tutor-lms-elementor-addons');
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    /**
     * Notice for elementor plugin required
     */
    public function notice_required_elementor() {
        $class = 'notice notice-warning';
        $message = __('In order to use Tutor LMS Elementor Integration, you must have install and activated Elementor Builder Plugin', 'tutor-lms-elementor-addons');
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }

    /**
     * Add custom category.
     *
     * @param $elements_manager
     */
    public function add_category(Elements_Manager $elements_manager) {
        $elements_manager->add_category(
            'tutor_addons_category',
            [
                'title' => __('Tutor LMS', 'tutor-lms-elementor-addons'),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }
}
