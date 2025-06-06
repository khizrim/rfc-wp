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
    'trial-form',
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
    get_template_directory_uri() . '/scripts/header-menu.js',
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


function enqueue_robot_slider_assets() {
  wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
  wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], null, true);
  wp_enqueue_script('robot-slider-init', get_template_directory_uri() . '/scripts/robot-slider.js', ['swiper-js'], null, true);
  wp_enqueue_script('mentor-slider-init', get_template_directory_uri() . '/scripts/mentor-slider.js', ['swiper-js'], null, true);
  wp_enqueue_script('mentor-popup-init', get_template_directory_uri() . '/scripts/mentor-popup.js', [], null, true);
  wp_enqueue_script('how-it-was-slider-init', get_template_directory_uri() . '/scripts/hiw-slider.js', ['swiper-js'], null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_robot_slider_assets');

function enqueue_filter_script() {
  wp_enqueue_script('shift-filter', get_template_directory_uri() . '/scripts/filter.js', ['jquery'], null, true);
  wp_localize_script('shift-filter', 'shift_ajax', [
    'ajax_url' => admin_url('admin-ajax.php'),
  ]);
}
add_action('wp_enqueue_scripts', 'enqueue_filter_script');


add_action('wp_ajax_get_default_shift', 'get_default_shift_callback');
add_action('wp_ajax_nopriv_get_default_shift', 'get_default_shift_callback');

function get_default_shift_callback() {
  $query = new WP_Query([
    'post_type' => 'camp_shift',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'ASC',
  ]);

  if ($query->have_posts()) {
    $query->the_post();
    $post_id = get_the_ID();

    $raw_date = get_field('start_date', $post_id);
    $date = DateTime::createFromFormat('d/m/Y', $raw_date);
    $start_date_value = $date ? $date->format('Ymd') : $raw_date;
    $city = get_field('city', $post_id);
    $city = is_array($city) ? $city['value'] : $city;


    $fields = [
      'post_id' => $post_id,
      'title' => get_the_title($post_id),
      'city' => $city,
      'address' => get_field('address', $post_id),
      'start_date' => $start_date_value,
      'start_date_label' => $date ? $date->format('d.m.Y') : $raw_date,
      'end_date' => get_field('end_date', $post_id),
      'age_range' => get_field('age_range', $post_id),
      'price' => get_field('price', $post_id),
      'hours' => get_field('hours', $post_id),
      'description' => get_field('description', $post_id),
      'program' => get_field('program', $post_id),
      'image' => get_field('image', $post_id),
      'secondary_image' => get_field('secondary_image', $post_id),
      'button_url' => get_field('button_url', $post_id),
    ];

    wp_send_json_success($fields);
  } else {
    wp_send_json_error(['message' => 'Нет доступных смен']);
  }
}

add_action('wp_ajax_get_shift_by_field', 'get_shift_by_field_callback');
add_action('wp_ajax_nopriv_get_shift_by_field', 'get_shift_by_field_callback');

function get_shift_by_field_callback() {
  $field = sanitize_text_field($_POST['field']);
  $value = sanitize_text_field($_POST['value']);

  $query = new WP_Query([
    'post_type' => 'camp_shift',
    'posts_per_page' => 1,
    'meta_query' => [[
      'key' => $field,
      'value' => $value,
      'compare' => '='
    ]]
  ]);

  if ($query->have_posts()) {
    $query->the_post();
    $post_id = get_the_ID();

    $raw_date = get_field('start_date', $post_id);
    $date = DateTime::createFromFormat('d/m/Y', $raw_date);
    $start_date_value = $date ? $date->format('Ymd') : $raw_date;

    $city = get_field('city', $post_id);
    $city = is_array($city) ? $city['value'] : $city;

    $fields = [
      'post_id' => $post_id,
      'title' => get_the_title($post_id),
      'city' => $city,
      'address' => get_field('address', $post_id),
      'start_date' => $start_date_value,
      'start_date_label' => $date ? $date->format('d.m.Y') : $raw_date,
      'end_date' => get_field('end_date', $post_id),
      'age_range' => get_field('age_range', $post_id),
      'price' => get_field('price', $post_id),
      'hours' => get_field('hours', $post_id),
      'description' => get_field('description', $post_id),
      'program' => get_field('program', $post_id),
      'image' => get_field('image', $post_id),
      'secondary_image' => get_field('secondary_image', $post_id),
      'button_url' => get_field('button_url', $post_id),
    ];

    wp_send_json_success($fields);
  } else {
    wp_send_json_error(['message' => 'Смена не найдена']);
  }


  wp_die(); // Обязательно!
}
