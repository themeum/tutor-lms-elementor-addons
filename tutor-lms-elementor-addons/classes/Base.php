<?php

/**
 * Plugin Base Class
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

        $this->load_files();

        //Plugin row meta
        add_filter('plugin_row_meta', [$this, 'plugin_row_meta'], 10, 2);
        // Register custom category
        add_action('elementor/elements/categories_registered', [$this, 'add_category']);

        AddonsManager::init();
        AssetsManager::init();
        Template::instance();

        do_action('tutor_elementor_addons_loaded');
    }

    public function load_files() {
        require_once ETLMS_DIR_PATH . 'includes/functions.php';
        require_once ETLMS_DIR_PATH . 'classes/Template.php';
        require_once ETLMS_DIR_PATH . 'classes/AssetsManager.php';
        require_once ETLMS_DIR_PATH . 'classes/AddonsTrait.php';
        require_once ETLMS_DIR_PATH . 'classes/AddonsManager.php';
    }

    public function plugin_row_meta($plugin_meta, $plugin_file) {
        if ($plugin_file === ETLMS_BASENAME) {
            $plugin_meta[] = sprintf(
                '<a href="%s" target="_blank">%s</a>',
                esc_url('https://docs.themeum.com/tutor-lms/integrations/elementor-page-builder/?utm_source=tutor-lms-elementor-addons&utm_medium=plugins_installation_list&utm_campaign=plugin_docs_link'),
                __('<strong style="color: #03bd24">Documentation</strong>', 'tutor-lms-elementor-addons')
            );
            $plugin_meta[] = sprintf(
                '<a href="%s" target="_blank">%s</a>',
                esc_url('https://www.themeum.com/contact-us/?utm_source=tutor-lms-elementor-addons&utm_medium=plugins_installation_list&utm_campaign=plugin_support_link'),
                __('<strong style="color: #03bd24">Get Support</strong>', 'tutor-lms-elementor-addons')
            );
        }
        return $plugin_meta;
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
