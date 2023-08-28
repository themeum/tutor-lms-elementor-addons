<div class="<?php tutor_container_classes(); ?> etlms-carousel-main-wrap">
	<?php
	$include_by_categories 	= $settings['course_carousel_include_by_categories'];
	$exclude_by_categories 	= $settings['course_carousel_exclude_by_categories'];
	$include_by_authors    	= $settings['course_carousel_include_by_authors'];
	$exclude_by_authors    	= $settings['course_carousel_exclude_by_authors'];
	$order_by              	= $settings['course_carousel_order_by'];
	$order                 	= $settings['course_carousel_order'];
	$limit                 	= $settings['course_carousel_post_limit'];

	/*
	* query arguments
	*/
	if ( ! function_exists( 'is_bundle_enabled' ) ) {
		function is_bundle_enabled() {
			$basename   = plugin_basename( TUTOR_COURSE_BUNDLE_FILE );
			$is_enabled = tutor_utils()->is_addon_enabled( $basename );
			return $is_enabled;
		}
	}
	if(in_array('tutor-pro/tutor-pro.php', apply_filters('active_plugins', get_option('active_plugins'))) && is_bundle_enabled() ){ 
		//plugin is activated
		$carosel_postype = ['courses','course-bundle'];
	}
	else{
		$carosel_postype = tutor()->course_post_type;
	}
	$args = array(
		'post_type'      => $carosel_postype,
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
		'tax_query'      => array(
			'relation' => 'AND',
		),
	);

	if ( ! empty( $include_by_categories ) ) {
		$tax_query = array(
			'taxonomy' => 'course-category',
			'field'    => 'term_id',
			'terms'    => $include_by_categories,
			'operator' => 'IN',
		);
		array_push( $args['tax_query'], $tax_query );
	}

	if ( ! empty( $exclude_by_categories ) ) {
		$tax_query = array(
			'taxonomy' => 'course-category',
			'field'    => 'term_id',
			'terms'    => $exclude_by_categories,
			'operator' => 'NOT IN',
		);
		array_push( $args['tax_query'], $tax_query );
	}

	if ( ! empty( $include_by_authors ) ) {
		$args['author__in'] = $include_by_authors;
	}

	if ( ! empty( $exclude_by_authors ) ) {
		$args['author__not_in'] = $exclude_by_authors;
	}

	if ( ! empty( $order_by ) ) {
		$args['orderby'] = $order_by;
		$args['order']   = $order;
	}

	// the query
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :
		?>

		<?php
			$courseCols    	= (isset($settings['etlms_course_carousel_column']) && $settings['etlms_course_carousel_column']) ? (int) $settings['etlms_course_carousel_column'] : 3;
			$layout 		= isset($settings['course_carousel_skin']) ? $settings['course_carousel_skin'] : 'card';
		?>

		<div class="etlms-carousel-loop-wrap tutor-courses tutor-courses-loop-wrap tutor-courses-layout-<?php echo $courseCols; ?> etlms-coursel-<?php echo $settings['course_carousel_skin']; ?> etlms-carousel-dots-<?php echo $settings['course_carousel_dots_position']; ?>" id="etlms-slick-responsive">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="<?php tutor_course_loop_col_classes(); ?>">
					<?php include etlms_get_template( 'course/carousel/' . $layout ); ?>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php if ( 'yes' == $settings['course_carousel_settings_arrows'] ) : ?>
			<div class="etlms-carousel-arrow etlms-carousel-arrow-prev arrow-<?php echo $settings['course_carousel_arrow_style']; ?> etlms-carousel-arrow-position-<?php echo esc_attr( $settings['course_carousel_arrows_position'] ); ?> ">
				<i class="fa fa-angle-left" aria-hidden="true"></i>
			</div>
			<div class="etlms-carousel-arrow etlms-carousel-arrow-next arrow-<?php echo $settings['course_carousel_arrow_style']; ?> etlms-carousel-arrow-position-<?php echo esc_attr( $settings['course_carousel_arrows_position'] ); ?>">
				<i class="fa fa-angle-right" aria-hidden="true"></i>
			</div>
		<?php endif; ?>
		<?php

	else :
		tutor_load_template( 'course-none' );
	endif;

	do_action( 'tutor_course/archive/after_loop' );
	?>

	<!-- handle elementor settings -->
	<?php
	$carousel_column         = '3';
	$carousel_column_tablet  = '2';
	$carousel_column_mobile  = '1';
	$carousel_arrows         = 'yes';
	$carousel_dots           = 'yes';
	$carousel_transition     = '600';
	$carousel_center         = 'yes';
	$carousel_smooth_scroll  = 'yes';
	$carousel_autoplay       = 'yes';
	$carousel_autoplay_speed = '5000';
	$carousel_infinite_loop  = 'yes';
	$carousel_pause_on_hover = 'yes';

	if ( isset( $settings ) ) {
		$settings['etlms_course_carousel_column'] != '' ? $carousel_column = $settings['etlms_course_carousel_column'] : '';
		$settings['etlms_course_carousel_column_tablet'] != '' ? $carousel_column_tablet = $settings['etlms_course_carousel_column_tablet'] : '';
		$settings['etlms_course_carousel_column_mobile'] != '' ? $carousel_column_mobile = $settings['etlms_course_carousel_column_mobile'] : '';
		isset( $settings['course_carousel_column_mobile'] ) ? $carousel_column_mobile = $settings['course_carousel_column_mobile'] : '';
		$settings['course_carousel_settings_arrows'] == 'yes' ? '' : $carousel_arrows = 'no';
		$settings['course_carousel_settings_dots'] == 'yes' ? '' : $carousel_dots = 'no';
		$carousel_transition = $settings['course_carousel_settings_transition'];
		$settings['course_carousel_settings_center_slides'] == 'yes' ? '' : $carousel_center = 'no';
		$settings['course_carousel_settings_scroll'] == 'yes' ? $carousel_smooth_scroll = 'linear' : $carousel_smooth_scroll = 'ease';
		$settings['course_carousel_settings_autoplay'] == 'yes' ? '' : $carousel_autoplay = 'no';
		$carousel_autoplay_speed = $settings['course_carousel_settings_autoplay_speed'];
		$settings['course_carousel_settings_infinite_loop'] == 'yes' ? '' : $carousel_infinite_loop = 'no';
		$settings['course_carousel_settings_pause_onhover'] == 'yes' ? '' : $carousel_pause_on_hover = 'no';
	}
	?>
	<div id="etlms_carousel_settings" arrows="<?php echo $carousel_arrows; ?>" dots="<?php echo $carousel_dots; ?>" transition="<?php echo $carousel_transition; ?>" center="<?php echo $carousel_center; ?>" smoth_scroll="<?php echo $carousel_smooth_scroll; ?>" auto_play="<?php echo $carousel_autoplay; ?>" auto_play_speed="<?php echo $carousel_autoplay_speed; ?>" infinite_loop="<?php echo $carousel_infinite_loop; ?>" pause_on_hover="<?php echo $carousel_pause_on_hover; ?>" desktop="<?php echo $carousel_column; ?>" medium="<?php echo $carousel_column_tablet; ?>" mobile="<?php echo $carousel_column_mobile; ?>">

	</div>
	<input type="hidden" id="etlms_enroll_btn_type" value="">
	<input type="hidden" id="etlms_enroll_btn_cart" value="">
</div>
<?php
if ( ! is_user_logged_in() ) {
	tutor_load_template_from_custom_path( tutor()->path . '/views/modal/login.php', false );
}
?>
