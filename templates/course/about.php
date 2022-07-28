<?php
if ( ! function_exists( 'truncate' ) ) {
	/**
	 * Truncate content
	 *
	 * @param [type]  $text
	 * @param integer $length
	 * @param string  $ending
	 * @param boolean $exact
	 * @param boolean $considerHtml
	 *
	 * @return string
	 */
	function truncate( $text, $length = 100, $ending = '...', $exact = true, $considerHtml = true ) {
		if ( is_array( $ending ) ) {
			extract( $ending );
		}
		if ( $considerHtml ) {
			if ( mb_strlen( preg_replace( '/<.*?>/', '', $text ) ) <= $length ) {
				return $text;
			}
			$totalLength = mb_strlen( $ending );
			$openTags    = array();
			$truncate    = '';
			preg_match_all( '/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER );
			foreach ( $tags as $tag ) {
				if ( ! preg_match( '/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2] ) ) {
					if ( preg_match( '/<[\w]+[^>]*>/s', $tag[0] ) ) {
						array_unshift( $openTags, $tag[2] );
					} elseif ( preg_match( '/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag ) ) {
						$pos = array_search( $closeTag[1], $openTags );
						if ( $pos !== false ) {
							array_splice( $openTags, $pos, 1 );
						}
					}
				}
				$truncate .= $tag[1];

				$contentLength = mb_strlen( preg_replace( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3] ) );
				if ( $contentLength + $totalLength > $length ) {
					$left           = $length - $totalLength;
					$entitiesLength = 0;
					if ( preg_match_all( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE ) ) {
						foreach ( $entities[0] as $entity ) {
							if ( $entity[1] + 1 - $entitiesLength <= $left ) {
								$left--;
								$entitiesLength += mb_strlen( $entity[0] );
							} else {
								break;
							}
						}
					}

					$truncate .= mb_substr( $tag[3], 0, $left + $entitiesLength );
					break;
				} else {
					$truncate    .= $tag[3];
					$totalLength += $contentLength;
				}
				if ( $totalLength >= $length ) {
					break;
				}
			}
		} else {
			if ( mb_strlen( $text ) <= $length ) {
				return $text;
			} else {
				$truncate = mb_substr( $text, 0, $length - strlen( $ending ) );
			}
		}
		if ( ! $exact ) {
			$spacepos = mb_strrpos( $truncate, ' ' );
			if ( isset( $spacepos ) ) {
				if ( $considerHtml ) {
					$bits = mb_substr( $truncate, $spacepos );
					preg_match_all( '/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER );
					if ( ! empty( $droppedTags ) ) {
						foreach ( $droppedTags as $closingTag ) {
							if ( ! in_array( $closingTag[1], $openTags ) ) {
								array_unshift( $openTags, $closingTag[1] );
							}
						}
					}
				}
				$truncate = mb_substr( $truncate, 0, $spacepos );
			}
		}

		$truncate .= $ending;

		if ( $considerHtml ) {
			foreach ( $openTags as $tag ) {
				$truncate .= '</' . $tag . '>';
			}
		}

		return $truncate;
	}
}

$excerpt      	= tutor_get_the_excerpt();
$is_enabled   	= get_tutor_option( 'enable_course_about' );
$string       	= $excerpt;
$limit        	= 100;
$has_show_more  = false;

if ( strlen( $string ) > $limit ) {
	$has_show_more = true;
}
?>

<?php if ( ! empty( $excerpt ) && $is_enabled ) : ?>
	<div class='etlms-course-about tutor-mb-48'>
		<div class='<?php echo $has_show_more ? "tutor-toggle-more-content tutor-toggle-more-collapsed" : "" ?>' <?php echo $has_show_more ? "data-tutor-toggle-more-content data-toggle-height='200' style='height: 200px;'" : "" ?>>
			<?php
			if ( \Elementor\Plugin::instance()->editor->is_edit_mode() && empty( $excerpt ) ) {
				echo '<span style="margin: 5px">' . esc_html__( 'Please add data from the course editor', 'tutor-lms-elementor-addons' ) . '</span>';
				return;
			}
			?>

			<h2 class="tutor-course-details-heading tutor-fs-5 tutor-fw-bold tutor-color-black tutor-mb-12">
				<?php echo esc_html( $settings['about_section_title_text'], 'tutor-lms-elementor-addons' ); ?>
			</h2>

			<div class="tutor-course-details-content tutor-fs-6 tutor-color-secondary">
				<?php echo esc_textarea( $string ); ?>
			</div>
		</div>
		<?php if ( $has_show_more ) : ?>
			<a href="#" class="tutor-btn-show-more tutor-btn tutor-btn-ghost tutor-mt-32" data-tutor-toggle-more=".tutor-toggle-more-content">
				<span class="tutor-toggle-btn-icon tutor-icon tutor-icon-plus tutor-mr-8" area-hidden="true"></span>
				<span class="tutor-toggle-btn-text"><?php esc_html_e( 'Show More', 'tutor' ); ?></span>
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>
