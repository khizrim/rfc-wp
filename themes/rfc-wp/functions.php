<?php

// Подключение кастомных типов записей
require_once get_template_directory() . '/post-types/mentor.php';
require_once get_template_directory() . '/post-types/robot.php';
require_once get_template_directory() . '/post-types/camp-shift.php';

// Глобальный список блоков
function rfc_get_block_list() {
  return [
    'section-heading',
    'hero',
    'features',
    'steps',
    'robots',
    'mentors',
    'how-it-was',
    'cards-mix',
  ];
}

// Подключение стилей
function rfc_enqueue_assets() {
  wp_enqueue_style(
    'rfc-main',
    get_template_directory_uri() . '/styles/index.css',
    [],
    filemtime(get_template_directory() . '/styles/index.css')
  );
}
add_action('wp_enqueue_scripts', 'rfc_enqueue_assets');

// Подключение скриптов
function rfc_enqueue_scripts() {
  wp_enqueue_script(
    'header-menu',
    get_template_directory_uri() . '/assets/js/header-menu.js',
    [],
    null,
    true
  );
}
add_action('wp_enqueue_scripts', 'rfc_enqueue_scripts');

// Регистрация ACF-блоков
function rfc_register_acf_blocks() {
  foreach (rfc_get_block_list() as $block) {
    register_block_type(get_template_directory() . "/blocks/{$block}");
  }
}
add_action('init', 'rfc_register_acf_blocks');

// Разрешение только указанных блоков
function rfc_allowed_block_types($allowed_block_types, $block_editor_context) {
  return array_map(fn($block) => "acf/rfc-{$block}", rfc_get_block_list());
}
add_filter('allowed_block_types_all', 'rfc_allowed_block_types', 10, 2);
