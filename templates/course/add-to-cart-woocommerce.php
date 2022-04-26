<?php
/**
 * Woocommerce add to cart template
 *
 * @package ETLMSWoocommerceAddToCart
 *
 * @version v2.0.0
 */
$product_id = tutor_utils()->get_course_product_id();
$product    = wc_get_product( $product_id );
if ( $product ) {
	if ( tutor_utils()->is_course_added_to_cart( $product_id, true ) ) {
		?>
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="tutor-btn tutor-btn-tertiary tutor-is-outline tutor-btn-lg tutor-btn-full">
				<?php esc_html_e( 'View Cart', 'tutor-lms-elementor-addons' ); ?>
			</a>
		<?php
	} else {
		?>
        <form action="<?php echo esc_url( apply_filters( 'tutor_course_add_to_cart_form_action', get_permalink( get_the_ID() ) ) ); ?>" method="post" enctype="multipart/form-data">
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"  class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block tutor-mt-24 tutor-add-to-cart-button">
                <span class="btn-icon tutor-icon-cart-filled"></span>
                <span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
            </button>
        </form>
		<?php
	}
} else {
	?>
	<p class="tutor-alert-warning">
		<?php esc_html_e( 'Please make sure that your product exists and valid for this course', 'tutor-lms-elementor-addons' ); ?>
	</p>
	<?php
}
