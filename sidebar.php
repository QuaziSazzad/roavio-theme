<?php

/**
 * The sidebar containing the Primary widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;

if ('no-sidebar' === Helper::content_sidebar() || ! is_active_sidebar('primary_sidebar')) {
  return;
}
$roavio_sidebar_class = 'ps-xl-5';
if (Helper::content_sidebar() == 'left-sidebar') {
  $roavio_sidebar_class = 'pe-xl-5  order-first';
}
?>
<div class="col-lg-4 col-md-8 col-sm-10  rmt-65 <?php echo esc_attr($roavio_sidebar_class); ?>">
  <div class="blog-sidebar main-sideber sticky-style">
    <div class="sidebar-area">
      <div class="primary-sidebar widget-area">
        <?php dynamic_sidebar('primary_sidebar'); ?>
      </div>
    </div>
  </div>
</div>