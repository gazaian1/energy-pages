<?php
/**
 * Template part singular content
 *
 * @package Spotlight
 */

$post_type = get_post_type();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( is_singular() ? 'post-section' : 'layout-full' ); ?>>

	<?php
	if ( ! is_singular() ) {
		?>
			<?php csco_get_post_meta( 'category', false, true, true ); ?>

			<header class="entry-header">
				<?php do_action( 'csco_singular_entry_header_start' ); ?>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

				<?php do_action( 'csco_singular_entry_header_end' ); ?>
			</header>
		<?php
	}
	?>

	<?php do_action( 'csco_singular_content_before' ); ?>

	<div class="entry-content">

		<?php do_action( 'csco_singular_content_start' ); ?>

		<div class="content">

			<?php
			if ( ! is_singular() && 'excerpt' === get_theme_mod( csco_get_archive_option( 'summary' ), 'excerpt' ) ) {
				the_excerpt();

				csco_get_post_meta( array( 'author', 'date', 'comments', 'shares', 'views', 'reading_time' ), false, true, true );

				?>
				<div class="entry-more-button">
					<a class="button entry-more" href="<?php echo esc_url( get_permalink() ); ?>">
						<?php esc_html_e( 'View Post', 'spotlight' ); ?>
					</a>
				</div><!-- .entry-more-button -->
				<?php
			} else {
				$more_link_text = sprintf(
					/* translators: %s: Name of current post */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'spotlight' ),
					get_the_title()
				);

				the_content( $more_link_text );
			}
			?>

		</div>
		<?php do_action( 'csco_singular_content_end' ); ?>
	</div>

	<?php do_action( 'csco_singular_content_after' ); ?>

</article>
