<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Spotlight
 */

global $wp_query;

$query = get_query_var( 'csco_featured_query' );

$query->the_post();

$post_type = get_post_type();

// Get thumbnail attr.
$thumbnail_attr = get_query_var( 'csco_featured_thumb_attr' );

// Get layout.
$layout = get_query_var( 'csco_featured_layout' );

// Add new classes.
$class = sprintf( 'layout-%s', $layout );

// Post meta.
$post_meta = sprintf( '%s_meta', get_query_var( 'csco_featured' ) );
?>

<article <?php post_class( $class ); ?>>

	<div class="post-wrap">

		<div class="post-outer">

			<a class="post-link" href="<?php echo esc_url( get_permalink() ); ?>"></a>

			<?php
			$image_size = 'csco-thumbnail-alternative';

			if ( 'featured-full' === $layout ) {
				$image_size = 'csco-medium-alternative';
			}
			?>

			<?php if ( 'featured-grid-simple' !== $layout && has_post_thumbnail() ) { ?>
				<div class="post-inner entry-thumbnail">
					<div class="cs-overlay cs-overlay-simple cs-overlay-ratio cs-ratio-landscape cs-bg-dark">
						<div class="cs-overlay-background">
							<?php the_post_thumbnail( $image_size, (array) $thumbnail_attr ); ?>
						</div>
						<div class="cs-overlay-content">
							<?php csco_get_post_meta( 'category', false, true, $post_meta ); ?>
							<?php csco_the_post_format_icon(); ?>
						</div>
					</div>
				</div>
			<?php } ?>

			<div class="post-inner entry-inner entry-data">
				<header class="entry-header">
					<?php
					// Post Title.
					the_title( '<h2 class="entry-title">', '</h2>' );
					?>
				</header>


				<div class="entry-excerpt">
					<?php echo esc_html( csco_str_truncate( get_the_excerpt(), 95 ) ); ?>
				</div>

				<?php
				// Post Meta.
				csco_get_post_meta( array( 'author', 'date', 'comments', 'shares', 'views', 'reading_time' ), false, true, $post_meta );
				?>
			</div>

		</div><!-- .post-outer -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
