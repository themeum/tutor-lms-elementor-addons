<?php


/**
 * @param null $template
 *
 * @return mixed|void
 *
 * @since v.1.0.0
 */
if ( ! function_exists('etlms_get_template')) {
	function etlms_get_template( $template = null ) {
		$template = str_replace( '.', DIRECTORY_SEPARATOR, $template );

		$template_dir = apply_filters('etlms_template_dir', ETLMS_DIR_PATH);
		$template_location = trailingslashit( $template_dir ) . "templates/{$template}.php";
		return apply_filters( 'etlms_get_template_path', $template_location, $template );
	}
}

if ( ! function_exists('camel2dashed')) {
	function camel2dashed($camelStr) {
		$str = preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $camelStr);
		$str = strtolower(ltrim($str, '\\'));
		return $str;
	}
}

if ( ! function_exists('etlms_courses')) {
	function etlms_courses() {
		$course_list = get_posts( array(
			'post_type'		=> tutor()->course_post_type,
			'post_status'	=> 'publish',
			'posts_per_page'=> 10,
			'orderby'       => 'date',
			'order'         => 'DESC',
		) );
		$courses = array();
		foreach ( $course_list as $course ) {
		   $courses[$course->ID] = $course->post_title;
		}
		return $courses;
	}
}

if ( ! function_exists('etlms_get_course')) {
	function etlms_get_course($st) {
		$course_id = etlms_course_id($st);
		if($course_id) {
			$query = new \WP_Query(array(
				'p' => $course_id, 
				'post_type' => tutor()->course_post_type
			));
			return $query;
		} else {
			return false;
		}
	}
}

if ( ! function_exists('etlms_course_id')) {
	function etlms_course_id($st) {
		if($st['course']) {
			return $st['course'];
		}
		if($_GET['course']) {
			return $_GET['course'];
		}
		$_SERVER['HTTP_REFERER'];
		$parts = parse_url($_SERVER['HTTP_REFERER']);
		parse_str($parts['query'], $query);
		if($query['course']) {
			return $query['course'];
		}
		return false;
	}
}