<?php

namespace RoavioTheme\Classes;

use Walker_Comment;

defined('ABSPATH') || exit;

if (! class_exists('Roavio_Comment_Walker')) {
    class Roavio_Comment_Walker extends Walker_Comment
    {

        /**
         * Starts the element output.
         */
        public function start_el(&$output, $data_object, $depth = 0, $args = [], $current_object_id = 0)
        {
            $depth++;
            $GLOBALS['comment_depth'] = $depth;
            $GLOBALS['comment']       = $data_object;

            ob_start();

            if (! empty($args['callback'])) {
                call_user_func($args['callback'], $data_object, $args, $depth);
                $output .= ob_get_clean();

                return;
            }

            if (('pingback' == $data_object->comment_type || 'trackback' == $data_object->comment_type) && $args['short_ping']) {
                $this->ping($data_object, $depth, $args);
            } else {
                $this->comment($data_object, $depth, $args);
            }

            $output .= ob_get_clean();
        }

        /**
         * Outputs a Ping-back comment.
         */
        protected function ping($comment, $depth, $args)
        { ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
                <div class="comment-body" id="div-comment-<?php comment_ID() ?>">
                    <div class="comment-content">
                        <div class="author-info">
                            <h5 class="name"><?php printf('%s', get_comment_author_link()) ?></h5>
                            <span class="date"><?php printf('%1$s', get_comment_date()) ?></span>
                        </div>
                        <div class="comment-text">
                            <?php comment_text() ?>
                        </div>
                    </div>
                </div>
            <?php }

        /**
         * Outputs a single comment.
         */
        protected function comment($comment, $depth, $args)
        {
            $max_depth_comment = min($args['max_depth'], 4);
            $GLOBALS['comment'] = $comment;
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
                <div class="comment-body" id="comment-<?php comment_ID(); ?>" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="author-thumb">
                        <?php echo get_avatar($comment->comment_author_email, 80); ?>
                    </div>
                    <div class="content">
                        <h6> <?php printf('%s', get_comment_author_link()); ?></h6>
                        <span class="date"><i class="far fa-calendar-alt"></i><?php printf('%1$s', get_comment_date()); ?></span>
                        <?php if ($comment->comment_approved == '0'): ?>
                            <p><?php esc_html_e('Your comment is awaiting moderation.', 'roavio'); ?></p>
                        <?php endif; ?>
                        <p><?php comment_text(); ?></p>
                        <?php
                        comment_reply_link(array_merge($args, [
                            'depth'      => $depth,
                            'reply_text' => esc_html__('Reply ', 'roavio') . '<i class="far fa-angle-right"></i>',
                            'max_depth'  => $max_depth_comment,
                        ]));
                        ?>
                    </div>
                </div>
    <?php
        }
    }
}
