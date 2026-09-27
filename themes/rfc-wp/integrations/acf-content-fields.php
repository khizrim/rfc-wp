<?php

/**
 * Хелперы для ACF-полей сайта. Сами группы полей («Настройки главной»
 * и дополнительные поля блоков) живут в БД и импортируются в ACF из
 * export/acf/acf-import.json.
 */

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
