<?php
/**
 * TutorLMS Elementor Assets
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

class AssetsManager {
    /**
     * Init manager
     * @since 1.0.0
     */
    public static function init(){
        /* Editor Scripts */
        add_action( 'elementor/editor/before_enqueue_scripts', [ __CLASS__, 'enqueue_editor_scripts' ] );
    }

    /**
     * Enqueue editor scripts
     * @since 1.0.0
     */
    public static function enqueue_editor_scripts() {
        wp_enqueue_style(
            'tutor-elementor-icons',
            ETLMS_ASSETS . 'tutor-elementor-icons.min.css',
            null,
            ETLMS_VERSION
        );
    }
}
