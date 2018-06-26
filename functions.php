<?php
/**
 * SmartDevices functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SmartDevices
 */

if ( ! function_exists( 'smartdevices_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function smartdevices_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SmartDevices, use a find and replace
		 * to change 'smartdevices' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'smartdevices', get_template_directory() . '/languages' );


        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

		// Add support posts formats.
        add_theme_support( 'post-formats', array(
            'gallery',
            'link',
            'video',
        ) );


		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		// This is primary menu
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'smartdevices' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

        // will allow to add custom excerpt to pages
        add_post_type_support( 'page', 'excerpt' );

		// Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'smartdevices_custom_background_args', array(
         'default-color' => 'ffffff',
         'default-image' => '',
     ) ) );

		// Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );





		/**
		 * Adding custom Image sizes
		 *
		 */
		add_image_size( 'smartdevices-hd', 2000, 1200, true );
		add_image_size( 'smartdevices-cover_hard', 1480, 460, false);
		add_image_size( 'smartdevices-cover', 1480, 460, true );

		add_image_size( 'smartdevices-thumbnail', 680, 580, true );
		add_image_size( 'smartdevices-shop_single', 520, 470, true );

        add_image_size( 'smartdevices-post-large', 720, 395, true );
        add_image_size( 'smartdevices-post', 400, 270, true );
        add_image_size( 'smartdevices-post-small', 350, 350, true );

        add_image_size( 'smartdevices-category', 340, 160, true );
        add_image_size( 'smartdevices-avatar', 100, 100, true );
		//usually used for small image in pilpil
        add_image_size( 'smartdevices-tiny', 60, 60, false );
    }
endif;
add_action( 'after_setup_theme', 'smartdevices_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function smartdevices_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'smartdevices_content_width', 640 );
}
add_action( 'after_setup_theme', 'smartdevices_content_width', 0 );

/**
 * Adding support to revisions of products
 */
