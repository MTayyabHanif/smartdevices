<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>








<?php  foreach ( $catalog_orderby_options as $id => $name ) : ?>
	<input type="hidden" value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); $selected_response[] = selected( $orderby, $id );?>/>
<?php endforeach; ?>




<?php
/**
 * Show three ordering options "Popular", "Low Price", "High Price"
 * These are in anchor tabs which will display like tabs in interface
 *
 */

$i = 0; // for array's index pupose

// whichever one come with specified number, it would have class of "selected", see loop below
$popularSelected; // value is 1, as woocommerce sorting order
$lowPriceSelected;// value is 4, as woocommerce sorting order
$highPriceSelected;// value is 5, as woocommerce sorting order

foreach ($selected_response as $value)
{
	$i++;
	// strpos can return 0 as a first matched position, 0 == false but !== false
	if ($value !== "") {
		if (strpos(" selected='selected'", $value) !== false)
		{

			if ($i == 1) { // checking if order by popularity is selected
				$popularSelected = "active";
			}
			if ($i == 5) { // checking if order by price-low-to-high is selected
				$lowPriceSelected = "active";
			}
			if ($i == 6) { // checking if order by price-high-to-low is selected
				$highPriceSelected = "active";
			}
			break;
		}
	}
}
$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
?>

<div class="woocommerce-tab-ordering tabs magic-b">
	<a class="display-xs-none button tab-name <?php echo $popularSelected; ?>" href="<?php  echo $shop_page_url; ?>?orderby=popularity"><?php echo __('Popular Items'); ?></a>
	<a class="display-xs-none button tab-name <?php echo $lowPriceSelected; ?>" href="<?php echo $shop_page_url; ?>?orderby=price"><?php echo __('Low Price'); ?></a>
	<a class="display-xs-none button tab-name <?php echo $highPriceSelected; ?>" href="<?php echo $shop_page_url; ?>?orderby=price-desc"><?php echo __('High Price'); ?></a>

	<form class="woocommerce-order display-none display-xs-inlineBlock" method="get">
		<select name="orderby" class="orderby">
			<?php $selected_response = array(); ?>
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); $selected_response[] = selected( $orderby, $id );?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php wc_query_string_form_fields( null, array( 'orderby', 'submit' ) ); ?>
	</form>
	<div class="woocommerce-filter display-none display-xs-inlineBlock"><span class="button">Show filters <span class="ti-filter"></span></span></div>

</div>
