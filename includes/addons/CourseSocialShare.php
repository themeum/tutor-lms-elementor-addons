<?php
/**
 * Course Share Addon
 *
 * @since 1.0.0
 */

namespace TutorLMS\Elementor\Addons;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CourseSocialShare extends BaseAddon {

	use \TutorLMS\Elementor\AddonsTrait;

	private static $prefix_class_layout    = 'elementor-layout-';
	private static $prefix_class_alignment = 'elementor-align-';

	public function get_title() {
		return __( 'Course Social Share', 'tutor-lms-elementor-addons' );
	}

	protected function register_content_controls() {

		$this->start_controls_section(
			'course_share_icon_content_section',
			array(
				'label' => __( 'Social Icons', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'course_share_icon',
			array(
				'label'   => esc_html__( 'Icon', 'plugin-name' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'library' => 'solid',
				),
			)
		);

		$this->add_control(
			'course_share_label_content',
			array(
				'label'        => __( 'Label', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',

			)
		);

		$this->add_responsive_control(
			'course_share_alignment',
			array(
				'label'     => __( 'Alignment', 'tutor-lms-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left' => array(
						'title' => __( 'Left', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'tutor-lms-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .etlms-course-share' => 'text-align: {{VALUE}};',
				),
				'default'   => 'left',
			)
		);
		$this->end_controls_section();

		// share popup section.
		$this->start_controls_section(
			'course_share_popup',
			array(
				'label' => __( 'Share Popup', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$this->add_control(
			'course_share_section_title',
			array(
				'label'       => esc_html__( 'Section Title', 'plugin-name' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Share Course', 'plugin-name' ),
				'placeholder' => esc_html__( 'Type your title here', 'plugin-name' ),
			)
		);

		$this->add_control(
			'course_share_title',
			array(
				'label'       => esc_html__( 'Share Title', 'plugin-name' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Share on social media', 'plugin-name' ),
				'placeholder' => esc_html__( 'Type your title here', 'plugin-name' ),
			)
		);

		$this->add_control(
			'course_share_icon_shape',
			array(
				'label'        => __( 'Shape', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'rounded' => __( 'Rounded', 'tutor-lms-elementor-addons' ),
					'square'  => __( 'Square', 'tutor-lms-elementor-addons' ),
					'circle'  => __( 'circle', 'tutor-lms-elementor-addons' ),

				),
				'default'      => 'rounded',
				'prefix_class' => 'etlms-social-icon-',
				'selectors'    => array(
					'{{WRAPPER}}.etlms-social-icon-square .tutor-social-share-button'  => 'border-radius: 0px;',
					'{{WRAPPER}}.etlms-social-icon-rounded .tutor-social-share-button'  => 'border-radius: 10px;',
					'{{WRAPPER}}.etlms-social-icon-circle .tutor-social-share-button'  => 'border-radius: 100%; width: 120px; height: 120px;',
				),
			)
		);

		$this->add_control(
			'course_social_icon',
			array(
				'label'        => __( 'Show Icon', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'course_social_icon_text',
			array(
				'label'        => __( 'Show Icon Text', 'tutor-lms-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'tutor-lms-elementor-addons' ),
				'label_off'    => __( 'Hide', 'tutor-lms-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_responsive_control(
			'course_share_circle_size',
			array(
				'label'      => __( 'Circle Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}}.etlms-social-icon-circle .tutor-social-share-button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'size' => 120,
				),
				'condition'  => array(
					'course_share_icon_shape' => 'circle',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_controls() {
		// Label
		$this->start_controls_section(
			'course_share_label_section',
			array(
				'label' => __( 'Label', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_share_label_content_color',
			array(
				'label'     => __( 'Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .etlms-course-share-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Typography', 'tutor-lms-elementor-addons' ),
				'selector' => '{{WRAPPER}} .etlms-course-share-label',
			)
		);
		$this->end_controls_section();

		// Icon
		$this->start_controls_section(
			'course_share_icon_section',
			array(
				'label' => __( 'Share Icon', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_share_icon_color_settings',
			array(
				'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .etlms-course-share-icon' => 'color: {{VALUE}};',
				),
			)
		);
		
		$this->add_control(
			'course_sahre_icon_size',
			array(
				'label'      => __( 'Icon Size', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),

				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .etlms-course-share-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Social Icons (Buttons)
		$this->start_controls_section(
			'course_social_share_icon',
			array(
				'label' => __( 'Social Icon', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		
		$this->add_control(
			'course_social_share_icon_color',
			array(
				'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-social-share-button' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'course_social_icon_shape_color',
			array(
				'label'     => __( 'Shape Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-social-share-button' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'course_social_share_icon_size',
			array(
				'label'     => __( 'Size', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 100,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 24,
				),
				'selectors' => array(
					'{{WRAPPER}} .tutor-social-share-button' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'course_social_share_icon_padding',
			array(
				'label'      => __( 'Padding', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .tutor-social-share-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'      => 10,
					'right'    => 10,
					'bottom'   => 10,
					'left'     => 10,
					'unit'     => 'px',
					'isLinked' => true,
				),
			)
		);

		$icon_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';

		$this->add_responsive_control(
			'course_social_share_icon_spacing',
			array(
				'label'     => __( 'Spacing', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tutor-social-share-button' => $icon_spacing,
				),
				'default'   => array(
					'size' => 5,
				),
			)
		);

		// Social Icons Border (Button)
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'course_social_share_icon_border',
				'selector'  => '{{WRAPPER}} .tutor-social-share-button',
				'separator' => 'before',
			)
		);

		$border_radius = array(
			'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', '%' ),
			'selectors'  => array(
				'{{WRAPPER}} .tutor-social-share-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			),
			'default'    => array(
				'top'      => 0,
				'right'    => 0,
				'bottom'   => 0,
				'left'     => 0,
				'unit'     => 'px',
				'isLinked' => true,
			),
		);

		// for square shape
		$border_radius['condition'] = array( 'course_share_icon_shape' => array( 'square' ) );
		$this->add_control(
			'course_social_share_border_radius_square',
			$border_radius
		);

		// for rounded shape
		$border_radius['condition'] = array( 'course_share_icon_shape' => array( 'rounded' ) );
		$border_radius['default']   = array(
			'top'      => 5,
			'right'    => 5,
			'bottom'   => 5,
			'left'     => 5,
			'unit'     => 'px',
			'isLinked' => true,
		);
		$this->add_control(
			'course_social_share_border_radius_rounded',
			$border_radius
		);

		// for rounded shape
		$border_radius['condition'] = array( 'course_share_icon_shape' => array( 'circle' ) );
		$border_radius['default']   = array(
			'top'      => 50,
			'right'    => 50,
			'bottom'   => 50,
			'left'     => 50,
			'unit'     => '%',
			'isLinked' => true,
		);
		$this->add_control(
			'course_social_share_border_radius_circle',
			$border_radius
		);
		$this->end_controls_section();
	
		// hover section start
		$this->start_controls_section(
			'course_share_icon_hover_section',
			array(
				'label' => __( 'Social Icon Hover', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'course_icon_hover_color',
			array(
				'label'     => __( 'Icon Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tutor-social-share-button:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'course_icon_shape_hover_color',
			array(
				'label'     => __( 'Shape Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tutor-social-share-button:hover' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'course_share_hover_animation',
			array(
				'label'     => __( 'Hover Animation', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'course_share_icon_shape' => array(
						'square',
						'rounded',
						'circle',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'course_share_popup_style_section',
			array(
				'label' => __( 'Popup', 'tutor-lms-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		
		$this->add_control(
			'popup_section_title',
			array(
				'label'     => __( 'Section Title', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .etlms-course-share-modal-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'popup_share_title',
			array(
				'label'     => __( 'Share Title', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .etlms-course-share-modal-sub-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'popup_close_icon_color',
			array(
				'label'     => __( 'Close Icon', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-iconic-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'popup_page_link_color',
			array(
				'label'     => __( 'Page Link', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .etlms-course-share-modal-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'popup_background_color',
			array(
				'label'     => __( 'Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-modal-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'popup_border',
				'selector'  => '{{WRAPPER}} .tutor-modal-content',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'popup_border_radius',
			array(
				'label'      => __( 'Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tutor-modal-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'      => 5,
					'right'    => 5,
					'bottom'   => 5,
					'left'     => 5,
					'unit'     => 'px',
					'isLinked' => true,
				),
			)
		);

		// input controls styles
		$this->add_control(
			'popup_input_text_color',
			array(
				'label'     => __( 'Input Text Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-modal-content .tutor-form-control' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'popup_input_background_color',
			array(
				'label'     => __( 'Input Background Color', 'tutor-lms-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tutor-modal-content .tutor-form-control' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'popup_input_border',
				'selector'  => '{{WRAPPER}} .tutor-modal-content .tutor-form-control',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'popup_input_border_radius',
			array(
				'label'      => __( 'Input Border Radius', 'tutor-lms-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tutor-modal-content .tutor-form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'      => 5,
					'right'    => 5,
					'bottom'   => 5,
					'left'     => 5,
					'unit'     => 'px',
					'isLinked' => true,
				),
			)
		);
		// input controls styles end

		$this->end_controls_section();
	}

	protected function render( $instance = array() ) {
		$disable_course_share = ! tutor_utils()->get_option( 'enable_course_share' );
		if ( $disable_course_share ) {
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
				echo __( 'Please enable course share from tutor settings', 'tutor-lms-elementor-addons' );
			}
			return;
		}
		ob_start();
		$settings = $this->get_settings_for_display();
		include etlms_get_template( 'course/share' );
		echo ob_get_clean();
	}
}
