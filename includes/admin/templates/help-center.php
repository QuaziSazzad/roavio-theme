<?php

/**
 * Template Help center
 *
 * Help Center Template for admin panel
 *
 * @package Roavio
 */

$allowed_html = [
    'a' => [
        'href'   => true,
        'target' => true,
    ],
];

?>
<div class="roavio-dashboard-pages roavio-helper-center-page">
    <div class="roavio-help-boxes">
        <div class="help-box doc-box" style="background-image: url( <?php echo ROAVIO_ASSETS . '/img/doc-bg.jpg' ?> );">
            <div class="img">
                <img src="<?php echo esc_url(ROAVIO_ASSETS . '/img/doc-img.png') ?>" alt="<?php esc_attr_e('Documentation', 'roavio') ?>">
            </div>
            <a href="<?php echo esc_url('https://webtend-support.gitbook.io/docs/') ?>" target="_blank" class="help-center-btn"><?php esc_html_e('Documentation', 'roavio') ?></a>
        </div>
        <div class="help-box support-box" style="background-image: url( <?php echo ROAVIO_ASSETS . '/img/support-bg.jpg' ?> );">
            <div class="img">
                <img src="<?php echo esc_url(ROAVIO_ASSETS . '/img/support-img.png') ?>" alt="<?php esc_attr_e('Documentation', 'roavio') ?>">
            </div>
            <a href="<?php echo esc_url('https://themeforest.net/user/webtend#contact') ?>" target="_blank" class="help-center-btn"><?php esc_html_e('Get Support', 'roavio') ?></a>
        </div>
    </div>
</div>