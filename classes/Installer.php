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

defined('ABSPATH') || die();

class Installer {
    /**
     * Installer constructor
     * @since 1.0.0
     */
    public function __construct() {

        /* Enqueue styles and scripts */
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'], 99);
        add_action('admin_init', [$this, 'check_plugin_dependency'], 99);
    }

    /**
     * Enqueue admin styles
     * @since 1.0.0
     */
    public function admin_enqueue_scripts() {
        wp_enqueue_style(
            'tutor-elementor-installer-css',
            ETLMS_ASSETS . 'installer.css',
            null,
            ETLMS_VERSION
        );
    }

    public function check_plugin_dependency() {
        if (!defined('TUTOR_VERSION')) {
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
        $tutor_basename = 'tutor/tutor.php';
        $source_file = WP_PLUGIN_DIR.'/'.$tutor_basename;
        if ( file_exists($source_file) && !is_plugin_active($tutor_basename) ) {
            $button = __('Activate Tutor LMS','tutor-elementor-addons');
        } elseif ( !file_exists($source_file) ) {
            $button = __('Install Tutor LMS','tutor-elementor-addons');
        }
        
        ?>
        <div class="notice notice-error etlms-install-notice">
            <div class="etlms-install-notice-inner">
                <div class="etlms-install-notice-icon">
                    <img src="<?php echo ETLMS_ASSETS.'images/plugin-logo.jpg'; ?>" alt="Tutor LMS Elementor Addons">
                </div>
                <div class="etlms-install-notice-content">
                    <h2><?php _e('Thanks for using Tutor LMS Elementor Addons','tutor-elementor-addons'); ?></h2>
                    <p><?php echo sprintf( __( 'You must have <a href="%s" target="_blank">Tutor LMS</a> Free version installed and activated on this website in order to use Tutor LMS Elementor Addons.', 'tutor-elementor-addons' ), esc_url( 'https://wordpress.org/plugins/tutor/' ) ); ?></p>
                    <a href="https://docs.themeum.com/tutor-lms/" target="_blank"><?php _e('Learn more about Tutor','tutor-elementor-addons'); ?></a>
                </div>
                <!-- <div class="etlms-install-notice-button">
                    <a  class="button button-primary" href="<?php echo add_query_arg(array('action' => 'activate_qubely_free'), admin_url()); ?>"><?php _e('Activate Tutor LMS','tutor-elementor-addons'); ?></a>
                </div> -->
            </div>
        </div>
        <?php
    }

    /**
     * Notice for elementor plugin required
     */
    public function notice_required_elementor() {
        $class = 'notice notice-warning';
        $message = __('In order to use Tutor LMS Elementor Integration, you must have install and activated Elementor Builder Plugin', 'tutor-elementor-addons');
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
}
