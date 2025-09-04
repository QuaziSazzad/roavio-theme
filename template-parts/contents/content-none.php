<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Roavio
 */
?>

<div class="not-found-wrapper">
	<h3 class="not-found-title"><?php esc_html_e('Nothing Found', 'roavio'); ?></h3>

	<?php if (is_home() && current_user_can('publish_posts')) : ?>
		<p>
			<?php esc_html_e('Ready to publish your first post?.', 'roavio'); ?>
			<a href="<?php echo esc_url(admin_url('post-new.php')) ?>">
				<?php esc_html_e('Get started here', 'roavio'); ?>
			</a>
		</p>
	<?php elseif (is_search()) : ?>
		<p>
			<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'roavio'); ?>
		</p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p>
			<?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'roavio'); ?>
		</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>