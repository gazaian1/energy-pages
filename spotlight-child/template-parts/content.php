<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Spotlight
 */

global $wp_query;

$post_type = get_post_type();

// Set layout of post.
$layout = csco_get_page_layout();

// Add new classes.
$class = sprintf( 'layout-%s', $layout );
?>

<article <?php post_class( $class ); ?>>

	<div class="post-outer">

		<a class="post-link" href="<?php echo get_permalink(); ?>"></a>

		<?php
		$image_size = 'csco-thumbnail';

		if ( 'list-alternative' === $layout ) {
			$image_size = 'csco-thumbnail-alternative';
		}

		if ( 'disabled' === csco_get_page_sidebar() ) {
			$image_size = 'csco-medium-alternative';

			if ( 'list-alternative' === $layout ) {
				$image_size = 'csco-thumbnail';
			}
		}
		?>

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-inner entry-thumbnail">
				<div class="cs-overlay cs-overlay-simple cs-overlay-ratio cs-ratio-landscape cs-bg-dark">
					<div class="cs-overlay-background">
						<?php the_post_thumbnail( $image_size ); ?>
					</div>
					<div class="cs-overlay-content">
						<?php csco_get_post_meta( 'category', false, true, true ); ?>
						<?php csco_the_post_format_icon(); ?>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="post-inner entry-inner">

			<div class="entry-data">

				<header class="entry-header">
					<?php
					// Post Title.
					the_title( '<h2 class="entry-title">', '</h2>' );
					?>
				</header>

				<div class="entry-excerpt">
					<?php the_excerpt(); ?>
				</div>

				<?php
				// Post Meta.
				csco_get_post_meta( array( 'author', 'date', 'comments', 'shares', 'views', 'reading_time' ), false, true, true );
				?>

			</div>

		</div>

	</div><!-- .post-outer -->

</article><!-- #post-<?php the_ID(); ?> -->
