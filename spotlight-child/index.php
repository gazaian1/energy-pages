<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spotlight
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'csco_main_before' ); ?>

		<main id="main" class="site-main">

			<?php

			do_action( 'csco_main_start' );

			if ( have_posts() ) {
				?>

				<div class="post-archive">

					<div class="archive-wrap">

						<div class="archive-main">
							<?php

							// Start the Loop.
							while ( have_posts() ) {
								the_post();
								if ( 'full' === csco_get_page_layout() ) {
									get_template_part( 'template-parts/content-singular' );
								} else {
									get_template_part( 'template-parts/content' );
								}
							}
							?>
						</div>

					</div>

					<?php
					/* Posts Pagination */
					if ( 'standard' === get_theme_mod( csco_get_archive_option( 'pagination_type' ), 'load-more' ) ) {
						the_posts_pagination(
							array(
								'prev_text' => esc_html__( 'Previous', 'spotlight' ),
								'next_text' => esc_html__( 'Next', 'spotlight' ),
							)
						);
					}
					?>

				</div>

			<?php
			} else {
				?>

				<div class="content entry-content">
					<p><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'spotlight' ); ?></p>
					<?php get_search_form(); ?>
				</div>

				<?php
			}

			do_action( 'csco_main_end' );
			?>

		</main>

		<?php do_action( 'csco_main_after' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
