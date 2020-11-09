include .env
# Vars
CONTAINER_PREFIX = "${APP_PREFIX}"

help: ## Help menu
	@echo "App Tasks"
	@cat $(MAKEFILE_LIST) | pcregrep -o -e "^([\w]*):\s?##(.*)"
	@echo

ssh: ## connect to fpm container
	docker exec -it $(CONTAINER_PREFIX)-fpm ash

start: ## starts docker compose
	docker-compose -f docker-compose.yml up

restart: ## starts docker compose
	docker-compose restart

stop: ## stops all containers
	docker-compose stop

composer-optimized: ## runs an optimized no-dev composer install
	composer install --apcu-autoloader --optimize-autoloader

atlas: ## builds the Atlas php orm files
	./vendor/bin/atlas-skeleton.php ./config/settings.php settings.atlas

copy-id_rsa: ## copies local id_rsa to server
	 scp ~/.ssh/id_rsa.pub majyvm29gtia@107.180.44.147:.ssh/authorized_keys

copy-env: ## copies local id_rsa to server
	 scp prod.env fivetale@mi3-ls12.a2hosting.com:~/angelbudget.fivetalents.software/cake-angelbudget/.env -p 7822

prod: ## ssh into prod server
	ssh fivetale@mi3-ls12.a2hosting.com -p 7822
