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
				<div class="etlms-install-notice-inner" style="display:flex; justify-content: space-between; align-items:center; padding: 10px;">
					<div>
						<div style="column-gap: 10px; display: flex; align-items:center;">
							<div class="etlms-install-notice-icon">
								<img src="<?php echo ETLMS_ASSETS . 'images/plugin-logo.jpg'; ?>" alt="Tutor LMS Elementor Addons">
							</div>
							<div class="etlms-install-notice-content">
								<h2 style="margin-bottom: 5px;">
									<i class="tutor-icon-warning-f" style="color:#ffb200;"></i> <?php esc_html_e( 'WARNING: YOU NEED TO INSTALL THE REQUIRED TUTOR LMS VERSION', 'tutor-lms-elementor-addons' ); ?></h2>
								<p style="margin-bottom: 5px;">
								<?php
									esc_html_e(
										'It seems you have installed the wrong version Of Tutor LMS. For a smoother Tutor LMS experience, you need to install at least ' . ETLMS_TUTOR_CORE_REQ_VERSION . ' version.
                                    ',
										'tutor-lms-elementor-addons'
									);
								?>
								</p>
								<p style="color: #757C8E;">
									<?php esc_html_e( 'Note: Tutor LMS Elementor Add-on will be installed but you will not be able to avail any of its’ features as well specific Tutor LMS add-ons.', 'tutor-lms-elementor-addons' ); ?>
								</p>
							</div>
						</div>
					</div>
					<!-- <div class="etlms-install-notice-button">
						<a  class="button button-primary install-etlms-dependency-plugin-button" data-slug="tutor" href="https://github.com/themeum/tutor/releases/tag/v2.0.0-beta" target="_blank"></a>
					</div> -->
				</div>
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
