<?php
/**
 * Course Last Update
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CourseLastUpdate extends BaseAddon {

    use ETLMS_Trait;

    private static $prefix_class_layout = "elementor-layout-";

    private static $prefix_class_alignment = "elementor-align-";

    public function get_title() {
        return __('Course Last Updated', 'tutor-elementor-addons');
    }

    //content section
    protected function register_content_controls(){
        //layout 
        $this->start_controls_section(
           'course_last_update_content_settings',
            [
                'label' => __( 'General Settings', 'tutor-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                
            ]
        );

        $this->add_control(
            'course_last_update_layout',
            //layout options
            $this->etlms_non_responsive_layout()
        ); 
        $this->add_control(
            'course_last_update_alignment',
        //alignment    
            $this->etlms_non_responsive_alignment()
        );

        $duration_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';


        $this->add_responsive_control(
            'course_last_update_gap',
            [
                'label' => __( 'Gap', 'tutor-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                       
                    ]

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 13,
                ],
                'selectors' => [
                    '.elementor-layout-left .etlms-single-course-meta-last-update a:not(:last-child)' => $duration_spacing,                    
                    '.elementor-layout-up .etlms-single-course-meta-last-update a:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );        
        $this->end_controls_section();
    }

    protected function register_style_controls() {
        $selector_label = '{{WRAPPER}} .etlms-single-course-meta-last-update a:first-child';
        $selector_value = '{{WRAPPER}} .etlms-single-course-meta-last-update a:last-child';

        $this->start_controls_section(
            'course_last_update_label_section',
            [
                'label' => __('Label', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_last_update_label_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
					$selector_label => 'color: {{VALUE}}',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_last_update_label_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector_label,
            ]
        );

        $this->end_controls_section();        

        $this->start_controls_section(
            'course_last_update_value_section',
            [
                'label' => __('Value', 'tutor-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'course_last_update_value_color',
            [
                'label'     => __('Color', 'tutor-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $selector_value => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'course_last_update_value_typo',
                'label'     => __('Typography', 'tutor-elementor-addons'),
                'selector'  => $selector_value
            ]
        );

        $this->end_controls_section();

    }

    protected function render($instance = []) {
        $disable_update_date = get_tutor_option('disable_course_update_date');
        if (!$disable_update_date) {
            $course = etlms_get_course();
            if ($course) {
                $markup = '<div class="etlms-single-course-meta-last-update">';
                $last_update = esc_html(get_the_modified_date());
                $markup .= __('<a>Last Updated </a>','tutor-elementor-addons');
                $markup .= __('<a>'.$last_update.'</a>','tutor-elementor-addons');
                $markup .= '</div>';
                echo $markup;
            }
        }
    }
}
