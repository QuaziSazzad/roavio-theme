<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;

get_header();

$not_found_text    = Helper::get_option('not_found_text', esc_html__('404 (page not found)', 'roavio'));
$error_title    = Helper::get_option('error_title', esc_html__('Sorry! page can’t be found', 'roavio'));
$error_message  = Helper::get_option('error_bottom_message', esc_html__('Sorry, the page you’re looking for doesn’t exist or may have been moved.', 'roavio'));
$button_text    = Helper::get_option('error_button_text', esc_html__('Go to Home', 'roavio'));
$error_page_image = Helper::get_option('error_page_image', ['url' => ROAVIO_ASSETS . '/img/error-404.png']);

?>

<!-- error Section Start -->
<section class="error-section section-padding fix">
    <div class="text"><?php echo esc_html($not_found_text); ?></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="error-item">
                    <?php if (!empty($error_page_image['url'])): ?>
                        <div class="error-image">
                            <img src="<?php echo esc_url($error_page_image['url']); ?>" alt="<?php esc_attr_e('404 Error', 'roavio'); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="error-content">
                        <h2><?php echo esc_html($error_title); ?></h2>
                        <p><?php echo esc_html($error_message); ?></p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="theme-btn" data-animation="fadeInUp" data-delay="1.3s"><?php echo esc_html($button_text); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
