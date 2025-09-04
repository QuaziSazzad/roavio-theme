<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Roavio
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;

$default_copyright = sprintf(
    esc_html__('Copyright © %s. All rights reserved.', 'roavio'),
    date('Y')
);

$copyright = Helper::get_option('copyright_text', $default_copyright);
?>

<footer class="roavio-site-footer default-footer text-center">
    <div class="container">
        <div class="footer-copyright">
            <p>
                <?php echo esc_html($copyright) ?>
            </p>
        </div>
    </div>
</footer>