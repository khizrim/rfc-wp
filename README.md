# 🤖 RFC — Robot Fight Club Russia

🔗 [rfc.khizrim.online](https://rfc.khizrim.online)

Лендинг сайта **Robot Fight Club Russia**, реализованный на WordPress с кастомной темой. Проект разворачивается в Docker-контейнерах, использует Makefile для разработки и GitHub Actions для автоматического деплоя.

---

## 📆 Стек

- WordPress + MariaDB
- Docker / Docker Compose
- GitHub Actions
- Makefile-утилиты
- Кастомная тема + плагины
- Хранение бэкапов, плагинов и данных в `export/`

---

## 🛠 ️ Локальная разработка

1. Склонируй репозиторий и создай `.env` на основе `.env.example`
2. Запусти:

```bash
make setup
```

Это автоматически:

- создаст нужные директории,
- соберёт и запустит контейнеры,
- дождётся базы,
- восстановит базу и плагины (если есть в `export/`).

---

## ⚙️ Основные команды Makefile

| Команда             | Описание                                   |
| ------------------- | ------------------------------------------ |
| `make up`           | Запуск контейнеров                         |
| `make down`         | Остановка и удаление                       |
| `make logs`         | Логи docker-compose                        |
| `make backup`       | Сохранение базы в `export/backup.sql.gz`   |
| `make restore`      | Восстановление из backup                   |
| `make sync-plugins` | Установка плагинов из `export/plugins.tgz` |
| `make extract`      | Экспорт БД и плагинов                      |
| `make clean`        | Чистка ненужных тем и плагинов             |
| `make doom`         | 💀 Полная очистка всего проекта            |

---

## 🌐 Конфигурация

Все настройки хранятся в `.env`: пароли, URL, соли, доступы. Они подгружаются в `wp-config.php` даже внутри WordPress.

Пример `.env`:

```dotenv
# 🔐 Настройки базы данных
MYSQL_ROOT_PASSWORD=supersecret
MYSQL_DATABASE=rfc
MYSQL_USER=rfc
MYSQL_PASSWORD=rfc

# ⚙️ Настройки WordPress
WORDPRESS_DB_HOST=rfc-db:3306
WORDPRESS_DB_NAME=rfc
WORDPRESS_DB_USER=rfc
WORDPRESS_DB_PASSWORD=rfc
WORDPRESS_TABLE_PREFIX=rfc_
WORDPRESS_LANGUAGE=ru_RU

WP_DEBUG=true
WP_AUTO_UPDATE_CORE=true
DISALLOW_FILE_EDIT=false

# 🌐 URL сайта
WP_HOME=http://localhost:3000
WP_SITEURL=http://localhost:3000

# 🐳 Docker
DOCKERFILE=local.Dockerfile

# 🔑 Секретные ключи и соли
AUTH_KEY='your-auth-key'
SECURE_AUTH_KEY='your-secure-auth-key'
LOGGED_IN_KEY='your-logged-in-key'
NONCE_KEY='your-nonce-key'
AUTH_SALT='your-auth-salt'
SECURE_AUTH_SALT='your-secure-auth-salt'
LOGGED_IN_SALT='your-logged-in-salt'
NONCE_SALT='your-nonce-salt'
```

---

## 🚀 Деплой

Происходит при пуше в `master` с помощью GitHub Actions. База резервируется, код копируется на сервер, контейнеры перезапускаются.

---

## 📁 Структура

- `themes/` — кастомная тема
- `plugins/` — используемые плагины
- `data/` — том базы данных
- `export/` — бэкапы, архивы плагинов
- `Makefile` — команды для работы
- `wp-config.php` — конфиг WordPress с .env
- `docker-compose.yml` — запуск контейнеров

---

## 🛡️ Возможные проблемы

- Проверь `.env`
- Убедись, что MariaDB доступна (`make wait-for-db`)
- Проверь права на директории (`chmod`, `chown`)
- Убедись, что имена контейнеров совпадают с Makefile

---
