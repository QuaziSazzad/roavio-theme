<?php

/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;
use RoavioTheme\Classes\Roavio_Post_Helper;

$show_post_share = Helper::get_option('blog_details_share', 'no');
$show_tag        = Helper::get_option('blog_details_tag', 'yes');
$show_nav        = Helper::get_option('blog_details_nav', 'yes');
$author_info     = Helper::get_option('blog_author_info', 'yes');
$show_category   = Helper::get_option('blog_details_category', 'yes');
$show_meta     = Helper::get_option('single_meta_items', 'yes');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post-details clearfix'); ?>>
	<div class="news-details-post blog-details-content">
		<?php
		if ('product' !== get_post_type() && 'yes' === $show_meta) {
			Roavio_Post_Helper::render_post_meta();
		}
		?>
		<div class="news-details-content">
			<?php if (has_post_thumbnail()) : ?>
				<div class="details-thumb">
					<?php Roavio_Post_Helper::render_media(); ?>
				</div>
			<?php endif; ?>
			<div class="entry-content clearfix">
				<?php
				the_content();

				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'roavio'),
					'after'  => '</div>',
				));
				?>
			</div>
			<?php if (('yes' === $show_tag && has_tag()) || ('yes' === $show_post_share && function_exists('roavio_post_share_links'))) : ?>
				<div class="row tag-share-wrap">
					<?php if ('yes' === $show_tag && has_tag()) : ?>
						<div class="col-xl-6 col-lg-6">
							<div class="tagcloud">
								<span><?php esc_html_e('Tags:', 'roavio'); ?></span>
								<?php the_tags('', ''); ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if (has_category() && 'yes' === $show_category) {
						$post_categories = get_the_category();
						if ($post_categories && !is_wp_error($post_categories)) :
					?>
							<div class="col-xl-6 col-lg-6">
								<div class="tagcloud category">
									<span><?php esc_html_e('Posted in:', 'roavio'); ?></span>
									<?php foreach ($post_categories as $cat) : ?>
										<a href="<?php echo esc_url(get_tag_link($cat->term_id)); ?>" rel="tag"><?php echo esc_html($cat->name); ?></a>
									<?php endforeach; ?>
								</div>
							</div>
					<?php
						endif;
					} ?>
					<?php if (function_exists('roavio_post_share_links')) : ?>
						<div class="col-xl-6 col-lg-6">
							<div class="social-share">
								<span><?php echo esc_html__('Share:', 'roavio'); ?></span>
								<?php roavio_post_share_links(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>


			<?php
			if ('yes' === $author_info) {
				Roavio_Post_Helper::post_author_info();
			}

			if ('yes' === $show_nav) {
				Roavio_Post_Helper::post_navigation();
			}
			?>
		</div>
	</div>
</article>