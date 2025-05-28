<?php

// 🔄 Универсальная функция для чтения переменных окружения и *_FILE
if (!function_exists('getenv_docker')) {
  function getenv_docker($env, $default = null) {
    $fileEnv = getenv($env . '_FILE');
    if ($fileEnv && file_exists($fileEnv)) {
      return rtrim(file_get_contents($fileEnv), "\r\n");
    } elseif (($val = getenv($env)) !== false) {
      return $val;
    } else {
      return $default;
    }
  }
}

// 📦 Настройки базы данных
define('DB_NAME',     getenv_docker('WORDPRESS_DB_NAME', 'wordpress'));
define('DB_USER',     getenv_docker('WORDPRESS_DB_USER', 'user'));
define('DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'password'));
define('DB_HOST',     getenv_docker('WORDPRESS_DB_HOST', 'mysql'));
define('DB_CHARSET',  'utf8mb4');
define('DB_COLLATE',  '');

// 🌐 Язык интерфейса
define('WPLANG', getenv_docker('WORDPRESS_LANGUAGE', 'ru_RU'));

// ⚙️ Настройки кэша
define('WP_CACHE', filter_var(getenv_docker('WORDPRESS_CACHE', true), FILTER_VALIDATE_BOOLEAN));
define('WPCACHEHOME', getenv_docker('WPCACHEHOME', '/var/www/html/wp-content/plugins/wp-super-cache/'));


// 🌍 URL сайта
define('WP_HOME',    getenv_docker('WP_HOME', 'https://rfc.khizrim.online'));
define('WP_SITEURL', getenv_docker('WP_SITEURL', 'https://rfc.khizrim.online'));

// 🔐 Уникальные ключи и соли безопасности
define('AUTH_KEY',         getenv_docker('WP_AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv_docker('WP_SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv_docker('WP_LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv_docker('WP_NONCE_KEY'));
define('AUTH_SALT',        getenv_docker('WP_AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv_docker('WP_SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv_docker('WP_LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv_docker('WP_NONCE_SALT'));

// 🔒 Защита и стабильность
define('DISALLOW_FILE_EDIT',     filter_var(getenv_docker('DISALLOW_FILE_EDIT', false), FILTER_VALIDATE_BOOLEAN));
define('WP_AUTO_UPDATE_CORE',    getenv_docker('WP_AUTO_UPDATE_CORE', 'minor'));
define('WP_DEBUG',               filter_var(getenv_docker('WP_DEBUG', false), FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_DISPLAY',       filter_var(getenv_docker('WP_DEBUG_DISPLAY', false), FILTER_VALIDATE_BOOLEAN));
define('WP_POST_REVISIONS', 0); // Отключаем ревизии

// 📋 Префикс таблиц базы данных
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

// ☁️ HTTPS через прокси
if (
  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
  $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'
) {
  $_SERVER['HTTPS'] = 'on';
}

// 🚀 Запуск WordPress
if (!defined('ABSPATH')) {
  define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';
