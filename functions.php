<?php

/**
 * Roavio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Roavio
 */

/**
 * Define constant
 */
$theme   = wp_get_theme();
$name    = ! $theme->parent() ? wp_get_theme()->get('Name') : wp_get_theme()->parent()->get('Name');
$version = ! $theme->parent() ? wp_get_theme()->get('Version') : wp_get_theme()->parent()->get('Version');

define('ROAVIO_NAME', $name);
define('ROAVIO_VERSION', $version);
define('ROAVIO_PATH', untrailingslashit(get_template_directory()));
define('ROAVIO_URI', untrailingslashit(get_template_directory_uri()));
define('ROAVIO_ASSETS', untrailingslashit(get_template_directory_uri()) . '/assets');
define('ROAVIO_VENDOR', untrailingslashit(get_template_directory_uri()) . '/assets/vendor');
define('ROAVIO_INCLUDES', ROAVIO_PATH . '/includes');
define('ROAVIO_CLASSES', ROAVIO_PATH . '/includes/classes');
define('ROAVIO_ADMIN', ROAVIO_PATH . '/includes/admin');

/**
 * Load theme files
 */
require_once ROAVIO_CLASSES . '/class-setup.php';
require_once ROAVIO_CLASSES . '/class-helper.php';
require_once ROAVIO_CLASSES . '/class-assets.php';
require_once ROAVIO_CLASSES . '/class-post-helper.php';
require_once ROAVIO_CLASSES . '/class-comment-walker.php';
require_once ROAVIO_CLASSES . '/class-nav-walker.php';
require_once ROAVIO_CLASSES . '/class-breadcrumb.php';
require_once ROAVIO_ADMIN . '/class-admin-panel.php';
require_once ROAVIO_INCLUDES . '/library/class-tgm-plugin-activation.php';
require_once ROAVIO_INCLUDES . '/library/required-plugin.php';

add_action('init', function () {
    if (function_exists('register_block_style')) {
        register_block_style(
            'core/quote',
            array(
                'name'         => 'blue-quote',
                'label'        => esc_html__('Blue Quote', 'roavio'),
                'is_default'   => true,
                'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
            )
        );
    }

    function roavio_register_my_patterns()
    {
        register_block_pattern(
            'roavio/roavio-example',
            array(
                'title'         => esc_html__('Block Pattern', 'roavio'),
                'description'   => _x('This is my first block pattern', 'Block pattern description', 'roavio'),
                'content'       => '<!-- wp:paragraph --><p>A single paragraph block style</p><!-- /wp:paragraph -->',
                'categories'    => array('text'),
                'keywords'      => array('cta', 'demo', 'example'),
                'viewportWidth' => 800,
            )
        );
    }

    add_action('init', 'roavio_register_my_patterns');
});
