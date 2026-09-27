<?php

/**
 * ACF-поля для текстов и ссылок сайта: группа «Настройки главной» на
 * странице опций «main» и дополнительные поля блоков. Если поле не
 * заполнено, шаблоны выводят прежнее значение.
 */

function rfc_register_content_acf_fields() {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  // Группа «Настройки главной» раньше жила только в БД. Ключи группы
  // и полей совпадают с прежними, поэтому сохранённые значения на месте.
  acf_add_local_field_group([
    'key' => 'group_homepage_settings',
    'title' => 'Настройки главной',
    'fields' => [
      rfc_acf_tab('contacts', 'Контакты'),
      [
        'key' => 'field_phone_number',
        'label' => 'Номер телефона',
        'name' => 'phone_number',
        'type' => 'text',
        'instructions' => 'В международном формате, например +7 925 000 00 00.',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_6889cf4f5b621',
        'label' => 'Номер WhatsApp',
        'name' => 'whatsapp_number',
        'type' => 'text',
        'instructions' => 'Если пусто, используется номер телефона.',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_685532fcf5f67',
        'label' => 'Email',
        'name' => 'email',
        'type' => 'email',
        'instructions' => 'Показывается в подвале.',
      ],

      rfc_acf_tab('socials', 'Соцсети и мессенджеры'),
      [
        'key' => 'field_6889cf5d5b622',
        'label' => 'Telegram-чат',
        'name' => 'telegram_chat_link',
        'type' => 'url',
        'instructions' => 'Иконка Telegram в шапке и мобильном меню.',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_telegram_link',
        'label' => 'Telegram-канал',
        'name' => 'telegram_link',
        'type' => 'url',
        'instructions' => 'Иконка Telegram в подвале.',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_rfc_max_link',
        'label' => 'MAX',
        'name' => 'max_link',
        'type' => 'url',
        'instructions' => 'Иконка в шапке, мобильном меню и подвале.',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_vk_link',
        'label' => 'ВКонтакте',
        'name' => 'vk_link',
        'type' => 'url',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_685532def5f65',
        'label' => 'Дзен',
        'name' => 'zen_link',
        'type' => 'url',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_685532eef5f66',
        'label' => 'Rutube',
        'name' => 'rutube_link',
        'type' => 'url',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_rfc_socials_note',
        'label' => '',
        'name' => '',
        'type' => 'message',
        'message' => 'Иконка соцсети скрывается, если ссылка пустая.',
      ],

      rfc_acf_tab('header', 'Шапка'),
      [
        'key' => 'field_68893e99e15db',
        'label' => 'Возрастное ограничение',
        'name' => 'age_limit',
        'type' => 'number',
        'instructions' => 'Показывается как «7+» в шапке и мобильном меню.',
        'min' => 0,
        'append' => '+',
        'wrapper' => ['width' => 33],
      ],
      [
        'key' => 'field_6889d23d44d72',
        'label' => 'Текст кнопки',
        'name' => 'cta_button_text',
        'type' => 'text',
        'placeholder' => 'Выбрать смену',
        'wrapper' => ['width' => 33],
      ],
      [
        'key' => 'field_rfc_header_button_link',
        'label' => 'Ссылка кнопки',
        'name' => 'header_button_link',
        'type' => 'text',
        'instructions' => 'Якорь на странице (например, #shift) '
          . 'или полный адрес.',
        'placeholder' => '#shift',
        'wrapper' => ['width' => 34],
      ],

      rfc_acf_tab('logos', 'Логотипы'),
      [
        'key' => 'field_rfc_logo_header',
        'label' => 'Логотип в шапке',
        'name' => 'logo_header',
        'type' => 'image',
        'return_format' => 'url',
        'instructions' => 'Также в карточках наставников. '
          . 'Если не задан, используется логотип темы.',
        'wrapper' => ['width' => 50],
      ],
      [
        'key' => 'field_rfc_logo_footer',
        'label' => 'Логотип в подвале',
        'name' => 'logo_footer',
        'type' => 'image',
        'return_format' => 'url',
        'instructions' => 'Если не задан, используется логотип темы.',
        'wrapper' => ['width' => 50],
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
 * Поле-вкладка для группы ACF
 */
function rfc_acf_tab($id, $label) {
  return [
    'key' => 'field_rfc_tab_' . $id,
    'label' => $label,
    'name' => '',
    'type' => 'tab',
    'placement' => 'top',
  ];
}

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
