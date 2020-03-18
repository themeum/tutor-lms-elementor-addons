<?php
/**
 * TutorLMS Addons Manager
 *
 * @category   Elementor
 * @package    TutorLMS_Addons
 * @author     Themeum <www.themeum.com>
 * @copyright  2020 Themeum <www.themeum.com>
 * @version    Release: @1.0.0
 * @since      1.0.0
 */

namespace TutorLMS\Elementor;

defined('ABSPATH') || exit;

class AddonsManager
{
    /**
     * Init manager
     * @since 1.0.0
     */
    public static function init()
    {
        add_action('elementor/widgets/widgets_registered', [__CLASS__, 'register']);
    }

    /**
     * Include addons and register
     * @since 1.0.0
     */
    public static function register()
    {
        include_once(ETLMS_DIR_PATH . 'includes/addons/Base.php');
        $all_addons = self::get_all_addons();
        foreach ($all_addons as $key => $props) {
            self::register_addon($key, $props);
        }
    }

    protected static function register_addon($key, $props)
    {
        $elementor = \Elementor\Plugin::instance();
        $addon_file = ETLMS_DIR_PATH . 'includes/addons/' . $key . '.php';

        if (is_readable($addon_file)) {
            include_once($addon_file);
            $addon_instance = '\TutorLMS\Elementor\Addons\\' . $key;
            if (class_exists($addon_instance)) {
                $elementor->widgets_manager->register_widget_type(new $addon_instance());
            }
        }
    }

    /**
     * Get all addons
     * @return array
     */
    public static function get_all_addons()
    {
        return [
            'CourseRating' => [
                'title' => __('Course Rating', 'tutor-elementor-addons'),
            ],
            'CourseTitle' => [
                'title' => __('Course Title', 'tutor-elementor-addons'),
            ],
            'CourseAuthor' => [
                'title' => __('Course Author', 'tutor-elementor-addons'),
            ],
            'CourseLevel' => [
                'title' => __('Course Level', 'tutor-elementor-addons'),
            ],
            'CourseShare' => [
                'title' => __('Course Social Share', 'tutor-elementor-addons'),
            ],
            'CourseCategories' => [
                'title' => __('Course Categories', 'tutor-elementor-addons'),
            ],
            'CourseDuration' => [
                'title' => __('Course Duration', 'tutor-elementor-addons'),
            ],
            'CourseTotalEnrolled' => [
                'title' => __('Course Total Enrolled', 'tutor-elementor-addons'),
            ],
            'CourseLastUpdate' => [
                'title' => __('Course Last Update', 'tutor-elementor-addons'),
            ],
            'CourseThumbnail' => [
                'title' => __('Course Thumbnail', 'tutor-elementor-addons'),
            ],
            'CoursePrice' => [
                'title' => __('Course Price', 'tutor-elementor-addons'),
            ],
            'CourseAbout' => [
                'title' => __('Course About', 'tutor-elementor-addons'),
            ],
        ];
    }
}
