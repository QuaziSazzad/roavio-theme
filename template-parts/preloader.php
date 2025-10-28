<?php

/**
 * Template part for site preloader
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Convis
 */

use RoavioTheme\Classes\Roavio_Helper as Helper;


if (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
    echo '';
} else {
?>
    <!-- Preloader Start -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner">
            </div>
            <div class="txt-loading">
                <?php
                $preloader_text = Helper::get_option('preloader_text', 'ROAVIO');
                if (!empty($preloader_text)) {
                    $letters = str_split($preloader_text);
                    foreach ($letters as $letter) {
                ?>
                        <span data-text-preloader="<?php echo esc_attr($letter); ?>" class="letters-loading">
                            <?php echo esc_html($letter); ?>
                        </span>
                <?php
                    }
                }
                ?>
            </div>
            <p class="text-center"><?php echo esc_html(Helper::get_option('loading_text', 'Loading')); ?></p>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
<?php
}
