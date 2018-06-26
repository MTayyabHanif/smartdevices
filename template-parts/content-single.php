<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SmartDevices
 */

?>
<div class="single-article-wrapper">
<article id="post-<?php the_ID(); ?>" <?php post_class('from-single'); ?>>


    <div class="post_image">

        <?php
        $big_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'smartdevices-cover');
        $big_post_image_src = $big_post_image[0];
        $big_post_image_width = $big_post_image[1];
        $big_post_image_height = $big_post_image[2];

        $small_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'smartdevices-tiny');
        $small_post_image = $small_post_image[0];
        $image_ID = get_post_thumbnail_id(get_the_ID());


        if ( has_post_thumbnail( get_the_ID() ) || has_post_thumbnail( $cat->term_id ) ) {  ?>
            <div class="aspectRatioPlaceholder <?php echo $image_ID; ?>"><div class="aspectRatioPlaceholder-fill"></div><div class="progressiveMedia" data-width="<?php echo $big_post_image_width; ?>" data-height="<?php echo $big_post_image_height; ?>">    <img class="progressiveMedia-thumbnail" src="<?php echo esc_url($small_post_image); ?>" title="<?php the_title();  ?>" alt="<?php the_title();  ?>" />  <canvas class="progressiveMedia-canvas"></canvas>   <img class="progressiveMedia-image" src="" data-src="<?php echo esc_url($big_post_image_src); ?>" title="<?php the_title();  ?>"  alt="<?php the_title();  ?>"/></div></div>

            <?php
        }
        ?>

    </div>


    <header class="entry-header">
        <div class="header-wrapper">
            <div class="title-wrapper">
                <?php smartdevices_blog_post_title(false); ?>
            </div>

            <div class="header-content">
                <?php custom_post_excerpt(20); ?>
            </div><!-- .header-content -->

            <div class="post-footer">
                <div class="author-date-meta">
                    <?php smartdevices_blog_posted_by_and_on(); ?>
                </div><!-- .author-meta -->

            </div><!-- .post-footer -->
        </div><!-- .header-wrapper -->



    </header><!-- .entry-header -->

    <div class="postcontents">

        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'smartdevices' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="post-entry-footer">
        <?php smartdevices_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
</div>
