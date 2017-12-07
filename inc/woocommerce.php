<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package SmartDevices
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function smartdevices_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	// add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'smartdevices_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function smartdevices_woocommerce_scripts() {
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'smartdevices-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'smartdevices_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function smartdevices_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'smartdevices_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function smartdevices_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'smartdevices_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function smartdevices_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'smartdevices_woocommerce_thumbnail_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function smartdevices_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'smartdevices_woocommerce_related_products_args' );


if ( ! function_exists( 'smartdevices_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function smartdevices_woocommerce_wrapper_before() {
		if ( is_active_sidebar( 'sidebar-2' ) && !is_product()){
			?>
			<div id="primary" class="content-area col-xl-9 col-lg-9 col-md-8 col-sm-8 col-xs-12">
				<main id="main" class="site-main" role="main">
			<?php
		}else{
			?>
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
			<?php
		}
	}
}
add_action( 'woocommerce_before_main_content', 'smartdevices_woocommerce_wrapper_before' );

if ( ! function_exists( 'smartdevices_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function smartdevices_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'smartdevices_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'smartdevices_woocommerce_header_cart' ) ) {
			smartdevices_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'smartdevices_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function smartdevices_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		smartdevices_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'smartdevices_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'smartdevices_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function smartdevices_woocommerce_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'smartdevices' ); ?>">
				<?php /* translators: number of items in the mini cart. */ ?>
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'smartdevices' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'smartdevices_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function smartdevices_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php smartdevices_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
					$instance = array(
						'title' => '',
					);

					the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}













/*************************************************
 *************************************************
 *  		PRODUCT SHOP COVER IMAGE             *
 *************************************************
 *************************************************
*/
// removing from previous places
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_product_archive_description', 10 );

// adding fuctions to our new action hook

add_action( 'woocommerce_shop_cover_header', 'woocommerce_smartdevices_shop_cover_Wrapper_open', 10 ); // header wrapper open
add_action( 'woocommerce_shop_cover_header', 'woocommerce_smartdevices_shop_cover_image', 15); // pilpil cover image - shop's featured image
add_action( 'woocommerce_shop_cover_header', 'woocommerce_breadcrumb', 20 ); // woo breadcrumbs
add_action( 'woocommerce_shop_cover_header', 'woocommerce_taxonomy_archive_description', 25 ); // description of category if there is
add_action( 'woocommerce_shop_cover_header', 'woocommerce_product_archive_description', 25 ); // description of page if there is
add_action( 'woocommerce_shop_cover_header', 'woocommerce_smartdevices_shop_cover_Wrapper_close', 40 ); // header wrapper close




// Change the breadcrumb delimeter from '/' to '>'
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = ' &nbsp;&rsaquo;&nbsp; ';
	return $defaults;
}



if ( ! function_exists( 'woocommerce_smartdevices_shop_cover_Wrapper_open' ) ) {
	/**
	 * Product listing Header.
	 *
	 * Opening the header cover wrapper tags.
	 *
	 * @return void
	 */
	function woocommerce_smartdevices_shop_cover_Wrapper_open() {
		?>
			<div class="woo-cover-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="woo cover-header row magic-b">
					<header class="woocommerce-products-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php
	}
}



if ( ! function_exists( 'woocommerce_smartdevices_shop_cover_image' ) ) {
	/**
	 * Displaying WooCommerce  shop page's featured image
	 *
	 * It also have pilpil as lazy loading
	 *
	 * @return void
	 */
	function woocommerce_smartdevices_shop_cover_image() {
		$big_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_option( 'woocommerce_shop_page_id' )), 'smartdevices-cover');
		$big_post_image = $big_post_image[0];
		
		$small_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_option( 'woocommerce_shop_page_id' )), 'smartdevices-tiny');
		$small_post_image = $small_post_image[0];
		
		
		if ( has_post_thumbnail( $post->ID ) ) { 	?>
		<div class="aspectRatioPlaceholder">
			<div class="aspectRatioPlaceholder-fill"></div>
			<div class="progressiveMedia" data-width="1280" data-height="360">
				<img class="progressiveMedia-thumbnail" src="<?php echo esc_url($small_post_image); ?>" title="Shop cover image" />
				<canvas class="progressiveMedia-canvas"></canvas>
				<img class="progressiveMedia-image" src="" data-src="<?php echo esc_url($big_post_image); ?>" title="Shop cover image"/>
			</div>
		</div>
		
		<?php 
		}
	}
}


if ( ! function_exists( 'woocommerce_smartdevices_headerWrapper_open' ) ) {
	/**
	 * Product listing Header.
	 *
	 * Opening the header cover wrapper tags.
	 *
	 * @return void
	 */
	function woocommerce_smartdevices_shop_cover_title() {
		if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif;
	}
}



if ( ! function_exists( 'woocommerce_smartdevices_shop_cover_Wrapper_close' ) ) {
	/**
	 * Product listing Header.
	 *
	 * Closing the header cover wrapper tags.
	 *
	 * @return void
	 */
	function woocommerce_smartdevices_shop_cover_Wrapper_close() {
		?>
					</header> <!-- .woocommerce-products-header  -->
				</div> <!-- .cover-header  -->
			</div> <!-- .woo-cover-header.col-xl-12  -->
		<?php
	}
}


function woocommerce_product_archive_description() {
	// Don't display the description on search results page
	if ( is_search() ) {
		return;
	}

	if ( is_post_type_archive( 'product' ) ) {
		$shop_page   = get_post( wc_get_page_id( 'shop' ) );
		if ( $shop_page ) {
			$description = wc_format_content( $shop_page->post_content );
			if ( $description ) {
				echo '<div class="page-description">' . $description . '</div>';
			}
		}
	}
}















