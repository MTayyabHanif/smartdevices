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
	<div class="mobile-menu-backdrop"></div>
	<nav id="secondary-navigation" class="mobile-navigation">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'mobile-menu',
				) );
				?>
	</nav><!-- #mobile-navigation -->
	<header id="masthead" class="site-header">
		<div class="header-wrapper">
			<a class="toggle-menu display-xs-inlineBlock" aria-controls="mobile-menu" aria-expanded="false"><span class="ti-menu"></span></a>
			<div class="site-branding">
				<?php
				the_custom_logo(); ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
				endif; ?>
			</div><!-- .site-branding -->
			
			<nav id="site-navigation" class="main-navigation display-xs-none">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
			</nav><!-- #site-navigation -->
			
			<div class="search-bar" id="header-search">
				<span><i class="ti-search"></i></span>
			</div>
			<!-- .search-bar -->
		</div><!-- .header-wrapper -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
