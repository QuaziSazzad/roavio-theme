<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;

get_header();
?>
<!-- Blog Details Area start -->
<section class="blog-details-page section-padding pt-0">
	<div class="container">
		<div class="row">
			<div class="<?php Helper::col_size(); ?>">
				<?php
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/contents/content', 'single');

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<!-- Blog Details Area end -->
<?php
get_footer();