add_filter( 'woocommerce_register_post_type_product', 'wpse_modify_product_post_type' );
function wpse_modify_product_post_type( $args ) {
 $args['supports'][] = 'revisions';

 return $args;
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function smartdevices_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'smartdevices' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'smartdevices' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Sidebar', 'smartdevices' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'It\'ll only show up only on Woo pages.', 'smartdevices' ),
		'before_widget' => '<section id="%1$s" class="woo-sidebar widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'smartdevices_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function smartdevices_scripts() {
	wp_enqueue_style( 'smartdevices-style', get_stylesheet_uri() );

	// minified - lintered scripts
	wp_enqueue_script( 'smartdevices-allScripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
    }

    /**
     * Adding script for live reload for styling purposes.
     *
     * @todo This script should be removed when shipping out the theme
     */
    wp_register_script( 'livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true );
    wp_enqueue_script( 'livereload' );


}
add_action( 'wp_enqueue_scripts', 'smartdevices_scripts' );
function my_enqueue() {
    wp_enqueue_script( 'my_custom_script', get_template_directory_uri() . '/assets/js/codescript.js', array('jquery'), false, true );
    wp_enqueue_style( 'my_custom_stript', get_template_directory_uri() . '/assets/js/codestyle.css');
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );

function smartdevices_adminpage_styles(){
    // showing selected image ID on dashboard
    echo '
    <style>
    .media-frame-content li.attachment.save-ready.selected:before {
        content: "179";
        position: absolute;
        left: 8px;
        background-color: #3ab3f5;
        z-index: 1;
        color: #fff;
        padding: 4px;
        border-radius: 2px;
        content: attr(data-id);
    }
    </style>
    ';
}
add_action( 'admin_head', 'smartdevices_adminpage_styles' );




// letting <i> tags in content
function add_mce_markup( $initArray ) {
    $ext = 'i[id|name|class|style]';
    if ( isset( $initArray['extended_valid_elements'] ) ) {
        $initArray['extended_valid_elements'] .= ',' . $ext;
    } else {
        $initArray['extended_valid_elements'] = $ext;
    }
    return $initArray;
}
add_filter( 'tiny_mce_before_init', 'add_mce_markup' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}












/*
*
*/
function unwanted_dequeue_scripts_style() {


    // we are not selling anything yet :p
    wp_dequeue_script( 'wc-single-product');
    wp_deregister_script( 'wc-single-product');

    wp_dequeue_script( 'wc-cart-fragments');
    wp_deregister_script( 'wc-cart-fragments');
    /////
    // Product filter scripts and styles
    // Product filter scripts not showing anywhere else than shop or achieve
    //////
    if (is_blog() || is_product()) {

        //scripts
        wp_dequeue_script( 'SimpleAjaxUploader');
        wp_deregister_script( 'SimpleAjaxUploader');

        wp_dequeue_script( 'SimpleAjaxUploader-action');
        wp_deregister_script( 'SimpleAjaxUploader-action');

        wp_dequeue_script( 'woof_modernizr');
        wp_deregister_script( 'woof_modernizr');

        wp_dequeue_script( 'woof');
        wp_deregister_script( 'woof');

        wp_dequeue_script( 'icheck-jquery');
        wp_deregister_script( 'icheck-jquery');

        wp_dequeue_script( 'woof_front');
        wp_deregister_script( 'woof_front');

        wp_dequeue_script( 'woof_front');
        wp_deregister_script( 'woof_front');

        wp_dequeue_script( 'woof_radio_html_items');
        wp_deregister_script( 'woof_radio_html_items');

        wp_dequeue_script( 'woof_checkbox_html_items');
        wp_deregister_script( 'woof_checkbox_html_items');

        wp_dequeue_script( 'woof_select_html_items');
        wp_deregister_script( 'woof_select_html_items');

        wp_dequeue_script( 'woof_mselect_html_items');
        wp_deregister_script( 'woof_mselect_html_items');

        wp_dequeue_script( 'chosen-drop-down');
        wp_deregister_script( 'chosen-drop-down');

        wp_dequeue_script( 'plainoverlay');
        wp_deregister_script( 'plainoverlay');

        wp_dequeue_script( 'mousewheel');
        wp_deregister_script( 'mousewheel');

        wp_dequeue_script( 'malihu-custom-scrollbar');
        wp_deregister_script( 'malihu-custom-scrollbar');

        wp_dequeue_script( 'malihu-custom-scrollbar-concat');
        wp_deregister_script( 'malihu-custom-scrollbar-concat');

        wp_dequeue_script( 'jquery-ui-core');
        wp_deregister_script( 'jquery-ui-core');

        wp_dequeue_script( 'jquery-ui-slider');
        wp_deregister_script( 'jquery-ui-slider');

        wp_dequeue_script( 'wc-jquery-ui-touchpunch');
        wp_deregister_script( 'wc-jquery-ui-touchpunch');

        wp_dequeue_script( 'wc-price-slider');
        wp_deregister_script( 'wc-price-slider');

        wp_dequeue_script( 'woof_sid');
        wp_deregister_script( 'woof_sid');

        // styles
        wp_dequeue_style( 'open_sans_font');
        wp_deregister_style( 'open_sans_font');

        wp_dequeue_style( 'woof');
        wp_deregister_style( 'woof');

        wp_dequeue_style( 'woof_fontello');
        wp_deregister_style( 'woof_fontello');

        wp_dequeue_style( 'thickbox');
        wp_deregister_style( 'thickbox');

        wp_dequeue_style( 'wp-color-picker');
        wp_deregister_style( 'wp-color-picker');

        wp_dequeue_style( 'chosen-drop-down');
        wp_deregister_style( 'chosen-drop-down');

        wp_dequeue_style( 'plainoverlay');
        wp_deregister_style( 'plainoverlay');

        wp_dequeue_style( 'malihu-custom-scrollbar');
        wp_deregister_style( 'malihu-custom-scrollbar');

        wp_dequeue_style( 'icheck-jquery-color');
        wp_deregister_style( 'icheck-jquery-color');
    }
}
add_action( 'wp_enqueue_scripts', 'unwanted_dequeue_scripts_style', 9999 );
add_action( 'wp_head', 'unwanted_dequeue_scripts_style', 9999 );
