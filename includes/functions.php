<?php


/**
 * @param null $template
 *
 * @return mixed|void
 *
 * @since v.1.0.0
 */
if (!function_exists('etlms_get_template')) {
	function etlms_get_template($template = null)
	{
		$template = str_replace('.', DIRECTORY_SEPARATOR, $template);

		$template_dir = apply_filters('etlms_template_dir', ETLMS_DIR_PATH);
		$template_location = trailingslashit($template_dir) . "templates/{$template}.php";
		return apply_filters('etlms_get_template_path', $template_location, $template);
	}
}

if (!function_exists('camel2dashed')) {
	function camel2dashed($camelStr)
	{
		$string = preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $camelStr);
		$string = strtolower(ltrim($string, '\\'));
		return $string;
	}
}

if (!function_exists('etlms_get_course')) {
	function etlms_get_course() {
		global $wpdb, $post;
		$course_id =  $post->ID;
		$course_post_type = tutor()->course_post_type;
		$is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();
		if ($is_editor) {
			$elementor_course_id = \Elementor\Plugin::instance()->editor->get_post_id();
			if ($post->post_type == $course_post_type && $course_id === $elementor_course_id) {
				return true;
			}
			$post_author = get_current_user_id();
			$course_id =(int) $wpdb->get_var("SELECT ID FROM {$wpdb -> posts} WHERE post_type = {$course_post_type} AND post_author {$post_author} AND post_status = 'publish' ORDER BY ID DESC");
			$course = get_post($course_id);
			setup_postdata( $course );
			return true;
		}
		if (is_single() && $post->post_type == $course_post_type) {
			return true;
		}
		return false;
	}
}
