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
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		/* Editor Scripts */
		add_action( 'elementor/editor/before_enqueue_scripts', array( __CLASS__, 'enqueue_editor_scripts' ) );

		/* Enqueue elementor styles and scripts */
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_elementor_styles' ), 100 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_elementor_scripts' ), 100 );
	}

	/**
	 * Enqueue editor scripts
	 *
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
	 *
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
			ETLMS_ASSETS . 'css/slick.min.css',
			null,
			ETLMS_VERSION
		);

		wp_enqueue_style(
			'slick-theme-css',
			ETLMS_ASSETS . 'css/slick-theme.css',
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
	 *
	 * @since 1.0.0
	 */
	public static function enqueue_elementor_scripts() {

		wp_enqueue_script(
			'etlms-slick-library',
			ETLMS_ASSETS . 'js/slick.min.js',
			array( 'jquery' ),
			ETLMS_VERSION
		);

		wp_enqueue_script(
			'tutor-elementor-js',
			ETLMS_ASSETS . 'js/tutor-elementor.js',
			array( 'jquery' ),
			ETLMS_VERSION
		);

		wp_add_inline_script(
			'tutor-elementor-js',
			'const etlmsUtility = ' . json_encode( self::utility_data() ) . '',
			'before'
		);
	}

	// Add default template library.
	public static function set_default_template() {
		global $post;
		$postID   = $post->ID;
		$meta_key = '_tutor_elementor_data_used';
		if ( get_post_type( $post ) === tutor()->course_post_type ) {
			$elementor_data_used = get_post_meta( $postID, $meta_key, true );
			if ( ! $elementor_data_used ) {
				$elementorData = file_get_contents( ETLMS_DIR_PATH . '/assets/layout/default.json' );
				$elementorData = json_decode( $elementorData, true );
				update_post_meta( $postID, '_elementor_controls_usage', $elementorData['controls'] );
				update_post_meta( $postID, '_elementor_data', $elementorData['layout'] );
				update_post_meta( $postID, $meta_key, 'yes' );
			}
		}
	}

	/**
	 * Get utility data
	 *
	 * @return array
	 */
	protected static function utility_data(): array {
		return array(
			'is_editor_mode' => \Elementor\Plugin::$instance->preview->is_preview_mode() ? true : false,
		);
	}
}
