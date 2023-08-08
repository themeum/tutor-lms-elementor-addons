<?php
/**
 * Template for displaying single course bundle
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com

 * @package TutorLMS/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

\Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-full-width' );

get_header();

/**
 * Before Header-Footer page template content.
 *
 * Fires before the content of Elementor Header-Footer page template.
 *
 * @since 1.0.0
 */
do_action( 'elementor/page_templates/header-footer/before_content' );


do_action( 'tutor_course/single/before/wrap' );
/**
 * Hook for course builder.
 */
global $post;
do_action( 'tutor_elementor_single_course_content', $post );
do_action( 'tutor_course/single/after/wrap' );

/**
 * After Header-Footer page template content.
 *
 * Fires after the content of Elementor Header-Footer page template.
 *
 * @since 1.0.0
 */
do_action( 'elementor/page_templates/header-footer/after_content' );

get_footer();
