<?php

/**
 * Регистрирует кастомный тип записи "robot" для управления роботами
 */
add_action('init', 'register_robot_cpt');

function register_robot_cpt() {
  $labels = [
    'name' => 'Роботы',
    'singular_name' => 'Робот',
    'add_new' => 'Добавить робота',
    'add_new_item' => 'Новый робот',
    'edit_item' => 'Редактировать робота',
    'new_item' => 'Новый робот',
    'view_item' => 'Посмотреть робота',
    'search_items' => 'Поиск роботов',
    'not_found' => 'Роботы не найдены',
    'menu_name' => 'Роботы',
  ];

  $args = [
    'labels' => $labels,
    'public' => true,
    'menu_icon' => 'dashicons-shield-alt',
    'has_archive' => false,
    'show_in_rest' => true,
    'supports' => ['title', 'thumbnail'],
    'rewrite' => ['slug' => 'robots'],
  ];

  register_post_type('robot', $args);
}
