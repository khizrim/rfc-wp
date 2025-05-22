<?php
function rfc_enqueue_assets() {
    wp_enqueue_style(
        'rfc-main',
        get_template_directory_uri() . '/styles/index.css',
        [],
        filemtime(get_template_directory() . '/styles/index.css')
    );
}

add_action('wp_enqueue_scripts', 'rfc_enqueue_assets');
