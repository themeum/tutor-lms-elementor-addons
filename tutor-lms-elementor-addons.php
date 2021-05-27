<?php
/*
Plugin Name: Tutor LMS Elementor Addons
Plugin URI: https://www.themeum.com/product/tutor-lms/
Description: Elementor Addons Integration - Tutor LMS plugin lets you design course pages with Elementor.
Author: Themeum
Version: 1.0.2
Author URI: http://themeum.com
Requires at least: 4.5
Tested up to: 5.4
License: GPLv2 or later
Text Domain: tutor-lms-elementor-addons
*/

defined('ABSPATH') || die();

define('ETLMS_VERSION', '1.0.3');
define('ETLMS_FILE__', __FILE__);
define('ETLMS_BASENAME', plugin_basename(ETLMS_FILE__));
define('ETLMS_DIR_PATH', plugin_dir_path(ETLMS_FILE__));
define('ETLMS_DIR_URL', plugin_dir_url(ETLMS_FILE__));
define('ETLMS_ASSETS', trailingslashit(ETLMS_DIR_URL . 'assets'));

/**
 * Instantiate Base Class after plugins loaded
 */
add_action('plugins_loaded', 'elementor_tutor_lms_init');
function elementor_tutor_lms_init() {
    if (!function_exists('tutor_lms') || !did_action('elementor/loaded')) {
        require_once ETLMS_DIR_PATH . 'classes/Installer.php';
        new \TutorLMS\Elementor\Installer();
    } else {
        require_once ETLMS_DIR_PATH . 'classes/Base.php';
        \TutorLMS\Elementor\Base::instance();
    }
}
