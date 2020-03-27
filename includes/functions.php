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