.PHONY: all setup doom extract build up stop down update-image import-db setup-plugins \
        import-plugins upgrade-plugins activate-plugins extract-plugins extract-data \
        extract-uploads build-image reset clean init-dirs logs shell dbshell wait-for-db check-env

include .env
export

DOCKERFILE ?= Dockerfile
export DOCKERFILE

# -----------------
#     VARIABLES
# -----------------

WP_CONTAINER     = rfc-wp
DB_CONTAINER     = rfc-db

PLUGINS          = ./plugins
THEMES           = ./themes
DATA             = ./data
TEMP             = ./temp
EXPORT           = ./export
UPLOADS          = ./uploads

WP_DUMP          = $(EXPORT)/backup.sql.gz

WP_CLI           = docker-compose exec -T $(WP_CONTAINER) wp
MYSQL_CLI        = docker-compose exec -T $(DB_CONTAINER) mariadb
MYSQL_DUMP_CLI   = docker-compose exec -T $(DB_CONTAINER) mariadb-dump

# -----------------
#     SHORTCUTS
# -----------------

up: check-env init-dirs
	@echo "🚀 Сборка и запуск проекта..."
	docker-compose up -d
	@echo "⏳ Ожидание готовности сервисов..."
	@until docker-compose ps | grep -q "healthy"; do \
		echo "⌛ Ожидание готовности сервисов..."; \
		sleep 5; \
	done
	@echo "✅ Сервисы готовы!"

down:
	docker-compose down

stop:
	docker-compose stop

logs:
	docker-compose logs -f

update-image:
	docker-compose build
	docker-compose up -d

init-dirs:
	@mkdir -p $(PLUGINS) $(THEMES) $(DATA) $(TEMP) $(EXPORT) $(UPLOADS)

check-env:
	@if [ ! -f .env ]; then \
		echo "❌ Файл .env не найден!"; \
		exit 1; \
	fi
	@if [ ! -f wp-config.php ]; then \
		echo "❌ Файл wp-config.php не найден!"; \
		exit 1; \
	fi

# -----------------
#     SETUP
# -----------------

setup: check-env init-dirs up
	@echo "🔄 Настройка WordPress..."
	@if ! $(WP_CLI) core is-installed --allow-root; then \
		echo "📦 Установка WordPress..."; \
		$(WP_CLI) core install --url=localhost:3000 --title="RFC Camp" --admin_user=admin --admin_password=admin --admin_email=admin@example.com --allow-root; \
	fi
	make restore
	make sync-plugins
	make clean
	@echo "✅ Проект готов к работе."

# -----------------
#     BACKUP & RESTORE
# -----------------

backup:
	@echo "💾 Создание резервной копии базы данных..."
	@mkdir -p $(EXPORT)
	$(MYSQL_DUMP_CLI) -u root -p"$(MYSQL_ROOT_PASSWORD)" $(MYSQL_DATABASE) --skip-comments 2>/dev/null | gzip - -c > $(WP_DUMP)
	@echo "✅ Резервная копия базы создана: $(WP_DUMP)"
	@echo "💾 Архивирование изображений..."
	tar cfz $(EXPORT)/uploads.tgz -C $(UPLOADS) .
	@echo "✅ Изображения заархивированы: $(EXPORT)/uploads.tgz"

restore:
	@if [ -f $(WP_DUMP) ]; then \
		echo "♻️  Восстановление базы из $(WP_DUMP)..."; \
		cat $(WP_DUMP) | gzip -d - -c | $(MYSQL_CLI) -u root -p"$(MYSQL_ROOT_PASSWORD)" $(MYSQL_DATABASE); \
		echo "✅ База данных восстановлена."; \
	else \
		echo "⚠️  Файл $(WP_DUMP) не найден. Пропуск восстановления базы."; \
	fi
	@if [ -f $(EXPORT)/uploads.tgz ]; then \
		echo "♻️  Восстановление изображений из $(EXPORT)/uploads.tgz..."; \
		mkdir -p $(UPLOADS); \
		tar xfz $(EXPORT)/uploads.tgz -C $(UPLOADS); \
		echo "✅ Изображения восстановлены."; \
	else \
		echo "⚠️  Файл $(EXPORT)/uploads.tgz не найден. Пропуск восстановления изображений."; \
	fi

# -----------------
#     PLUGINS
# -----------------

sync-plugins:
	@if [ -f $(EXPORT)/plugins.tgz ]; then \
		echo "📦 Установка плагинов из $(EXPORT)/plugins.tgz..."; \
		mkdir -p $(PLUGINS); \
		tar -xzf $(EXPORT)/plugins.tgz -C $(PLUGINS); \
		for dir in $(PLUGINS)/*; do \
			if [ -d "$$dir" ]; then \
				name=$$(basename $$dir); \
				$(WP_CLI) plugin activate "$$name" --allow-root || true; \
			fi; \
		done; \
		echo "✅ Плагины синхронизированы."; \
	else \
		echo "⚠️  Архив $(EXPORT)/plugins.tgz не найден. Пропускаем установку плагинов."; \
	fi

# -----------------
#     EXTRACT
# -----------------

extract: extract-plugins extract-data extract-uploads

extract-plugins:
	@echo "📦 Архивирование плагинов..."
	tar cfz $(EXPORT)/plugins.tgz -C $(PLUGINS) .
	@echo "✅ Плагины заархивированы."

extract-data: backup

extract-uploads:
	@echo "📦 Архивирование изображений..."
	tar cfz $(EXPORT)/uploads.tgz -C $(UPLOADS) .
	@echo "✅ Изображения заархивированы."

# -----------------
#     BUILD
# -----------------

build-image: stop clean
	@echo "🏗️  Сборка Docker образа..."
	docker build -t business-secrets-wordpress .
	@echo "✅ Образ собран."

# -----------------
#     CLEANUP
# -----------------

reset:
	@echo "🧹 Очистка данных..."
	rm -rf $(DATA) $(PLUGINS) $(TEMP) $(UPLOADS)
	@echo "✅ Данные очищены."

clean:
	@echo "🧹 Удаление стандартных тем и плагинов..."
	rm -rf $(THEMES)/twentytwentyfour \
	       $(THEMES)/twentytwentythree
	rm -rf $(PLUGINS)/akismet
	rm -rf $(PLUGINS)/hello.php
	@echo "✅ Очистка завершена."

doom:
	@echo "💀 Удаление всех данных..."
	docker-compose down -v --remove-orphans
	make clean reset
	@echo "✅ Все данные удалены."

# -----------------
#     UTILITIES
# -----------------

shell:
	docker exec -it $(WP_CONTAINER) bash

dbshell:
	docker exec -it $(DB_CONTAINER) bash

all:
	@echo "ℹ️  См. README.md для подробностей использования."
