env=dev
user := $(shell id -u)
group := $(shell id -g)
whoami := $(shell whoami)
container_php=php
dc=docker-compose
dr := $(dc) run --rm --user "$(user):$(group)" --entrypoint ""
de := $(dc) exec
php_exec := $(de) $(container_php)
node_exec := $(de) $(container_php)
php := $(dr) $(container_php)
node := $(dr) $(container_php)
symfony := $(php_exec) bin/console

export env compose container_php

.DEFAULT_GOAL := help
.PHONY: help
help: ## Aide
	@cat $(MAKEFILE_LIST) | sort -t, -k3r | grep -e "^[a-zA-Z_\-\.]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: console
console: docker.start
	$(php_exec) bash

.PHONY: init
init: ## initialise le projet
	$(dc) up -d --build
	$(php) composer install
	$(symfony) doctrine:database:create --if-not-exists
	$(symfony) doctrine:migrations:migrate --no-interaction
	$(symfony) app:import-all
	$(symfony) doctrine:fixtures:load --append
	$(node) yarn dev

.PHONY: watch
watch: public/build
	-$(node) yarn build:watch

.PHONY: db.reset
db.reset:  ## DB reset (drop+create+migrate)
	$(symfony) doctrine:database:drop --force --if-exists
	$(symfony) doctrine:database:create --if-not-exists
	$(symfony) doctrine:migrations:migrate --no-interaction

.PHONY: clear.all
clear.all: ## Clear de tous les caches existants
	$(php_exec) sh -c 'rm -rf var/cache/*'
	make clear.orm

.PHONY: clear.sf
clear.sf: ## Clear du cahe Symfony
	$(php_exec) sh -c 'rm -rf var/cache/*;chmod -R 777 var'

.PHONY: clear.orm
clear.orm: ## Clear du cahe ORM only
	$(symfony) doctrine:cache:clear-query
	$(symfony) doctrine:cache:clear-metadata
	$(symfony) doctrine:cache:clear-result

