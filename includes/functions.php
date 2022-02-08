<?php


/**
 * @param null $template
 *
 * @return mixed|void
 *
 * @since v.1.0.0
 */

if ( ! function_exists( 'etlms_get_template' ) ) {
	function etlms_get_template( $template = null ) {
		$template = str_replace( '.', DIRECTORY_SEPARATOR, $template );

		$template_dir      = apply_filters( 'etlms_template_dir', ETLMS_DIR_PATH );
		$template_location = trailingslashit( $template_dir ) . "templates/{$template}.php";
		return apply_filters( 'etlms_get_template_path', $template_location, $template );
	}
}

if ( ! function_exists( 'camel2dashed' ) ) {
	function camel2dashed( $camelStr ) {
		$string = preg_replace( '/([a-zA-Z])(?=[A-Z])/', '$1-', $camelStr );
		$string = strtolower( ltrim( $string, '\\' ) );
		return $string;
	}
}

if ( ! function_exists( 'setup_course_data' ) ) {
	function setup_course_data() {
		global $wpdb, $post;
		$post_author = get_current_user_id();
		$course_id   = $wpdb->get_var( $wpdb->prepare( "SELECT ID from $wpdb->posts where post_status = 'publish' and post_type = %s and post_author = %d", tutor()->course_post_type, $post_author ) );

		if ( $course_id ) {
			$post = get_post( $course_id );
			setup_postdata( $post );
			return true;
		}
		return false;
	}
}

if ( ! function_exists( 'etlms_get_course' ) ) {
	function etlms_get_course() {
		global $post;
		$course_id        = $post->ID;
		$course_post_type = tutor()->course_post_type;

		if ( is_single() && $post->post_type == $course_post_type ) {
			return true;
		}

		if ( $post->post_type == 'elementor_library' ) {
			$is_tutor_template = get_post_meta( $post->ID, '_tutor_lms_elementor_template_id', true );
			if ( $is_tutor_template ) {
				return setup_course_data();
			}
		}

		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			$elementor_course_id = \Elementor\Plugin::instance()->editor->get_post_id();
			if ( $post->post_type == $course_post_type && $course_id === $elementor_course_id ) {
				return true;
			}
			return setup_course_data();
		}

		return false;
	}
}

if ( ! function_exists( 'etlms_course_categories' ) ) {
	function etlms_course_categories() {
		$course_categories      = array();
		$course_categories_term = tutils()->get_course_categories_term();
		foreach ( $course_categories_term as $term ) {
			$course_categories[ $term->term_id ] = $term->name;
		}

		return $course_categories;
	}
}

if ( ! function_exists( 'etlms_course_authors' ) ) {
	function etlms_course_authors() {
		$course_authors = array();
		$authors        = get_users( array( 'role__in' => array( 'author', tutor()->instructor_role ) ) );
		foreach ( $authors as $author ) {
			$course_authors[ $author->ID ] = $author->display_name;
		}

		return $course_authors;
	}
}
