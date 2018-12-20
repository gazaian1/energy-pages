<?php
/**
 * The template part for displaying large header layout.
 *
 * @package Spotlight
 */

?>

<?php
$color_topbar_bg    = strtoupper( get_theme_mod( 'color_large_header_bg', '#FFFFFF' ) );
$color_bottombar_bg = strtoupper( get_theme_mod( 'color_navbar_bg', '#FFFFFF' ) );

$scheme_topbar    = csco_light_or_dark( $color_topbar_bg, null, ' cs-bg-navbar-dark' );
$scheme_bottombar = csco_light_or_dark( $color_bottombar_bg, null, ' cs-bg-navbar-dark' );

// If the background color in the bars is different.
if ( $color_topbar_bg !== $color_bottombar_bg ) {
	$scheme_topbar .= ' navbar-multicolor';
}
?>

<div class="navbar navbar-topbar">
	<div class="navbar-wrap <?php echo esc_attr( $scheme_topbar ); ?>">
		<?php do_action( 'csco_navbar_large_topbar' ); ?>
	</div>
</div>

<nav class="navbar navbar-primary navbar-bottombar">

	<?php do_action( 'csco_navbar_start' ); ?>

	<div class="navbar-wrap <?php echo esc_attr( $scheme_bottombar ); ?>">

		<div class="navbar-container">

			<div class="navbar-content">

				<?php do_action( 'csco_navbar_large_bottombar' ); ?>

			</div><!-- .navbar-content -->

		</div><!-- .navbar-container -->

	</div><!-- .navbar-wrap -->

	<?php do_action( 'csco_navbar_end' ); ?>

</nav><!-- .navbar -->
