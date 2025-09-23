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
$button_text       = Helper::get_option('button_text', esc_html__('Book Now', 'roavio'));
$button_url        = Helper::get_option('button_url', '#');
$search_button     = Helper::get_option('search_button', 'enabled');

?>

<div class="header-right d-flex justify-content-end align-items-center">
    <?php if ('enabled' === $search_button) : ?>
        <div class="search-widget">
            <form action="<?php echo esc_url(home_url('/')); ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input type="text" placeholder="<?php echo esc_attr_x('Search..', 'placeholder', 'roavio'); ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Enter your keyword', 'label', 'roavio'); ?>">
            </form>
        </div>
    <?php endif; ?>
    <?php if ('enabled' === $header_button) : ?>
        <div class="header-button">
            <a href="<?php echo esc_url($button_url); ?>" class="theme-btn"><?php echo esc_html($button_text); ?></a>
        </div>
    <?php endif; ?>

    <div class="header__hamburger d-xl-none my-auto">
        <div class="sidebar__toggle">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</div>