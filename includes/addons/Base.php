<?php
/**
 * Addons Base Class
 *
 * @category   Elementor
 * @package    TutorLMS_Addons
 * @author     Themeum <www.themeum.com>
 * @copyright  2020 Themeum <www.themeum.com>
 * @version    Release: @1.0.0
 * @since      1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

abstract class BaseAddon extends Widget_Base {

	/**
	 * Get addon name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'etlms-' . $this->__class_name();
	}

	/**
	 * Get addon icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'icon-' . $this->__class_name();
	}

	/**
	 * Get class name as slug.
	 *
	 * @since 1.0.0
	 */
	private function __class_name() {
		/* Generate name slug from class */
		$class_name = str_replace( __NAMESPACE__, '', $this->get_class_name() );
		$class_name = camel2dashed( $class_name );
		return $class_name;
	}

	/**
	 * Get addon categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return array( 'tutor_addons_category' );
	}

	/**
	 * Override from addon to add custom wrapper class.
	 *
	 * @return string
	 */
	protected function get_custom_wrapper_class() {
		return '';
	}

	/**
	 * Overriding default function to add custom html class.
	 *
	 * @return string
	 */
	public function get_html_wrapper_class() {
		$html_class  = parent::get_html_wrapper_class();
		$html_class .= ' tutor-addon';
		$html_class .= ' ' . $this->get_name();
		$html_class .= ' ' . $this->get_custom_wrapper_class();
		return rtrim( $html_class );
	}

	/**
	 * Register addon controls
	 */
	protected function register_controls() {
		do_action( 'tutor_start_register_controls', $this );

		$this->register_content_controls();

		$this->register_style_controls();

		do_action( 'tutor_end_register_controls', $this );
	}

	/**
	 * Register content controls
	 *
	 * @return void
	 */
	protected function register_content_controls() {
	}

	/**
	 * Register style controls
	 *
	 * @return void
	 */
	abstract protected function register_style_controls();
}