/*************************************************
 *************************************************
 *  		PRODUCT LISTING FUNCTIONS            *
 *************************************************
 *************************************************
*/





if ( ! function_exists( 'smartdevices_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function smartdevices_woocommerce_product_columns_wrapper() {
		echo '<div class="products-list-wrapper container">'; 
	}
}
add_action( 'woocommerce_before_shop_loop', 'smartdevices_woocommerce_product_columns_wrapper', 40 );






if ( ! function_exists( 'smartdevices_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function smartdevices_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'smartdevices_woocommerce_product_columns_wrapper_close', 40 );


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );







if ( ! function_exists( 'woocommerce_template_loop_product_link_wrapper_open' ) ) {
	/**
	 * Product in loop link wrapper open.
	 *
	 * @return  void
	 */
	function woocommerce_template_loop_product_link_wrapper_open() {
		echo '<div class="product-loop-link-wrapper">'; 
	}
}
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_wrapper_open', 5 );

if ( ! function_exists( 'woocommerce_template_loop_product_link_wrapper_close' ) ) {
	/**
	 * Product in loop link wrapper close.
	 *
	 * @return  void
	 */
	function woocommerce_template_loop_product_link_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_wrapper_close', 20 );




/**
 * Changing position of default product link wrapper.
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 15 );




/**
 * Displaying product image
 *
 * It also have pilpil as lazy loading
 *
 * @return void
 */
function woocommerce_template_loop_product_thumbnail($product){

	$big_post_image = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'smartdevices-post');
	$big_post_image = $big_post_image[0];
	
	$small_post_image = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'smartdevices-tiny');
	$small_post_image = $small_post_image[0];
	
	
	if ( has_post_thumbnail( $product->ID ) ) { 	?>
	<div class="aspectRatioPlaceholder">
		<div class="aspectRatioPlaceholder-fill"></div>
		<div class="progressiveMedia" data-width="400" data-height="270">
			<img class="progressiveMedia-thumbnail" id="progressiveMedia-thumbnail" src="<?php echo esc_url($small_post_image); ?>" title="<?php the_title(); ?>" />
			<canvas class="progressiveMedia-canvas" id="progressiveMedia-canvas"></canvas>
			<img class="progressiveMedia-image" src="" data-src="<?php echo esc_url($big_post_image); ?>" title="<?php the_title(); ?>"/>
			<noscript class="js-progressiveMedia-inner">&amp;lt;img class="progressiveMedia-noscript js-progressiveMedia-inner" src="<?php echo esc_url($big_post_image); ?>"&amp;gt;</noscript>
		</div>
	</div>
	<?php 
	}
}







/**
 * custom_woocommerce_loop_product_add_to_cart_text
*/
function custom_woocommerce_loop_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
			return __( 'Buy product', 'woocommerce' );
		break;
		case 'grouped':
			return __( 'View products', 'woocommerce' );
		break;
		case 'simple':
			return __( 'Show details', 'woocommerce' );
		break;
		case 'variable':
			return __( 'Select options', 'woocommerce' );
		break;
		default:
			return __( 'Read more', 'woocommerce' );
	}
	
}
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_loop_product_add_to_cart_text' );






// Changing position of pagination shop page
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_main_content', 'woocommerce_pagination', 20 );



















/*************************************************
 *************************************************
 *  		SINGLE PRODUCT FUNCTIONS             *
 *************************************************
 *************************************************
*/
function woocommerce_breadcrumb_single(){
	if (is_product()) {
		?>
		<div class="single-product single-top-bar">
			<?php woocommerce_breadcrumb(); ?>
			
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb_single', 5 ); // woo breadcrumbs on single page

function woocommerce_share_product_single(){
	if (is_product()) {
	?>
	<div class="socialoptions">
		<span>Share: </span>
		<ul class="sharebuttons">
			<li>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;" class="socialdark facebook"><i class="ti-facebook"></i></a>
			</li>
			<li>
				<a href="http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&amp;url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;" class="socialdark twitter"><i class="ti-twitter"></i></a>
			</li>
			<li>
				<a href="mailto:?body=<?php the_permalink(); ?>" class="socialdark email"><i class="ti-email"></i></a>
			</li>
		</ul>
	</div>
	</div> <!-- .single-top-bar -->
		
	<?php
	}
}
add_action( 'woocommerce_before_main_content', 'woocommerce_share_product_single', 8 ); // woo breadcrumbs on single page






// adding next & prev on flexslider
add_filter( 'woocommerce_single_product_carousel_options', function( $options ) {
	$options['directionNav'] = true;
	return $options;
} );

// removing unncessary things from single page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );




/**
 * Display the review authors gravatar
 *
 * @param array $comment WP_Comment.
 * @return void
 */
function woocommerce_review_display_gravatar( $comment ) {
	echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '100' ), '' );
}





/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 6; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}









/*************************************************
 *************************************************
 *  		Categories LOOP functions            *
 *************************************************
 *************************************************
*/



/**
 * Show subcategory thumbnails.
 *
 * @param mixed $category Category.
 * @subpackage	Loop
 */
function woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size  	= apply_filters( 'subcategory_archive_thumbnail_size', 'smartdevices-category' );
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

	if ( $thumbnail_id ) {
		$image        = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		$image        = $image[0];
		$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
		$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;
	} else {
		$image        = wc_placeholder_img_src();
		$image_srcset = $image_sizes = false;
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds.
		// Ref: https://core.trac.wordpress.org/ticket/23605.
		$image = str_replace( ' ', '%20', $image );

		// Add responsive image markup if available.
		if ( $image_srcset && $image_sizes ) {
			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
		} else {
			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}
	}
}