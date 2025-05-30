<?php

/**
 * Регистрирует кастомный тип записи "mentor" для управления наставниками
 */
add_action('init', 'register_mentor_cpt');

function register_mentor_cpt() {
  $labels = [
    'name' => 'Наставники',
    'singular_name' => 'Наставник',
    'add_new' => 'Добавить наставника',
    'add_new_item' => 'Новый наставник',
    'edit_item' => 'Редактировать наставника',
    'new_item' => 'Новый наставник',
    'view_item' => 'Посмотреть наставника',
    'search_items' => 'Поиск наставников',
    'not_found' => 'Наставники не найдены',
    'menu_name' => 'Наставники',
    'capability_type' => 'post',
  ];

  $args = [
    'labels' => $labels,
    'public' => true,
    'menu_icon' => 'dashicons-universal-access-alt',
    'has_archive' => false,
    'show_in_rest' => true,
    'supports' => ['title', 'thumbnail'],
    'rewrite' => ['slug' => 'mentors'],
  ];

  register_post_type('mentor', $args);
}
