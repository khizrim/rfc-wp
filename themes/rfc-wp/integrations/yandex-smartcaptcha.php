<?php

/**
 * Yandex SmartCaptcha integration for Contact Form 7
 *
 * Keys are managed via a dedicated ACF options page registered below:
 * - smartcaptcha_client_key
 * - smartcaptcha_server_key
 */

const RFC_SMARTCAPTCHA_WIDGET_URL = 'https://smartcaptcha.yandexcloud.net/captcha.js?render=onload';
const RFC_SMARTCAPTCHA_VALIDATE_URL = 'https://smartcaptcha.yandexcloud.net/validate';

/**
 * Register the SmartCaptcha ACF options page and its key fields
 */
function rfc_register_smartcaptcha_acf() {
  if (!function_exists('acf_add_options_page') || !function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_options_page([
    'page_title' => 'Yandex SmartCaptcha',
    'menu_title' => 'SmartCaptcha',
    'menu_slug' => 'rfc-smartcaptcha-settings',
    'capability' => 'manage_options',
  ]);

  acf_add_local_field_group([
    'key' => 'group_rfc_smartcaptcha',
    'title' => 'Yandex SmartCaptcha',
    'fields' => [
      [
        'key' => 'field_rfc_smartcaptcha_client_key',
        'label' => 'Client key',
        'name' => 'smartcaptcha_client_key',
        'type' => 'text',
      ],
      [
        'key' => 'field_rfc_smartcaptcha_server_key',
        'label' => 'Server key',
        'name' => 'smartcaptcha_server_key',
        'type' => 'text',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'rfc-smartcaptcha-settings',
        ],
      ],
    ],
  ]);
}
add_action('acf/init', 'rfc_register_smartcaptcha_acf');

/**
 * Get the configured SmartCaptcha keys, or null if either key is missing
 */
function rfc_smartcaptcha_keys() {
  static $keys = null;

  if ($keys === null) {
    $client = get_field('smartcaptcha_client_key', 'option');
    $server = get_field('smartcaptcha_server_key', 'option');
    $keys = ($client && $server) ? ['client' => $client, 'server' => $server] : false;
  }

  return $keys ?: null;
}

/**
 * Enqueue the SmartCaptcha widget script
 */
function rfc_enqueue_smartcaptcha_script() {
  if (!rfc_smartcaptcha_keys()) {
    return;
  }

  wp_enqueue_script('yandex-smartcaptcha', RFC_SMARTCAPTCHA_WIDGET_URL, [], null, true);
}
add_action('wp_enqueue_scripts', 'rfc_enqueue_smartcaptcha_script');

/**
 * Append the SmartCaptcha widget to every Contact Form 7 form
 */
function rfc_add_smartcaptcha_to_form($elements) {
  $keys = rfc_smartcaptcha_keys();

  if (!$keys) {
    return $elements;
  }

  $client_key = esc_attr($keys['client']);
  $elements .= "<div class=\"smart-captcha\" data-sitekey=\"{$client_key}\"></div>";

  return $elements;
}
add_filter('wpcf7_form_elements', 'rfc_add_smartcaptcha_to_form');

/**
 * Validate the SmartCaptcha token server-side and mark the submission as spam if it fails
 */
function rfc_validate_smartcaptcha_spam($spam) {
  $keys = rfc_smartcaptcha_keys();

  if ($spam || !$keys) {
    return $spam;
  }

  $token = isset($_POST['smart-token']) ? sanitize_text_field($_POST['smart-token']) : '';

  if (!$token) {
    return true;
  }

  $query = http_build_query([
    'secret' => $keys['server'],
    'token' => $token,
    'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
  ]);

  $response = wp_remote_get(RFC_SMARTCAPTCHA_VALIDATE_URL . "?{$query}", ['timeout' => 3]);

  if (is_wp_error($response)) {
    return true;
  }

  $body = json_decode(wp_remote_retrieve_body($response), true);

  return !isset($body['status']) || $body['status'] !== 'ok';
}
add_filter('wpcf7_spam', 'rfc_validate_smartcaptcha_spam');
