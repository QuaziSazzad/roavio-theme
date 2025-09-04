<?php

/**
 * Template Welcome
 *
 * Welcome Template for admin panel
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

<div class="roavio-dashboard-pages roavio-welcome-page">
    <div class="roavio-welcome-wrapper">
        <div class="wrapper-left">
            <div class="theme-screenshot">
                <img src="<?php echo esc_url(get_template_directory_uri() . "/screenshot.png"); ?>" alt="<?php esc_attr_e('Screenshot', 'roavio'); ?>">
            </div>
        </div>
        <div class="wrapper-right">
            <div class="roavio-welcome-title">
                <h3>
                    <?php esc_html_e('Welcome to', 'roavio'); ?>
                    <?php echo esc_html(wp_get_theme()->get('Name')); ?>

                    <span class="version-theme">
                        <?php esc_html_e('Version - ', 'roavio'); ?>
                        <?php echo esc_html(wp_get_theme()->get('Version')); ?>
                    </span>
                    <?php if (is_child_theme()) : ?>
                        <span class="version-theme">
                            <?php esc_html_e('Parent Theme Version - ', 'roavio'); ?>
                            <?php echo ROAVIO_VERSION; ?>
                        </span>
                    <?php endif; ?>
                </h3>
                <p>
                    <?php echo sprintf(__('%s is already installed and ready to use! Let\'s build something impressive.', 'roavio'), ROAVIO_NAME); ?>
                </p>
            </div>
            <h6 class="roavio-welcome-step-title"><?php echo __('Just complete the steps below:', 'roavio'); ?></h6>
            <ul>
                <li>
                    <span class="step-title">
                        <?php esc_html_e('Step 1', 'roavio'); ?>
                    </span>
                    <?php echo sprintf(
                        wp_kses(__('Check <a href="%s">Server status</a> to avoid errors with your WordPress.', 'roavio'), $allowed_html),
                        esc_url(admin_url('admin.php?page=roavio_server_status'))
                    ); ?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e('Step 2', 'roavio'); ?>
                    </span>
                    <?php esc_html_e('Install Required and recommended plugins.', 'roavio'); ?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e('Step 3', 'roavio'); ?>
                    </span>
                    <?php esc_html_e('Import demo content', 'roavio'); ?>
                </li>
            </ul>
        </div>
    </div>
</div>