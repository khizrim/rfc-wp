<?php

/**
 * Дополнительные ACF-поля для текстов и ссылок, которые раньше были
 * зашиты в шаблоны. Поля добавляются на существующие экраны админки:
 * страницу опций «main» и настройки блоков. Если поле не заполнено,
 * шаблоны выводят прежнее значение.
 */

function rfc_register_content_acf_fields() {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group([
    'key' => 'group_rfc_site_header_contacts',
    'title' => 'Шапка, логотипы и MAX',
    'fields' => [
      [
        'key' => 'field_rfc_header_button_text',
        'label' => 'Текст кнопки в шапке',
        'name' => 'header_button_text',
        'type' => 'text',
        'placeholder' => 'Выбрать смену',
      ],
      [
        'key' => 'field_rfc_header_button_link',
        'label' => 'Ссылка кнопки в шапке',
        'name' => 'header_button_link',
        'type' => 'text',
        'instructions' => 'Якорь на странице (например, #shift) '
          . 'или полный адрес.',
        'placeholder' => '#shift',
      ],
      [
        'key' => 'field_rfc_logo_header',
        'label' => 'Логотип в шапке и карточках наставников',
        'name' => 'logo_header',
        'type' => 'image',
        'return_format' => 'url',
        'instructions' => 'Если не задан, используется логотип темы.',
      ],
      [
        'key' => 'field_rfc_logo_footer',
        'label' => 'Логотип в подвале',
        'name' => 'logo_footer',
        'type' => 'image',
        'return_format' => 'url',
        'instructions' => 'Если не задан, используется логотип темы.',
      ],
      [
        'key' => 'field_rfc_max_link',
        'label' => 'Ссылка на MAX',
        'name' => 'max_link',
        'type' => 'url',
        'instructions' => 'Иконка MAX показывается в шапке и подвале, '
          . 'только если ссылка заполнена.',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'main',
        ],
      ],
    ],
    'menu_order' => 10,
  ]);

  acf_add_local_field_group([
    'key' => 'group_rfc_hero_link',
    'title' => 'RFC Hero: ссылка кнопки',
    'fields' => [
      [
        'key' => 'field_rfc_hero_button_link',
        'label' => 'Ссылка кнопки',
        'name' => 'button_link',
        'type' => 'text',
        'instructions' => 'Якорь на странице (например, #shift) '
          . 'или полный адрес.',
        'placeholder' => '#shift',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/rfc-hero',
        ],
      ],
    ],
    'menu_order' => 10,
  ]);

  acf_add_local_field_group([
    'key' => 'group_rfc_trial_form_texts',
    'title' => 'RFC Форма пробного периода: тексты',
    'fields' => [
      [
        'key' => 'field_rfc_trial_form_title',
        'label' => 'Заголовок',
        'name' => 'trial_title',
        'type' => 'text',
        'placeholder' => 'Попробуй бесплатно!',
      ],
      [
        'key' => 'field_rfc_trial_form_subtitle',
        'label' => 'Подзаголовок',
        'name' => 'trial_subtitle',
        'type' => 'textarea',
        'rows' => 2,
        'new_lines' => '',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/rfc-trial-form',
        ],
      ],
    ],
    'menu_order' => 10,
  ]);
}
add_action('acf/init', 'rfc_register_content_acf_fields');

/**
 * URL логотипа из опций или файл темы по умолчанию
 */
function rfc_get_logo_url($field, $fallback_file) {
  $url = get_field($field, 'option');

  return $url ?: get_template_directory_uri() . '/images/' . $fallback_file;
}

/**
 * Ссылка на WhatsApp: номер из опций, иначе основной телефон
 */
function rfc_get_whatsapp_link() {
  $number = get_field('whatsapp_number', 'option')
    ?: get_field('phone_number', 'option');
  $digits = preg_replace('/\D+/', '', (string) $number);

  return $digits ? 'https://wa.me/' . $digits : '';
}
