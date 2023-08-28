<div class="<?php tutor_container_classes(); ?> etlms-course-list-main-wrap">
	<?php
	/*
	* get settings from elementor
	*/
	$course_list_perpage = $settings['course_list_perpage'];
	$course_list_column  = $settings['course_list_column'];

	$include_by_categories = $settings['course_list_include_by_categories'];
	$exclude_by_categories = $settings['course_list_exclude_by_categories'];
	$include_by_authors    = $settings['course_list_include_by_authors'];
	$exclude_by_authors    = $settings['course_list_exclude_by_authors'];
	$order_by              = $settings['course_list_order_by'];
	$order                 = $settings['course_list_order'];

	/*
	* query arguments
	*/
	$paged = isset( $_GET['current_page'] ) ? sanitize_text_field( $_GET['current_page'] ) : 1;
	// check for plugin using tutor pro
	if ( ! function_exists( 'is_bundle_enabled' ) ) {
		function is_bundle_enabled() {
			$basename   = plugin_basename( TUTOR_COURSE_BUNDLE_FILE );
			$is_enabled = tutor_utils()->is_addon_enabled( $basename );
			return $is_enabled;
		}
	}

	if(in_array('tutor-pro/tutor-pro.php', apply_filters('active_plugins', get_option('active_plugins'))) && is_bundle_enabled() ){ 
		//plugin is activated
		$listing_postype = ['courses','course-bundle'];
	}
	else{
		$listing_postype = tutor()->course_post_type;
	}
	$args  = array(
		'post_type'      => $listing_postype,
		'post_status'    => 'publish',
		'posts_per_page' => $course_list_perpage,
		'paged'          => $paged,
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

	do_action( 'tutor_elementor/before/course_list' );

	if ( $the_query->have_posts() ) :
		?>
		<?php
			$courseColumns    = (isset($settings['course_list_column']) && $settings['course_list_column']) ? (int) $settings['course_list_column'] : 3;
			
			$listStyle = '';
			if ( 'yes' == $settings['course_list_masonry'] ) {
				$listStyle = 'masonry';
			} else {
				$listStyle = 'tutor-courses';
			}

			$layout = isset($settings['course_list_skin']) ? $settings['course_list_skin'] : 'card';
			$path = $courseColumns > 1 ? 'list' : 'list/grid';
		?>
		<div class="etlms-course-list-loop-wrap tutor-course-list tutor-grid tutor-grid-<?php echo esc_attr( $courseColumns ); ?>">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="etlms-course-list-col">
					<?php include etlms_get_template( 'course/' . $path . '/' . $layout ); ?>
				</div>
			<?php endwhile; ?>
		</div>

		<?php if ( 'yes' == $settings['course_list_pagination_settings'] ) : ?>
			<?php
			$prev_next_pagination = true;
			$pagination_type      = $settings['course_list_pagination_type'];

			// setting pagination type
			if ( $pagination_type == 'numbers' ) {
				$prev_next_pagination = false;
			}

			$pagination_page_limit = $settings['course_list_pagination_page_limit'];
			$pagination_prev_label = $settings['course_list_pagination_previous_label'];
			$pagination_next_label = $settings['course_list_pagination_next_label'];

			$big = 999999999; // need an unlikely integer.

			$pagination_link_arg = array(
				'format'    => '?current_page=%#%',
				'current'   => max( 1, $paged ),
				'end_size'  => $pagination_page_limit,
				'prev_next' => $prev_next_pagination,
				'prev_text' => __( $pagination_prev_label, 'tutor-lms-elementor-addons' ),
				'next_text' => __( $pagination_next_label, 'tutor-lms-elementor-addons' ),
				'total'     => $the_query->max_num_pages,
			);

			$pagination_links = paginate_links( $pagination_link_arg );
			?>
		<div class="etlms-course-list-pagination-wrap tutor-mt-32">
			<div class="etlms-pagination prev-next">
				<?php if ( $pagination_type == 'prev_next' ) : ?>

					<?php if ( $the_query->found_posts > $course_list_perpage ) : ?>
						<?php
						$current_url = strtok( $_SERVER['REQUEST_URI'], '?' );
						$prev_page   = $paged - 1;
						$next_page   = $paged + 1;
						$prev_link   = $current_url . '?current_page=' . $prev_page;
						$next_link   = $current_url . '?current_page=' . $next_page;
						$max_page    = $the_query->max_num_pages;
						?>
						<?php if ( $prev_page < 1 ) : ?>
							<span class="page-numbers">
								<?php echo esc_html( $pagination_prev_label ); ?>
							</span>
						<?php else : ?>
							<a class="page-numbers" href="<?php echo esc_url( $prev_link ); ?>">
								<?php echo esc_html( $pagination_prev_label ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $next_page > $max_page ) : ?>
							<span class="page-numbers">
								<?php echo esc_html( $pagination_next_label ); ?>
							</span>
						<?php else : ?>
							<a class="page-numbers" href="<?php echo esc_url( $next_link ); ?>">
								<?php echo esc_html( $pagination_next_label ); ?>
							</a>
						<?php endif; ?>

					<?php endif; ?>

				<?php else : ?>
			</div>

			<div class="etlms-pagination pagination-numbers-prev-next">
				<?php echo $pagination_links; ?>
			</div>
		<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php
	else :
		/**
		 * No course found
		 */
		tutor_load_template( 'course-none' );
	endif;

	do_action( 'tutor_elementor/after/course_list' );
	wp_reset_postdata();
	?>
</div>
<?php
if ( ! is_user_logged_in() ) {
	tutor_load_template_from_custom_path( tutor()->path . '/views/modal/login.php', false );
}
?>