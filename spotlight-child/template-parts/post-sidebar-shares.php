<?php
/**
 * The template part for displaying post sidebar shares section.
 *
 * @package Spotlight
 */

if ( csco_powerkit_module_enabled( 'share_buttons' ) ) {
	if ( get_option( 'powerkit_share_buttons_post_sidebar_display', true ) ) {
		$tag = apply_filters( 'csco_share_title_tag', 'h5' );
		?>
		<section class="post-section post-sidebar-shares cs-d-none cs-d-lg-block">
			<<?php echo esc_html( $tag ); ?> class="title-block">
				<?php esc_html_e( 'Share article', 'spotlight' ); ?>
			</<?php echo esc_html( $tag ); ?>>

			<?php powerkit_share_buttons_location( 'post_sidebar' ); ?>
		</section>
		<?php
	}
}
