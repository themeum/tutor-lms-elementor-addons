<?php
/**
 * Course Ratting Addon
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CourseRating extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Course Rating', 'tutor-lms-elementor-addons' );
	}

	protected function register_content_controls() {
		$this->start_controls_section(
			'course_title_content',
			array(
				'label' => __( 'General Settings', 'tutor-lms-elementor-addons' ),
			)
		);
		$this->add_responsive_control(
			'course_rating_layout',
			array(
				'label'        => __( 'Layout', 'tutor-lms-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'row'    => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'column' => array(
						'title' => __( 'Up', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-v-align-top',
					),
				),
				'default'      => 'row',
				'prefix_class' => 'etlms-rating-layout-',
				'toggle'       => false,
				'selectors'    => array(
					'{{WRAPPER}} .etlms-rating .tutor-ratings' => 'display: flex; flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_rating_align',
			array(
				'label'     => __( 'Alignment', 'tutor-lms-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'flex-start',
				'selectors' => array(
					'{{WRAPPER}}.etlms-rating-layout-row .tutor-ratings' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}}.etlms-rating-layout-column .tutor-ratings' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_controls() {
		$rating_group = '{{WRAPPER}} .tutor-ratings-stars';
		$rating_count = '{{WRAPPER}} .tutor-ratings-count';

		// Style
		$this->start_controls_section(
			'course_style_section',
			array(
				'label' => __( 'Rating Stars', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_rating_star_color',
			array(
				'label'     => __( 'Star Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$rating_group => 'color: {{VALUE}};',
				),
				'default'   => '#ED9700',
			)
		);

		$this->add_responsive_control(
			'course_rating_star_size',
			array(
				'label'      => __( 'Star Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					$rating_group . ' i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 16,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'course_rating_typography',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => $rating_count,
			)
		);

		$this->add_control(
			'course_rating_text_color',
			array(
				'label'     => __( 'Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$rating_count => 'color: {{VALUE}};',
				),
				'default'   => '#525252',
			)
		);

		$this->add_responsive_control(
			'gap',
			array(
				'label'      => __( 'Gap', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					$rating_group . ' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 5,
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		$disable = (bool) get_tutor_option( 'disable_course_review' );
		if ( $disable ) {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				echo __( 'Please enable course review from tutor settings', 'tutor-lms-elementor-addons' );
			}
			return;
		}

		$course = etlms_get_course();
		if ( $course ) {
			ob_start();
			include etlms_get_template( 'course/rating' );
			echo ob_get_clean();
		}
	}
}
