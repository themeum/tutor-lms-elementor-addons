<?php
/**
 * Manage dependency to run this plugin. Make sure if Tutor LMS Core plugin
 * the required version to run Tutor LMS Elementor Addons.
 *
 * @since v2.0.0
 *
 * @package ETLMSDependency
 */

namespace TutorLMS\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Manage dependency, show admin notices.
 */
class ManageDependency {

	/**
	 * Register hooks
	 *
	 * @since v2.0.0
	 */
	public function show_admin_notice() {
		?>
			<div class="notice notice-error etlms-install-notice">
				<div class="etlms-install-notice-inner">
					<div class="etlms-install-notice-icon">
						<img src="<?php echo ETLMS_ASSETS . 'images/plugin-logo.jpg'; ?>" alt="Tutor LMS Elementor Addons">
					</div>
					<div class="etlms-install-notice-content">
						<h2><?php esc_html_e( 'Thanks for using Tutor LMS Elementor Addons', 'tutor-lms-elementor-addons' ); ?></h2>
						<p><?php echo sprintf( __( 'To use Tutor LMS Elementor Integration, you must have <a href="%s" target="_blank">Tutor LMS</a> Free installed and activated', 'tutor-lms-elementor-addons' ), esc_url( 'https://wordpress.org/plugins/tutor/' ) ); ?></p>
						<a href="https://www.themeum.com/product/tutor-lms/" target="_blank"><?php esc_html_e( 'Learn more about Tutor LMS', 'tutor-lms-elementor-addons' ); ?></a>
					</div>
					<div class="etlms-install-notice-button">
						<a  class="button button-primary install-etlms-dependency-plugin-button" data-slug="tutor" href=""><?php esc_html_e( 'Upgrade Tutor LMS' ); ?></a>
					</div>
				</div>
				<div id="etlms_install_dependency_msg"></div>
			</div>
		<?php
	}

	/**
	 * Check whether Tutor core has required version installed
	 *
	 * @return bool | if has return true otherwise false
	 *
	 * @since v2.0.0
	 */
	public function is_tutor_core_has_req_verion(): bool {
		$file_path              = WP_PLUGIN_DIR . '/tutor/tutor.php';
		$plugin_data            = get_file_data(
			$file_path,
			array(
				'Version' => 'Version',
			)
		);
		$tutor_version          = $plugin_data['Version'];
		$tutor_core_req_version = ETLMS_TUTOR_CORE_REQ_VERSION;
		$is_compatible          = version_compare( $tutor_version, $tutor_core_req_version, '>=' );
		return $is_compatible ? true : false;
	}
}
