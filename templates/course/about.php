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

$excerpt      = tutor_get_the_excerpt();
$is_enabled   = get_tutor_option( 'enable_course_about' );
$string       = $excerpt;
$limit        = 500;
$has_readmore = false;
if ( strlen( $string ) > $limit ) {
	$has_readmore = true;
	// truncate string.
	$first_part = truncate( $string, $limit );
}

?>

<?php
if ( ! empty( $excerpt ) && $is_enabled ) {
	?>
	<div class='etlms-course-about tutor-mb-50 tab-item-content <?php echo $has_readmore ? 'tutor-has-showmore' : ''; ?> etlms-course-summery'>
		<?php
		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() && empty( $excerpt ) ) {
			   echo '<span style="margin: 5px">' . esc_html__( 'Please add data from the course editor', 'tutor-lms-elementor-addons' ) . '</span>';
			   return;
		}
		?>
		<div class='tutor-showmore-content'>
			<div class="text-medium-h6 tutor-color-text-primary">
				<?php echo esc_html( $settings['about_section_title_text'], 'tutor-lms-elementor-addons' ); ?>
			</div>
			<div class="text-regular-body tutor-color-text-subsued tutor-mt-12">
				<?php
				// if ( $has_readmore ) {
				// 	echo "<div class='showmore-short-text'>{$first_part}</div>";
				// 	echo "<div class='showmore-text'>{$string}</div>";
				// } else {
				// 	echo "<div><"
				// }
				?>
				<?php if ( $has_readmore ) : ?>
					<div class='showmore-short-text'>
						<?php echo esc_textarea( $first_part ); ?>
					</div>
					<div class='showmore-text'>
						<?php echo esc_textarea( $string ); ?>
					</div>
				<?php else: ?>
					<div class='showmore-text'>
						<?php echo esc_textarea( $string ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $has_readmore ) : ?>
			<div class="tutor-showmore-btn tutor-mt-22" data-showmore="true">
				<button class="tutor-btn tutor-btn-icon tutor-btn-disable-outline tutor-btn-ghost tutor-no-hover tutor-btn-md btn-showmore">
					<span class="btn-icon tutor-icon-plus-filled tutor-color-design-brand"></span>
					<span class="tutor-color-text-subsued">
						<?php esc_html_e( 'Show More', 'tutor-lms-elementor-addons' ); ?>
					</span>
				</button>
				<button class="tutor-btn tutor-btn-icon tutor-btn-disable-outline tutor-btn-ghost tutor-no-hover tutor-btn-md btn-showless">
					<span class="btn-icon tutor-icon-minus-filled tutor-color-design-brand"></span>
					<span class="tutor-color-text-subsued">
						<?php esc_html_e( 'Show Less', 'tutor-lms-elementor-addons' ); ?>
					</span>
				</button>
			</div>
		<?php endif; ?>
	</div>
	<?php
}
?>
