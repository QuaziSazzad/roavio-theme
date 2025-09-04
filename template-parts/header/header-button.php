<?php

/**
 * Template part for displaying Main Header Button
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;

$header_button     = Helper::get_option('header_button', 'disabled');
$button_text       = Helper::get_option('button_text', esc_html__('Get In Touch', 'roavio'));
$button_url        = Helper::get_option('button_url', '#');

if ('enabled' === $header_button) : ?>
    <div class="menu-btns ms-lg-auto">
        <a href="<?php echo esc_url($button_url); ?>" class="theme-btn btn-small ms-lg-4"><?php echo esc_html($button_text); ?></a>
        <!-- menu sidbar -->
        <div class="menu-sidebar ms-4">
            <button class="bg-transparent"></button>
        </div>
    </div>
<?php endif;
