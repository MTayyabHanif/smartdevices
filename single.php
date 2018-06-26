<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SmartDevices
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php

		while ( have_posts() ) : the_post();


			get_template_part( 'template-parts/content', 'single' );


				$previous = get_previous_post();
				$next = get_next_post();

				if ( get_next_post() || get_previous_post() ) { ?>
					<div class="pagination-wrapper">
					<nav class="pagination pager flat">
						<ul class="p-0">

							<?php if ( get_previous_post() ) { ?>

								<li class="prev">
									<span class="label tag">Prev post</span>
									<?php previous_post_link('%link'); ?>
								</li>

							<?php } if ( get_next_post() ) { ?>

								<li class="next">
									<span class="label tag">Next post</span>
									<?php next_post_link('%link'); ?>
								</li>

							<?php } ?>

						</ul>
					</nav>
					</div>
				<?php }


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
