<?php
/**
 * The template part for displaying post sidebar date section.
 *
 * @package Spotlight
 */

?>

<section class="post-section post-sidebar-date">
	<?php
	$time_string = null;

	if ( get_theme_mod( 'post_date_format', false ) ) {
		$format = get_option( 'date_format' );
	} else {
		$format = 'd F Y';
	}

	if ( csco_has_post_meta( 'time', false ) ) {
		$format .= ', H:i e';
	}

	if ( csco_has_post_meta( 'date' ) ) {
		$reader_text = __( '<span class="reader-text published-text">Published on</span>', 'spotlight' );

		$time_string .= '<time class="entry-date published" datetime="%1$s">' . $reader_text . ' %2$s</time>';
	}

	if ( csco_has_post_meta( 'updated_date', false ) && get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$reader_text = __( '<span class="reader-text updated-text">Updated on</span>', 'spotlight' );

		$time_string .= '<time class="updated" datetime="%3$s">' . $reader_text . ' %4$s</time>';
	}

	echo apply_filters( 'csco_post_sidebar_date_output', sprintf( $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date( $format ) ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date( $format ) )
	) ); // XSS ok.
	?>
</section>
