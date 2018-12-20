<?php
/**
 * The template part for displaying post subscribe section.
 *
 * @package Spotlight
 */

$image = get_theme_mod( 'post_subscribe_background_image' );
?>

<?php do_action( 'csco_post_subscribe_before' ); ?>

<section class="post-subscribe">
	<?php
		$title = get_theme_mod( 'post_subscribe_title', esc_html__( 'Sign Up for Our Newsletters', 'spotlight' ) );
		$text  = get_theme_mod( 'post_subscribe_text', esc_html__( 'Get notified of the best deals on our WordPress themes.', 'spotlight' ) );
		$name  = get_theme_mod( 'post_subscribe_name', false );

		$shortcode = sprintf( '[powerkit_subscription_form title="%s" text="%s" bg_image_id="%s" display_name="%s"]', $title, $text, $image, $name );

		echo do_shortcode( apply_filters( 'csco_subscribe_shortcode', $shortcode, 'post', $text, $title, $image ) );
	?>
</section>

<?php do_action( 'csco_post_subscribe_after' ); ?>
