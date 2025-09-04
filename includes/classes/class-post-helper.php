<?php

namespace RoavioTheme\Classes;

defined('ABSPATH') || exit;

/**
 * Post Helper Function
 */
class Roavio_Post_Helper
{

	/**
	 * Get Post Media
	 */
	public static function render_media()
	{
		if (! has_post_thumbnail()) {
			return;
		}

		if ('no-sidebar' === Roavio_Helper::content_sidebar()) {
			$size = 'roavio_1290x620';
		} else {
			$size = 'roavio_850x470';
		}

		the_post_thumbnail($size, ['alt' => wp_kses_post(get_the_title())]);
	}

	/**
	 * Get Meta Markup
	 */
	public static function meta_item_markup($meta)
	{
		$author_id = get_post_field('post_author', get_the_ID());

		if ('author' === $meta) : ?>
			<li><i class="far fa-user"></i>
				<a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
					<?php echo esc_html(get_the_author_meta('display_name', $author_id)) ?>
				</a>
			</li>
		<?php elseif ('date' === $meta) : ?>
			<li><i class="far fa-calendar-alt"></i>
				<a href="<?php echo esc_url(get_the_permalink(get_the_ID())) ?>">
					<?php echo esc_html(get_the_date()) ?>
				</a>
			</li>
		<?php elseif ('comments' === $meta && ! post_password_required() && comments_open()) : ?>
			<li><i class="far fa-comments"></i>
				<a href="<?php echo esc_url(esc_url(get_comments_link())) ?>" class="comments">
					<span class="comment-text"><?php echo esc_html__('Comments ', 'roavio') ?></span>
					<?php echo '(' . esc_html(get_comments_number()) . ')' ?>
				</a>
			</li>
		<?php endif;
	}

	/**
	 * Get Post Meta
	 */
	public static function render_post_meta()
	{
		$default_item = [
			'enabled' => [
				'author'   => esc_html__('Author', 'roavio'),
				'date'     => esc_html__('Date', 'roavio'),
				'comments' => esc_html__('Date', 'roavio'),
			]
		];
		if (is_single()) {
			$meta_items = Roavio_Helper::get_option('single_meta_items', $default_item);
		} else {
			$meta_items = Roavio_Helper::get_option('archive_meta_items', $default_item);
		}
		$enable_meta = $meta_items['enabled'] ? $meta_items['enabled'] : [];
		?>
		<ul class="blog-meta-two">
			<?php foreach ($enable_meta as $key => $item) {
				self::meta_item_markup($key);
			} ?>
		</ul>
	<?php
	}

	/**
	 * Post Navigation
	 */
	public static function post_navigation()
	{
		if ('post' !== get_post_type()) {
			return;
		}

		$prev = get_previous_post();
		$next = get_next_post();

		if (empty($prev) && empty($next)) {
			return;
		}
	?>
		<div class="next-prev-blog">
			<?php foreach ([$prev, $next] as $post) :
				if (! empty($post)) : ?>
					<div class="item" data-aos="<?php echo esc_attr($post === $prev ? 'fade-left' : 'fade-right'); ?>" data-aos-duration="1500" data-aos-offset="50">
						<?php if (has_post_thumbnail($post->ID)) : ?>
							<div class="image">
								<?php echo get_the_post_thumbnail($post->ID, 'roavio_100x80'); ?>
							</div>
						<?php endif; ?>
						<div class="content">
							<h5><a href="<?php echo esc_url(get_permalink($post->ID)) ?>"><?php echo wp_kses_post(wp_trim_words(get_the_title($post->ID), '6', '...')); ?></a></h5>
						</div>
					</div>
			<?php endif;
			endforeach; ?>
		</div>
	<?php
	}

	/**
	 * Post Author Info
	 */
	public static function post_author_info()
	{
		global $post;
		$user_id = get_the_author_meta('ID');

		// Get author's display name - NB! changed display_name to first_name. Error in code.
		$display_name = get_the_author_meta('display_name', $post->post_author);

		// If display name is not available then use nickname as display name
		if (empty($display_name)) {
			$display_name = get_the_author_meta('nickname', $post->post_author);
		}

		$user_description = get_the_author_meta('user_description', $post->post_author);
		$user_posts       = get_author_posts_url($user_id);
		$user_avatar      = get_avatar($user_id, 130);
	?>
		<div class="admin-comment mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
			<div class="comment-body">
				<div class="author-thumb">
					<?php echo wp_kses_post($user_avatar); ?>
				</div>
				<div class="content">
					<h5><?php echo esc_html($display_name); ?></h5>
					<p><?php echo wpautop($user_description); ?></p>
				</div>
			</div>
		</div>
	<?php
	}

	/**
	 * Pagination
	 */
	public static function pagination($query = false)
	{
		if ($query != false) {
			$wp_query = $query;
		} else {
			global $paged, $wp_query;
		}

		if (empty($paged)) {
			$query_vars = $wp_query->query_vars;
			$paged      = $query_vars['paged'] ?? 1;
		}

		$max_page = $wp_query->max_num_pages;

		// Exit if pagination not need
		if (! ($max_page > 1)) {
			return;
		}

		//return $output;
		$big = 999999999;

		$page_items = paginate_links([
			'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'type'      => 'array',
			'current'   => max(1, $paged),
			'end_size'  => 1,
			'mid_size'  => 1,
			'total'     => $max_page,
			'prev_text' => '<i class="far fa-chevron-left"></i>',
			'next_text' => '<i class="far fa-chevron-right"></i>',
		]);
	?>
		<ul class="roavio-pagination pagination ">
			<?php foreach ($page_items as $key => $value) : ?>
				<li class="page page-item"><?php echo wp_kses_post($value) ?></li>
			<?php endforeach; ?>
		</ul>
<?php
	}
}
