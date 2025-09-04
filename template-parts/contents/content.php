<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;
use RoavioTheme\Classes\Roavio_Post_Helper;

$show_category = Helper::get_option('archive_post_category', 'yes');
$show_meta     = Helper::get_option('archive_post_meta', 'yes');
$show_excerpt  = Helper::get_option('archive_post_excerpt', 'yes');
$excerpt_count = Helper::get_option('archive_excerpt_count', 30);
$show_button   = Helper::get_option('archive_post_button', 'yes');
$button_text   = Helper::get_option('post_button_text', __('Read More', 'roavio'));

$post_class = ['entry-post', 'clearfix'];

if (! has_post_thumbnail()) {
	$post_class[] = 'no-thumbnail';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<div class="blog-standard-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
		<?php if (has_post_thumbnail()) : ?>
			<div class="image">
				<?php Roavio_Post_Helper::render_media(); ?>
			</div>
		<?php endif; ?>
		<div class="content">
			<?php
			if ('product' !== get_post_type() && 'yes' === $show_meta) {
				Roavio_Post_Helper::render_post_meta();
			}
			?>
			<?php the_title('<h3 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
			<?php

			if ('yes' === $show_excerpt) {
				if (has_excerpt()) {
					echo wpautop(wp_trim_words(get_the_excerpt(), $excerpt_count, '...'));
				} else {
					echo wpautop(wp_trim_words(get_the_content(), $excerpt_count, '...'));
				}
			}
			?><?php if ('yes' === $show_button && ! empty($button_text)) {
					if ('product' === get_post_type()) { ?>
			<a href="<?php the_permalink(); ?>" class="blog-read-more" data-hover="<?php esc_attr_e('View Product', 'roavio'); ?>">
				<span><?php esc_html_e('View Product', 'roavio'); ?></span>
			</a>
		<?php } else { ?>
			<a href="<?php the_permalink(); ?>" class="blog-read-more" data-hover="<?php echo esc_attr($button_text); ?>">
				<span><?php echo esc_html($button_text); ?></span>
			</a>
	<?php }
				} ?>
		</div>
	</div>
</article>