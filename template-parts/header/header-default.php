<?php

/**
 * Template part for displaying Main Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;
use RoavioTheme\Classes\Roavio_Nav_Walker;

$site_logo_type  = Helper::get_option('site_logo_type', 'image');
$site_text_logo  = Helper::get_option('site_text_logo', __('Roavio', 'roavio'));
$site_image_logo = Helper::get_option('site_image_logo', ['url' => ROAVIO_ASSETS . '/img/logo.png']);

?>
<div class="fix-area">
	<div class="offcanvas__info">
		<div class="offcanvas__wrapper">
			<div class="offcanvas__content">
				<div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
					<div class="offcanvas__logo">
						<a href="<?php echo esc_url(home_url()) ?>">
							<?php if ('text' === $site_logo_type && ! empty($site_text_logo)): ?>
								<?php echo esc_html($site_text_logo) ?>
							<?php elseif ('image' === $site_logo_type && ! empty($site_image_logo['url'])): ?>
								<img src="<?php echo esc_url($site_image_logo['url']) ?>" alt="<?php echo esc_attr(get_bloginfo()) ?>">
							<?php endif; ?>
						</a>
					</div>
					<div class="offcanvas__close">
						<button>
							<i class="fas fa-times"></i>
						</button>
					</div>
				</div>
				<div class="mobile-menu fix mb-3"></div>
			</div>
		</div>
	</div>
</div>
<div class="offcanvas__overlay"></div>


<!-- Header Section Start -->
<header id="header-sticky" class="header-1">
	<div class="container-fluid">
		<div class="mega-menu-wrapper">
			<div class="header-main">
				<div class="header-left">
					<div class="logo">
						<a href="<?php echo esc_url(home_url()) ?>" class="header-logo">
							<?php if ('text' === $site_logo_type && ! empty($site_text_logo)): ?>
								<?php echo esc_html($site_text_logo) ?>
							<?php elseif ('image' === $site_logo_type && ! empty($site_image_logo['url'])): ?>
								<img src="<?php echo esc_url($site_image_logo['url']) ?>" alt="<?php echo esc_attr(get_bloginfo()) ?>">
							<?php endif; ?>
						</a>
					</div>
					<div class="mean__menu-wrapper">
						<div class="main-menu">
							<nav id="mobile-menu" style="display: block;">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'primary_menu',
										'menu_class' => 'navigation clearfix',
										'container'       => '',
										'fallback_cb'     => false,
										'container_class' => '',
										'walker'          => new Roavio_Nav_Walker()
									)
								);
								?>
							</nav>
						</div>
					</div>
				</div>

				<!-- Menu Button -->
				<?php get_template_part('template-parts/header/header', 'button'); ?>

			</div>
		</div>
	</div>
</header>