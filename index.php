<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>

					<?php
				endif;

				/* Start the Loop */
				$GLOBALS['post_count'] = 0;
				echo '<div class="posts_wrapper">	<div class="container-fluid small-gutters"> 	<div class="row with-sm-gutters">';

				while ( have_posts() ) : the_post();
					$GLOBALS['post_count']++;


					if ($GLOBALS['post_count'] == 2):
						echo '<div class="deep-posts col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">';
						echo '<div class="container small-gutters deep-container"><div class="row with-sm-gutters">';
					endif;

					get_template_part( 'template-parts/content', get_post_format() );


					if ($GLOBALS['post_count'] == 5):
						echo '</div></div>';
						echo '</div>';
					endif;

				endwhile;

				echo '</div><!-- .posts_wrapper -->	</div><!-- .posts_wrapper>.container --> 	</div><!-- .posts_wrapper>.container>.row -->';

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->







	<?php
	get_sidebar();
	get_footer();
