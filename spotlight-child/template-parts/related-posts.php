<?php
/**
 * The template part for displaying related posts.
 *
 * @package Spotlight
 */

$args = array(
	'query_type'          => 'related',
	'orderby'             => 'rand',
	'ignore_sticky_posts' => true,
	'post__not_in'        => array( $post->ID ),
	'category__in'        => wp_get_post_categories( $post->ID ),
	'posts_per_page'      => get_theme_mod( 'related_number', 4 ),
);

// Order by post views.
if ( class_exists( 'Post_Views_Counter' ) ) {
	$args['orderby'] = 'post_views';
}

// Time Frame.
$time_frame = get_theme_mod( 'related_time_frame' );
if ( $time_frame ) {
	$args['date_query'] = array(
		array(
			'column' => 'post_date_gmt',
			'after'  => $time_frame . ' ago',
		),
	);
}

// WP Query.
$related = new WP_Query( apply_filters( 'csco_related_posts_args', $args ) );

// Set query vars, so that we can get them across all templates.
set_query_var( 'csco_layout', 'related_layout' );

if ( $related->have_posts() && isset( $related->posts ) ) {
	?>

	<section class="post-archive archive-related">

		<div class="archive-wrap">

			<?php $tag = apply_filters( 'csco_section_title_tag', 'h5' ); ?>

			<<?php echo esc_html( $tag ); ?> class="title-block">
				<?php esc_html_e( 'You May Also Like', 'spotlight' ); ?>
			</<?php echo esc_html( $tag ); ?>>

			<div class="archive-main">
				<?php
				$counter = 0;
				/* Start the Loop */
				while ( $related->have_posts() ) {
					$related->the_post();

					$counter++;

					// Get content template part.
					get_template_part( 'template-parts/content' );
				}
				?>
			</div>

		</div>

	</section>

	<?php wp_reset_postdata(); ?>

<?php
set_query_var( 'csco_layout', null );
}
