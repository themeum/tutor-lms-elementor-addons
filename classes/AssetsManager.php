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

defined('ABSPATH') || die();

class AssetsManager {
    /**
     * Init manager
     * @since 1.0.0
     */
    public static function init() {
        /* Editor Scripts */
        add_action('elementor/editor/before_enqueue_scripts', [__CLASS__, 'enqueue_editor_scripts']);

        /* Enqueue elementor styles and scripts */
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_elementor_styles']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_elementor_scripts']);
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

    /**
     * Enqueue styles
     * @since 1.0.0
     */
    public static function enqueue_elementor_styles() {
        wp_register_style(
            'font-awesome-5-all',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css',
            false,
            '1.0.0'
        );

        wp_register_style(
            'font-awesome-4-shim',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/v4-shims.min.css',
            false,
            '1.0.0'
        );

        wp_enqueue_style(
            'slick-css',
            'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
            null,
            ETLMS_VERSION
        );        

        wp_enqueue_style(
            'slick-theme-css',
            'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css',
            null,
            ETLMS_VERSION
        );

        wp_enqueue_style(
            'tutor-elementor-css',
            ETLMS_ASSETS . 'tutor-elementor.css',
            null,
            //ETLMS_VERSION
           time()
        );
    }

    /**
     * Enqueue scripts
     * @since 1.0.0
     */
    public static function enqueue_elementor_scripts() {
        wp_enqueue_script(
            'etlms-slick-library',
            'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
            array(),
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'tutor-elementor-js',
            ETLMS_ASSETS . 'tutor-elementor.js',
            array('jquery'),
            ETLMS_VERSION,
            true
        );
    }
}
