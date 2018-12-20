<?php
/**
 * Template part for displaying footer posts section.
 *
 * @package Spotlight
 */

do_action( 'csco_footer_posts_before' );
?>

<div class="section-footer-posts">

	<?php do_action( 'csco_footer_posts_start' ); ?>

		<div class="cs-container">

			<div class="cs-footer-posts-wrap">

				<?php
				// Exclude featured posts.
				$post__not_in = array();

				if ( get_theme_mod( 'footer_featured_posts_avoid_duplicate' ) ) {
					$post__not_in = csco_get_featured_posts_ids();
				}

				$posts_per_page = csco_get_featured_posts_numbers( 'type-4' );

				$ids = csco_get_featured_posts_ids( 'footer', $posts_per_page, $post__not_in );

				if ( $ids ) {
					$args = array(
						'ignore_sticky_posts' => true,
						'post__in'            => $ids,
						'posts_per_page'      => $posts_per_page,
					);

					$the_query = new WP_Query( $args );
				}

				// Determines whether there are more posts available in the loop.
				$have_posts = $ids && $the_query->have_posts() ? true : false;

				if ( $have_posts && $the_query->post_count >= $posts_per_page ) {
					?>
					<div class="cs-footer-posts cs-featured-posts cs-featured-type-4">
						<?php
						set_query_var( 'csco_featured', 'footer_featured_posts' );
						set_query_var( 'csco_featured_query', $the_query );
						set_query_var( 'csco_featured_thumb_attr', array() );

						csco_get_featured_posts( array(
							'featured-grid',
							'featured-grid',
							'featured-grid',
							'featured-grid',
						) );
						?>
					</div>

					<?php wp_reset_postdata(); ?>

				<?php } ?>

			</div>

		</div>

	<?php do_action( 'csco_footer_posts_end' ); ?>

</div>

<?php

do_action( 'csco_footer_posts_after' );
