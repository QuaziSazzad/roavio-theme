<?php

namespace RoavioTheme\Classes;

defined('ABSPATH') || exit;

/**
 * Initial setup for this theme
 */
class Roavio_Setup
{

	protected static $instance = null;

	public static function instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct()
	{
		add_action('after_setup_theme', [$this, 'setup_theme']);
		add_action('widgets_init', [$this, 'register_theme_sidebar']);
		add_action('init', [$this, 'register_theme_menu']);
		add_filter('body_class', [$this, 'body_classes']);
		add_action('after_switch_theme', [$this, 'default_elementor_option']);
	}

	public function setup_theme()
	{
		load_theme_textdomain('roavio', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');

		add_theme_support('title-tag');

		add_theme_support('post-thumbnails');

		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		add_image_size('roavio_850x470', 850, 470, true);
		add_image_size('roavio_1290x620', 1290, 620, true);
		add_image_size('roavio_100x80', 100, 80, true);

		add_theme_support('customize-selective-refresh-widgets');

		add_theme_support('align-wide');

		// Custom logo
		add_theme_support('custom-logo');

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('assets/css/style-editor.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		add_theme_support('custom-header');

		add_theme_support('custom-background');


		global $content_width;

		if (! isset($content_width)) {
			if ('no-sidebar' === Roavio_Helper::content_sidebar()) {
				$content_width = 1290;
			} else {
				$content_width = 850;
			}
		}

		remove_theme_support('widgets-block-editor');
	}

	public function register_theme_sidebar()
	{
		register_sidebar(
			[
				'name'          => esc_html__('Primary Sidebar', 'roavio'),
				'id'            => 'primary_sidebar',
				'description'   => esc_html__('Add widgets here.', 'roavio'),
				'before_widget' => '<div id="%1$s" class="widget %2$s ">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			]
		);
	}

	public function register_theme_menu()
	{
		register_nav_menus([
			'primary_menu' => esc_html__('Primary Menu', 'roavio'),
		]);
	}

	public function body_classes($classes)
	{
		if ('boxed' === Roavio_Helper::site_layout()) {
			$classes[] = 'roavio-boxed-layout';
		}

		if (!empty(Roavio_Helper::get_meta('roavio_page_meta', 'body_class'))) {
			$classes[] = Roavio_Helper::get_meta('roavio_page_meta', 'body_class');
		}

		if ('dark' === Roavio_helper::get_option('color_scheme', 'light')) {
			$classes[] = 'dark-version';
		}


		if (Roavio_helper::get_option('site_border', false)) {
			$classes[] = 'roavio-site-border';
		} else {
			$classes[] = 'roavio-site-border-none';
		}

		return $classes;
	}

	public function default_elementor_option()
	{
		update_option('elementor_disable_color_schemes', 'yes');
		update_option('elementor_disable_typography_schemes', 'yes');
		update_option('elementor_experiment-e_font_icon_svg', 'inactive');
		update_option('elementor_experiment-container', 'active');
		update_option('elementor_experiment-nested-elements', 'active');
		update_option('elementor_experiment-additional_custom_breakpoints', 'active');
	}
}

Roavio_Setup::instance();
