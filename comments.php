<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Comment_Walker;

if (post_password_required()) {
	return;
}
?>
<div class="news-details-post">
	<div class="news-details-content">
		<div id="comments" class="comment-area ">
			<?php if (have_comments()): ?>
				<h3 class="comments-title">
					<?php
					comments_number(
						esc_html__('Comments (0)', 'roavio'),
						esc_html__('Comments (1)', 'roavio'),
						esc_html__('Comments (%)', 'roavio')
					);
					?>
				</h3>

				<ul class="comment-list mb-55 my-55">
					<?php
					wp_list_comments([
						'walker'      => new Roavio_Comment_Walker(),
						'avatar_size' => 100,
						'short_ping'  => true,
					]);
					?>
				</ul>

				<?php
				the_comments_navigation();

				if (! comments_open()) : ?>
					<p class="no-comments"><?php esc_html_e('Comments are closed.', 'roavio'); ?></p>
			<?php endif;

			endif;

			$roavio_commenter = wp_get_current_commenter();
			$roavio_comment_fields = array(
				'author' => ' <div class="col-md-6"><div class="form-clt"><input type="text" id="name" name="author" class="form-control" placeholder="' . esc_attr__('Your Name', 'roavio') . '" value="' . esc_attr($roavio_commenter['comment_author']) . '" required></div></div>',
				'email' => ' <div class="col-md-6"><div class="form-clt"><input type="text" id="email" name="email" class="form-control" placeholder="' . esc_attr__('Your Email', 'roavio') . '" value="' . esc_attr($roavio_commenter['comment_author_email']) . '" required ></div></div>',
			);
			$roavio_comments_args = array(
				'fields' => apply_filters('comment_form_default_fields', $roavio_comment_fields),
				'class_form' => 'row g-4 comment-form comment-form-wrap',
				'title_reply_before' => '<h3 class="comment-title mb-25">',
				'title_reply' => esc_html__('Leave a Comment', 'roavio'),
				'title_reply_after' => '</h3>',
				'comment_notes_before' => '',
				'comment_field' => ' <div class="col-md-12"><div class="form-group"><textarea name="comment" id="comment" class="form-control" rows="4" placeholder="' . esc_attr__('Write Comment', 'roavio') . '" required></textarea></div></div>',
				'comment_notes_after' => '',
				'submit_button' => '<button type="submit" class="theme-btn hover-primary" data-hover="' . esc_attr__(' Submit Comment', 'roavio') . '"><span>' . esc_html__(' Submit Comment', 'roavio') . '</span></button>',
			);
			comment_form($roavio_comments_args);

			?>
		</div>
	</div>
</div>