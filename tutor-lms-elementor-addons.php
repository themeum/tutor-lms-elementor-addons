<?php
/*
Plugin Name: Tutor LMS Elementor Addons
Plugin URI: https://www.themeum.com/product/tutor-lms/
Description: Elementor Addons Integration - Tutor LMS plugin lets you design course pages with Elementor.
Author: Themeum
Version: 2.0.7
Author URI: http://themeum.com
Requires at least: 5.3
Tested up to: 6.1
License: GPLv2 or later
Text Domain: tutor-lms-elementor-addons
*/

defined( 'ABSPATH' ) || die();

define( 'ETLMS_VERSION', '2.0.6' );

/**
 * Tutor LMS Elementor addons v2.0.0 dependency on Tutor core
 *
 * Define Tutor core version on that TutorLMSElementorAddons is dependent to run,
 * without require version v2.0.0 will just show admin notice to install require core version.
 *
 * @since v2.0.0
 */
define( 'ETLMS_TUTOR_CORE_REQ_VERSION', '2.1.0' );

define( 'ETLMS_FILE__', __FILE__ );
define( 'ETLMS_BASENAME', plugin_basename( ETLMS_FILE__ ) );
define( 'ETLMS_DIR_PATH', plugin_dir_path( ETLMS_FILE__ ) );
define( 'ETLMS_TEMPLATE', plugin_dir_path( ETLMS_FILE__ ) . 'templates/course/' );
define( 'ETLMS_DIR_URL', plugin_dir_url( ETLMS_FILE__ ) );
define( 'ETLMS_ASSETS', trailingslashit( ETLMS_DIR_URL . 'assets' ) );

/**
 * Instantiate Base Class after plugins loaded.
 */
add_action( 'plugins_loaded', 'elementor_tutor_lms_init' );

/**
 * Check dependency before load Addons
 *
 * @return void
 */
function elementor_tutor_lms_init() {
	require_once ETLMS_DIR_PATH . 'classes/ManageDependency.php';
	$dependency = new \TutorLMS\Elementor\ManageDependency();

	// all three conditions are required to run Tutor LMS Elementor addons v2.1.0.
	if ( ! function_exists( 'tutor_lms' ) || ! did_action( 'elementor/loaded' ) ) {
		require_once ETLMS_DIR_PATH . 'classes/Installer.php';
		new \TutorLMS\Elementor\Installer();
	} elseif ( function_exists( 'tutor_lms' ) && ! $dependency->is_tutor_core_has_req_verion() ) {
		add_action( 'admin_notices', array( $dependency, 'show_admin_notice' ) );
	} else {
		require_once ETLMS_DIR_PATH . 'classes/Base.php';
		\TutorLMS\Elementor\Base::instance();
	}
}
