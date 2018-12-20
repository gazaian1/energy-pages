<?php
/**
 * The template part for displaying post header section.
 *
 * @package Spotlight
 */

$page_header = csco_get_page_header_type();

$class = sprintf( 'entry-header-%s', $page_header );

// Check if post has an image attached.
if ( has_post_thumbnail() ) {
	$class .= ' entry-header-thumbnail';
}

// Check if page header is wide.
if ( 'wide' === $page_header ) {
	$class .= ' cs-overlay cs-overlay-no-hover cs-overlay-ratio cs-bg-dark';
}
?>

<section class="entry-header <?php echo esc_attr( $class ); ?>">

	<?php do_action( 'csco_singular_entry_header_start' ); ?>

	<?php if ( 'large' === $page_header && has_post_thumbnail() ) { ?>
		<div class="cs-overlay cs-overlay-simple cs-overlay-ratio cs-ratio-large">
			<div class="cs-overlay-background">
				<?php
					the_post_thumbnail( 'csco-extra-large', array(
						'class' => 'pk-lazyload-disabled',
					) );
				?>
			</div>
		</div>
	<?php } ?>


	<div class="cs-container">

		<?php if ( 'wide' === $page_header ) { ?>
			<div class="cs-overlay-background">
				<?php
					the_post_thumbnail( 'csco-extra-large', array(
						'class' => 'pk-lazyload-disabled',
					) );
				?>
			</div>
			<div class="cs-overlay-content">
		<?php } ?>

		<?php csco_breadcrumbs( true ); ?>

		<?php if ( is_singular( 'post' ) ) { ?>
			<div class="entry-inline-meta">
				<?php csco_get_post_meta( 'category', false, true, 'post_meta' ); ?>
			</div>
		<?php } ?>

		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );

		if ( has_excerpt() ) {
			?>
			<div class="post-excerpt"><?php the_excerpt(); ?></div>
			<?php
		}
		?>

		<?php
		if ( is_singular( 'post' ) ) {
			if ( csco_has_post_meta( 'views' ) || csco_has_post_meta( 'comments' ) || csco_has_post_meta( 'reading_time' ) || csco_has_post_meta( 'shares' ) ) {
			?>
				<div class="entry-meta-details">
					<?php
					csco_get_post_meta( array( 'views', 'comments', 'reading_time' ), false, true, 'post_meta' );

					if ( csco_powerkit_module_enabled( 'share_buttons' ) ) {
						powerkit_share_buttons_location( 'post_header' );
					}
					?>
				</div>
			<?php
			}
		}
		?>

		<?php if ( 'wide' === $page_header ) { ?>
			</div>
		<?php } ?>

	</div>

	<?php do_action( 'csco_singular_entry_header_end' ); ?>

</section>
