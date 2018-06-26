<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SmartDevices
 */
?>


<?php
$post_classes = 'article_wrap p_count_' . $GLOBALS['post_count'];

if ($GLOBALS['post_count'] == 1){

	$post_classes .= ' col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ';

}elseif($GLOBALS['post_count'] == 2 || $GLOBALS['post_count'] == 3 || $GLOBALS['post_count'] == 4 || $GLOBALS['post_count'] == 5 ){
	$post_classes .=' col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 ';
	$image_size = "smartdevices-post";
}else{

	$image_size = "smartdevices-post-small";
	$post_classes .=' col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 allOthers';

}
?>


<div class="<?php echo $post_classes; ?>">
	<article data-count="<?php echo $GLOBALS['post_count']; ?>" id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>

		<div class="post_image">

			<?php
			$big_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_size);
			$big_post_image_src = $big_post_image[0];
			$big_post_image_width = $big_post_image[1];
			$big_post_image_height = $big_post_image[2];

			$small_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'smartdevices-tiny');
			$small_post_image = $small_post_image[0];
			$image_ID = get_post_thumbnail_id(get_the_ID());


			if ( has_post_thumbnail( get_the_ID() ) || has_post_thumbnail( $cat->term_id ) ) { 	?>
				<div class="aspectRatioPlaceholder <?php echo $image_ID; ?>"><div class="aspectRatioPlaceholder-fill"></div><div class="progressiveMedia" data-width="<?php echo $big_post_image_width; ?>" data-height="<?php echo $big_post_image_height; ?>">	<img class="progressiveMedia-thumbnail" src="<?php echo esc_url($small_post_image); ?>" title="<?php the_title();  ?>" alt="<?php the_title();  ?>" />	<canvas class="progressiveMedia-canvas"></canvas>	<img class="progressiveMedia-image" src="" data-src="<?php echo esc_url($big_post_image_src); ?>" title="<?php the_title();  ?>"  alt="<?php the_title();  ?>"/></div></div>

				<?php
			}
			?>

		</div>
		<div class="post-wrapper">




			<?php //FOR FIRST POST  ?>
			<?php if ($GLOBALS['post_count'] == 1): ?>

				<div class="title-wrapper">
					<?php smartdevices_blog_post_title(); ?>
				</div>

				<div class="content-wrap">
					<div class="entry-content">
						<?php custom_post_excerpt(14); ?>
					</div><!-- .entry-content -->
				</div><!-- .content-wrap -->

				<div class="post-footer">
					<div class="author-date-meta">
						<?php smartdevices_blog_posted_by_and_on(); ?>
					</div><!-- .author-meta -->

					<div class="comment-meta">
						<?php post_comment_count_w_icon(); ?>
					</div><!-- .comment-meta -->
				</div><!-- .post-footer -->



				<?php //FOR 2-3-4 POST  ?>
				<?php elseif($GLOBALS['post_count'] == 2 || $GLOBALS['post_count'] == 3 || $GLOBALS['post_count'] == 4 || $GLOBALS['post_count'] == 5 ): ?>


					<div class="title-wrapper">
						<?php smartdevices_blog_post_title(); ?>
					</div>


					<div class="post-footer">
						<div class="author-date-meta">
							<?php smartdevices_blog_posted_by_and_on(); ?>
						</div><!-- .author-meta -->

						<div class="comment-meta">
							<?php post_comment_count_w_icon(); ?>
						</div><!-- .comment-meta -->
					</div><!-- .post-footer -->


					<?php else: ?>


						<div class="title-wrapper">
							<?php smartdevices_blog_post_title(); ?>
						</div>


						<div class="content-wrap">
							<div class="entry-content">
								<?php custom_post_excerpt(12); ?>
							</div><!-- .entry-content -->
						</div><!-- .content-wrap -->


						<div class="post-footer">
							<div class="author-date-meta">
								<?php smartdevices_blog_posted_by_and_on(); ?>
							</div><!-- .author-meta -->

							<div class="comment-meta">
								<?php post_comment_count_w_icon(); ?>
							</div><!-- .comment-meta -->
						</div><!-- .post-footer -->



					<?php endif ?>



				</div>


			</article>
		</div><!-- #post-<?php the_ID(); ?> -->

