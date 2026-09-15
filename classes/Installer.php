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

/**
 * Installer class
 *
 * @package TutorLMS\Elementor
 * @since 1.0.0
 */
class Installer {

	/**
	 * Nonce action guarding the dependency install & activate requests
	 *
	 * @since 4.0.2
	 */
	const NONCE_ACTION = 'etlms_dependency_action';

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
			ETLMS_ASSETS . 'css/installer.min.css',
			null,
			ETLMS_VERSION
		);

		wp_enqueue_script(
			'tutor-elementor-installer-js',
			ETLMS_ASSETS . 'js/installer.min.js',
			array( 'jquery' ),
			ETLMS_VERSION
		);

		wp_localize_script(
			'tutor-elementor-installer-js',
			'_etlms_installer',
			array(
				'nonce'         => wp_create_nonce( self::NONCE_ACTION ),
				'generic_error' => __( 'Installation failed. Please try again.', 'tutor-lms-elementor-addons' ),
			)
		);
	}

	/**
	 * Check plugin dependency
	 *
	 * @since 1.0.0
	 */
	public function check_plugin_dependency() {
		// Only users who can act on the notice should see it.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		if ( ! defined( 'TUTOR_VERSION' ) ) {
			// Required Tutor Message.
			add_action( 'admin_notices', array( $this, 'notice_required_tutor' ) );
		}

		if ( ! did_action( 'elementor/loaded' ) ) {
			// Required Elementor Plugin.
			add_action( 'admin_notices', array( $this, 'notice_required_elementor' ) );
		}
	}

	/**
	 * Build a nonce protected admin URL for the given installer action
	 *
	 * @since 4.0.2
	 *
	 * @param string $action Installer action name.
	 *
	 * @return string
	 */
	private function get_action_url( $action ) {
		return wp_nonce_url( add_query_arg( array( 'action' => $action ), admin_url() ), self::NONCE_ACTION );
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
						<p><?php printf( __( 'To use Tutor LMS Elementor Integration, you must have <a href="%s" target="_blank">Tutor LMS</a> Free installed and activated', 'tutor-lms-elementor-addons' ), esc_url( 'https://wordpress.org/plugins/tutor/' ) ); ?></p>
						<a href="https://www.themeum.com/product/tutor-lms/" target="_blank"><?php _e( 'Learn more about Tutor LMS', 'tutor-lms-elementor-addons' ); ?></a>
					</div>
					<div class="etlms-install-notice-button">
						<a  class="button button-primary <?php echo esc_attr( $button_class ); ?>" data-slug="tutor" href="<?php echo esc_url( $this->get_action_url( $action ) ); ?>"><?php echo esc_html( $button_txt ); ?></a>
					</div>
				</div>
				<div class="etlms-install-notice-msg"></div>
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
						<p><?php printf( __( 'To use Tutor LMS Elementor Integration, you must have <a href="%s" target="_blank">Elementor</a> Free installed and activated', 'tutor-lms-elementor-addons' ), esc_url( 'https://wordpress.org/plugins/elementor/' ) ); ?></p>
						<a href="https://elementor.com/" target="_blank"><?php _e( 'Learn more about Elementor', 'tutor-lms-elementor-addons' ); ?></a>
					</div>
					<div class="etlms-install-notice-button">
						<a  class="button button-primary <?php echo esc_attr( $button_class ); ?>" data-slug="elementor" href="<?php echo esc_url( $this->get_action_url( $action ) ); ?>"><?php echo esc_html( $button_txt ); ?></a>
					</div>
				</div>
				<div class="etlms-install-notice-msg"></div>
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
		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error( esc_html__( 'You are not allowed to perform this action', 'tutor-lms-elementor-addons' ), 403 );
		}

		if ( ! check_ajax_referer( self::NONCE_ACTION, 'nonce', false ) ) {
			wp_send_json_error( esc_html__( 'Nonce not matched. Action failed!', 'tutor-lms-elementor-addons' ), 403 );
		}

		include ABSPATH . 'wp-admin/includes/plugin-install.php';
		include ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

		if ( ! class_exists( 'Plugin_Upgrader' ) ) {
			include ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';
		}
		if ( ! class_exists( 'Plugin_Installer_Skin' ) ) {
			include ABSPATH . 'wp-admin/includes/class-plugin-installer-skin.php';
		}

		$plugin = isset( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';
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
	 * Activate a dependency plugin on behalf of an authorized request
	 *
	 * @since 4.0.2
	 *
	 * @param string $basename Plugin basename to activate.
	 *
	 * @return void
	 */
	private function activate_dependency_plugin( $basename ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_die(
				esc_html__( 'You are not allowed to perform this action', 'tutor-lms-elementor-addons' ),
				esc_html__( 'Permission Denied', 'tutor-lms-elementor-addons' ),
				array( 'response' => 403 )
			);
		}

		check_admin_referer( self::NONCE_ACTION );

		activate_plugin( $basename );

		wp_safe_redirect( admin_url() );
		exit;
	}

	/**
	 * Activate tutor plugin action
	 *
	 * @since 1.0.0
	 */
	public function activate_tutor_free() {
		$this->activate_dependency_plugin( 'tutor/tutor.php' );
	}

	/**
	 * Activate elementor plugin action
	 *
	 * @since 1.0.0
	 */
	public function activate_elementor_free() {
		$this->activate_dependency_plugin( 'elementor/elementor.php' );
	}
}
