<?php

/**
 * Theme functions and definitions
 */

// Include post types
require_once get_template_directory() . '/post-types/mentor.php';
require_once get_template_directory() . '/post-types/robot.php';
require_once get_template_directory() . '/post-types/camp-shift.php';

// Include AJAX handlers
require_once get_template_directory() . '/ajax/shift-handlers.php';

/**
 * Block Management
 */

/**
 * Get list of available blocks
 * 
 * @return array List of block names
 */
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
    'trial-form',
  ];
}

/**
 * Register ACF blocks
 */
function rfc_register_acf_blocks() {
  foreach (rfc_get_block_list() as $block) {
    register_block_type(get_template_directory() . "/blocks/{$block}");
  }
}
add_action('init', 'rfc_register_acf_blocks');

/**
 * Restrict available blocks to only those defined in rfc_get_block_list()
 */
function rfc_allowed_block_types($allowed_block_types, $block_editor_context) {
  return array_map(fn($block) => "acf/rfc-{$block}", rfc_get_block_list());
}
add_filter('allowed_block_types_all', 'rfc_allowed_block_types', 10, 2);

/**
 * Asset Management
 */

/**
 * Enqueue theme styles
 */
function rfc_enqueue_assets() {
  wp_enqueue_style(
    'rfc-main',
    get_template_directory_uri() . '/styles/index.css',
    [],
    filemtime(get_template_directory() . '/styles/index.css')
  );
}
add_action('wp_enqueue_scripts', 'rfc_enqueue_assets');

/**
 * Enqueue theme scripts
 */
function rfc_enqueue_scripts() {
  wp_enqueue_script(
    'header-menu',
    get_template_directory_uri() . '/scripts/header-menu.js',
    [],
    null,
    true
  );
}
add_action('wp_enqueue_scripts', 'rfc_enqueue_scripts');

/**
 * Enqueue slider assets conditionally based on block usage
 */
function enqueue_robot_slider_assets() {
  // Only load Swiper if needed
  if (has_block('acf/rfc-robots') || has_block('acf/rfc-mentors') || has_block('acf/rfc-how-it-was')) {
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8.4.7/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper@8.4.7/swiper-bundle.min.js', [], null, true);
  }

  // Load specific slider scripts only if their blocks are present
  if (has_block('acf/rfc-robots')) {
    wp_enqueue_script('robot-slider-init', get_template_directory_uri() . '/scripts/robot-slider.js', ['swiper-js'], null, true);
  }

  if (has_block('acf/rfc-mentors')) {
    wp_enqueue_script('mentor-slider-init', get_template_directory_uri() . '/scripts/mentor-slider.js', ['swiper-js'], null, true);
    wp_enqueue_script('mentor-popup-init', get_template_directory_uri() . '/scripts/mentor-popup.js', [], null, true);
  }

  if (has_block('acf/rfc-how-it-was')) {
    wp_enqueue_script('how-it-was-slider-init', get_template_directory_uri() . '/scripts/hiw-slider.js', ['swiper-js'], null, true);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_robot_slider_assets');

/**
 * Enqueue filter script and localize AJAX URL
 */
function enqueue_filter_script() {
  wp_enqueue_script('shift-filter', get_template_directory_uri() . '/scripts/filter.js', ['jquery'], null, true);
  wp_localize_script('shift-filter', 'shift_ajax', [
    'ajax_url' => admin_url('admin-ajax.php'),
  ]);
}
add_action('wp_enqueue_scripts', 'enqueue_filter_script');
