<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SmartDevices
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'smartdevices' ); ?></a>
	<div class="searchbar-backdrop"></div>
	<header id="masthead" class="site-header">
		<div class="header-wrapper">
			<div class="site-branding">
                    <?php
                    if (has_custom_logo()) {

                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img src="<?php echo $image[0]; ?>" alt="<?php bloginfo( 'name' ); ?>">
                            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                        </a>
                    <?php
                    }else{
                    ?>

                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    </a>

                    <?php
                    }
                    ?>
			</div><!-- .site-branding -->
			
			<nav id="site-navigation" class="main-navigation">
            <a class="toggle-menu display-xs-inlineBlock" aria-controls="mobile-menu" aria-expanded="false"><span class="ti-menu"></span></a>
                <div class="menu-wrapper">
                    <?php get_product_search_form(); ?>
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                        ) );
                    ?>
                </div>
			</nav><!-- #site-navigation -->
			
			<div class="desktop search-bar display-xs-none" id="header-search">
				<span><i class="ti-search"></i></span>
			</div><!-- .search-bar -->
			
			<div class="mobile search-bar display-xs-block" id="header-search">
				<span><i class="ti-search"></i></span>
			</div><!-- .search-bar -->
		</div><!-- .header-wrapper -->
	</header><!-- #masthead -->
	<div class="mobile-search" id="mobile-search">
        <?php get_product_search_form(); ?>
	</div><!-- .mobile-search -->
                            
<?php
	if ( !is_product()) {
		if ( is_active_sidebar( 'sidebar-2'  )  && !is_home() && !is_front_page() && is_woocommerce()) {
			?>

			<div id="content" class="site-content row active-sidebar">
				
		<?php
		}elseif ( is_active_sidebar( 'sidebar-1'  )) { ?>

			<div id="content" class="site-content row active-wp-sidebar">
		
		<?php
		}else{
			?>

			<div id="content" class="site-content">

			<?php
		}
	}
?>
