<?php
/**
 * The template part for displaying page header.
 *
 * @package Spotlight
 */

// Init class for header.
$class = null;

// If description exists.
if ( get_the_archive_description() ) {
	$class = 'page-header-has-description';
}
?>

<header class="page-header <?php echo esc_attr( $class ); ?>">

	<?php

	do_action( 'csco_page_header_before' );

	if ( is_home() ) {

		echo '<h1 class="title-block">' . esc_html__( 'The Latest', 'spotlight' ) . '</h1>';

	} elseif ( is_author() ) {

		$subtitle  = esc_html__( 'All Posts By', 'spotlight' );
		$author_id = get_queried_object_id();
		?>

		<div class="cs-row">
			<div class="cs-col-2">
				<?php
				echo get_avatar( $author_id, 130 );
				if ( csco_powerkit_module_enabled( 'social_links' ) ) {
					powerkit_author_social_links( $author_id );
				}
				?>
			</div>
			<div class="cs-col-10">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				csco_archive_post_count();
				csco_archive_post_description();
				?>
			</div>
		</div>

		<?php
	} elseif ( is_archive() ) {

		// Add special subtitles.
		if ( is_category() ) {
			$subtitle = esc_html__( 'Browsing Category', 'spotlight' );
		} elseif ( is_tag() ) {
			$subtitle = esc_html__( 'Browsing Tag', 'spotlight' );
		} else {
			$subtitle = '';
		}

		// Add a subtitle, wrapped in <p></p> if it exists.
		if ( $subtitle ) {
			?>
			<p class="page-subtitle title-block"><?php echo esc_html( $subtitle ); ?></p>
			<?php
		}

		the_archive_title( '<h1 class="page-title">', '</h1>' );
		csco_archive_post_count();
		csco_archive_post_description();

	} elseif ( is_search() ) {

		?>
		<p class="page-subtitle title-block"><?php esc_html_e( 'Search Results', 'spotlight' ); ?></p>
		<h1 class="page-title"><?php echo get_search_query(); ?></h1>
		<?php
		csco_archive_post_count();

	} elseif ( is_404() ) {

		?>
		<h1 class="page-title"><?php esc_html_e( '404', 'spotlight' ); ?></h1>
		<?php

	}

	do_action( 'csco_page_header_after' );
	?>
</header>
