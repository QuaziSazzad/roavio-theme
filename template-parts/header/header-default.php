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
<!-- main header -->
<header class="main-header">
	<!--Header-Upper-->
	<div class="header-upper">
		<div class="container-fluid clearfix">

			<div class="header-inner before-after-none rel d-flex align-items-center for-border default-header">
				<div class="logo-outer me-5 pe-xl-4">
					<div class="logo">
						<a href="<?php echo esc_url(home_url()) ?>">
							<?php if ('text' === $site_logo_type && ! empty($site_text_logo)): ?>
								<?php echo esc_html($site_text_logo) ?>
							<?php elseif ('image' === $site_logo_type && ! empty($site_image_logo['url'])): ?>
								<img src="<?php echo esc_url($site_image_logo['url']) ?>" alt="<?php echo esc_attr(get_bloginfo()) ?>">
							<?php endif; ?>
						</a>
					</div>
				</div>

				<div class="nav-outer clearfix">
					<!-- Main Menu -->
					<nav class="main-menu navbar-expand-lg">
						<div class="navbar-header py-15">
							<div class="mobile-logo">
								<a href="<?php echo esc_url(home_url()) ?>">
									<?php if ('text' === $site_logo_type && ! empty($site_text_logo)): ?>
										<?php echo esc_html($site_text_logo) ?>
									<?php elseif ('image' === $site_logo_type && ! empty($site_image_logo['url'])): ?>
										<img src="<?php echo esc_url($site_image_logo['url']) ?>" alt="<?php echo esc_html(get_bloginfo()) ?>">
									<?php endif; ?>
								</a>
							</div>

							<!-- Toggle Button -->
							<button type="button" class="navbar-toggle" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary_menu',
								'menu_class' => 'navigation clearfix',
								'container'       => 'div',
								'fallback_cb'     => false,
								'container_class' => 'navbar-collapse collapse clearfix',
								'walker'          => new Roavio_Nav_Walker()
							)
						);
						?>

					</nav>
					<!-- Main Menu End-->
				</div>

				<!-- Menu Button -->
				<?php get_template_part('template-parts/header/header', 'button'); ?>
			</div>
		</div>
		<!--End Header Upper-->
	</div>
</header>