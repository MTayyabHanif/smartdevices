<?php
/**
 * Custom BLOG template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package SmartDevices
 */


// making blog cover
add_action( 'woocommerce_blog_cover_header', 'smartdevices_blog_cover_Wrapper_open', 10 ); // header wrapper open
add_action( 'woocommerce_blog_cover_header', 'smartdevices_blog_cover_image', 15); // pilpil cover image - shop's featured image
add_action( 'woocommerce_blog_cover_header', 'woocommerce_breadcrumb', 20 ); // woo breadcrumbs
add_action( 'woocommerce_blog_cover_header', 'blog_archive_description', 25 ); // description of page if there is
add_action( 'woocommerce_blog_cover_header', 'smartdevices_blog_cover_Wrapper_close', 40 ); // header wrapper close





/**
 * Product listing Header.
 *
 * Opening the header cover wrapper tags.
 *
 * @return void
 */
function smartdevices_blog_cover_Wrapper_open() {
	$cat_id = get_query_var('cat');
	if ( is_home() || $cat_id) {
		$cover_blog_styles = 'data-styles-from-php="true" style="max-width: 1480px; margin: 0 auto;" ';
	}
	?>
	<div class="woo-cover-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" <?php echo $cover_blog_styles; ?>>
		<div class="woo cover-header row magic-b">
			<header class="woocommerce-products-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php
			}




/**
 * Displaying WooCommerce  shop page's featured image
 *
 * It also have pilpil as lazy loading
 *
 * @return void
 */
function smartdevices_blog_cover_image() {

	$big_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_option( 'page_for_posts' )), 'smartdevices-cover');
	$big_post_image = $big_post_image[0];

	$small_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_option( 'page_for_posts' )), 'smartdevices-tiny');
	$small_post_image = $small_post_image[0];
	$image_ID = get_post_thumbnail_id(get_option( 'page_for_posts' ));


	if ( has_post_thumbnail( get_option( 'page_for_posts' ) ) || has_post_thumbnail( $cat->term_id ) ) { 	?>
		<div class="aspectRatioPlaceholder <?php echo $image_ID; ?>"><div class="aspectRatioPlaceholder-fill"></div><div class="progressiveMedia" data-width="1280" data-height="360">	<img class="progressiveMedia-thumbnail" src="<?php echo esc_url($small_post_image); ?>" title="Shop cover image" />	<canvas class="progressiveMedia-canvas"></canvas>	<img class="progressiveMedia-image" src="" data-src="<?php echo esc_url($big_post_image); ?>" title="Shop cover image"/></div>
	</div>

	<?php
}
}









/**
* Show an page description of SHOP page
*
*/
function blog_archive_description() {
	// title on cover image when we search

	$cat_id = get_query_var('cat');
	?>

	<?php if ($cat_id): ?>

		<div class="page-description">
			<h1 class="page-title"><?php
			the_archive_title();
			?></h1>
			<p><?php the_archive_description(); ?></p>
		</div>

		<?php else: ?>

			<div class="page-description">
				<h1 class="page-title"><?php
				echo get_the_title( get_option('page_for_posts', true) );
				?></h1>
				<p>News, articles, thought & much more!</p>
			</div>

		<?php endif;
	}









/**
 * Product listing Header.
 *
 * Closing the header cover wrapper tags.
 *
 * @return void
 */
function smartdevices_blog_cover_Wrapper_close() {
	?>
</header> <!-- .woocommerce-products-header  -->
</div> <!-- .cover-header  -->
</div> <!-- .woo-cover-header.col-xl-12  -->
<?php
}


















/**
 * Prints HTML with meta information for the current post-date
 */
function smartdevices_blog_posted_on($return = false) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published with-upd" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( '%s', 'post date', 'smartdevices' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);


	if ($return) {
		return '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	} else {
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}

}





/**
 * Prints HTML with meta information for the current category author.
 */
function smartdevices_blog_posted_by() {

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'smartdevices' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}






/**
 * Prints HTML with meta information for the current category author and date.
 */
function smartdevices_blog_posted_by_and_on() {

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'smartdevices' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);



	echo '<img src=" ' .  esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ) . '" /> <span class="byline"> ' . $byline . '</span><br>' . smartdevices_blog_posted_on(true); // WPCS: XSS OK.
}







