<?php
/**
 * The template part for displaying post sidebar author section.
 *
 * @package Spotlight
 */

$authors = array();

if ( csco_coauthors_enabled() ) {
	$authors = get_coauthors();
}

$tag = apply_filters( 'csco_author_title_tag', 'h5' );
?>

<?php do_action( 'csco_author_before' ); ?>

<section class="post-section post-sidebar-author cs-d-none cs-d-lg-block">

	<<?php echo esc_html( $tag ); ?> class="title-block">
		<?php esc_html_e( 'Author', 'spotlight' ); ?>
	</<?php echo esc_html( $tag ); ?>>

	<?php
	if ( $authors ) {
		foreach ( $authors as $author ) {
			csco_post_author( $author->ID );
		}
	} else {
		// Get the default WP author details.
		csco_post_author();
	}
	?>

</section>

<?php do_action( 'csco_author_after' ); ?>
