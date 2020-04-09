<?php
/*
Plugin Name: Tutor LMS Elementor Addons
Plugin URI: https://www.themeum.com/product/tutor-lms/
Description: Elementor Addons Integration - Tutor LMS plugin let's you to design your courses, lesson page by Elementor.
Author: Themeum
Version: 1.0.0
Author URI: http://themeum.com
Requires at least: 4.5
Tested up to: 5.4
License: GPLv2 or later
Text Domain: elementor-tutor-lms
*/

defined('ABSPATH') || die();

define('ETLMS_VERSION', '1.0.0');
define('ETLMS_FILE__', __FILE__);
define('ETLMS_DIR_PATH', plugin_dir_path(ETLMS_FILE__));
define('ETLMS_DIR_URL', plugin_dir_url(ETLMS_FILE__));
define('ETLMS_ASSETS', trailingslashit(ETLMS_DIR_URL . 'assets'));

/**
 * Turn off template override from TutorLMS
 */
if (!function_exists('is_plugin_active')) {
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}

/**
 * Now fire the plugin
 * ekhon plugin-e agun lagiye den
 */
add_action('plugins_loaded', 'elementor_tutor_lms_init');
function elementor_tutor_lms_init() {
    require ETLMS_DIR_PATH . 'base.php';
    \TutorLMS\Elementor\Base::instance();
}
