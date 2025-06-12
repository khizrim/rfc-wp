<?php

/**
 * AJAX handlers for camp shift functionality
 */

// Register AJAX actions
add_action('wp_ajax_get_default_shift', 'get_default_shift_callback');
add_action('wp_ajax_nopriv_get_default_shift', 'get_default_shift_callback');
add_action('wp_ajax_get_shift_by_field', 'get_shift_by_field_callback');
add_action('wp_ajax_nopriv_get_shift_by_field', 'get_shift_by_field_callback');

/**
 * Get the default (first) camp shift
 */
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

  wp_die();
}

/**
 * Get camp shift by specific field value
 */
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

  wp_die();
}
