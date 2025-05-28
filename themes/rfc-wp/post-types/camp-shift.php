<?php

/**
 * Регистрирует кастомный тип записи "camp_shift" для управления сменами
 */
add_action('init', 'register_camp_shift_cpt');

function register_camp_shift_cpt() {
  $labels = [
    'name' => 'Смены',
    'singular_name' => 'Смена',
    'add_new' => 'Добавить смену',
    'add_new_item' => 'Добавить новую смену',
    'edit_item' => 'Редактировать смену',
    'new_item' => 'Новая смена',
    'view_item' => 'Посмотреть смену',
    'search_items' => 'Поиск смен',
    'not_found' => 'Смены не найдены',
    'menu_name' => 'Смены',
  ];

  $args = [
    'labels' => $labels,
    'public' => true,
    'menu_icon' => 'dashicons-calendar-alt',
    'has_archive' => false,
    'show_in_rest' => false,
    'supports' => ['title', 'thumbnail'],
    'rewrite' => ['slug' => 'shifts'],
  ];

  register_post_type('camp_shift', $args);
}
