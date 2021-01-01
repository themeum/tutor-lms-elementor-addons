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
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_elementor_styles'], 99);
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_elementor_scripts'], 99);
    }

    /**
     * Enqueue editor scripts
     * @since 1.0.0
     */
    public static function enqueue_editor_scripts() {
        wp_enqueue_style(
            'tutor-elementor-icons',
            ETLMS_ASSETS . 'css/tutor-elementor-icons.min.css',
            null,
            ETLMS_VERSION
        );

        // Set default template before enqueue
        self::set_default_template();
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
            ETLMS_VERSION
        );

        wp_register_style(
            'font-awesome-4-shim',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/v4-shims.min.css',
            false,
            ETLMS_VERSION
        );

        wp_enqueue_style(
            'slick-css',
            'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css',
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
            ETLMS_ASSETS . 'css/tutor-elementor.min.css',
            null,
            ETLMS_VERSION
        );
    }

    /**
     * Enqueue scripts
     * @since 1.0.0
     */
    public static function enqueue_elementor_scripts() {

        $slick_lib_url = 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js';
        if (file_exists(ELEMENTOR_ASSETS_PATH.'lib/slick/slick.min.js')) {
            $slick_lib_url = ELEMENTOR_ASSETS_URL.'lib/slick/slick.min.js';
        }
        wp_enqueue_script(
            'etlms-slick-library',
            $slick_lib_url,
            array('jquery'),
            ETLMS_VERSION
        );

        wp_enqueue_script(
            'tutor-elementor-js',
            ETLMS_ASSETS . 'js/tutor-elementor.js',
            array('jquery'),
            ETLMS_VERSION
        );
    }

    // Add default template library
	public static function set_default_template() {
		global $post;
		$postID = $post->ID;
		$meta_key = '_tutor_elementor_data_used';
		if (get_post_type($post) === tutor()->course_post_type) {
			$elementor_data_used = get_post_meta($postID, $meta_key, true);
			if (!$elementor_data_used) {
                $elementorData = file_get_contents(ETLMS_DIR_PATH . '/assets/layout/default.json');
                $elementorData = json_decode($elementorData, true);
				update_post_meta($postID, '_elementor_controls_usage', $elementorData['controls']);
				update_post_meta($postID, '_elementor_data', $elementorData['layout']);
				update_post_meta($postID, $meta_key, 'yes');
			}
		}
	}
}
