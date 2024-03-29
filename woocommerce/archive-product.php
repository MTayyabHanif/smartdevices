<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


// removing products count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);



get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_shop_cover_header hook.
		 * 
		 * @hooked woocommerce_smartdevices_shop_cover_Wrapper_open - 10
		 * @hooked woocommerce_smartdevices_shop_cover_image - 15
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked woocommerce_taxonomy_archive_description - 25
		 * @hooked woocommerce_product_archive_description - 25
		 * @hooked woocommerce_smartdevices_shop_cover_Wrapper_close - 40
		 */
		do_action( 'woocommerce_shop_cover_header' );
	?>


		
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>



	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
        do_action( 'woocommerce_before_main_content' );
        
        // echo "<pre>";
        // print_r($wp_query);
        // $sorted_array = usort($wp_query->posts, function($a, $b){
        // if ($a == $b) {
        //         return 0;
        //     }
        //     return ($a < $b) ? -1 : 1;
        // });
        // echo "</pre>";
	?>


		

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php
                        $customm = get_post_meta($post->ID, 'product_releasing_date',true );
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 * @hooked woocommerce_pagination -20 
		 * @hooked cf_category_long_description -25
		 */
		do_action( 'woocommerce_after_main_content' );
	?>


<?php get_footer( 'shop' ); ?>
