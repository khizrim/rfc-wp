<?php

/**
 * AJAX handlers for camp shift functionality
 */

// Register AJAX actions
add_action('wp_ajax_get_default_shift', 'get_default_shift_callback');
add_action('wp_ajax_nopriv_get_default_shift', 'get_default_shift_callback');
add_action('wp_ajax_get_shift_by_field', 'get_shift_by_field_callback');
add_action('wp_ajax_nopriv_get_shift_by_field', 'get_shift_by_field_callback');

add_action('wp_ajax_filter_shifts', 'filter_shifts_callback');
add_action('wp_ajax_nopriv_filter_shifts', 'filter_shifts_callback');
add_action('wp_ajax_get_available_options', 'get_available_options_callback');
add_action('wp_ajax_nopriv_get_available_options', 'get_available_options_callback');

/**
 * Get the default (first) camp shift
 */
function get_default_shift_callback() {
  $query = new WP_Query([
    'post_type' => 'camp_shift',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'ASC',
    'meta_query' => [[
      'key' => 'visible',
      'value' => '1',
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
      'title' => typo_process(get_the_title($post_id)),
      'city' => typo_process($city),
      'address' => typo_process(get_field('address', $post_id)),
      'start_date' => $start_date_value,
      'start_date_label' => $date ? $date->format('d.m.Y') : $raw_date,
      'end_date' => get_field('end_date', $post_id),
      'age_range' => typo_process(get_field('age_range', $post_id)),
      'price' => typo_process(number_format(get_field('price', $post_id), 0, '', ' ')),
      'hours' => typo_process(get_field('hours', $post_id)),
      'description' => typo_process(get_field('description', $post_id)),
      'program' => typo_process(get_field('program', $post_id)),
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
    'meta_query' => [
      'relation' => 'AND',
      [
        'key' => $field,
        'value' => $value,
        'compare' => '='
      ],
      [
        'key' => 'visible',
        'value' => '1',
        'compare' => '='
      ]
    ]
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
      'title' => typo_process(get_the_title($post_id)),
      'city' => typo_process($city),
      'address' => typo_process(get_field('address', $post_id)),
      'start_date' => $start_date_value,
      'start_date_label' => $date ? $date->format('d.m.Y') : $raw_date,
      'end_date' => get_field('end_date', $post_id),
      'age_range' => typo_process(get_field('age_range', $post_id)),
      'price' => typo_process(number_format(get_field('price', $post_id), 0, '', ' ')),
      'hours' => typo_process(get_field('hours', $post_id)),
      'description' => typo_process(get_field('description', $post_id)),
      'program' => typo_process(get_field('program', $post_id)),
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

/**
 * Filter shifts by multiple criteria
 */
function filter_shifts_callback() {
  // Собираем фильтры
  $requested_filters = [];

  if (!empty($_POST['city'])) {
    $requested_filters['city'] = sanitize_text_field($_POST['city']);
  }
  if (!empty($_POST['address'])) {
    $requested_filters['address'] = sanitize_text_field($_POST['address']);
  }
  if (!empty($_POST['age_range'])) {
    $requested_filters['age_range'] = sanitize_text_field($_POST['age_range']);
  }
  if (!empty($_POST['start_date'])) {
    $requested_filters['start_date'] = sanitize_text_field($_POST['start_date']);
  }

  // Получаем все смены и фильтруем их напрямую через get_field()
  $all_shifts = get_posts(['post_type' => 'camp_shift', 'posts_per_page' => -1]);
  $matching_shift = null;

  foreach ($all_shifts as $shift) {
    $matches = true;

    // Проверяем поле visible
    $is_visible = get_field('visible', $shift->ID);
    if (!$is_visible) {
      continue; // Пропускаем невидимые смены
    }

    foreach ($requested_filters as $filter_key => $filter_value) {
      $shift_value = get_field($filter_key, $shift->ID);

      // Для поля city учитываем, что оно может быть массивом
      if ($filter_key === 'city' && is_array($shift_value)) {
        $shift_value = $shift_value['value'];
      }

      if ($shift_value !== $filter_value) {
        $matches = false;
        break;
      }
    }

    if ($matches) {
      $matching_shift = $shift;
      break; // Берем первую найденную
    }
  }

  if ($matching_shift) {
    $post_id = $matching_shift->ID;

    $raw_date = get_field('start_date', $post_id);
    $date = DateTime::createFromFormat('d/m/Y', $raw_date);
    $start_date_value = $date ? $date->format('Ymd') : $raw_date;

    $city = get_field('city', $post_id);
    $city = is_array($city) ? $city['value'] : $city;

    $fields = [
      'post_id' => $post_id,
      'title' => typo_process(get_the_title($post_id)),
      'city' => typo_process($city),
      'address' => typo_process(get_field('address', $post_id)),
      'start_date' => $start_date_value,
      'start_date_label' => $date ? $date->format('d.m.Y') : $raw_date,
      'end_date' => get_field('end_date', $post_id),
      'age_range' => typo_process(get_field('age_range', $post_id)),
      'price' => typo_process(number_format(get_field('price', $post_id), 0, '', ' ')),
      'hours' => typo_process(get_field('hours', $post_id)),
      'description' => typo_process(get_field('description', $post_id)),
      'program' => typo_process(get_field('program', $post_id)),
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

/**
 * Helper function to get available values for a specific field
 */
function get_available_field_values($field, $exclude_filters, $current_filters) {
  // Если в фильтрах есть дата, используем прямой поиск вместо meta_query
  if (isset($current_filters['start_date'])) {
    // Получаем все смены
    $all_shifts = get_posts(['post_type' => 'camp_shift', 'posts_per_page' => -1]);
    $matching_shifts = [];

    // Фильтруем смены через get_field()
    foreach ($all_shifts as $shift) {
      $matches = true;

      // Проверяем поле visible
      $is_visible = get_field('visible', $shift->ID);
      if (!$is_visible) {
        continue; // Пропускаем невидимые смены
      }

      foreach ($current_filters as $filter_key => $filter_value) {
        if (in_array($filter_key, $exclude_filters)) {
          continue; // Пропускаем исключенные фильтры
        }

        $shift_value = get_field($filter_key, $shift->ID);

        // Для поля city учитываем, что оно может быть массивом
        if ($filter_key === 'city' && is_array($shift_value)) {
          $shift_value = $shift_value['value'];
        }

        if ($shift_value !== $filter_value) {
          $matches = false;
          break;
        }
      }

      if ($matches) {
        $matching_shifts[] = $shift;
      }
    }

    // Собираем значения нужного поля из найденных смен
    $values = [];
    foreach ($matching_shifts as $shift) {
      $value = get_field($field, $shift->ID);

      if ($field === 'city' && is_array($value)) {
        $label = $value['label'] ?? '';
        $value = $value['value'] ?? '';
      } elseif ($field === 'start_date') {
        $raw_value = $value;

        $date = null;
        $formats = ['d/m/Y', 'Y-m-d', 'Ymd', 'm/d/Y', 'Y/m/d'];

        foreach ($formats as $format) {
          $date = DateTime::createFromFormat($format, $raw_value);
          if ($date !== false) {
            break;
          }
        }

        if ($date === false) {
          $timestamp = strtotime($raw_value);
          if ($timestamp !== false) {
            $date = new DateTime();
            $date->setTimestamp($timestamp);
          }
        }

        $label = $date !== false ? $date->format('d.m.Y') : $raw_value;
        $value = $raw_value;
      } else {
        $label = $value;
      }

      if ($value && !isset($values[$value])) {
        $values[$value] = $label;
      }
    }

    return $values;
  }

  // Старая логика с meta_query (для случаев без даты)
  $query_filters = [];

  foreach ($current_filters as $key => $value) {
    if (!in_array($key, $exclude_filters)) {
      $query_filters[] = [
        'key' => $key,
        'value' => $value,
        'compare' => '='
      ];
    }
  }

  // Добавляем обязательное условие для поля visible
  $query_filters[] = [
    'key' => 'visible',
    'value' => '1',
    'compare' => '='
  ];

  $query_args = [
    'post_type' => 'camp_shift',
    'posts_per_page' => -1
  ];

  if (!empty($query_filters)) {
    $query_args['meta_query'] = $query_filters;
    if (count($query_filters) > 1) {
      $query_args['meta_query']['relation'] = 'AND';
    }
  }

  $query = new WP_Query($query_args);
  $values = [];

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $value = get_field($field, get_the_ID());

      if ($field === 'city' && is_array($value)) {
        $label = $value['label'] ?? '';
        $value = $value['value'] ?? '';
      } elseif ($field === 'start_date') {
        // Для дат используем исходное значение как есть
        $raw_value = $value;

        // Пытаемся создать красивую метку для отображения
        $date = null;
        $formats = ['d/m/Y', 'Y-m-d', 'Ymd', 'm/d/Y', 'Y/m/d'];

        foreach ($formats as $format) {
          $date = DateTime::createFromFormat($format, $raw_value);
          if ($date !== false) {
            break;
          }
        }

        if ($date === false) {
          $timestamp = strtotime($raw_value);
          if ($timestamp !== false) {
            $date = new DateTime();
            $date->setTimestamp($timestamp);
          }
        }

        $label = $date !== false ? $date->format('d.m.Y') : $raw_value;
        $value = $raw_value;
      } else {
        $label = $value;
      }

      if ($value && !isset($values[$value])) {
        $values[$value] = $label;
      }
    }
  }

  wp_reset_postdata();
  return $values;
}

/**
 * Get available options for all filters based on current selection
 */
function get_available_options_callback() {
  $current_filters = [];

  // Собираем текущие фильтры
  if (!empty($_POST['city'])) {
    $current_filters['city'] = sanitize_text_field($_POST['city']);
  }
  if (!empty($_POST['address'])) {
    $current_filters['address'] = sanitize_text_field($_POST['address']);
  }
  if (!empty($_POST['age_range'])) {
    $current_filters['age_range'] = sanitize_text_field($_POST['age_range']);
  }
  if (!empty($_POST['start_date'])) {
    // Используем дату как есть, без конвертации
    $current_filters['start_date'] = sanitize_text_field($_POST['start_date']);
  }

  // Получаем доступные варианты для каждого фильтра
  $available_options = [
    'cities' => get_available_field_values('city', ['city'], $current_filters),
    'addresses' => get_available_field_values('address', ['address'], $current_filters),
    'age_ranges' => get_available_field_values('age_range', ['age_range'], $current_filters),
    'start_dates' => get_available_field_values('start_date', ['start_date'], $current_filters)
  ];

  // Сортируем даты по времени
  $dates = $available_options['start_dates'];
  uksort($dates, function ($a, $b) {
    $dateA = strtotime($a);
    $dateB = strtotime($b);
    return $dateA <=> $dateB;
  });
  $available_options['start_dates'] = $dates;

  wp_send_json_success($available_options);
  wp_die();
}
