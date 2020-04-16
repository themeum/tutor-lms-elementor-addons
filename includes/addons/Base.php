<?php
/**
 * Plugin base file
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
use Elementor\Controls_Manager;

defined('ABSPATH') || die();

abstract class BaseAddon extends Widget_Base {
    
    /**
     * Get addon name.
     * @since 1.0.0
     */
    public function get_name() {
        /* Automatically generate addon name from class */
        $className = str_replace(__NAMESPACE__, '', $this->get_class_name());
        $name = camel2dashed($className);
        return 'etlms-' . $name;
    }
    
    /**
     * Get addon icon.
     * @since 1.0.0
     */
    public function get_icon() {
        /* Automatically generate addon name from class */
        $className = str_replace(__NAMESPACE__, '', $this->get_class_name());
        $icon = camel2dashed($className);
        return 'icon-' . $icon;
    }

    /**
     * Get addon categories.
     * @since 1.0.0
     */
    public function get_categories() {
        return ['tutor_addons_category'];
    }

    /**
     * Override from addon to add custom wrapper class.
     * @return string
     */
    protected function get_custom_wrapper_class() {
        return '';
    }

    /**
     * Overriding default function to add custom html class.
     * @return string
     */
    public function get_html_wrapper_class() {
        $html_class = parent::get_html_wrapper_class();
        $html_class .= ' tutor-addon';
        $html_class .= ' ' . $this->get_name();
        $html_class .= ' ' . $this->get_custom_wrapper_class();
        return rtrim($html_class);
    }

    /**
     * Register addon controls
     */
    protected function _register_controls() {
        do_action('tutor_start_register_controls', $this);

        // Slider Button stle
        /* $this->start_controls_section(
            'section_select_course',
            [
                'label' => __('Course', 'tutor-elementor-addons'),
            ]
        );
        $this->add_control(
            'course',
            [
                'label'   => __('Course', 'tutor-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => etlms_courses(),
                'default' => $_GET['course'],
            ]
        );
        $this->end_controls_section(); */

        $this->register_content_controls();

        $this->register_style_controls();

        do_action('tutor_end_register_controls', $this);
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
