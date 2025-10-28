<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<!-- MouseCursor Start -->
	<div class="mouseCursor cursor-outer"></div>
	<div class="mouseCursor cursor-inner"></div>
	<div id="roavio-page" class="roavio-body-content">
		<?php
		if ('enabled' === Helper::get_option('site_preloader', 'enabled')) {
			get_template_part('template-parts/preloader');
		}

		if (class_exists('Roavio_Toolkit')) {
			do_action("roavio_builder_before_main");
		}

		if ('enabled' === Helper::check_default_header()) {
			get_template_part('template-parts/header/header', 'default');
		}
		?>
		<main id="roavio-content" class="roavio-content-area">
			<?php get_template_part('template-parts/page-title'); ?>