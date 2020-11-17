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
        /* Additional css */
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_additional_scripts']);
        /* Editor Scripts */
        add_action('elementor/editor/before_enqueue_scripts', [__CLASS__, 'enqueue_editor_scripts']);


         // Enqueue Scripts

        add_action( 'elementor/frontend/after_register_scripts', [ __CLASS__, 'etlms_elementor_scripts' ] );

        //Enqueue Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ __CLASS__, 'etlms_elementor_styles' ] );


    }

    /**
     * Enqueue additional scripts
     * @since 1.0.0
     */
    public static function enqueue_additional_scripts() {
        wp_enqueue_style(
            'tutor-elementor',
            ETLMS_ASSETS . 'tutor-elementor.css',
            null,
            ETLMS_VERSION
        );        

        wp_enqueue_style(
            'tutor-shewa-elementor',
            ETLMS_ASSETS . 'tutor-shewa-elementor.css',
            null,
            //ETLMS_VERSION
            filemtime(ETLMS_DIR_PATH.'/assets/tutor-shewa-elementor.css')
        );       

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

    public static function etlms_elementor_styles(){

        //Register FontAwesome for fallback
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
    } 
    public static function etlms_elementor_scripts(){

        wp_register_script( 'etlms-slick-library', 
            'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 
            array(  ), 
            '1.0.0', true ); 

        wp_register_script (
            'etlms-slick-slider',
            ETLMS_ASSETS.'slick-slider.js',
            array('etlms-slick-library'),
            filemtime(ETLMS_DIR_PATH.'/assets/slick-slider.js'),
            true
        );          

        wp_register_script (
            'etlms-enroll-button',
            ETLMS_ASSETS.'enroll-button.js',
            array('jquery'),
            filemtime(ETLMS_DIR_PATH.'/assets/enroll-button.js'),
            true
        );        

        wp_register_script (
            'etlms-course-topics',
            ETLMS_ASSETS.'course-topics.js',
            array('jquery'),
            filemtime(ETLMS_DIR_PATH.'/assets/course-topics.js'),
            true
        );  
        wp_enqueue_script( 'etlms-slick-library');
        wp_enqueue_script( 'etlms-slick-slider');
        wp_enqueue_script('etlms-course-topics');
        wp_enqueue_script('etlms-enroll-button');
    }
}