/**
 * Prints HTML with custom excerpt length
 */
function custom_post_excerpt($num) {
	$limit = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt)."...";
	echo $excerpt;
}


/**
 * Prints HTML with meta information for the current author.
 */
function smartdevices_blog_posted_in() {

	$categories = get_the_category();
	$category_name = $categories[0]->name;
	$posted_in = sprintf(
		/* translators: %s: post category. */
		esc_html_x( '%s', 'post category', 'smartdevices' ),
		'<a class="uppercase" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . $category_name . '</a>'
	);
	echo '<span class="posted-in">' . $posted_in . '</span>'; // WPCS: XSS OK.
}






/**
 * Prints HTML title of blog post
 */
function smartdevices_blog_post_title($with_link = true) {
	if ($with_link) {
		return the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	} else {
		return the_title( '<h2 class="entry-title">', '</h2>' );
	}
}









/**
 * Prints HTML with meta information comments count.
 */
function post_comment_count_w_icon() {
	$comments_count = get_comments_number_text( '0', '1', '%' );
	echo '<span class="comments-count"><span class="ti-comments"></span> ' . $comments_count . '</span>'; // WPCS: XSS OK.
}












if ( ! function_exists( 'smartdevices_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function smartdevices_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			echo '<div class="post-cat-tag">';
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ' ', 'smartdevices' ) );
				if ( $categories_list ) {
					echo '<div class="post-cats">';
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . esc_html__( '%1$s', 'smartdevices' ) . '</span>', $categories_list ); // WPCS: XSS OK.
					echo '</div>';
				}

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'smartdevices' ) );
				if ( $tags_list ) {
					echo '<div class="post-tags">';
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . esc_html__( '%1$s', 'smartdevices' ) . '</span>', $tags_list ); // WPCS: XSS OK.
					echo '</div>';
				}
			echo '</div>';
			echo devices_social_sharing_buttons();

		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'smartdevices' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'smartdevices' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;











/*
* SOCIAL SHARING FOR POSTS
*/

function devices_social_sharing_buttons() {
    // Get current page URL
	$devicesURL = get_permalink();

    // Get current page title
	$devicesTitle = str_replace( ' ', '%20', get_the_title());

    // Get Post Thumbnail for pinterest
	$devicesThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

    // Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$devicesTitle.'&amp;url='.$devicesURL.'&amp;';
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$devicesURL;
	$googleURL = 'https://plus.google.com/share?url='.$devicesURL;
	$bufferURL = 'https://bufferapp.com/add?url='.$devicesURL.'&amp;text='.$devicesTitle;

    // Based on popular demand added Pinterest too
	$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$devicesURL.'&amp;media='.$devicesThumbnail[0].'&amp;description='.$devicesTitle;

    // Add sharing button at the end of page/page content
	$variable .= '<!-- devices.com.pk social sharing-->';
	$variable .= '<div class="devices-social"><span class="share-text">Share on:</span>';
	$variable .= '<a class="devices-link devices-twitter" href="'. $twitterURL .'" target="_blank"> <span class="screen-reader-text">Share on Twitter</span> <span class="ti-twitter"></span></a>';
	$variable .= '<a class="devices-link devices-facebook" href="'.$facebookURL.'" target="_blank"> <span class="screen-reader-text">Share on Facebook</span> <span class="ti-facebook"></span></a>';
	$variable .= '<a class="devices-link devices-googleplus" href="'.$googleURL.'" target="_blank"> <span class="screen-reader-text">Share on Google plus</span> <span class="ti-google"></span></a>';
	$variable .= '<a class="devices-link devices-pinterest" href="'.$pinterestURL.'" target="_blank"> <span class="screen-reader-text">Share on Pinterest</span> <span class="ti-pinterest"></span></a>';
	$variable .= '</div>';

	return $variable;
}





// cookies consent checkbox in comemnts
function comment_form_change_cookies_consent( $fields ) {
	$commenter = wp_get_current_commenter();
	$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
	$fields['cookies'] = '<p class="comment-form-cookies-consent"> <label class="checkbox"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
					 '<span class="checkbox__label">Save my name, email, and website in this browser for the next time I comment.</span></label></p>';
	return $fields;
}
add_filter( 'comment_form_default_fields', 'comment_form_change_cookies_consent' );
