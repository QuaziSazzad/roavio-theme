<?php

/**
 * Template for displaying search forms
 *
 * @package Roavio
 */
?>
<form role="search" method="get" class="roavio-search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <input
        type="search"
        class="search-field"
        placeholder="<?php echo esc_attr_x('Search..', 'placeholder', 'roavio'); ?>"
        value="<?php echo get_search_query() ?>"
        name="s"
        title="<?php echo esc_attr_x('Enter your keyword', 'label', 'roavio'); ?>" />
    <button type="submit" class="search-submit"><i class="far fa-search"></i></button>
</form>