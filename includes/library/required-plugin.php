<?php

/**
 * Required Plugin for Roavio theme
 *
 * @package Roavio
 */

if (! defined('ABSPATH')) {
	exit('No direct script access allowed');
}

add_action('tgmpa_register', 'roavio_register_required_plugins');
function roavio_register_required_plugins()
{
	$plugins = [
		[
			'name'     => esc_html__('Elementor Website Builder', 'roavio'),
			'slug'     => 'elementor',
			'required' => true,
			'version'  => '3.12',
		],
		[
			'name'     => esc_html__('Roavio Toolkit', 'roavio'),
			'slug'     => 'roavio-toolkit',
			'source'   => 'https://wp.webtend.net/roavio/tf-data/roavio-toolkit.zip',
			'required' => true,
			'version'  => '1.0.0',
		],
		[
			'name'     => esc_html__('Contact Form 7', 'roavio'),
			'slug'     => 'contact-form-7',
			'required' => false,
		],
		[
			'name'     => esc_html__('Breadcrumb NavXT', 'roavio'),
			'slug'     => 'breadcrumb-navxt',
			'required' => false,
		],
		[
			'name'     => esc_html__('One Click Demo Import', 'roavio'),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		],
	];

	$config = [
		'id'           => 'roavio_theme_plugins',
		'default_path' => '',
		'menu'         => 'roavio_required_plugins',
		'parent_slug'  => 'roavio_dashboard',
		'capability'   => 'manage_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
		'strings'      => [
			'menu_title' => esc_html__('Required Plugins', 'roavio'),
			'page_title' => esc_html__('Required Plugins', 'roavio'),
		],
	];

	tgmpa($plugins, $config);
}
