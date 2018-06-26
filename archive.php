<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SmartDevices
 */

get_header(); ?>

<?php
	/**
	 * woocommerce_shop_cover_header hook.
	 *
	 * @hooked woocommerce_smartdevices_blog_cover_Wrapper_open - 10
	 * @hooked woocommerce_smartdevices_blog_cover_image - 15
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked woocommerce_product_archive_description - 25
	 * @hooked woocommerce_smartdevices_shop_cover_Wrapper_close - 40
	 */
	do_action( 'woocommerce_blog_cover_header' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */

			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
