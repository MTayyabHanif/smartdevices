<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SmartDevices
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>




<?php
if ( is_active_sidebar( 'sidebar-1' ) && !is_woocommerce()  && !is_front_page() && !is_home()) {
?>

<aside id="secondary" class="widget-area col-xl-3 col-lg-3 col-md-4 col-sm-4 col-xs-12 last-xs">
	<div class="sidebar-wrapper">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->

<?php
}
?>




<?php
if ( is_active_sidebar( 'sidebar-2' ) && is_woocommerce() && !is_product() && !is_front_page() && !is_home() ) {
?>

<aside id="secondary" class="woo-sidebar widget-area col-xl-3 col-lg-3 col-md-4 col-sm-4 col-xs-12 last-xs">
	<div class="sidebar-wrapper">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div>
</aside><!-- #secodary .woo sidebar -->

<?php
}
?>
