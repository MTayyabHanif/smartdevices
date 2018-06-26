<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package SmartDevices
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found text-center">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'smartdevices' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the products below or a search?', 'smartdevices' ); ?></p>
                    
					<?php
                    get_product_search_form();
                    ?>
                    <div class="recent_products home_section text-left mt-6">
                        <h3 class="mb-2"><span class="ti-bookmark mr-3"></span>Recent Products</h2>
                        <?php
                            echo do_shortcode('[recent_products per_page="12"]');
                        ?>
                    </div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
