<?php

/**
 * TutorLMS Installer Class
 *
 * @category   Elementor
 * @package    TutorLMS_Addons
 * @author     Themeum <www.themeum.com>
 * @copyright  2020 Themeum <www.themeum.com>
 * @version    Release: @1.0.0
 * @since      1.0.0
 */

namespace TutorLMS\Elementor;

defined( 'ABSPATH' ) || die();

class Installer {
	/**
	 * Installer constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		/* Enqueue styles and scripts */
		add_action( 'admin_init', array( $this, 'check_plugin_dependency' ), 99 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 99 );
		add_action( 'admin_action_activate_tutor_free', array( $this, 'activate_tutor_free' ) );
		add_action( 'admin_action_activate_elementor_free', array( $this, 'activate_elementor_free' ) );
		add_action( 'wp_ajax_install_etlms_dependency_plugin', array( $this, 'install_etlms_dependency_plugin' ) );
	}

	/**
	 * Enqueue admin styles
	 *
	 * @since 1.0.0
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style(
			'tutor-elementor-installer-css',
			ETLMS_ASSETS . 'css/installer.css',
			null,
			ETLMS_VERSION
		);

		wp_enqueue_script(
			'tutor-elementor-installer-js',
			ETLMS_ASSETS . 'js/installer.min.js',
			array( 'jquery' ),
			ETLMS_VERSION
		);
	}

	public function check_plugin_dependency() {
		if ( ! defined( 'TUTOR_VERSION' ) ) {
			// Required Tutor Message
			add_action( 'admin_notices', array( $this, 'notice_required_tutor' ) );
		}

		if ( ! did_action( 'elementor/loaded' ) ) {
			// Required Elementor Plugin
			add_action( 'admin_notices', array( $this, 'notice_required_elementor' ) );
		}
	}

	/**
	 * Notice for tutor lms plugin required
	 *
	 * @since 1.0.0
	 */
	public function notice_required_tutor() {
		$tutor_basename = 'tutor/tutor.php';
		$source_file    = WP_PLUGIN_DIR . '/' . $tutor_basename;

		$action = $button_txt = $button_class = '';
		if ( file_exists( $source_file ) && ! is_plugin_active( $tutor_basename ) ) {
			$action     = 'activate_tutor_free';
			$button_txt = __( 'Activate Tutor LMS', 'tutor-lms-elementor-addons' );
		} elseif ( ! file_exists( $source_file ) ) {
			$action       = 'install_tutor_plugin';
			$button_txt   = __( 'Install Tutor LMS', 'tutor-lms-elementor-addons' );
			$button_class = 'install-etlms-dependency-plugin-button';
		}
		if ( $action ) {
			?>
			<div class="notice notice-error etlms-install-notice">
				<div class="etlms-install-notice-inner">
					<div class="etlms-install-notice-icon">
						<img src="<?php echo ETLMS_ASSETS . 'images/plugin-logo.jpg'; ?>" alt="Tutor LMS Elementor Addons">
					</div>
					<div class="etlms-install-notice-content">
						<h2><?php _e( 'Thanks for using Tutor LMS Elementor Addons', 'tutor-lms-elementor-addons' ); ?></h2>
						<p><?php echo sprintf( __( 'To use Tutor LMS Elementor Integration, you must have <a href="%s" target="_blank">Tutor LMS</a> Free installed and activated', 'tutor-lms-elementor-addons' ), esc_url( 'https://wordpress.org/plugins/tutor/' ) ); ?></p>
						<a href="https://www.themeum.com/product/tutor-lms/" target="_blank"><?php _e( 'Learn more about Tutor LMS', 'tutor-lms-elementor-addons' ); ?></a>
					</div>
					<div class="etlms-install-notice-button">
						<a  class="button button-primary <?php echo $button_class; ?>" data-slug="tutor" href="<?php echo add_query_arg( array( 'action' => $action ), admin_url() ); ?>"><?php echo $button_txt; ?></a>
					</div>
				</div>
				<div id="etlms_install_dependency_msg"></div>
			</div>
			<?php
		}
	}

	/**
	 * Notice for elementor plugin required
	 *
	 * @since 1.0.0
	 */
	public function notice_required_elementor() {
		$elementor_basename = 'elementor/elementor.php';
		$source_file        = WP_PLUGIN_DIR . '/' . $elementor_basename;

		$action = $button_txt = $button_class = '';
		if ( file_exists( $source_file ) && ! is_plugin_active( $elementor_basename ) ) {
			$action     = 'activate_elementor_free';
			$button_txt = __( 'Activate Elementor', 'tutor-lms-elementor-addons' );
		} elseif ( ! file_exists( $source_file ) ) {
			$action       = 'install_tutor_plugin';
			$button_txt   = __( 'Install Elementor', 'tutor-lms-elementor-addons' );
			$button_class = 'install-etlms-dependency-plugin-button';
		}
		if ( $action ) {
			?>
			<div class="notice notice-error etlms-install-notice">
				<div class="etlms-install-notice-inner">
					<div class="etlms-install-notice-icon">
						<img src="<?php echo ETLMS_ASSETS . 'images/plugin-logo.jpg'; ?>" alt="Tutor LMS Elementor Addons">
					</div>
					<div class="etlms-install-notice-content">
						<h2><?php _e( 'Thanks for using Tutor LMS Elementor Addons', 'tutor-lms-elementor-addons' ); ?></h2>
						<p><?php echo sprintf( __( 'To use Tutor LMS Elementor Integration, you must have <a href="%s" target="_blank">Elementor</a> Free installed and activated', 'tutor-lms-elementor-addons' ), esc_url( 'https://wordpress.org/plugins/elementor/' ) ); ?></p>
						<a href="https://elementor.com/" target="_blank"><?php _e( 'Learn more about Elementor', 'tutor-lms-elementor-addons' ); ?></a>
					</div>
					<div class="etlms-install-notice-button">
						<a  class="button button-primary <?php echo $button_class; ?>" data-slug="elementor" href="<?php echo add_query_arg( array( 'action' => $action ), admin_url() ); ?>"><?php echo $button_txt; ?></a>
					</div>
				</div>
				<div id="etlms_install_dependency_msg"></div>
			</div>
			<?php
		}
	}

	/**
	 * Install tutor plugin action
	 *
	 * @since 1.0.0
	 */
	public function install_etlms_dependency_plugin() {
		include ABSPATH . 'wp-admin/includes/plugin-install.php';
		include ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

		if ( ! class_exists( 'Plugin_Upgrader' ) ) {
			include ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';
		}
		if ( ! class_exists( 'Plugin_Installer_Skin' ) ) {
			include ABSPATH . 'wp-admin/includes/class-plugin-installer-skin.php';
		}

		$plugin = sanitize_text_field( $_POST['slug'] );
		if ( $plugin == 'tutor' || $plugin == 'elementor' ) {
			$api = plugins_api(
				'plugin_information',
				array(
					'slug'   => $plugin,
					'fields' => array(
						'short_description' => false,
						'sections'          => false,
						'requires'          => false,
						'rating'            => false,
						'ratings'           => false,
						'downloaded'        => false,
						'last_updated'      => false,
						'added'             => false,
						'tags'              => false,
						'compatibility'     => false,
						'homepage'          => false,
						'donate_link'       => false,
					),
				)
			);

			if ( is_wp_error( $api ) ) {
				wp_die( $api );
			}

			$title = sprintf( __( 'Installing Plugin: %s' ), $api->name . ' ' . $api->version );
			$nonce = 'install-plugin_' . $plugin;
			$url   = 'update.php?action=install-plugin&plugin=' . urlencode( $plugin );

			$upgrader = new \Plugin_Upgrader( new \Plugin_Installer_Skin( compact( 'title', 'url', 'nonce', 'plugin', 'api' ) ) );
			$upgrader->install( $api->download_link );
		} else {
			wp_send_json_error( __( 'Unknown Plugin', 'tutor-lms-elementor-addons' ) );
		}
		die();
	}

	/**
	 * Activate tutor plugin action
	 *
	 * @since 1.0.0
	 */
	public function activate_tutor_free() {
		activate_plugin( 'tutor/tutor.php' );
	}

	/**
	 * Activate elementor plugin action
	 *
	 * @since 1.0.0
	 */
	public function activate_elementor_free() {
		activate_plugin( 'elementor/elementor.php' );
	}

}
