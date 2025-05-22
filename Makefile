.PHONY: all setup doom extract build up stop down update-image import-db setup-plugins \
        import-plugins upgrade-plugins activate-plugins extract-plugins extract-data \
        build-image reset clean init-dirs logs shell dbshell wait-for-db

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

WP_DUMP          = $(EXPORT)/backup.sql.gz

WP_CLI           = docker-compose exec -T $(WP_CONTAINER) wp
MYSQL_CLI        = docker-compose exec -T $(DB_CONTAINER) mariadb
MYSQL_DUMP_CLI   = docker-compose exec -T $(DB_CONTAINER) mariadb-dump

# -----------------
#     SHORTCUTS
# -----------------

up: init-dirs
	@echo "🚀 Сборка и запуск проекта..."
	docker-compose up -d

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
	@mkdir -p $(PLUGINS) $(THEMES) $(DATA) $(TEMP)

wait-for-db:
	@echo "⏳ Ожидание доступности базы данных..."
	@until $(MYSQL_CLI) -u root -p"$(MYSQL_ROOT_PASSWORD)" -e "SHOW DATABASES;" >/dev/null 2>&1; do \
		echo "⌛ MariaDB ещё не готова..."; \
		sleep 2; \
	done

# -----------------
#     SETUP
# -----------------

setup: init-dirs up wait-for-db
	make restore
	make sync-plugins
	make clean
	@echo "✅ Проект готов к работе."

# -----------------
#     BACKUP & RESTORE
# -----------------

backup:
	$(MYSQL_DUMP_CLI) -u root -p"$(MYSQL_ROOT_PASSWORD)" $(MYSQL_DATABASE) --skip-comments 2>/dev/null | gzip - -c > $(WP_DUMP)

restore:
	@if [ -f $(WP_DUMP) ]; then \
		echo "♻️  Восстановление базы из $(WP_DUMP)..."; \
		cat $(WP_DUMP) | gzip -d - -c | $(MYSQL_CLI) -u root -p"$(MYSQL_ROOT_PASSWORD)" $(MYSQL_DATABASE); \
	else \
		echo "⚠️  Файл $(WP_DUMP) не найден. Пропуск восстановления."; \
	fi

# -----------------
#     PLUGINS
# -----------------

sync-plugins:
	@if [ -f $(EXPORT)/plugins.tgz ]; then \
		echo "📦 Установка плагинов из $(EXPORT)/plugins.tgz..."; \
		mkdir -p $(PLUGINS); \
		tar -xzf $(EXPORT)/plugins.tgz; \
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

extract: extract-plugins backup

extract-plugins:
	tar cfz $(EXPORT)/plugins.tgz $(PLUGINS)

extract-data: backup

# -----------------
#     BUILD
# -----------------

build-image: stop clean
	docker build --target prod_image -t business-secrets-wordpress .

# -----------------
#     CLEANUP
# -----------------

reset:
	rm -rf $(DATA) $(PLUGINS) $(TEMP)

clean:
	rm -rf $(THEMES)/twentytwentyfour \
	       $(THEMES)/twentytwentythree
	rm -rf $(PLUGINS)/akismet
	rm -rf $(PLUGINS)/hello.php

doom:
	docker-compose down -v --remove-orphans
	make clean reset
	@echo "💀 Все данные удалены."

# -----------------
#     UTILITIES
# -----------------

shell:
	docker exec -it $(WP_CONTAINER) bash

dbshell:
	docker exec -it $(DB_CONTAINER) bash

all:
	@echo "ℹ️  См. README.md для подробностей использования."
